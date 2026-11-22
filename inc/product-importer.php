<?php
/**
 * 1-Click CSV Product Bulk Importer Module
 * Zero-Plugin, 100% Free Bulk Product Importer with Dynamic ACF Sync for Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * 1. Register Submenu under "Products"
 */
function gbh_register_product_importer_menu()
{
    add_submenu_page(
        'edit.php?post_type=product',
        'Bulk Import Products (CSV)',
        'Import CSV',
        'manage_options',
        'gbh-product-importer',
        'gbh_render_product_importer_page'
    );
}
add_action('admin_menu', 'gbh_register_product_importer_menu');

/**
 * 2. Helpers: CSV Normalization, Friendly Aliases & Dynamic ACF Discovery
 */
function gbh_normalize_csv_header($name)
{
    $name = strval($name);
    // Strip UTF-8 BOM (often added by Microsoft Excel "CSV UTF-8")
    $name = preg_replace('/^\x{FEFF}/u', '', $name);
    $name = preg_replace('/^\xEF\xBB\xBF/', '', $name);
    $name = strtolower(trim($name));
    return str_replace(array(' ', '-', '_'), '', $name);
}

/**
 * Known friendly CSV column aliases mapped by canonical ACF/meta field key.
 */
function gbh_get_product_csv_field_aliases()
{
    return array(
        'product_price' => array('Regular_Price', 'Price', 'MRP'),
        'product_offer_price' => array('Offer_Price', 'Sale_Price'),
        'discount_label' => array('Discount_Badge', 'Badge'),
        '_sku' => array('SKU'),
        '_stock_status' => array('Stock_Status'),
        'stock_quantity' => array('Stock_Quantity', 'Stock', 'Quantity'),
        'number_of_seeds' => array('Pack_Size', 'Seeds_Count', 'Pack'),
        'seed_type' => array('Seed_Type', 'Variety', 'Type'),
        'sowing_season' => array('Sowing_Season', 'Season'),
        'germination_temperature' => array('Germination_Temperature', 'Germ_Temp'),
        'germination_time' => array('Germination_Time', 'Germ_Time'),
        'first_harvest' => array('First_Harvest', 'Harvest_Days'),
        'container_pot_size' => array('Container_Pot_Size', 'Pot_Size'),
        'growing_level' => array('Growing_Level', 'Difficulty'),
        'how_to_grow' => array('How_To_Grow'),
        'plant_care_tips' => array('Plant_Care_Tips', 'Care_Tips'),
        'pests_and_diseases' => array('Pests_And_Diseases', 'Pests'),
        'harvesting_guide' => array('Harvesting_Guide'),
        'product_image_1' => array('Gallery_Image_1', 'Image_2'),
        'product_image_2' => array('Gallery_Image_2', 'Image_3'),
        'product_image_3' => array('Gallery_Image_3', 'Image_4'),
        'product_image_4' => array('Gallery_Image_4', 'Image_5'),
        'product_image_5' => array('Gallery_Image_5', 'Image_6'),
    );
}

/**
 * Dynamically fetch all active ACF input fields attached to the 'product' CPT.
 * Automatically picks up any new fields created later in WP Admin -> ACF -> Field Groups.
 */
function gbh_get_product_acf_fields()
{
    $fields_by_name = array();
    $skip_types = array('tab', 'accordion', 'message', 'repeater', 'flexible_content', 'clone', 'group');

    if (function_exists('acf_get_field_groups') && function_exists('acf_get_fields')) {
        $groups = acf_get_field_groups(array('post_type' => 'product'));
        if (!empty($groups) && is_array($groups)) {
            foreach ($groups as $group) {
                $group_fields = acf_get_fields($group);
                if (empty($group_fields) || !is_array($group_fields)) {
                    continue;
                }
                foreach ($group_fields as $field) {
                    if (empty($field['name']) || in_array($field['type'], $skip_types, true)) {
                        continue;
                    }
                    if (!isset($fields_by_name[$field['name']])) {
                        $fields_by_name[$field['name']] = array(
                            'key' => isset($field['key']) ? $field['key'] : '',
                            'name' => $field['name'],
                            'label' => isset($field['label']) ? $field['label'] : $field['name'],
                            'type' => isset($field['type']) ? $field['type'] : 'text',
                        );
                    }
                }
            }
        }
    }

    // Fallback to local acf-json if ACF is inactive or returned nothing
    if (empty($fields_by_name)) {
        $json_file = get_stylesheet_directory() . '/acf-json/group_gbh_product_master.json';
        if (file_exists($json_file)) {
            $group = json_decode(file_get_contents($json_file), true);
            if (!empty($group['fields']) && is_array($group['fields'])) {
                foreach ($group['fields'] as $field) {
                    if (empty($field['name']) || in_array($field['type'], $skip_types, true)) {
                        continue;
                    }
                    $fields_by_name[$field['name']] = array(
                        'key' => isset($field['key']) ? $field['key'] : '',
                        'name' => $field['name'],
                        'label' => isset($field['label']) ? $field['label'] : $field['name'],
                        'type' => isset($field['type']) ? $field['type'] : 'text',
                    );
                }
            }
        }
    }

    return array_values($fields_by_name);
}

/**
 * Helper: Download Dynamic CSV Template Synced with All Current ACF Fields
 */
function gbh_handle_csv_template_download()
{
    if (!isset($_GET['page']) || $_GET['page'] !== 'gbh-product-importer') {
        return;
    }
    if (!isset($_GET['gbh_download_template']) || $_GET['gbh_download_template'] !== '1') {
        return;
    }
    if (!current_user_can('manage_options') || !check_admin_referer('gbh_download_template_nonce')) {
        wp_die('Unauthorized request.');
    }

    $aliases = gbh_get_product_csv_field_aliases();
    $acf_fields = gbh_get_product_acf_fields();

    $headers = array(
        'Product_Name',
        'Category',
        'Sub_Category',
        'Main_Image_URL',
        'Short_Description',
        'Full_Description',
    );

    $sample_values = array(
        'Product_Name' => 'Cherry Tomato Seed Pack',
        'Category' => 'Seeds',
        'Sub_Category' => 'Vegetables',
        'Main_Image_URL' => 'https://www.gardenbaskethubb.com/wp-content/uploads/2026/03/sample.jpg',
        'Short_Description' => 'High-germination heirloom seeds ideal for pots & balconies.',
        'Full_Description' => '<p>Complete growing instructions and product details.</p>',
    );

    $example_by_meta = array(
        'product_price' => '249',
        'product_offer_price' => '199',
        'discount_label' => '20% OFF',
        '_sku' => 'GBH-SAMPLE-01',
        '_stock_status' => 'instock',
        'stock_quantity' => '100',
        'number_of_seeds' => '50+ Seeds',
        'seed_type' => '100% Heirloom Non-GMO',
        'sowing_season' => 'All Seasons',
        'germination_temperature' => '18-28 °C',
        'germination_time' => '7-10 Days',
        'first_harvest' => '60-75 Days',
        'container_pot_size' => '12x12 inch Grow Bag',
        'growing_level' => 'Easy (Beginner Friendly)',
        'how_to_grow' => 'Sow seeds 1-2 cm deep in well-draining potting mix.',
        'plant_care_tips' => 'Provide 6-8 hours of daily sunlight.',
        'pests_and_diseases' => 'Spray Neem oil every 15 days.',
        'harvesting_guide' => 'Harvest ripe red cherry tomatoes regularly.',
    );

    foreach ($acf_fields as $field) {
        $meta_name = $field['name'];
        // Prefer friendly primary alias for built-in fields; exact ACF name for newly added fields
        $col_header = isset($aliases[$meta_name]) ? $aliases[$meta_name][0] : $meta_name;
        if (!in_array($col_header, $headers, true)) {
            $headers[] = $col_header;
            $sample_values[$col_header] = isset($example_by_meta[$meta_name]) ? $example_by_meta[$meta_name] : '';
        }
    }

    $example_row = array();
    foreach ($headers as $h) {
        $example_row[] = isset($sample_values[$h]) ? $sample_values[$h] : '';
    }

    nocache_headers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="gbh-products-template-' . date('Y-m-d') . '.csv"');

    $out = fopen('php://output', 'w');
    // UTF-8 BOM for clean Excel compatibility
    fwrite($out, "\xEF\xBB\xBF");
    fputcsv($out, $headers);
    fputcsv($out, $example_row);
    fclose($out);
    exit;
}
add_action('admin_init', 'gbh_handle_csv_template_download');

/**
 * 3. Helper: Sideload image from URL to Media Library (with deduplication)
 */
function gbh_sideload_product_image($image_url, $post_id, $desc = '', $set_thumbnail = true)
{
    $image_url = trim((string) $image_url);
    if (empty($image_url)) {
        return 0;
    }

    // 1. If an Attachment ID was passed directly as integer
    if (is_numeric($image_url)) {
        $existing_id = (int) $image_url;
        if (get_post_type($existing_id) === 'attachment') {
            if ($set_thumbnail) {
                set_post_thumbnail($post_id, $existing_id);
            }
            return $existing_id;
        }
    }

    // 2. Check if image filename already exists in the WordPress Media Library (instant match regardless of domain or upload folder)
    $clean_url = strtok($image_url, '?');
    $filename = wp_basename($clean_url);
    if ($filename && preg_match('/\.(jpe?g|png|webp|gif|svg)$/i', $filename)) {
        global $wpdb;
        $att_id = $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta 
             WHERE meta_key = '_wp_attached_file' 
             AND (meta_value = %s OR meta_value LIKE %s) 
             ORDER BY post_id DESC LIMIT 1",
            $filename,
            '%/' . $wpdb->esc_like($filename)
        ));
        if ($att_id) {
            $existing_id = (int) $att_id;
            if ($set_thumbnail) {
                set_post_thumbnail($post_id, $existing_id);
            }
            return $existing_id;
        }
    }

    // If relative path like /wp-content/uploads/..., prepend site_url
    if (strpos($image_url, '/wp-content/uploads/') === 0) {
        $image_url = site_url($image_url);
    }

    // 3. Check if the image matches by exact URL in the Media Library
    $existing_id = attachment_url_to_postid($clean_url);
    if (!$existing_id) {
        $existing_id = attachment_url_to_postid($image_url);
    }

    // 4. Check if previously sideloaded from the exact same source URL
    if (!$existing_id) {
        $matched_attachments = get_posts(array(
            'post_type'      => 'attachment',
            'meta_key'       => '_gbh_source_url',
            'meta_value'     => $image_url,
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'post_status'    => 'any',
        ));
        if (!empty($matched_attachments)) {
            $existing_id = (int) $matched_attachments[0];
        }
    }

    // If already exists in Media Library, simply associate it without downloading
    if ($existing_id) {
        if ($set_thumbnail) {
            set_post_thumbnail($post_id, $existing_id);
        }
        return $existing_id;
    }

    if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        return 0;
    }

    // 4. External URL: Sideload download once into Media Library
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $att_id = media_sideload_image($image_url, $post_id, $desc, 'id');
    if (!is_wp_error($att_id) && $att_id) {
        update_post_meta($att_id, '_gbh_source_url', $image_url);
        if ($set_thumbnail) {
            set_post_thumbnail($post_id, $att_id);
        }
        return (int) $att_id;
    }

    return 0;
}

/**
 * Save field safely via ACF (preserving field-key reference) + post_meta fallback.
 */
function gbh_save_acf_or_meta($post_id, $field_name, $field_key, $value)
{
    if (function_exists('update_field') && !empty($field_key)) {
        update_field($field_key, $value, $post_id);
    } else {
        update_post_meta($post_id, $field_name, $value);
    }
}

/**
 * Assign hierarchical Category & Sub-Category cleanly inside 'product_cat'.
 */
function gbh_assign_product_categories($post_id, $category_str, $sub_category_str)
{
    $term_ids = array();
    $parent_id = 0;

    if ($category_str !== '') {
        $cats = array_filter(array_map('trim', explode(',', $category_str)));
        foreach ($cats as $idx => $cat_name) {
            $term = get_term_by('name', $cat_name, 'product_cat');
            if (!$term) {
                $created = wp_insert_term($cat_name, 'product_cat');
                if (!is_wp_error($created) && !empty($created['term_id'])) {
                    $tid = (int) $created['term_id'];
                    $term_ids[] = $tid;
                    if ($idx === 0) {
                        $parent_id = $tid;
                    }
                }
            } else {
                $term_ids[] = (int) $term->term_id;
                if ($idx === 0) {
                    $parent_id = (int) $term->term_id;
                }
            }
        }
    }

    if ($sub_category_str !== '') {
        $subs = array_filter(array_map('trim', explode(',', $sub_category_str)));
        foreach ($subs as $sub_name) {
            $sub_term = get_term_by('name', $sub_name, 'product_cat');
            if (!$sub_term) {
                $args = $parent_id ? array('parent' => $parent_id) : array();
                $created = wp_insert_term($sub_name, 'product_cat', $args);
                if (!is_wp_error($created) && !empty($created['term_id'])) {
                    $term_ids[] = (int) $created['term_id'];
                }
            } else {
                $term_ids[] = (int) $sub_term->term_id;
            }
        }
    }

    if (!empty($term_ids)) {
        wp_set_object_terms($post_id, array_unique($term_ids), 'product_cat', true);
    }
}

/**
 * 4. Render Admin Importer Page & Handle Upload
 */
function gbh_render_product_importer_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $imported_count = 0;
    $updated_count = 0;
    $errors = array();
    $messages = array();

    // Handle Quick Import of the local 12-sample file
    if (isset($_POST['gbh_run_sample_import']) && check_admin_referer('gbh_import_nonce', 'gbh_import_nonce_field')) {
        $sample_file = get_template_directory() . '/exported_products_from_live_site/sample_products_for_client.csv';
        if (file_exists($sample_file)) {
            $res = gbh_process_csv_file($sample_file);
            $imported_count = $res['imported'];
            $updated_count = $res['updated'];
            $errors = $res['errors'];
            $messages[] = "Successfully processed the 12 Sample Products test file!";
        } else {
            $errors[] = "Sample CSV file not found on server.";
        }
    }

    // Handle User Uploaded CSV
    if (isset($_POST['gbh_submit_csv_import']) && check_admin_referer('gbh_import_nonce', 'gbh_import_nonce_field')) {
        if (!empty($_FILES['gbh_csv_file']['tmp_name'])) {
            $csv_path = $_FILES['gbh_csv_file']['tmp_name'];
            $res = gbh_process_csv_file($csv_path);
            $imported_count = $res['imported'];
            $updated_count = $res['updated'];
            $errors = $res['errors'];
            $messages[] = "CSV upload processed successfully!";
        } else {
            $errors[] = "Please select a valid CSV file to upload.";
        }
    }

    $acf_fields = gbh_get_product_acf_fields();
    $aliases = gbh_get_product_csv_field_aliases();
    $download_url = wp_nonce_url(
        admin_url('edit.php?post_type=product&page=gbh-product-importer&gbh_download_template=1'),
        'gbh_download_template_nonce'
    );
    ?>
    <div class="wrap" style="max-width:1040px;">
        <h1 class="wp-heading-inline">Import Products (CSV)</h1>
        <hr class="wp-header-end">
        <p style="font-size:13px;color:#50575e;">
            Upload a CSV file to create or update products in bulk. Column headers map directly to WordPress product fields
            and all active ACF fields on the Product post type.
        </p>

        <?php if (!empty($messages)): ?>
            <div class="notice notice-success is-dismissible">
                <?php foreach ($messages as $msg): ?>
                    <p><strong><?php echo esc_html($msg); ?></strong></p>
                <?php endforeach; ?>
                <p><strong>Created:</strong> <?php echo intval($imported_count); ?> | <strong>Updated:</strong>
                    <?php echo intval($updated_count); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="notice notice-error is-dismissible">
                <?php foreach ($errors as $err): ?>
                    <p><?php echo esc_html($err); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:16px;">

            <!-- Upload Custom CSV -->
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:18px 22px;">
                <h2 style="margin-top:0;font-size:15px;color:#1d2327;border-bottom:1px solid #f0f0f1;padding-bottom:10px;">
                    Upload CSV File
                </h2>
                <form method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field('gbh_import_nonce', 'gbh_import_nonce_field'); ?>
                    <p style="margin-bottom:12px;color:#50575e;">Select a UTF-8 CSV file formatted with the headers below:
                    </p>
                    <input type="file" name="gbh_csv_file" accept=".csv" required
                        style="display:block;margin-bottom:16px;padding:8px;border:1px dashed #c3c4c7;width:100%;background:#f6f7f7;border-radius:3px;">

                    <button type="submit" name="gbh_submit_csv_import" class="button button-primary button-large"
                        style="width:100%;text-align:center;">
                        Run Importer
                    </button>
                </form>
            </div>

            <!-- Template Download & Sample Import -->
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:18px 22px;">
                <h2 style="margin-top:0;font-size:15px;color:#1d2327;border-bottom:1px solid #f0f0f1;padding-bottom:10px;">
                    CSV Template &amp; Sample Data
                </h2>
                <p style="margin-bottom:12px;color:#50575e;">
                    Download a blank template generated from the <strong><?php echo count($acf_fields); ?> active ACF
                        fields</strong> currently configured for Products:
                </p>
                <a href="<?php echo esc_url($download_url); ?>" class="button button-secondary button-large"
                    style="width:100%;text-align:center;margin-bottom:14px;">
                    Download CSV Template
                </a>

                <form method="post" style="border-top:1px solid #f0f0f1;padding-top:12px;">
                    <?php wp_nonce_field('gbh_import_nonce', 'gbh_import_nonce_field'); ?>
                    <button type="submit" name="gbh_run_sample_import" class="button button-secondary"
                        style="width:100%;text-align:center;">
                        Import Sample Products (12 Items)
                    </button>
                </form>
            </div>

        </div>

        <div class="notice notice-info inline" style="margin:18px 0 0 0;padding:10px 14px;">
            <p style="margin:0 0 4px 0;"><strong>Field Mapping Behavior</strong></p>
            <ul style="margin:4px 0 0 18px;list-style:disc;color:#3c434a;">
                <li><strong>Column Order:</strong> Columns are matched by header name, so reordering columns does not affect
                    mapping.</li>
                <li><strong>Blank or Omitted Fields:</strong> Missing columns or empty cells are skipped without overwriting
                    existing product data.</li>
                <li><strong>Custom ACF Fields:</strong> New fields added under <em>ACF &rarr; Field Groups</em> are
                    automatically supported using either the field name or field label as the column header.</li>
            </ul>
        </div>

        <!-- Reference Table: Core Columns + Active ACF Fields -->
        <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:18px 22px;margin-top:18px;">
            <h3 style="margin-top:0;font-size:14px;color:#1d2327;">Supported CSV Column Headers</h3>
            <table class="widefat striped" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th style="font-weight:600;">Column Header</th>
                        <th style="font-weight:600;">Field Label</th>
                        <th style="font-weight:600;">Source / Type</th>
                        <th style="font-weight:600;">Accepted Aliases</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>Product_Name</code></td>
                        <td>Product Title (Required)</td>
                        <td>WordPress Core</td>
                        <td><code>Title</code>, <code>Name</code></td>
                    </tr>
                    <tr>
                        <td><code>Category</code></td>
                        <td>Category</td>
                        <td>Taxonomy (<code>product_cat</code>)</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <td><code>Sub_Category</code></td>
                        <td>Sub-Category</td>
                        <td>Taxonomy (<code>product_cat</code>)</td>
                        <td><code>SubCategory</code></td>
                    </tr>
                    <tr>
                        <td><code>Main_Image_URL</code></td>
                        <td>Featured Image URL</td>
                        <td>Media Library</td>
                        <td><code>Image_URL</code>, <code>Image</code></td>
                    </tr>
                    <tr>
                        <td><code>Short_Description</code></td>
                        <td>Excerpt</td>
                        <td>WordPress Core</td>
                        <td><code>Excerpt</code></td>
                    </tr>
                    <tr>
                        <td><code>Full_Description</code></td>
                        <td>Description</td>
                        <td>WordPress Core</td>
                        <td><code>Description</code>, <code>Content</code></td>
                    </tr>
                    <?php foreach ($acf_fields as $field):
                        $meta_name = $field['name'];
                        $primary_header = isset($aliases[$meta_name]) ? $aliases[$meta_name][0] : $meta_name;
                        $alt_headers = array($meta_name, $field['label']);
                        if (isset($aliases[$meta_name])) {
                            $alt_headers = array_merge($alt_headers, $aliases[$meta_name]);
                        }
                        $alt_headers = array_values(array_diff(array_unique($alt_headers), array($primary_header)));
                        ?>
                        <tr>
                            <td><code><?php echo esc_html($primary_header); ?></code></td>
                            <td><?php echo esc_html($field['label']); ?></td>
                            <td>ACF (<?php echo esc_html($field['type']); ?>)</td>
                            <td><?php echo !empty($alt_headers) ? '<code>' . implode('</code>, <code>', array_map('esc_html', $alt_headers)) . '</code>' : '—'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php
}

/**
 * 5. Core Function: Process CSV and Create/Update Products
 */
function gbh_process_csv_file($filepath)
{
    // Prevent timeout & memory crashes on bulk imports (e.g. 767 products with image downloads)
    if (function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    @ini_set('max_execution_time', '0');
    @ini_set('memory_limit', '512M');

    $imported = 0;
    $updated = 0;
    $errors = array();

    if (!file_exists($filepath) || !is_readable($filepath)) {
        return array('imported' => 0, 'updated' => 0, 'errors' => array('File could not be opened.'));
    }

    $handle = fopen($filepath, 'r');
    if ($handle === false) {
        return array('imported' => 0, 'updated' => 0, 'errors' => array('Failed to read CSV stream.'));
    }

    // Read header row
    $header = fgetcsv($handle);
    if (!$header) {
        fclose($handle);
        return array('imported' => 0, 'updated' => 0, 'errors' => array('CSV file is empty.'));
    }

    // Normalize header names cleanly (including stripping UTF-8 BOM from Excel CSVs)
    $col_map = array();
    foreach ($header as $idx => $name) {
        $clean_name = gbh_normalize_csv_header($name);
        if ($clean_name !== '') {
            $col_map[$clean_name] = $idx;
        }
    }

    // Pre-fetch dynamic ACF fields + friendly aliases once before looping rows
    $acf_fields = gbh_get_product_acf_fields();
    $acf_by_name = array();
    foreach ($acf_fields as $af) {
        $acf_by_name[$af['name']] = $af;
    }
    $field_aliases = gbh_get_product_csv_field_aliases();

    while (($row = fgetcsv($handle)) !== false) {
        if (function_exists('set_time_limit')) {
            @set_time_limit(120);
        }
        if (empty($row) || (count($row) === 1 && trim(strval($row[0])) === '')) {
            continue;
        }

        // Safely read value by candidate header names without confusing '0' for empty
        $get_val = function ($candidates) use ($col_map, $row) {
            if (!is_array($candidates)) {
                $candidates = array($candidates);
            }
            foreach ($candidates as $key) {
                $clean_key = gbh_normalize_csv_header($key);
                if ($clean_key !== '' && isset($col_map[$clean_key]) && array_key_exists($col_map[$clean_key], $row)) {
                    $val = trim(strval($row[$col_map[$clean_key]]));
                    if ($val !== '') {
                        return $val;
                    }
                }
            }
            return '';
        };

        $title = $get_val(array('Product_Name', 'Title', 'Name'));
        if ($title === '') {
            continue;
        }

        $category = $get_val('Category');
        $sub_category = $get_val(array('Sub_Category', 'SubCategory'));
        $img_url = $get_val(array('Main_Image_URL', 'Image_URL', 'Image'));
        $short_desc = $get_val(array('Short_Description', 'Excerpt'));
        if ($short_desc !== '' && function_exists('gbh_clean_text_snippet')) {
            $short_desc = gbh_clean_text_snippet($short_desc);
        }
        $full_desc = $get_val(array('Full_Description', 'Description', 'Content'));
        if ($full_desc !== '' && function_exists('gbh_strip_ai_dom_artifacts')) {
            $full_desc = gbh_strip_ai_dom_artifacts($full_desc);
        }

        // Check if product already exists (by title)
        $existing = null;
        $check_query = get_posts(array(
            'post_type' => 'product',
            'title' => $title,
            'numberposts' => 1,
            'post_status' => 'any',
        ));
        if (!empty($check_query)) {
            $existing = $check_query[0];
        }

        if ($existing) {
            $p_id = $existing->ID;
            // Only overwrite content/excerpt if CSV cell is non-empty
            if ($full_desc !== '' || $short_desc !== '') {
                wp_update_post(array(
                    'ID' => $p_id,
                    'post_content' => $full_desc !== '' ? $full_desc : $existing->post_content,
                    'post_excerpt' => $short_desc !== '' ? $short_desc : $existing->post_excerpt,
                ));
            }
            $updated++;
        } else {
            $p_id = wp_insert_post(array(
                'post_type' => 'product',
                'post_title' => $title,
                'post_content' => $full_desc,
                'post_excerpt' => $short_desc,
                'post_status' => 'publish',
            ));
            if (is_wp_error($p_id) || !$p_id) {
                $errors[] = "Failed to create product: " . esc_html($title);
                continue;
            }
            $imported++;
        }

        // Track keys handled by special pricing/inventory logic so they aren't double-processed
        $special_keys = array('product_price', 'product_offer_price', 'stock_quantity', '_stock_status');

        // A. Pricing (GBH + WooCommerce keys)
        $reg_price = $get_val(array('product_price', 'Regular_Price', 'Price', 'MRP'));
        $offer_price = $get_val(array('product_offer_price', 'Offer_Price', 'Sale_Price'));

        if ($reg_price !== '') {
            $key = isset($acf_by_name['product_price']['key']) ? $acf_by_name['product_price']['key'] : '';
            gbh_save_acf_or_meta($p_id, 'product_price', $key, $reg_price);
            update_post_meta($p_id, '_regular_price', $reg_price);
        }

        if ($offer_price !== '' && ($reg_price === '' || floatval($offer_price) < floatval($reg_price))) {
            $key = isset($acf_by_name['product_offer_price']['key']) ? $acf_by_name['product_offer_price']['key'] : '';
            gbh_save_acf_or_meta($p_id, 'product_offer_price', $key, $offer_price);
            update_post_meta($p_id, '_sale_price', $offer_price);
            update_post_meta($p_id, '_price', $offer_price);
        } elseif ($reg_price !== '') {
            update_post_meta($p_id, '_price', $reg_price);
        }

        // B. Stock Quantity & Stock Status (preserve '0', don't clobber existing values if blank)
        $stock_qty = $get_val(array('stock_quantity', 'Stock_Quantity', 'Stock', 'Quantity'));
        if ($stock_qty !== '') {
            $qty_int = intval($stock_qty);
            $key = isset($acf_by_name['stock_quantity']['key']) ? $acf_by_name['stock_quantity']['key'] : '';
            gbh_save_acf_or_meta($p_id, 'stock_quantity', $key, $qty_int);
            update_post_meta($p_id, '_stock', $qty_int);
        } elseif (!$existing && get_post_meta($p_id, 'stock_quantity', true) === '') {
            $key = isset($acf_by_name['stock_quantity']['key']) ? $acf_by_name['stock_quantity']['key'] : '';
            gbh_save_acf_or_meta($p_id, 'stock_quantity', $key, 100);
        }

        $stock_status = $get_val(array('_stock_status', 'Stock_Status'));
        if ($stock_status !== '') {
            $norm_status = str_replace(array(' ', '_'), '', strtolower($stock_status));
            $mapped_status = ($norm_status === 'outofstock' || $norm_status === 'soldout') ? 'outofstock' : 'instock';
            $key = isset($acf_by_name['_stock_status']['key']) ? $acf_by_name['_stock_status']['key'] : '';
            gbh_save_acf_or_meta($p_id, '_stock_status', $key, $mapped_status);
        } elseif (!$existing && get_post_meta($p_id, '_stock_status', true) === '') {
            $key = isset($acf_by_name['_stock_status']['key']) ? $acf_by_name['_stock_status']['key'] : '';
            gbh_save_acf_or_meta($p_id, '_stock_status', $key, 'instock');
        }

        // C. Dynamic Mapping for ALL Current & Future ACF Fields on 'product'
        foreach ($acf_fields as $field) {
            $meta_name = $field['name'];
            if (in_array($meta_name, $special_keys, true)) {
                continue;
            }

            $candidates = array($meta_name, $field['label']);
            if (isset($field_aliases[$meta_name])) {
                $candidates = array_merge($candidates, $field_aliases[$meta_name]);
            }

            $val = $get_val($candidates);
            if ($val === '') {
                // Safely skip omitted columns or blank cells without errors
                continue;
            }

            if ($field['type'] === 'image') {
                // Sideload only if field is empty and CSV contains a valid URL or filename
                if (!get_post_meta($p_id, $meta_name, true) && (filter_var($val, FILTER_VALIDATE_URL) || preg_match('/\.(jpe?g|png|webp|gif|svg)$/i', $val))) {
                    $gal_id = gbh_sideload_product_image($val, $p_id, $title . ' - ' . $field['label'], false);
                    if ($gal_id) {
                        gbh_save_acf_or_meta($p_id, $meta_name, $field['key'], $gal_id);
                    }
                }
            } else {
                gbh_save_acf_or_meta($p_id, $meta_name, $field['key'], $val);
            }
        }

        // D. Hierarchical Categories Mapping
        gbh_assign_product_categories($p_id, $category, $sub_category);

        // E. Sideload Main Featured Image if post has no thumbnail yet
        if ($img_url !== '' && !has_post_thumbnail($p_id)) {
            gbh_sideload_product_image($img_url, $p_id, $title, true);
        }
    }

    fclose($handle);

    return array(
        'imported' => $imported,
        'updated' => $updated,
        'errors' => $errors,
    );
}
