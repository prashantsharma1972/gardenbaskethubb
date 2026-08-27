<?php
/**
 * XML Sitemap & Robots.txt Directives Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * Register Sitemap Rewrite Rule
 */
function gbh_register_sitemap_rewrite()
{
    add_rewrite_rule('^sitemap\.xml$', 'index.php?gbh_sitemap=1', 'top');
}
add_action('init', 'gbh_register_sitemap_rewrite');

/**
 * Register Custom Query Variable
 */
function gbh_add_sitemap_query_var($vars)
{
    $vars[] = 'gbh_sitemap';
    return $vars;
}
add_filter('query_vars', 'gbh_add_sitemap_query_var');

/**
 * Output Dynamic XML Sitemap
 */
function gbh_render_xml_sitemap()
{
    if (get_query_var('gbh_sitemap')) {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        $urls = array(
            array('url' => home_url('/'), 'priority' => '1.0', 'changefreq' => 'daily'),
            array('url' => gbh_get_page_url('shop'), 'priority' => '0.9', 'changefreq' => 'daily'),
            array('url' => gbh_get_page_url('reels'), 'priority' => '0.8', 'changefreq' => 'weekly'),
            array('url' => gbh_get_page_url('blog'), 'priority' => '0.8', 'changefreq' => 'weekly'),
            array('url' => gbh_get_page_url('about-us'), 'priority' => '0.7', 'changefreq' => 'monthly'),
            array('url' => gbh_get_page_url('contact-us'), 'priority' => '0.7', 'changefreq' => 'monthly'),
        );

        // Add Products
        $prods = get_posts(array('post_type' => 'product', 'posts_per_page' => 100, 'post_status' => 'publish'));
        foreach ($prods as $p) {
            $urls[] = array(
                'url' => get_permalink($p->ID),
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => get_the_modified_date('c', $p->ID)
            );
        }

        // Add Blogs
        $blogs = get_posts(array('post_type' => 'post', 'posts_per_page' => 100, 'post_status' => 'publish'));
        foreach ($blogs as $b) {
            $urls[] = array(
                'url' => get_permalink($b->ID),
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => get_the_modified_date('c', $b->ID)
            );
        }

        foreach ($urls as $u) {
            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url($u['url']) . '</loc>' . "\n";
            if (isset($u['lastmod'])) {
                echo '    <lastmod>' . esc_html($u['lastmod']) . '</lastmod>' . "\n";
            }
            echo '    <changefreq>' . esc_html($u['changefreq']) . '</changefreq>' . "\n";
            echo '    <priority>' . esc_html($u['priority']) . '</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        echo '</urlset>';
        exit;
    }
}
add_action('template_redirect', 'gbh_render_xml_sitemap');

/**
 * Custom Robots.txt Directives Filter
 */
function gbh_custom_robots_txt($output, $public)
{
    $sitemap_url = home_url('/sitemap.xml');
    $robots = "User-agent: *\n";
    $robots .= "Allow: /\n";
    $robots .= "Disallow: /wp-admin/\n";
    $robots .= "Disallow: /cart/\n";
    $robots .= "Disallow: /checkout/\n";
    $robots .= "Disallow: /thank-you/\n\n";
    $robots .= "Sitemap: " . $sitemap_url . "\n";
    return $robots;
}
add_filter('robots_txt', 'gbh_custom_robots_txt', 99, 2);
