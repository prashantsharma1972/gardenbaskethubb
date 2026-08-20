<?php
/**
 * Garden Basket Hub — Main Theme Functions
 *
 * All specialized subsystems are cleanly organized in the /inc/ directory.
 */

if (!defined('ABSPATH')) exit;

define('GBH_THEME_DIR', get_template_directory());
define('GBH_THEME_URI', get_template_directory_uri());

/* ============================================================
   1. API & CREDENTIALS CONFIGURATION
   ============================================================ */
// Razorpay Credentials (Plug keys directly here when received)
if (!defined('GBH_RAZORPAY_KEY_ID')) define('GBH_RAZORPAY_KEY_ID', get_option('gbh_razorpay_key_id', 'rzp_live_YOUR_KEY_ID_HERE'));
if (!defined('GBH_RAZORPAY_KEY_SECRET')) define('GBH_RAZORPAY_KEY_SECRET', get_option('gbh_razorpay_key_secret', 'YOUR_SECRET_HERE'));

// Shiprocket Credentials
if (!defined('GBH_SHIPROCKET_EMAIL')) define('GBH_SHIPROCKET_EMAIL', get_option('gbh_shiprocket_email', 'prashant753@gmail.com'));
if (!defined('GBH_SHIPROCKET_PASSWORD')) define('GBH_SHIPROCKET_PASSWORD', get_option('gbh_shiprocket_password', 'Snow@123'));
if (!defined('GBH_SHIPROCKET_PICKUP_LOCATION')) define('GBH_SHIPROCKET_PICKUP_LOCATION', get_option('gbh_shiprocket_pickup_location', 'Jaipur_Nursery_Main'));

/* ============================================================
   2. LOAD MODULAR SUBSYSTEMS (/inc/)
   ============================================================ */
require_once GBH_THEME_DIR . '/inc/cpt-taxonomies.php';
require_once GBH_THEME_DIR . '/inc/cart-engine.php';
require_once GBH_THEME_DIR . '/inc/razorpay-integration.php';
require_once GBH_THEME_DIR . '/inc/shiprocket-integration.php';
require_once GBH_THEME_DIR . '/inc/checkout-orders.php';
require_once GBH_THEME_DIR . '/inc/email-notifications.php';
require_once GBH_THEME_DIR . '/inc/seo-engine.php';
require_once GBH_THEME_DIR . '/inc/sitemap-robots.php';

/* ============================================================
   3. THEME SETUP & FEATURES SUPPORT
   ============================================================ */
function gbh_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');

    // Register Image Sizes
    add_image_size('gbh-card', 600, 600, true);
    add_image_size('gbh-hero', 1200, 800, true);
    add_image_size('gbh-thumb', 200, 200, true);
}
add_action('after_setup_theme', 'gbh_theme_setup');

// Disable WordPress Admin Bar for clean storefront design
add_filter('show_admin_bar', '__return_false');

/* ============================================================
   4. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function gbh_enqueue_assets() {
    // 1. Google Fonts
    wp_enqueue_style(
        'gbh-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:ital,opsz,wght@0,9..40,300..700;1,9..40,300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap',
        array(),
        null
    );

    // 2. Master Theme Stylesheet (100% full design tokens, typography, and 360px mobile responsive CSS)
    wp_enqueue_style(
        'gbh-main-style',
        get_stylesheet_uri(),
        array('gbh-google-fonts'),
        filemtime(GBH_THEME_DIR . '/style.css')
    );

    // 3. jQuery
    wp_enqueue_script('jquery');

    // 4. Master Frontend Engine
    wp_enqueue_script(
        'gbh-main-js',
        GBH_THEME_URI . '/assets/js/main.js',
        array('jquery'),
        filemtime(GBH_THEME_DIR . '/assets/js/main.js'),
        true
    );

    // 5. Localize Script with AJAX URL & Security Nonce
    wp_localize_script('gbh-main-js', 'gbh_ajax_obj', array(
        'ajax_url'        => admin_url('admin-ajax.php'),
        'nonce'           => wp_create_nonce('gbh_cart_nonce'),
        'home_url'        => home_url('/'),
        'shop_url'        => gbh_get_page_url('shop'),
        'cart_url'        => gbh_get_page_url('cart'),
        'checkout_url'    => gbh_get_page_url('checkout'),
        'razorpay_key_id' => (GBH_RAZORPAY_KEY_ID && GBH_RAZORPAY_KEY_ID !== 'rzp_live_YOUR_KEY_ID_HERE') ? GBH_RAZORPAY_KEY_ID : 'rzp_test_GBH_SIMULATED',
    ));
}
add_action('wp_enqueue_scripts', 'gbh_enqueue_assets');



/* ============================================================
   5. POST VIEWS TRACKER
   ============================================================ */
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