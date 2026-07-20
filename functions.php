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

// 2. Disable unnecessary WordPress scripts/head bloat
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
    wp_deregister_style('dashicons');
}
add_action('wp_print_styles', 'remove_dashicons_styles', 100);

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

// 6. E-Commerce Cart Engine (AJAX Handlers)

/**
 * Get Cart Data helper function
 */
function gbh_get_cart_data() {
    if (!isset($_SESSION['gbh_cart'])) {
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

        // Fetch price from ACF or post meta
        $price = get_field('product_offer_price', $product_id);
        if (!$price) {
            $price = get_field('product_price', $product_id);
        }
        $price = floatval(preg_replace('/[^0-9.]/', '', $price));
        if ($price <= 0) $price = 199; // Fallback price

        $line_total = $price * $qty;
        $subtotal += $line_total;
        $total_count += $qty;

        // Image
        $img_url = get_the_post_thumbnail_url($product_id, 'gbh-thumb');
        if (!$img_url) {
            $img_field = get_field('product_image', $product_id);
            $img_url = $img_field ? $img_field : '';
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

    if (!isset($_SESSION['gbh_cart'])) {
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