<?php
/**
 * Garden Basket Hub — Professional SEO, Sitemap & Robots.txt Manager
 */

if (!defined('ABSPATH')) exit;

class GBH_SEO_Manager {

    public static function init() {
        add_action('wp_head', array(__CLASS__, 'inject_meta_tags'), 1);
        add_action('do_robotstxt', array(__CLASS__, 'generate_robots_txt'), 10, 2);
        
        // Add rewrite rule for dynamic sitemap if desired
        // Or generate a static sitemap.xml in root
    }

    public static function inject_meta_tags() {
        global $post;
        
        $title = get_bloginfo('name');
        $desc = get_bloginfo('description');
        $url = home_url();
        $image = get_theme_file_uri('assets/images/og-default.jpg'); // Fallback

        if (is_singular()) {
            $title = get_the_title() . ' | ' . get_bloginfo('name');
            $desc = wp_trim_words(get_the_excerpt(), 20);
            $url = get_permalink();
            if (has_post_thumbnail()) {
                $image = get_the_post_thumbnail_url(null, 'large');
            }
        }

        echo '<!-- GBH SEO Manager -->'."\n";
        echo '<meta name="description" content="'.esc_attr($desc).'">'."\n";
        echo '<meta property="og:title" content="'.esc_attr($title).'">'."\n";
        echo '<meta property="og:description" content="'.esc_attr($desc).'">'."\n";
        echo '<meta property="og:url" content="'.esc_url($url).'">'."\n";
        echo '<meta property="og:type" content="website">'."\n";
        echo '<meta property="og:image" content="'.esc_url($image).'">'."\n";
        echo '<meta name="twitter:card" content="summary_large_image">'."\n";
        echo '<!-- /GBH SEO Manager -->'."\n";
    }

    public static function generate_robots_txt($output, $public) {
        $site_url = home_url();
        
        $custom_robots = "User-agent: *\n";
        $custom_robots .= "Disallow: /wp-admin/\n";
        $custom_robots .= "Allow: /wp-admin/admin-ajax.php\n";
        $custom_robots .= "Sitemap: {$site_url}/sitemap.xml\n";
        
        return $custom_robots;
    }
}

GBH_SEO_Manager::init();
