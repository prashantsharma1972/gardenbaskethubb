<?php
/**
 * Garden Basket Hub — Theme Functions & E-Commerce Engine
 */

// 1. Session Management
function gbh_init_session() {
    if (!session_id() && !headers_sent()) {
        session_start();
    }
}
add_action('init', 'gbh_init_session', 1);

// 2. Disable WP Admin Bar & head bloat for pristine frontend view
add_filter('show_admin_bar', '__return_false');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

function remove_dashicons_styles() {
    if (!is_admin()) {
        wp_deregister_style('dashicons');
    }
}
add_action('wp_print_styles', 'remove_dashicons_styles', 100);

// 2b. Guaranteed Page Auto-Creator & Dynamic URL Resolvers
function gbh_create_required_wp_pages() {
    $required_pages = array(
        'shop'                 => array('title' => 'Shop', 'template' => 'archive-product.php'),
        'reels'                => array('title' => 'Gardening Reels', 'template' => 'archive-reels.php'),
        'about-us'             => array('title' => 'Our Story', 'template' => 'page-about-us.php'),
        'contact-us'           => array('title' => 'Contact Us', 'template' => 'page-contact-us.php'),
        'cart'                 => array('title' => 'Shopping Bag', 'template' => 'page-cart.php'),
        'checkout'             => array('title' => 'Checkout', 'template' => 'page-checkout.php'),
        'thank-you'            => array('title' => 'Thank You', 'template' => 'page-thank-you.php'),
        'privacy-policy'       => array('title' => 'Privacy Policy', 'template' => 'privacy-policy.php'),
        'terms-and-conditions' => array('title' => 'Terms & Conditions', 'template' => 'page-terms-and-conditions.php'),
        'refund-policy'        => array('title' => 'Refund & Shipping Policy', 'template' => 'page-refund-policy.php'),
    );

    foreach ($required_pages as $slug => $data) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_type'   => 'page',
                'post_title'  => $data['title'],
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_content'=> '',
            ));
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
}
add_action('init', 'gbh_create_required_wp_pages', 5);

/**
 * Get dynamic page URL (works across plain and pretty permalinks)
 */
function gbh_get_page_url($slug) {
    $page = get_page_by_path($slug);
    if ($page) {
        return get_permalink($page->ID);
    }
    if ($slug === 'shop') {
        $archive = get_post_type_archive_link('product');
        return $archive ? $archive : home_url('/?post_type=product');
    }
    if ($slug === 'reels') {
        $archive = get_post_type_archive_link('reels');
        return $archive ? $archive : home_url('/?post_type=reels');
    }
    return home_url('/' . $slug . '/');
}

// 2c. Guaranteed Template Redirect Guard for All Store Pages & Legal Policies
function gbh_template_redirect_override($template) {
    if (is_page('shop') || is_post_type_archive('product') || (isset($_GET['post_type']) && $_GET['post_type'] === 'product')) {
        $new_template = get_theme_file_path('archive-product.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('reels') || is_post_type_archive('reels') || (isset($_GET['post_type']) && $_GET['post_type'] === 'reels')) {
        $new_template = get_theme_file_path('archive-reels.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('blog') || is_post_type_archive('post') || (is_home() && !is_front_page())) {
        $new_template = get_theme_file_path('archive-blog.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('about-us') || is_page('about') || is_page('our-story')) {
        $new_template = get_theme_file_path('page-about-us.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('contact-us') || is_page('contact')) {
        $new_template = get_theme_file_path('page-contact-us.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('cart') || is_page('bag')) {
        $new_template = get_theme_file_path('page-cart.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('checkout')) {
        $new_template = get_theme_file_path('page-checkout.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('thank-you') || is_page('order-complete')) {
        $new_template = get_theme_file_path('page-thank-you.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('privacy-policy')) {
        $new_template = get_theme_file_path('privacy-policy.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('terms-and-conditions') || is_page('terms')) {
        $new_template = get_theme_file_path('page-terms-and-conditions.php');
        if (file_exists($new_template)) return $new_template;
    }
    if (is_page('refund-policy') || is_page('shipping-policy')) {
        $new_template = get_theme_file_path('page-refund-policy.php');
        if (file_exists($new_template)) return $new_template;
    }
    return $template;
}
add_filter('template_include', 'gbh_template_redirect_override');




// 3. Theme Setup & Supports
function gbh_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post', 'page', 'product', 'reels', 'blog'));
    add_image_size('gbh-card', 600, 600, true);
    add_image_size('gbh-thumb', 200, 200, true);
}
add_action('after_setup_theme', 'gbh_theme_setup');

// 4. Register Custom Post Types & Taxonomies
function gbh_register_cpts() {
    // Custom Post Type: Products (if WooCommerce is not active)
    if (!post_type_exists('product')) {
        register_post_type('product', array(
            'labels' => array(
                'name' => 'Products',
                'singular_name' => 'Product',
                'add_new' => 'Add New Product',
                'add_new_item' => 'Add New Product',
                'edit_item' => 'Edit Product',
                'all_items' => 'All Products',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'shop'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'menu_icon' => 'dashicons-cart',
            'show_in_rest' => true,
        ));
    }

    // Custom Post Type: Reels
    register_post_type('reels', array(
        'labels' => array(
            'name' => 'Gardening Reels',
            'singular_name' => 'Reel',
            'add_new' => 'Add New Reel',
            'add_new_item' => 'Add New Reel',
            'edit_item' => 'Edit Reel',
            'all_items' => 'All Reels',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'reels'),
        'supports' => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-format-video',
        'show_in_rest' => true,
    ));

    // Custom Post Type: GBH Orders
    register_post_type('gbh_order', array(
        'labels' => array(
            'name' => 'Store Orders',
            'singular_name' => 'Order',
            'all_items' => 'All Orders',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-clipboard',
    ));

    // Taxonomy: Product Category
    register_taxonomy('product_cat', array('product'), array(
        'labels' => array(
            'name' => 'Product Categories',
            'singular_name' => 'Product Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'product-category'),
        'show_in_rest' => true,
    ));

    // Taxonomy: Season
    register_taxonomy('product_season', array('product'), array(
        'labels' => array(
            'name' => 'Seasons',
            'singular_name' => 'Season',
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'season'),
        'show_in_rest' => true,
    ));

    // Taxonomy: Reel Category
    register_taxonomy('reel_cat', array('reels'), array(
        'labels' => array(
            'name' => 'Reel Categories',
            'singular_name' => 'Reel Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'reel-category'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'gbh_register_cpts');

/**
 * Automatic Sample Content Seeder for Products & Reels
 */
function gbh_seed_sample_content() {
    $prod_count = wp_count_posts('product');
    if (isset($prod_count->publish) && intval($prod_count->publish) === 0) {
        $sample_products = array(
            array(
                'title' => 'Tomato Seedling Tray',
                'excerpt' => '6 healthy cherry tomato seedlings, 3 weeks old. Ready to plant in balcony pots with same-day delivery in Jaipur.',
                'content' => 'Sow seeds directly in pots or grow bags at a depth of 2cm. Maintain spacing of 30cm between plants. Keep soil evenly moist during growth.',
                'cat' => 'Seedlings',
                'season' => 'Monsoon',
                'price' => '249',
                'offer_price' => '199',
                'badge' => 'Jaipur Only',
                'seeds' => '6 Saplings',
                'type' => 'Hybrid Cherry',
                'germ_temp' => '20-28°C',
                'germ_time' => '7-10 Days',
                'harvest' => '60-70 Days',
                'pot_size' => '12 Inch Pot / Grow Bag',
                'level' => 'Beginner Friendly'
            ),
            array(
                'title' => 'Monsoon Veg Seed Kit',
                'excerpt' => '8 heirloom organic vegetable varieties including Okra, Ridge Gourd, Bitter Gourd & Spinach.',
                'content' => 'Complete organic seed kit packaged for monsoon sowing in Indian climate conditions.',
                'cat' => 'Seeds',
                'season' => 'Monsoon',
                'price' => '499',
                'offer_price' => '349',
                'badge' => 'Bestseller',
                'seeds' => '120+ Seeds (8 Packs)',
                'type' => 'Heirloom Organic',
                'germ_temp' => '25-32°C',
                'germ_time' => '5-8 Days',
                'harvest' => '45-60 Days',
                'pot_size' => 'Balcony & Terrace Pots',
                'level' => 'Easy to Grow'
            ),
            array(
                'title' => 'Organic Vermicompost 5kg',
                'excerpt' => 'Premium quality 100% organic earthworm castings processed at Jaipur nursery for rich soil nutrition.',
                'content' => 'Enrich your pot soil with nitrogen, phosphorus, and potassium. Ideal for flowering plants, vegetables, and fruit trees.',
                'cat' => 'Compost & Soil',
                'season' => 'All Year',
                'price' => '399',
                'offer_price' => '299',
                'badge' => '100% Organic',
                'seeds' => '5 kg Pack',
                'type' => 'Organic Vermicompost',
                'germ_temp' => 'N/A',
                'germ_time' => 'N/A',
                'harvest' => 'Continuous Supply',
                'pot_size' => 'Mix 20-30% with pot soil',
                'level' => 'Essential Care'
            ),
            array(
                'title' => 'Marigold Sapling Pack',
                'excerpt' => 'Pack of 4 fresh blooming saplings (Orange & Yellow varieties), ready to transplant.',
                'content' => 'Marigolds repel garden pests and bring vibrant festive colors to your home garden.',
                'cat' => 'Seedlings',
                'season' => 'Winter',
                'price' => '199',
                'offer_price' => '149',
                'badge' => 'Jaipur Only',
                'seeds' => 'Pack of 4',
                'type' => 'French Marigold',
                'germ_temp' => '18-25°C',
                'germ_time' => '4-7 Days',
                'harvest' => '30-40 Days',
                'pot_size' => '8-10 Inch Pot',
                'level' => 'Beginner Friendly'
            ),
            array(
                'title' => 'Essential Gardening Tool Set',
                'excerpt' => '5-piece heavy duty steel kit: trowel, transplanter, hand fork, bypass pruner & protective gloves.',
                'content' => 'High carbon steel tools with ergonomic wooden handles built for balcony and home gardens.',
                'cat' => 'Tools',
                'season' => 'All Year',
                'price' => '799',
                'offer_price' => '599',
                'badge' => 'Top Rated',
                'seeds' => '5 Tool Set',
                'type' => 'Carbon Steel & Wood',
                'germ_temp' => 'N/A',
                'germ_time' => 'N/A',
                'harvest' => 'Multi-Season Durable',
                'pot_size' => 'All Pots & Gardens',
                'level' => 'All Gardeners'
            ),
            array(
                'title' => 'Monsoon Starter Kit',
                'excerpt' => 'Seeds + vermicompost + seedling tray + organic neem spray — everything to start gardening today.',
                'content' => 'All-in-one gardening starter bundle curated by Jaipur nursery experts.',
                'cat' => 'Seeds',
                'season' => 'Monsoon',
                'price' => '999',
                'offer_price' => '799',
                'badge' => 'Complete Kit',
                'seeds' => 'Full Starter Pack',
                'type' => 'Complete Bundle',
                'germ_temp' => '22-30°C',
                'germ_time' => '5-10 Days',
                'harvest' => '45-60 Days',
                'pot_size' => 'Includes 12-Cell Tray',
                'level' => 'Perfect Gift'
            )
        );

        foreach ($sample_products as $sp) {
            $post_id = wp_insert_post(array(
                'post_type' => 'product',
                'post_title' => $sp['title'],
                'post_excerpt' => $sp['excerpt'],
                'post_content' => $sp['content'],
                'post_status' => 'publish',
            ));

            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, 'product_price', $sp['price']);
                update_post_meta($post_id, 'product_offer_price', $sp['offer_price']);
                update_post_meta($post_id, 'discount_label', $sp['badge']);
                update_post_meta($post_id, 'number_of_seeds', $sp['seeds']);
                update_post_meta($post_id, 'seed_type', $sp['type']);
                update_post_meta($post_id, 'sowing_season', $sp['season']);
                update_post_meta($post_id, 'germination_temperature', $sp['germ_temp']);
                update_post_meta($post_id, 'germination_time', $sp['germ_time']);
                update_post_meta($post_id, 'first_harvest', $sp['harvest']);
                update_post_meta($post_id, 'container_pot_size', $sp['pot_size']);
                update_post_meta($post_id, 'growing_level', $sp['level']);
                wp_set_object_terms($post_id, $sp['cat'], 'product_cat');
                wp_set_object_terms($post_id, $sp['season'], 'product_season');
            }
        }
    }

    $reel_count = wp_count_posts('reels');
    if (isset($reel_count->publish) && intval($reel_count->publish) === 0) {
        $sample_reels = array(
            array(
                'title' => 'Monsoon Gardening Tips',
                'views' => '2.4K views',
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'excerpt' => 'Learn how to protect young seedlings during heavy monsoon rains in Jaipur.'
            ),
            array(
                'title' => 'How to Repot Your Plant',
                'views' => '3.1K views',
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'excerpt' => 'Step-by-step guide to transplanting saplings into clay pots without root shock.'
            ),
            array(
                'title' => 'Terracotta Pots from Jaipur',
                'views' => '1.8K views',
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'excerpt' => 'Behind the scenes at our local pottery workshop crafting handmade eco pots.'
            ),
            array(
                'title' => 'Seed Saving 101',
                'views' => '5.2K views',
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'excerpt' => 'Harvesting, drying, and preserving heirloom seeds for your next garden cycle.'
            )
        );

        foreach ($sample_reels as $sr) {
            $r_id = wp_insert_post(array(
                'post_type' => 'reels',
                'post_title' => $sr['title'],
                'post_excerpt' => $sr['excerpt'],
                'post_status' => 'publish',
            ));

            if ($r_id && !is_wp_error($r_id)) {
                update_post_meta($r_id, 'reel_view_count', $sr['views']);
                update_post_meta($r_id, 'reel_video_url', $sr['video']);
            }
        }
    }

    // Seed Blog Posts if empty
    $post_count = wp_count_posts('post');
    if (isset($post_count->publish) && intval($post_count->publish) === 0) {
        $sample_blogs = array(
            array(
                'title' => 'Monsoon Gardening 101: How to Prevent Root Rot in Jaipur Rain',
                'excerpt' => 'Learn essential tips for draining excess water, preventing fungal root rot, and protecting delicate balcony vegetable saplings during monsoon storms.',
                'content' => 'Monsoon brings lush greenery but also heavy downpours that can waterlog container plants. In this guide, our Jaipur nursery experts share drainage pot techniques, neem oil sprays, and organic soil mixes to keep your garden thriving through rainy months.',
                'read_time' => '5 min read',
                'cat' => 'Monsoon Care'
            ),
            array(
                'title' => 'Top 10 Heirloom Organic Seeds for Urban Balcony Gardens',
                'excerpt' => 'Discover fast-growing vegetable and herb varieties that thrive in Indian climate conditions with minimal balcony space.',
                'content' => 'Growing your own organic vegetables doesn’t require acres of land. Learn how to grow Cherry Tomatoes, Spinach, Coriander, Chillies, and Basil in 10-inch pots with 100% organic heirloom seeds.',
                'read_time' => '7 min read',
                'cat' => 'Seeds & Sowing'
            ),
            array(
                'title' => 'The Secret to Rich Soil: Perfect Vermicompost Potting Mix Ratios',
                'excerpt' => 'Master the 3-part potting mix formula using organic earthworm castings, cocopeat, and neem cake for healthy root growth.',
                'content' => 'Soil quality determines plant health. Discover why 30% organic vermicompost combined with cocopeat and red soil creates the perfect aeration and nutrient retention balance for pots.',
                'read_time' => '4 min read',
                'cat' => 'Soil & Nutrition'
            )
        );

        foreach ($sample_blogs as $sb) {
            $b_id = wp_insert_post(array(
                'post_type' => 'post',
                'post_title' => $sb['title'],
                'post_excerpt' => $sb['excerpt'],
                'post_content' => $sb['content'],
                'post_status' => 'publish',
            ));

            if ($b_id && !is_wp_error($b_id)) {
                update_post_meta($b_id, 'read_time', $sb['read_time']);
                wp_set_object_terms($b_id, $sb['cat'], 'category');
            }
        }
    }
}
add_action('init', 'gbh_seed_sample_content', 20);



// 5. Enqueue Styles & Scripts
function gbh_enqueue_assets() {
    // Fonts
    wp_enqueue_style('gbh-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;700&family=DM+Mono:wght@400&display=swap', array(), null);
    
    // Main Stylesheet
    wp_enqueue_style('gbh-style', get_stylesheet_uri(), array('gbh-fonts'), '1.0.0');

    // Custom JS AJAX Script
    wp_enqueue_script('gbh-main', get_theme_file_uri('assets/js/main.js'), array('jquery'), '1.0.0', true);

    wp_localize_script('gbh-main', 'gbh_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('gbh_cart_nonce'),
        'cart_url' => home_url('/cart/'),
        'checkout_url' => home_url('/checkout/'),
    ));
}
add_action('wp_enqueue_scripts', 'gbh_enqueue_assets');

// 6. E-Commerce Cart Engine (AJAX Handlers & Multi-Layer Persistence)

/**
 * Save cart data to both Session and HTTP Cookie (30 days persistence)
 */
function gbh_save_cart($cart_array) {
    if (!session_id() && !headers_sent()) {
        session_start();
    }
    $_SESSION['gbh_cart'] = $cart_array;
    $encoded = json_encode($cart_array);
    if (!headers_sent()) {
        setcookie('gbh_cart_cookie', $encoded, time() + (86400 * 30), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, is_ssl(), false);
    }
}

/**
 * Get Cart Data helper function
 */
function gbh_get_cart_data() {
    if (!session_id() && !headers_sent()) {
        session_start();
    }

    // 1. Restore from cookie if session is missing
    if (empty($_SESSION['gbh_cart']) && !empty($_COOKIE['gbh_cart_cookie'])) {
        $cookie_cart = json_decode(stripslashes($_COOKIE['gbh_cart_cookie']), true);
        if (is_array($cookie_cart)) {
            $_SESSION['gbh_cart'] = $cookie_cart;
        }
    }

    if (!isset($_SESSION['gbh_cart']) || !is_array($_SESSION['gbh_cart'])) {
        $_SESSION['gbh_cart'] = array();
    }
    
    $cart = $_SESSION['gbh_cart'];
    $items = array();
    $subtotal = 0;
    $total_count = 0;

    foreach ($cart as $key => $item) {
        $product_id = intval($item['product_id']);
        $qty = intval($item['quantity']);
        $variant = isset($item['variant']) ? $item['variant'] : '';
        
        $title = get_the_title($product_id);
        if (!$title) continue;

        // Fetch price with backward compatible fallbacks
        $price = get_post_meta($product_id, 'product_offer_price', true);
        if (!$price && function_exists('get_field')) {
            $price = get_field('product_offer_price', $product_id);
        }
        if (!$price) {
            $price = get_post_meta($product_id, 'product_price', true);
        }
        if (!$price && function_exists('get_field')) {
            $price = get_field('product_price', $product_id);
        }
        
        $price = floatval(preg_replace('/[^0-9.]/', '', strval($price)));
        if ($price <= 0) $price = 199; // Default price fallback

        $line_total = $price * $qty;
        $subtotal += $line_total;
        $total_count += $qty;

        // Image
        $img_url = get_the_post_thumbnail_url($product_id, 'gbh-thumb');
        if (!$img_url && function_exists('get_field')) {
            $img_url = get_field('product_image', $product_id);
        }
        if (!$img_url) {
            $img_url = get_post_meta($product_id, 'product_image', true);
        }

        $items[] = array(
            'key' => $key,
            'product_id' => $product_id,
            'title' => $title,
            'price' => $price,
            'price_formatted' => '₹' . number_format($price, 0),
            'quantity' => $qty,
            'variant' => $variant,
            'image' => $img_url,
            'line_total' => $line_total,
            'line_total_formatted' => '₹' . number_format($line_total, 0),
        );
    }

    $delivery_fee = ($subtotal > 0 && $subtotal < 799) ? 49 : 0;
    $discount = isset($_SESSION['gbh_discount']) ? floatval($_SESSION['gbh_discount']) : 0;
    $total = max(0, $subtotal + $delivery_fee - $discount);

    return array(
        'items' => $items,
        'total_count' => $total_count,
        'subtotal' => $subtotal,
        'subtotal_formatted' => '₹' . number_format($subtotal, 0),
        'delivery_fee' => $delivery_fee,
        'delivery_fee_formatted' => ($delivery_fee > 0) ? '₹' . $delivery_fee : 'FREE',
        'discount' => $discount,
        'discount_formatted' => '−₹' . number_format($discount, 0),
        'total' => $total,
        'total_formatted' => '₹' . number_format($total, 0),
    );
}

// AJAX: Add To Cart
function gbh_ajax_add_to_cart() {
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;
    $variant = isset($_POST['variant']) ? sanitize_text_field($_POST['variant']) : '';

    if (!$product_id) {
        wp_send_json_error(array('message' => 'Invalid product ID'));
    }

    if (!isset($_SESSION['gbh_cart']) || !is_array($_SESSION['gbh_cart'])) {
        $_SESSION['gbh_cart'] = array();
    }

    $cart_key = $product_id . '_' . sanitize_key($variant);

    if (isset($_SESSION['gbh_cart'][$cart_key])) {
        $_SESSION['gbh_cart'][$cart_key]['quantity'] += $quantity;
    } else {
        $_SESSION['gbh_cart'][$cart_key] = array(
            'product_id' => $product_id,
            'quantity'   => $quantity,
            'variant'    => $variant,
        );
    }

    gbh_save_cart($_SESSION['gbh_cart']);
    $cart_data = gbh_get_cart_data();

    wp_send_json_success(array(
        'message' => get_the_title($product_id) . ' added to bag!',
        'cart' => $cart_data
    ));
}

add_action('wp_ajax_gbh_add_to_cart', 'gbh_ajax_add_to_cart');
add_action('wp_ajax_nopriv_gbh_add_to_cart', 'gbh_ajax_add_to_cart');

// AJAX: Get Cart
function gbh_ajax_get_cart() {
    $cart_data = gbh_get_cart_data();
    wp_send_json_success($cart_data);
}
add_action('wp_ajax_gbh_get_cart', 'gbh_ajax_get_cart');
add_action('wp_ajax_nopriv_gbh_get_cart', 'gbh_ajax_get_cart');

// AJAX: Update / Remove Item
function gbh_ajax_update_cart() {
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $key = isset($_POST['key']) ? sanitize_text_field($_POST['key']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if (isset($_SESSION['gbh_cart'][$key])) {
        if ($quantity <= 0) {
            unset($_SESSION['gbh_cart'][$key]);
        } else {
            $_SESSION['gbh_cart'][$key]['quantity'] = $quantity;
        }
        gbh_save_cart($_SESSION['gbh_cart']);
    }

    $cart_data = gbh_get_cart_data();
    wp_send_json_success($cart_data);
}

add_action('wp_ajax_gbh_update_cart', 'gbh_ajax_update_cart');
add_action('wp_ajax_nopriv_gbh_update_cart', 'gbh_ajax_update_cart');

// AJAX: Apply Coupon
function gbh_ajax_apply_coupon() {
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $coupon = isset($_POST['coupon']) ? strtoupper(trim(sanitize_text_field($_POST['coupon']))) : '';

    if ($coupon === 'MONSOON10' || $coupon === 'GARDEN10') {
        $_SESSION['gbh_discount'] = 120;
        wp_send_json_success(array(
            'message' => 'Coupon MONSOON10 applied! (₹120 Off)',
            'cart' => gbh_get_cart_data()
        ));
    } else {
        wp_send_json_error(array('message' => 'Invalid coupon code. Try MONSOON10'));
    }
}
add_action('wp_ajax_gbh_apply_coupon', 'gbh_ajax_apply_coupon');
add_action('wp_ajax_nopriv_gbh_apply_coupon', 'gbh_ajax_apply_coupon');

// AJAX: Check Pincode
function gbh_ajax_check_pincode() {
    $pincode = isset($_POST['pincode']) ? trim(sanitize_text_field($_POST['pincode'])) : '';
    
    if (empty($pincode)) {
        wp_send_json_error(array('message' => 'Please enter a valid pincode'));
    }

    if (strpos($pincode, '302') === 0) {
        wp_send_json_success(array(
            'message' => '🚚 Same-day delivery available in Jaipur for ' . $pincode . '!',
            'type' => 'jaipur'
        ));
    } else {
        wp_send_json_success(array(
            'message' => '📦 Express Pan-India shipping available (3-5 business days).',
            'type' => 'national'
        ));
    }
}
add_action('wp_ajax_gbh_check_pincode', 'gbh_ajax_check_pincode');
add_action('wp_ajax_nopriv_gbh_check_pincode', 'gbh_ajax_check_pincode');

// AJAX: Place Order
function gbh_ajax_place_order() {
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $cart_data = gbh_get_cart_data();
    if (empty($cart_data['items'])) {
        wp_send_json_error(array('message' => 'Your bag is empty!'));
    }

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
    $landmark = isset($_POST['landmark']) ? sanitize_text_field($_POST['landmark']) : '';
    $city = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : 'Jaipur';
    $pincode = isset($_POST['pincode']) ? sanitize_text_field($_POST['pincode']) : '';
    $delivery_slot = isset($_POST['delivery_slot']) ? sanitize_text_field($_POST['delivery_slot']) : '';
    $payment_method = isset($_POST['payment_method']) ? sanitize_text_field($_POST['payment_method']) : 'UPI / Razorpay';

    if (empty($email) || empty($phone) || empty($first_name) || empty($address)) {
        wp_send_json_error(array('message' => 'Please fill in all required contact and delivery fields.'));
    }

    $order_num = 'GBH-' . strtoupper(wp_generate_password(6, false));

    // Create Order Post
    $order_id = wp_insert_post(array(
        'post_type'   => 'gbh_order',
        'post_title'  => 'Order ' . $order_num . ' — ' . $first_name . ' ' . $last_name,
        'post_status' => 'publish',
        'post_content'=> 'Customer Phone: ' . $phone . "\nEmail: " . $email,
    ));

    if (is_wp_error($order_id)) {
        wp_send_json_error(array('message' => 'Failed to process order. Please try again.'));
    }

    // Save Order Meta Data
    update_post_meta($order_id, '_gbh_order_num', $order_num);
    update_post_meta($order_id, '_gbh_email', $email);
    update_post_meta($order_id, '_gbh_phone', $phone);
    update_post_meta($order_id, '_gbh_customer_name', $first_name . ' ' . $last_name);
    update_post_meta($order_id, '_gbh_address', $address);
    update_post_meta($order_id, '_gbh_landmark', $landmark);
    update_post_meta($order_id, '_gbh_city', $city);
    update_post_meta($order_id, '_gbh_pincode', $pincode);
    update_post_meta($order_id, '_gbh_delivery_slot', $delivery_slot);
    update_post_meta($order_id, '_gbh_payment_method', $payment_method);
    update_post_meta($order_id, '_gbh_total_amount', $cart_data['total']);
    update_post_meta($order_id, '_gbh_order_items', json_encode($cart_data['items']));
    update_post_meta($order_id, '_gbh_order_status', 'Processing');

    // Clear Cart
    $_SESSION['gbh_cart'] = array();
    unset($_SESSION['gbh_discount']);

    $redirect_url = add_query_arg(array(
        'order_id' => $order_id,
        'order_num' => $order_num,
    ), home_url('/thank-you/'));

    wp_send_json_success(array(
        'message' => 'Order placed successfully!',
        'order_num' => $order_num,
        'redirect_url' => $redirect_url
    ));
}
add_action('wp_ajax_gbh_place_order', 'gbh_ajax_place_order');
add_action('wp_ajax_nopriv_gbh_place_order', 'gbh_ajax_place_order');

// 7. Utility function: Increase Post Views
function increase_post_views($post_id) {
    $views = get_post_meta($post_id, 'view_count', true);
    if (!$views) $views = 0;
    $views++;
    update_post_meta($post_id, 'view_count', $views);
}

function track_post_views() {
    if (is_single()) {
        $post_id = get_the_ID();
        if (!current_user_can('edit_posts')) {
            increase_post_views($post_id);
        }
    }
}
add_action('wp', 'track_post_views');

// 8. AJAX Product Catalog Filter & Sorting Handler
function gbh_ajax_filter_products() {
    $cats = isset($_POST['cats']) && is_array($_POST['cats']) ? array_map('sanitize_text_field', $_POST['cats']) : array();
    $seasons = isset($_POST['seasons']) && is_array($_POST['seasons']) ? array_map('sanitize_text_field', $_POST['seasons']) : array();
    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 0;
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : 'featured';

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 24,
        'post_status' => 'publish',
    );

    $tax_query = array('relation' => 'AND');

    if (!empty($cats)) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cats,
        );
    }

    if (!empty($seasons)) {
        $tax_query[] = array(
            'taxonomy' => 'product_season',
            'field'    => 'slug',
            'terms'    => $seasons,
        );
    }

    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    if ($sort === 'low-high') {
        $args['meta_key'] = 'product_offer_price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    } elseif ($sort === 'high-low') {
        $args['meta_key'] = 'product_offer_price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    } elseif ($sort === 'newest') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $p_id = get_the_ID();
            $price = get_post_meta($p_id, 'product_price', true);
            if (!$price && function_exists('get_field')) $price = get_field('product_price', $p_id);
            
            $offer_price = get_post_meta($p_id, 'product_offer_price', true);
            if (!$offer_price && function_exists('get_field')) $offer_price = get_field('product_offer_price', $p_id);
            
            $discount_label = get_post_meta($p_id, 'discount_label', true);
            if (!$discount_label && function_exists('get_field')) $discount_label = get_field('discount_label', $p_id);

            $thumb_url = get_the_post_thumbnail_url($p_id, 'gbh-card');
            if (!$thumb_url && function_exists('get_field')) $thumb_url = get_field('product_image', $p_id);
            if (!$thumb_url) $thumb_url = get_post_meta($p_id, 'product_image', true);
            ?>
            <div class="product-card" data-product-id="<?php echo esc_attr($p_id); ?>">
              <div class="product-img">
                <?php if ($thumb_url): ?>
                  <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                <?php else: ?>
                  🌱
                <?php endif; ?>

                <?php if ($discount_label): ?>
                  <span class="badge-hot"><?php echo esc_html($discount_label); ?></span>
                <?php else: ?>
                  <span class="badge-jaipur">Jaipur Special</span>
                <?php endif; ?>
              </div>

              <div class="product-body">
                <div class="product-category">
                  <?php
                  $terms = get_the_terms($p_id, 'product_cat');
                  echo ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Gardening';
                  ?>
                </div>

                <div class="product-name">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>

                <div class="product-desc">
                  <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                </div>

                <div class="product-footer">
                  <div class="product-price">
                    <?php if ($offer_price): ?>
                      ₹<?php echo esc_html($offer_price); ?>
                      <?php if ($price): ?><del>₹<?php echo esc_html($price); ?></del><?php endif; ?>
                    <?php else: ?>
                      ₹<?php echo esc_html($price ? $price : '199'); ?>
                    <?php endif; ?>
                  </div>

                  <button class="add-btn" data-product-id="<?php echo esc_attr($p_id); ?>">
                    Add to bag
                  </button>
                </div>
              </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<div style="grid-column:1/-1;text-align:center;padding:48px 20px;"><div style="font-size:3rem;margin-bottom:12px;">🌱🔍</div><h3 style="font-family:var(--f-display);color:var(--soil);">No products match your selection</h3><p style="color:var(--clay);margin-top:8px;">Try clearing filters or selecting another category.</p></div>';
    }

    $html = ob_get_clean();

    wp_send_json_success(array(
        'html' => $html,
        'count' => $query->found_posts
    ));
}
add_action('wp_ajax_gbh_filter_products', 'gbh_ajax_filter_products');
add_action('wp_ajax_nopriv_gbh_filter_products', 'gbh_ajax_filter_products');