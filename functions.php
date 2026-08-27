<?php
/**
 * Garden Basket Hub — Main Theme Functions
 *
 * All specialized subsystems are cleanly organized in the /inc/ directory.
 */

if (!defined('ABSPATH'))
    exit;

define('GBH_THEME_DIR', get_template_directory());
define('GBH_THEME_URI', get_template_directory_uri());

/* ============================================================
   1. DISABLE UNUSED WP FEATURES (from s2-labs)
   ============================================================ */
// Disable WordPress Emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Disable WordPress Embeds and unused link tags
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'rel_shortlink');

// Disable Dashicons
function remove_dashicons_styles() {
    wp_deregister_style('dashicons');
}
add_action('wp_print_styles', 'remove_dashicons_styles', 100);

function add_image_insert_override($size) {
    unset($size["thumbnail"]);
    unset($size["medium"]);
    unset($size["medium_large"]);
    unset($size["large"]);
    unset($size["1536x1536"]);
    unset($size["2048x2048"]);
    return $size;
}
add_action("intermediate_image_sizes_advanced", "add_image_insert_override");

// Block endpoints for public users only on wp-json requests
function allow_specific_rest_api_endpoints($endpoints) {
    if (strpos($_SERVER['REQUEST_URI'], '/wp-json/') !== false) {
        $allowed_endpoints = [
            '/wp/v2/posts',
            '/wp/v2/tags',
            '/wp/v2/pages',
            '/wp/v2/products',
            '/wp/v2/gardening-reels',
        ];
        foreach ($endpoints as $route => $handlers) {
            $route_match = false;
            foreach ($allowed_endpoints as $allowed) {
                if (strpos($route, $allowed) === 0) {
                    $route_match = true;
                    break;
                }
            }
            if (!$route_match) {
                unset($endpoints[$route]);
            }
        }
    }
    return $endpoints;
}
add_filter('rest_endpoints', 'allow_specific_rest_api_endpoints');

function disable_search_redirect() {
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url('/404'));
        exit();
    }
}
add_action('template_redirect', 'disable_search_redirect');

/* ============================================================
   2. API & CREDENTIALS CONFIGURATION
   ============================================================ */
// Razorpay Credentials (Plug keys directly here when received)
if (!defined('GBH_RAZORPAY_KEY_ID'))
    define('GBH_RAZORPAY_KEY_ID', get_option('gbh_razorpay_key_id', 'rzp_live_YOUR_KEY_ID_HERE'));
if (!defined('GBH_RAZORPAY_KEY_SECRET'))
    define('GBH_RAZORPAY_KEY_SECRET', get_option('gbh_razorpay_key_secret', 'YOUR_SECRET_HERE'));

// Shiprocket Credentials
if (!defined('GBH_SHIPROCKET_EMAIL'))
    define('GBH_SHIPROCKET_EMAIL', get_option('gbh_shiprocket_email', 'prashant753@gmail.com'));
if (!defined('GBH_SHIPROCKET_PASSWORD'))
    define('GBH_SHIPROCKET_PASSWORD', get_option('gbh_shiprocket_password', 'Snow@123'));
if (!defined('GBH_SHIPROCKET_PICKUP_LOCATION'))
    define('GBH_SHIPROCKET_PICKUP_LOCATION', get_option('gbh_shiprocket_pickup_location', 'Jaipur_Nursery_Main'));

/* ============================================================
   2. LOAD MODULAR SUBSYSTEMS (/inc/ & /helpers/)
   ============================================================ */
require_once GBH_THEME_DIR . '/inc/cpt-taxonomies.php';
require_once GBH_THEME_DIR . '/inc/cart-engine.php';
require_once GBH_THEME_DIR . '/inc/razorpay-integration.php';
require_once GBH_THEME_DIR . '/inc/shiprocket-integration.php';
require_once GBH_THEME_DIR . '/inc/checkout-orders.php';
require_once GBH_THEME_DIR . '/inc/email-notifications.php';

// New Helpers
require_once GBH_THEME_DIR . '/helpers/PaymentGateway.php';
require_once GBH_THEME_DIR . '/helpers/ShippingManager.php';
// SEO and Sitemap Modules
require_once GBH_THEME_DIR . '/inc/seo-engine.php';
require_once GBH_THEME_DIR . '/inc/sitemap-robots.php';

/* ============================================================
   3. THEME SETUP & FEATURES SUPPORT
   ============================================================ */
function gbh_theme_setup()
{
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

// Register Custom Menus
function gbh_register_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'gardenbaskethubb'),
        'footer-menu' => __('Footer Menu', 'gardenbaskethubb')
    ));
}
add_action('init', 'gbh_register_menus');

// Disable WordPress Admin Bar for clean storefront design
add_filter('show_admin_bar', '__return_false');

/* ============================================================
   4. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function gbh_enqueue_assets()
{
    // 1. Google Fonts
    wp_enqueue_style(
        'gbh-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:ital,opsz,wght@0,9..40,300..700;1,9..40,300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap',
        array(),
        null
    );

    // 2. Master Theme Stylesheet
    wp_enqueue_style(
        'gbh-main-style',
        get_stylesheet_uri(),
        array('gbh-google-fonts'),
        filemtime(GBH_THEME_DIR . '/style.css')
    );

    // 3. jQuery
    wp_enqueue_script('jquery');

    // 4. Razorpay Checkout Script
    wp_enqueue_script('razorpay-checkout', 'https://checkout.razorpay.com/v1/checkout.js', array(), null, true);

    // 5. Global settings for Webpack JS
    wp_add_inline_script('jquery', '
        window.gbh_ajax_obj = {
            ajax_url: "' . admin_url('admin-ajax.php') . '",
            nonce: "' . wp_create_nonce('gbh_cart_nonce') . '",
            home_url: "' . home_url('/') . '",
            cart_url: "' . home_url('/cart/') . '",
            checkout_url: "' . home_url('/checkout/') . '",
            shop_url: "' . home_url('/shop/') . '",
            razorpay_key_id: "' . ((GBH_RAZORPAY_KEY_ID && GBH_RAZORPAY_KEY_ID !== 'rzp_live_YOUR_KEY_ID_HERE') ? GBH_RAZORPAY_KEY_ID : 'rzp_test_GBH_SIMULATED') . '"
        };
    ', 'before');
}
add_action('wp_enqueue_scripts', 'gbh_enqueue_assets');



/* ============================================================
   5. POST VIEWS TRACKER
   ============================================================ */
function increase_post_views($post_id)
{
    $views = get_post_meta($post_id, 'view_count', true);
    if (!$views)
        $views = 0;
    $views++;
    update_post_meta($post_id, 'view_count', $views);
}

function track_post_views()
{
    if (is_single()) {
        $post_id = get_the_ID();
        if (!current_user_can('edit_posts')) {
            increase_post_views($post_id);
        }
    }
}
add_action('wp', 'track_post_views');

// One-time flush rewrite rules to fix 404 errors on Custom Post Types
add_action('init', function () {
    if (!get_option('gbh_rules_flushed_v4')) {
        flush_rewrite_rules();
        update_option('gbh_rules_flushed_v4', 1);
    }
}, 99);