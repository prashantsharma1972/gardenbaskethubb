<?php
/**
 * Technical SEO, Open Graph & Schema.org JSON-LD Engine Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH')) exit;

/**
 * Render Dynamic Titles, Meta Descriptions, Canonical, OG Tags & Schema.org JSON-LD
 */
function gbh_render_seo_meta_tags() {
    $site_name = get_bloginfo('name') ? get_bloginfo('name') : 'Garden Basket Hub';
    $site_desc = 'Jaipur’s Premier E-Commerce Nursery for Heirloom Seeds, Live Saplings, 100% Organic Vermicompost & Terracotta Clay Pots. Same-day delivery in Jaipur!';
    $site_logo = get_template_directory_uri() . '/assets/images/og-banner.jpg';

    $page_title = '';
    $meta_desc  = $site_desc;
    $og_type    = 'website';
    $og_image   = $site_logo;

    global $wp;
    $canonical_url = home_url(add_query_arg(array(), isset($wp->request) ? $wp->request : ''));
    if (!empty($_SERVER['REQUEST_URI'])) {
        $canonical_url = home_url($_SERVER['REQUEST_URI']);
    }

    if (is_front_page()) {
        $page_title = 'Garden Basket Hub — Heirloom Seeds, Saplings & Organic Soil Jaipur';
        $meta_desc  = 'Buy 100% organic heirloom seeds, sapling trays, vermicompost, and handcrafted terracotta pots online in Jaipur. Same-day nursery delivery!';
    } elseif (is_singular('product')) {
        $post_id = get_the_ID();
        $price   = get_post_meta($post_id, 'product_offer_price', true);
        if (!$price) $price = get_post_meta($post_id, 'product_price', true);
        if (!$price) $price = '199';

        $page_title = get_the_title() . ' (₹' . $price . ') — Garden Basket Hub Jaipur';
        $excerpt    = get_the_excerpt();
        if ($excerpt) $meta_desc = wp_strip_all_tags($excerpt);
        
        $thumb = get_the_post_thumbnail_url($post_id, 'large');
        if ($thumb) $og_image = $thumb;
        $og_type = 'product';

        // Render Product Schema JSON-LD
        echo '<script type="application/ld+json">' . json_encode(array(
            '@context'    => 'https://schema.org/',
            '@type'       => 'Product',
            'name'        => get_the_title(),
            'image'       => array($og_image),
            'description' => $meta_desc,
            'sku'         => 'GBH-PROD-' . $post_id,
            'brand'       => array('@type' => 'Brand', 'name' => 'Garden Basket Hub'),
            'offers'      => array(
                '@type'         => 'Offer',
                'url'           => get_permalink(),
                'priceCurrency' => 'INR',
                'price'         => floatval($price),
                'availability'  => 'https://schema.org/InStock',
                'seller'        => array('@type' => 'Organization', 'name' => 'Garden Basket Hub')
            )
        ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";

    } elseif (is_singular('post')) {
        $post_id = get_the_ID();
        $page_title = get_the_title() . ' — Gardening Tips | Garden Basket Hub';
        $excerpt    = get_the_excerpt();
        if ($excerpt) $meta_desc = wp_strip_all_tags($excerpt);
        $thumb = get_the_post_thumbnail_url($post_id, 'large');
        if ($thumb) $og_image = $thumb;
        $og_type = 'article';

        // Render Article Schema JSON-LD
        echo '<script type="application/ld+json">' . json_encode(array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'image'         => array($og_image),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'author'        => array('@type' => 'Organization', 'name' => 'Garden Basket Hub Nursery Team')
        ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";

    } elseif (is_post_type_archive('product') || is_page('shop')) {
        $page_title = 'Nursery Shop — Heirloom Seeds, Saplings & Soil | Garden Basket Hub';
        $meta_desc  = 'Explore our curated shop of non-GMO heirloom seeds, seedling trays, organic soil mix, gardening tools, and clay pots. Same-day Jaipur delivery!';
    } elseif (is_post_type_archive('reels') || is_page('reels')) {
        $page_title = 'Gardening Reels & Video Guides | Garden Basket Hub';
        $meta_desc  = 'Watch quick 60-second video guides on seed germination, potting mix ratios, pest prevention, and balcony garden maintenance.';
    } elseif (is_home() || is_archive() || is_page('blog')) {
        $page_title = 'Gardening Guides, Soil Ratios & Care Tips | Garden Basket Hub';
        $meta_desc  = 'Expert urban farming blog — monsoon plant care, vermicompost ratios, seedling protection, and organic growing guides.';
    } else {
        $page_title = get_the_title() . ' — Garden Basket Hub Jaipur';
    }

    // Output Meta Tags
    echo '<title>' . esc_html($page_title) . '</title>' . "\n";
    echo '<meta name="description" content="' . esc_attr($meta_desc) . '">' . "\n";
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";

    // Open Graph (OG) Meta Tags
    echo '<meta property="og:locale" content="en_IN">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($meta_desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical_url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    if ($og_image) {
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
    }

    // Twitter Card Meta Tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($page_title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($meta_desc) . '">' . "\n";
    if ($og_image) {
        echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
    }

    // LocalBusiness Nursery Schema
    if (is_front_page()) {
        echo '<script type="application/ld+json">' . json_encode(array(
            '@context'    => 'https://schema.org',
            '@type'       => 'GardenStore',
            'name'        => 'Garden Basket Hub',
            'url'         => home_url('/'),
            'logo'        => $site_logo,
            'description' => $site_desc,
            'telephone'   => '+91-9876543210',
            'address'     => array(
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Jaipur',
                'addressRegion'   => 'Rajasthan',
                'postalCode'      => '302001',
                'addressCountry'  => 'IN'
            ),
            'geo'         => array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => '26.9124',
                'longitude' => '75.7873'
            ),
            'openingHoursSpecification' => array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
                'opens'     => '08:00',
                'closes'    => '20:00'
            )
        ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
add_action('wp_head', 'gbh_render_seo_meta_tags', 1);
