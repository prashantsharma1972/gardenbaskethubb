<?php
/**
 * Product Custom Fields, ACF JSON Sync & Database Registration Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * 1. ACF Local JSON Save and Load Paths
 */
add_filter('acf/settings/save_json', 'gbh_acf_json_save_point');
function gbh_acf_json_save_point($path)
{
    return get_stylesheet_directory() . '/acf-json';
}

add_filter('acf/settings/load_json', 'gbh_acf_json_load_point');
function gbh_acf_json_load_point($paths)
{
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

/**
 * 2. Auto-Import Field Group into WordPress Database
 * This ensures it shows up in WP Admin -> ACF -> Field Groups for visual editing!
 */
function gbh_sync_acf_product_field_group_to_db()
{
    if (!function_exists('acf_import_field_group')) {
        return;
    }

    $synced_version = get_option('gbh_acf_synced_v4');
    if ($synced_version) {
        return;
    }

    $json_file = get_stylesheet_directory() . '/acf-json/group_gbh_product_master.json';
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        $field_group = json_decode($json_data, true);
        if ($field_group && is_array($field_group)) {
            // Update existing DB record in place instead of creating a duplicate
            $existing_post = function_exists('acf_get_internal_post_type_post')
                ? acf_get_internal_post_type_post($field_group['key'], 'acf-field-group')
                : false;

            if ($existing_post && !empty($existing_post->ID)) {
                $field_group['ID'] = (int) $existing_post->ID;

                if (function_exists('acf_get_fields')) {
                    $db_fields = acf_get_fields($existing_post->ID);
                    if (!empty($db_fields) && is_array($db_fields)) {
                        $json_keys = array();
                        foreach ($field_group['fields'] as $jf) {
                            if (!empty($jf['key'])) {
                                $json_keys[] = $jf['key'];
                            }
                        }
                        foreach ($db_fields as $dbf) {
                            if (!empty($dbf['key']) && !in_array($dbf['key'], $json_keys, true)) {
                                $field_group['fields'][] = $dbf;
                            }
                        }
                    }
                }
            }

            acf_import_field_group($field_group);
            update_option('gbh_acf_synced_v4', 1);
        }
    }
}
add_action('init', 'gbh_sync_acf_product_field_group_to_db', 20);
add_action('admin_init', 'gbh_sync_acf_product_field_group_to_db');

/**
 * 3. Fallback Registration via acf_add_local_field_group
 */
function gbh_register_local_acf_product_group()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $json_file = get_stylesheet_directory() . '/acf-json/group_gbh_product_master.json';
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        $field_group = json_decode($json_data, true);
        if ($field_group && is_array($field_group)) {
            acf_add_local_field_group($field_group);
        }
    }
}
add_action('acf/init', 'gbh_register_local_acf_product_group');

/**
 * 4. Native WordPress Meta Box Fallback (If ACF is ever deactivated)
 */
function gbh_add_native_product_metabox()
{
    if (function_exists('acf_add_local_field_group')) {
        return;
    }

    add_meta_box(
        'gbh_product_native_meta_box',
        'Product Data',
        'gbh_render_native_product_metabox',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes_product', 'gbh_add_native_product_metabox');

function gbh_render_native_product_metabox($post)
{
    wp_nonce_field('gbh_save_product_native_meta', 'gbh_product_native_nonce');

    $price = get_post_meta($post->ID, 'product_price', true);
    if (!$price) $price = get_post_meta($post->ID, '_regular_price', true);
    if (!$price) $price = get_post_meta($post->ID, '_price', true);

    $offer_price = get_post_meta($post->ID, 'product_offer_price', true);
    if (!$offer_price) $offer_price = get_post_meta($post->ID, '_sale_price', true);

    $discount_label = get_post_meta($post->ID, 'discount_label', true);
    $pack_size = get_post_meta($post->ID, 'number_of_seeds', true);
    $seed_type = get_post_meta($post->ID, 'seed_type', true);
    $sku = get_post_meta($post->ID, '_sku', true);
    $stock_qty = get_post_meta($post->ID, 'stock_quantity', true);
    $how_to_grow = get_post_meta($post->ID, 'how_to_grow', true);
    $care_tips = get_post_meta($post->ID, 'plant_care_tips', true);
    ?>
    <table class="form-table" style="margin:0;">
        <tr>
            <th style="width:180px;"><label for="gbh_price">Regular Price (MRP ₹)</label></th>
            <td><input type="number" name="product_price" id="gbh_price" value="<?php echo esc_attr($price); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_offer_price">Sale Price (₹)</label></th>
            <td><input type="number" name="product_offer_price" id="gbh_offer_price" value="<?php echo esc_attr($offer_price); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_discount_label">Discount Badge</label></th>
            <td><input type="text" name="discount_label" id="gbh_discount_label" value="<?php echo esc_attr($discount_label); ?>" placeholder="e.g. 25% OFF, Bestseller" style="width:300px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_sku">SKU</label></th>
            <td><input type="text" name="_sku" id="gbh_sku" value="<?php echo esc_attr($sku); ?>" placeholder="e.g. GBH-001" style="width:300px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_stock_qty">Stock Quantity</label></th>
            <td><input type="number" name="stock_quantity" id="gbh_stock_qty" value="<?php echo esc_attr($stock_qty !== '' ? $stock_qty : 100); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_pack_size">Pack Size</label></th>
            <td><input type="text" name="number_of_seeds" id="gbh_pack_size" value="<?php echo esc_attr($pack_size); ?>" placeholder="e.g. 50+ Seeds, Pack of 6" style="width:300px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_seed_type">Variety / Type</label></th>
            <td><input type="text" name="seed_type" id="gbh_seed_type" value="<?php echo esc_attr($seed_type); ?>" placeholder="e.g. Heirloom Non-GMO" style="width:300px;"></td>
        </tr>
        <tr>
            <th><label for="gbh_how_to_grow">How to Grow</label></th>
            <td><textarea name="how_to_grow" id="gbh_how_to_grow" rows="3" style="width:100%; max-width:600px;"><?php echo esc_textarea($how_to_grow); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="gbh_care_tips">Care Requirements</label></th>
            <td><textarea name="plant_care_tips" id="gbh_care_tips" rows="3" style="width:100%; max-width:600px;"><?php echo esc_textarea($care_tips); ?></textarea></td>
        </tr>
    </table>
    <?php
}

function gbh_save_native_product_metabox($post_id)
{
    if (!isset($_POST['gbh_product_native_nonce']) || !wp_verify_nonce($_POST['gbh_product_native_nonce'], 'gbh_save_product_native_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array(
        'product_price'       => 'sanitize_text_field',
        'product_offer_price' => 'sanitize_text_field',
        '_regular_price'      => 'sanitize_text_field',
        '_sale_price'         => 'sanitize_text_field',
        '_price'              => 'sanitize_text_field',
        'discount_label'      => 'sanitize_text_field',
        '_sku'                => 'sanitize_text_field',
        'stock_quantity'      => 'intval',
        'number_of_seeds'     => 'sanitize_text_field',
        'seed_type'           => 'sanitize_text_field',
        'sowing_season'       => 'sanitize_text_field',
        'germination_temperature' => 'sanitize_text_field',
        'germination_time'    => 'sanitize_text_field',
        'first_harvest'       => 'sanitize_text_field',
        'container_pot_size'  => 'sanitize_text_field',
        'growing_level'       => 'sanitize_text_field',
        'how_to_grow'         => 'wp_kses_post',
        'plant_care_tips'     => 'wp_kses_post',
        'pests_and_diseases'  => 'wp_kses_post',
        'harvesting_guide'    => 'wp_kses_post',
    );

    foreach ($fields as $key => $sanitizer) {
        if (isset($_POST[$key])) {
            $val = call_user_func($sanitizer, $_POST[$key]);
            update_post_meta($post_id, $key, $val);
        }
    }
}
add_action('save_post_product', 'gbh_save_native_product_metabox');

/**
 * 5. Shared Product Text Sanitization Helpers
 * Strips pasted ChatGPT/Tailwind DOM attribute artifacts from product copy.
 */
function gbh_strip_ai_dom_artifacts($text)
{
    $text = strval($text);
    if ($text === '') {
        return '';
    }

    // Remove broken ChatGPT DOM class/attribute fragments (including unescaped '>' inside '[&>*]')
    $text = preg_replace('/<div[^>]*pointer-events-auto[^>]*>/is', '', $text);
    $text = preg_replace('/(?:\*\]:pointer-events-auto|scroll-mt-\[)[^\n]*?(?:data-turn="(?:assistant|user)"|data-scroll-anchor="[^"]*")\s*>/is', ' ', $text);
    $text = preg_replace('/\*\]:pointer-events-auto[^>]*>/is', ' ', $text);
    $text = preg_replace('/\s+data-(?:start|end|turn|turn-id|testid|scroll-anchor)="[^"]*"/is', '', $text);
    return trim($text);
}

/**
 * Clean a plain-text product excerpt/snippet and optionally trim by word count.
 */
function gbh_clean_text_snippet($text, $word_limit = 0)
{
    $clean = gbh_strip_ai_dom_artifacts($text);
    $clean = html_entity_decode($clean, ENT_QUOTES, 'UTF-8');
    $clean = function_exists('wp_strip_all_tags') ? wp_strip_all_tags($clean) : strip_tags($clean);
    $clean = preg_replace('/\s+/', ' ', trim($clean));

    if ($word_limit > 0 && function_exists('wp_trim_words')) {
        $clean = wp_trim_words($clean, $word_limit, '...');
    }
    return $clean;
}

/**
 * 6. Admin UI Enhancements: Clear Featured Image Box Styling & Product List Thumbnails
 */
function gbh_admin_featured_image_box_styles()
{
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || !in_array($screen->base, array('post', 'post-new'), true)) {
        return;
    }
    ?>
    <style>
        .editor-post-featured-image {
            padding: 12px;
            border: 1px solid #dcdcde;
            border-radius: 4px;
            background: #f6f7f7;
        }
        .editor-post-featured-image::before {
            content: "Featured Image";
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1e1e1e;
            margin-bottom: 8px;
        }
        .editor-post-featured-image__preview-image {
            max-height: 220px;
            width: 100%;
            object-fit: contain;
            background: #fff;
            border: 1px solid #e2e4e7;
            border-radius: 2px;
        }
    </style>
    <?php
}
add_action('admin_head', 'gbh_admin_featured_image_box_styles');

function gbh_add_product_admin_columns($columns)
{
    $new_cols = array();
    foreach ($columns as $key => $label) {
        if ($key === 'title') {
            $new_cols['gbh_thumb'] = 'Image';
        }
        $new_cols[$key] = $label;
        if ($key === 'title') {
            $new_cols['gbh_sku']   = 'SKU';
            $new_cols['gbh_price'] = 'Price';
            $new_cols['gbh_stock'] = 'Stock';
        }
    }
    return $new_cols;
}
add_filter('manage_product_posts_columns', 'gbh_add_product_admin_columns');

function gbh_render_product_admin_columns($column, $post_id)
{
    if ($column === 'gbh_thumb') {
        $thumb = get_the_post_thumbnail_url($post_id, 'gbh-thumb');
        if (!$thumb) {
            $thumb = get_the_post_thumbnail_url($post_id, 'large');
        }
        if ($thumb) {
            echo '<img src="' . esc_url($thumb) . '" alt="" style="width:44px;height:44px;object-fit:contain;border:1px solid #dcdcde;border-radius:3px;background:#fff;">';
        } else {
            echo '<span style="display:inline-block;width:44px;height:44px;line-height:44px;text-align:center;border:1px dashed #c3c4c7;border-radius:3px;color:#8c8f94;font-size:11px;">No img</span>';
        }
    } elseif ($column === 'gbh_sku') {
        $sku = get_post_meta($post_id, '_sku', true);
        echo $sku ? esc_html($sku) : '—';
    } elseif ($column === 'gbh_price') {
        $reg = get_post_meta($post_id, 'product_price', true) ?: get_post_meta($post_id, '_regular_price', true);
        $off = get_post_meta($post_id, 'product_offer_price', true) ?: get_post_meta($post_id, '_sale_price', true);
        if ($off && (!$reg || floatval($off) < floatval($reg))) {
            echo '<strong>₹' . esc_html($off) . '</strong> <del style="color:#8c8f94;">₹' . esc_html($reg) . '</del>';
        } elseif ($reg) {
            echo '₹' . esc_html($reg);
        } else {
            echo '—';
        }
    } elseif ($column === 'gbh_stock') {
        $status = get_post_meta($post_id, '_stock_status', true);
        $qty = get_post_meta($post_id, 'stock_quantity', true);
        $label = ($status === 'outofstock') ? 'Out of stock' : 'In stock';
        $color = ($status === 'outofstock') ? '#b32d2e' : '#007017';
        echo '<span style="color:' . esc_attr($color) . ';font-weight:500;">' . esc_html($label) . '</span>';
        if ($qty !== '') {
            echo ' (' . intval($qty) . ')';
        }
    }
}
add_action('manage_product_posts_custom_column', 'gbh_render_product_admin_columns', 10, 2);

function gbh_admin_product_list_column_width()
{
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if ($screen && $screen->id === 'edit-product') {
        echo '<style>.column-gbh_thumb{width:64px;text-align:center;}.column-gbh_sku{width:110px;}.column-gbh_price{width:110px;}.column-gbh_stock{width:120px;}</style>';
    }
}
add_action('admin_head', 'gbh_admin_product_list_column_width');
