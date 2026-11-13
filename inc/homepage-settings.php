<?php
/**
 * Homepage Dynamic Settings & Controls Module
 * Controls: Star Featured Product & Nursery Story Collage
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * 1. Helper: Get Homepage Star Product Data
 */
function gbh_get_star_product_data()
{
    // Try to get selected product ID from front page meta or global option
    $front_id = get_option('page_on_front');
    if (!$front_id) {
        $home_page = get_page_by_path('home-page');
        if ($home_page) {
            $front_id = $home_page->ID;
        }
    }

    $star_id = 0;
    if ($front_id) {
        $meta_star_id = get_post_meta($front_id, '_gbh_star_product_id', true);
        if ($meta_star_id) {
            $star_id = intval($meta_star_id);
        }
    }

    if (!$star_id) {
        $opt_star_id = get_option('gbh_star_featured_product_id');
        if ($opt_star_id) {
            $star_id = intval($opt_star_id);
        }
    }

    // Fallback: search for "Organic Plant Booster" or "Booster"
    if (!$star_id || !get_post($star_id) || get_post_status($star_id) !== 'publish') {
        $booster_post = function_exists('gbh_get_product_by_title')
            ? gbh_get_product_by_title('Garden Basket Organic Plant Booster (500ml)')
            : null;
        if ($booster_post) {
            $star_id = $booster_post->ID;
        } else {
            $alt_query = new WP_Query(array(
                'post_type'      => 'product',
                's'              => 'Plant Booster',
                'posts_per_page' => 1,
                'post_status'    => 'publish'
            ));
            if ($alt_query->have_posts()) {
                $alt_query->the_post();
                $star_id = get_the_ID();
                wp_reset_postdata();
            } else {
                // Last fallback: first published product
                $first_prod = get_posts(array(
                    'post_type'      => 'product',
                    'posts_per_page' => 1,
                    'post_status'    => 'publish'
                ));
                if (!empty($first_prod)) {
                    $star_id = $first_prod[0]->ID;
                }
            }
        }
    }

    // Default booster data fallbacks
    $defaults = array(
        'id'          => $star_id,
        'title'       => 'Garden Basket Organic Plant Booster (500ml)',
        'subtitle'    => 'All-in-one organic liquid nutrition booster for flowers, veggies, and potted plants.',
        'desc'        => 'Formulated right in Jaipur, our signature bio-liquid plant booster combines cold-water seaweed kelp, humic acids, and essential micronutrients. Delivers visible greener leaves in 5 days and 3x more vibrant flower blooms.',
        'img'         => '',
        'badge'       => '⭐ Signature Bestseller',
        'kicker'      => '★★★★★ 4.9/5 (180+ Happy Gardeners)',
        'tag'         => 'Jaipur Formulated',
        'price'       => '399',
        'offer_price' => '299',
        'stock'       => '🟢 In Stock · Ready for Immediate Dispatch',
        'thumb_1'     => '🧪 500ml Bio-Elixir',
        'thumb_2'     => '🌸 3x Flower Blooms',
        'thumb_3'     => '🥬 Veggie Yield Boost',
        'features'    => array(
            array('icon' => '🌱', 'title' => 'Root & Shoot Vigor', 'desc' => 'Fast nutrient uptake'),
            array('icon' => '🌸', 'title' => '3x More Blooms', 'desc' => 'Abundant flowering & fruiting'),
            array('icon' => '🛡️', 'title' => 'Pest Resilience', 'desc' => 'Boosts natural plant immunity'),
            array('icon' => '🇮🇳', 'title' => 'Pan-India Delivery', 'desc' => 'Ships safely across India'),
        ),
    );

    if (!$star_id) {
        return $defaults;
    }

    $post_obj = get_post($star_id);
    if (!$post_obj) {
        return $defaults;
    }

    // Overrides from front-page meta (if client set custom text in admin)
    $custom_badge = $front_id ? get_post_meta($front_id, '_gbh_star_badge', true) : '';
    $custom_kicker = $front_id ? get_post_meta($front_id, '_gbh_star_kicker', true) : '';
    $custom_subtitle = $front_id ? get_post_meta($front_id, '_gbh_star_subtitle', true) : '';

    // Product prices
    $price = get_post_meta($star_id, 'product_price', true);
    if (!$price && function_exists('get_field')) $price = get_field('product_price', $star_id);

    $offer = get_post_meta($star_id, 'product_offer_price', true);
    if (!$offer && function_exists('get_field')) $offer = get_field('product_offer_price', $star_id);

    $badge = get_post_meta($star_id, 'discount_label', true);
    if (!$badge && function_exists('get_field')) $badge = get_field('discount_label', $star_id);

    // Product thumbnail
    $img = get_the_post_thumbnail_url($star_id, 'large');
    if (!$img && function_exists('get_field')) $img = get_field('product_image', $star_id);
    if (!$img) $img = get_post_meta($star_id, 'product_image', true);

    $title = get_the_title($star_id);
    $excerpt = get_the_excerpt($star_id);
    $content = wp_strip_all_tags(get_post_field('post_content', $star_id));

    return array(
        'id'          => $star_id,
        'title'       => $title ?: $defaults['title'],
        'subtitle'    => $custom_subtitle ?: ($excerpt ?: $defaults['subtitle']),
        'desc'        => $content ?: $defaults['desc'],
        'img'         => $img,
        'badge'       => $custom_badge ?: ($badge ?: $defaults['badge']),
        'kicker'      => $custom_kicker ?: $defaults['kicker'],
        'tag'         => $defaults['tag'],
        'price'       => $price ?: $defaults['price'],
        'offer_price' => $offer ?: $defaults['offer_price'],
        'stock'       => $defaults['stock'],
        'thumb_1'     => $defaults['thumb_1'],
        'thumb_2'     => $defaults['thumb_2'],
        'thumb_3'     => $defaults['thumb_3'],
        'features'    => $defaults['features'],
    );
}

/**
 * 2. Helper: Get Homepage Nursery Story & Photo Collage Data
 */
function gbh_get_story_collage_data()
{
    $front_id = get_option('page_on_front');
    if (!$front_id) {
        $home_page = get_page_by_path('home-page');
        if ($home_page) {
            $front_id = $home_page->ID;
        }
    }

    $defaults = array(
        'badge'        => '📍 Est. 2019 in Jaipur',
        'heading'      => 'Step into our Jaipur nursery shop',
        'lead'         => '<strong>Garden Basket started in 2019</strong> with a simple mission: bringing authentic, thriving green life into urban Jaipur homes and balconies.',
        'text'         => 'What you see on our website comes directly from our physical nursery racks. Every potted sapling is hand-tended under Jaipur\'s natural sunlight, and every heirloom seed batch is personally germ-tested before dispatch.',
        'img_main'     => '/wp-content/uploads/2026/10/our-story-jaipur-shop-front.webp',
        'img_entrance' => '/wp-content/uploads/2026/10/our-story-jaipur-shop-entrance.webp',
        'img_saplings' => '/wp-content/uploads/2026/10/our-story-fresh-saplings-rack.webp',
        'maps_url'     => 'https://maps.app.goo.gl/PNbyJo98EydJKEWw7?g_st=ic',
        'whatsapp_url' => 'https://wa.me/919414216343?text=Hi%20Garden%20Basket%20Hub!%20I%20would%20like%20to%20visit%20your%20Jaipur%20shop',
    );

    if (!$front_id) {
        return $defaults;
    }

    $badge = get_post_meta($front_id, '_gbh_story_badge', true);
    $heading = get_post_meta($front_id, '_gbh_story_heading', true);
    $lead = get_post_meta($front_id, '_gbh_story_lead', true);
    $text = get_post_meta($front_id, '_gbh_story_text', true);
    $img_main = get_post_meta($front_id, '_gbh_story_img_main', true);
    $img_entrance = get_post_meta($front_id, '_gbh_story_img_entrance', true);
    $img_saplings = get_post_meta($front_id, '_gbh_story_img_saplings', true);
    $maps_url = get_post_meta($front_id, '_gbh_story_maps_url', true);
    $wa_url = get_post_meta($front_id, '_gbh_story_wa_url', true);

    return array(
        'badge'        => !empty($badge) ? $badge : $defaults['badge'],
        'heading'      => !empty($heading) ? $heading : $defaults['heading'],
        'lead'         => !empty($lead) ? $lead : $defaults['lead'],
        'text'         => !empty($text) ? $text : $defaults['text'],
        'img_main'     => !empty($img_main) ? $img_main : $defaults['img_main'],
        'img_entrance' => !empty($img_entrance) ? $img_entrance : $defaults['img_entrance'],
        'img_saplings' => !empty($img_saplings) ? $img_saplings : $defaults['img_saplings'],
        'maps_url'     => !empty($maps_url) ? $maps_url : $defaults['maps_url'],
        'whatsapp_url' => !empty($wa_url) ? $wa_url : $defaults['whatsapp_url'],
    );
}

/**
 * 3. Register Native WordPress Meta Box on Home Page
 */
function gbh_add_homepage_controls_metabox()
{
    $screen = 'page';
    add_meta_box(
        'gbh_homepage_controls_meta',
        'Homepage Settings',
        'gbh_render_homepage_controls_metabox',
        $screen,
        'normal',
        'high'
    );
}
add_action('add_meta_boxes_page', 'gbh_add_homepage_controls_metabox');

/**
 * Render Homepage Meta Box in Admin
 */
function gbh_render_homepage_controls_metabox($post)
{
    // Check if this page is the front page or home page
    $front_id = get_option('page_on_front');
    $is_home = ($post->ID == $front_id) || ($post->post_name === 'home-page') || ($post->post_name === 'home');

    if (!$is_home) {
        echo '<p style="color:#666;"><em>This panel controls the Homepage sections. It activates on the Home/Front Page.</em></p>';
    }

    wp_nonce_field('gbh_save_home_settings', 'gbh_home_settings_nonce');

    $star_id = get_post_meta($post->ID, '_gbh_star_product_id', true);
    $star_badge = get_post_meta($post->ID, '_gbh_star_badge', true);
    $star_subtitle = get_post_meta($post->ID, '_gbh_star_subtitle', true);

    $story_badge = get_post_meta($post->ID, '_gbh_story_badge', true);
    $story_heading = get_post_meta($post->ID, '_gbh_story_heading', true);
    $story_lead = get_post_meta($post->ID, '_gbh_story_lead', true);
    $story_text = get_post_meta($post->ID, '_gbh_story_text', true);
    $story_img_main = get_post_meta($post->ID, '_gbh_story_img_main', true);
    $story_img_entrance = get_post_meta($post->ID, '_gbh_story_img_entrance', true);
    $story_img_saplings = get_post_meta($post->ID, '_gbh_story_img_saplings', true);
    $story_maps = get_post_meta($post->ID, '_gbh_story_maps_url', true);
    $story_wa = get_post_meta($post->ID, '_gbh_story_wa_url', true);

    // Get all products for dropdown
    $products = get_posts(array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));
    ?>
    <div style="padding:8px 0;">

        <!-- SECTION A: FEATURED PRODUCT -->
        <div style="background:#fff; border:1px solid #dcdcde; border-radius:4px; padding:16px 20px; margin-bottom:20px;">
            <h3 style="margin-top:0; font-size:14px; color:#1d2327; border-bottom:1px solid #f0f0f1; padding-bottom:10px;">
                Featured Product Section
            </h3>
            <p class="description" style="margin-bottom:14px;">
                Choose which product is highlighted in the homepage showcase section.
            </p>

            <table class="form-table" style="margin:0;">
                <tr>
                    <th style="width:200px;"><label for="gbh_star_product_id">Featured Product</label></th>
                    <td>
                        <select name="gbh_star_product_id" id="gbh_star_product_id" style="min-width:320px;">
                            <option value="">-- Auto-detect (Plant Booster or First Product) --</option>
                            <?php foreach ($products as $prod): ?>
                                <option value="<?php echo esc_attr($prod->ID); ?>" <?php selected($star_id, $prod->ID); ?>>
                                    <?php echo esc_html($prod->post_title); ?> (ID: <?php echo $prod->ID; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description">Title, pricing, image, and excerpt will be pulled automatically from the selected product.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_star_badge">Badge Text (Optional)</label></th>
                    <td>
                        <input type="text" name="gbh_star_badge" id="gbh_star_badge" value="<?php echo esc_attr($star_badge); ?>" placeholder="e.g. Signature Bestseller" style="width:100%; max-width:400px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_star_subtitle">Subtitle Override (Optional)</label></th>
                    <td>
                        <input type="text" name="gbh_star_subtitle" id="gbh_star_subtitle" value="<?php echo esc_attr($star_subtitle); ?>" placeholder="Leave blank to use product short excerpt" style="width:100%; max-width:550px;">
                    </td>
                </tr>
            </table>
        </div>

        <!-- SECTION B: NURSERY STORY & PHOTO COLLAGE -->
        <div style="background:#fff; border:1px solid #dcdcde; border-radius:4px; padding:16px 20px;">
            <h3 style="margin-top:0; font-size:14px; color:#1d2327; border-bottom:1px solid #f0f0f1; padding-bottom:10px;">
                Nursery Story Section
            </h3>
            <p class="description" style="margin-bottom:14px;">
                Manage the nursery storefront images, story text, and location links displayed on the homepage.
            </p>

            <table class="form-table" style="margin:0;">
                <tr>
                    <th style="width:200px;"><label for="gbh_story_badge">Section Label</label></th>
                    <td>
                        <input type="text" name="gbh_story_badge" id="gbh_story_badge" value="<?php echo esc_attr($story_badge); ?>" placeholder="Est. 2019 in Jaipur" style="width:100%; max-width:400px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_heading">Section Heading</label></th>
                    <td>
                        <input type="text" name="gbh_story_heading" id="gbh_story_heading" value="<?php echo esc_attr($story_heading); ?>" placeholder="Step into our Jaipur nursery shop" style="width:100%; max-width:500px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_lead">Lead Paragraph</label></th>
                    <td>
                        <textarea name="gbh_story_lead" id="gbh_story_lead" rows="2" style="width:100%; max-width:650px;" placeholder="Garden Basket started in 2019 with a simple mission..."><?php echo esc_textarea($story_lead); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_text">Detailed Narrative Text</label></th>
                    <td>
                        <textarea name="gbh_story_text" id="gbh_story_text" rows="3" style="width:100%; max-width:650px;" placeholder="What you see on our website comes directly from our physical nursery racks..."><?php echo esc_textarea($story_text); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_img_main">Main Storefront Photo URL</label></th>
                    <td>
                        <input type="text" name="gbh_story_img_main" id="gbh_story_img_main" value="<?php echo esc_attr($story_img_main); ?>" placeholder="/wp-content/uploads/2026/10/our-story-jaipur-shop-front.webp" style="width:100%; max-width:550px;">
                        <p class="description">Paste any uploaded image URL from WordPress Media Library.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_img_entrance">Shop Entrance Photo URL</label></th>
                    <td>
                        <input type="text" name="gbh_story_img_entrance" id="gbh_story_img_entrance" value="<?php echo esc_attr($story_img_entrance); ?>" placeholder="/wp-content/uploads/2026/10/our-story-jaipur-shop-entrance.webp" style="width:100%; max-width:550px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_img_saplings">Saplings Rack Photo URL</label></th>
                    <td>
                        <input type="text" name="gbh_story_img_saplings" id="gbh_story_img_saplings" value="<?php echo esc_attr($story_img_saplings); ?>" placeholder="/wp-content/uploads/2026/10/our-story-fresh-saplings-rack.webp" style="width:100%; max-width:550px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_maps_url">Google Maps Shop URL</label></th>
                    <td>
                        <input type="url" name="gbh_story_maps_url" id="gbh_story_maps_url" value="<?php echo esc_attr($story_maps); ?>" placeholder="https://maps.app.goo.gl/..." style="width:100%; max-width:550px;">
                    </td>
                </tr>
                <tr>
                    <th><label for="gbh_story_wa_url">WhatsApp Button Link</label></th>
                    <td>
                        <input type="text" name="gbh_story_wa_url" id="gbh_story_wa_url" value="<?php echo esc_attr($story_wa); ?>" placeholder="https://wa.me/919414216343?text=..." style="width:100%; max-width:550px;">
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <?php
}

/**
 * 4. Save Homepage Meta Box Settings
 */
function gbh_save_homepage_controls_meta($post_id)
{
    if (!isset($_POST['gbh_home_settings_nonce']) || !wp_verify_nonce($_POST['gbh_home_settings_nonce'], 'gbh_save_home_settings')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // Star Product Fields
    if (isset($_POST['gbh_star_product_id'])) {
        $star_id = intval($_POST['gbh_star_product_id']);
        update_post_meta($post_id, '_gbh_star_product_id', $star_id);
        update_option('gbh_star_featured_product_id', $star_id);
    }
    if (isset($_POST['gbh_star_badge'])) {
        update_post_meta($post_id, '_gbh_star_badge', sanitize_text_field($_POST['gbh_star_badge']));
    }
    if (isset($_POST['gbh_star_subtitle'])) {
        update_post_meta($post_id, '_gbh_star_subtitle', sanitize_text_field($_POST['gbh_star_subtitle']));
    }

    // Story Collage Fields
    if (isset($_POST['gbh_story_badge'])) {
        update_post_meta($post_id, '_gbh_story_badge', sanitize_text_field($_POST['gbh_story_badge']));
    }
    if (isset($_POST['gbh_story_heading'])) {
        update_post_meta($post_id, '_gbh_story_heading', sanitize_text_field($_POST['gbh_story_heading']));
    }
    if (isset($_POST['gbh_story_lead'])) {
        update_post_meta($post_id, '_gbh_story_lead', wp_kses_post($_POST['gbh_story_lead']));
    }
    if (isset($_POST['gbh_story_text'])) {
        update_post_meta($post_id, '_gbh_story_text', wp_kses_post($_POST['gbh_story_text']));
    }
    if (isset($_POST['gbh_story_img_main'])) {
        update_post_meta($post_id, '_gbh_story_img_main', esc_url_raw($_POST['gbh_story_img_main']));
    }
    if (isset($_POST['gbh_story_img_entrance'])) {
        update_post_meta($post_id, '_gbh_story_img_entrance', esc_url_raw($_POST['gbh_story_img_entrance']));
    }
    if (isset($_POST['gbh_story_img_saplings'])) {
        update_post_meta($post_id, '_gbh_story_img_saplings', esc_url_raw($_POST['gbh_story_img_saplings']));
    }
    if (isset($_POST['gbh_story_maps_url'])) {
        update_post_meta($post_id, '_gbh_story_maps_url', esc_url_raw($_POST['gbh_story_maps_url']));
    }
    if (isset($_POST['gbh_story_wa_url'])) {
        update_post_meta($post_id, '_gbh_story_wa_url', esc_url_raw($_POST['gbh_story_wa_url']));
    }
}
add_action('save_post_page', 'gbh_save_homepage_controls_meta');

