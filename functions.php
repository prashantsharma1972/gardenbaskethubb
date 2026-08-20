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



// 5. Enqueue Styles & Scripts
function gbh_enqueue_assets() {
    // Fonts
    wp_enqueue_style('gbh-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;700&family=DM+Mono:wght@400&display=swap', array(), null);
    
    // Main Stylesheet
    wp_enqueue_style('gbh-style', get_stylesheet_uri(), array('gbh-fonts'), '1.0.0');

    // Global settings for Webpack JS
    wp_add_inline_script('jquery', '
        window.gbh_ajax_obj = {
            ajax_url: "' . admin_url('admin-ajax.php') . '",
            nonce: "' . wp_create_nonce('gbh_cart_nonce') . '",
            cart_url: "' . home_url('/cart/') . '",
            checkout_url: "' . home_url('/checkout/') . '"
        };
    ', 'before');
}
add_action('wp_enqueue_scripts', 'gbh_enqueue_assets');

// 6. Load Professional Helpers
require_once GBH_THEME_DIR . '/helpers/CartAPI.php';
require_once GBH_THEME_DIR . '/helpers/PaymentGateway.php';
require_once GBH_THEME_DIR . '/helpers/ShippingManager.php';
require_once GBH_THEME_DIR . '/helpers/SEOManager.php';

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