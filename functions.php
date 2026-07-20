<?php
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
function remove_dashicons_styles()
{
    wp_deregister_style('dashicons');
}
add_action('wp_print_styles', 'remove_dashicons_styles', 100);

add_theme_support('post-thumbnails', array('blog'));
add_theme_support('post-thumbnails', array('post'));
add_theme_support('post-thumbnails', array('page'));

add_post_type_support('blog', array(
    'excerpt'
));

// Remove Wordpress Styles
add_action(
    'wp_enqueue_scripts',
    function () {
        wp_dequeue_style('classic-theme-styles');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('wp-block-library');
    },
    20
);

// Remove RSD link
remove_action('wp_head', 'rsd_link');

// Remove wordpress generator, robot meta tag
remove_action('wp_head', 'wp_generator');
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

// Block endpoints for public users only on wp-json requests
function allow_specific_rest_api_endpoints($endpoints)
{
    // Check if the request is for the REST API
    if (strpos($_SERVER['REQUEST_URI'], '/wp-json/') !== false) {
        // Allowed endpoints (Add the ones you want to keep)
        $allowed_endpoints = [
            '/wp/v2/posts',
            '/wp/v2/tags',
            '/wp/v2/blog',
            '/wp/v2/pages',
            '/simple-history/v1',
        ];
        // Loop through all registered endpoints
        foreach ($endpoints as $route => $handlers) {
            $route_match = false;
            // Check if the route starts with one of the allowed endpoints
            foreach ($allowed_endpoints as $allowed) {
                if (strpos($route, $allowed) === 0) {
                    $route_match = true;
                    break;
                }
            }
            // If the route does not match any allowed endpoint, unset it
            if (!$route_match) {
                unset($endpoints[$route]);
            }
        }
    }
    return $endpoints;
}
add_filter('rest_endpoints', 'allow_specific_rest_api_endpoints');

function add_cors_http_header()
{
    header("Access-Control-Allow-Origin: *");
}
add_action('init', 'add_cors_http_header');
//View Count Section
function increase_post_views($post_id)
{
    // Fetch current view count
    $views = get_post_meta($post_id, 'view_count', true);

    // Debug: Log the current view count
    error_log("Current views: " . $views);

    // If no view count exists, start from 0
    if (!$views) {
        $views = 0;
    }

    // Increment view count
    $views++;

    // Update the view count in the database
    $updated = update_post_meta($post_id, 'view_count', $views);

    // Debug: Log if update was successful
    if ($updated) {
        error_log("Views updated to: " . $views);
    } else {
        error_log("Failed to update views for post ID: " . $post_id);
    }
}

function track_post_views()
{
    if (is_single()) {
        $post_id = get_the_ID();

        // Ensure we don't count views for logged-in administrators
        if (!current_user_can('edit_posts')) {
            increase_post_views($post_id);
        }
    }
}
// Hook into wp to ensure it runs on single post pages
add_action('wp', 'track_post_views');

?>