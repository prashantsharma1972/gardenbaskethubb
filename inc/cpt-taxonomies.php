<?php
/**
 * Custom Post Types, Taxonomies, Page Creator & URL Routing Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

// 1. Register Custom Post Types & Taxonomies
function gbh_register_cpts_and_taxonomies()
{
    // CPT: Products
    register_post_type('product', array(
        'labels' => array(
            'name' => 'Products',
            'singular_name' => 'Product',
            'add_new_item' => 'Add New Product',
            'edit_item' => 'Edit Product',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'shop'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-cart',
        'show_in_rest' => true,
    ));

    // Taxonomy: Product Categories
    register_taxonomy('product_cat', 'product', array(
        'labels' => array(
            'name' => 'Product Categories',
            'singular_name' => 'Product Category',
        ),
        'hierarchical' => true,
        'rewrite' => array('slug' => 'product-category'),
        'show_in_rest' => true,
    ));

    // Taxonomy: Sowing Seasons
    register_taxonomy('product_season', 'product', array(
        'labels' => array(
            'name' => 'Sowing Seasons',
            'singular_name' => 'Season',
        ),
        'hierarchical' => true,
        'rewrite' => array('slug' => 'season'),
        'show_in_rest' => true,
    ));

    // CPT: Gardening Reels
    register_post_type('reels', array(
        'labels' => array(
            'name' => 'Gardening Reels',
            'singular_name' => 'Reel',
            'add_new_item' => 'Add New Reel',
            'edit_item' => 'Edit Reel',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'reels'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-video-alt3',
        'show_in_rest' => true,
    ));

    // Taxonomy: Reel Category
    register_taxonomy('reel_cat', 'reels', array(
        'labels' => array(
            'name' => 'Reel Categories',
            'singular_name' => 'Reel Category',
        ),
        'hierarchical' => true,
        'rewrite' => array('slug' => 'reel-category'),
        'show_in_rest' => true,
    ));

    // CPT: GBH Store Orders
    register_post_type('gbh_order', array(
        'labels' => array(
            'name' => 'Store Orders',
            'singular_name' => 'Order',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-clipboard',
    ));
}
add_action('init', 'gbh_register_cpts_and_taxonomies');

// 2. Automatic Required Pages Creator
function gbh_create_required_wp_pages()
{
    $pages = array(
        'shop' => array('title' => 'Shop All Products', 'template' => 'archive-product.php'),
        'reels' => array('title' => 'Gardening Reels', 'template' => 'archive-reels.php'),
        'blog' => array('title' => 'Gardening Guides & Blog', 'template' => 'archive-blog.php'),
        'about-us' => array('title' => 'About Us & Nursery Story', 'template' => 'page-about-us.php'),
        'contact-us' => array('title' => 'Contact Us', 'template' => 'page-contact-us.php'),
        'cart' => array('title' => 'Shopping Bag', 'template' => 'page-cart.php'),
        'checkout' => array('title' => 'Checkout', 'template' => 'page-checkout.php'),
        'thank-you' => array('title' => 'Order Confirmation', 'template' => 'page-thank-you.php'),
        'privacy-policy' => array('title' => 'Privacy Policy', 'template' => 'privacy-policy.php'),
        'terms-and-conditions' => array('title' => 'Terms & Conditions', 'template' => 'page-terms-and-conditions.php'),
        'refund-policy' => array('title' => 'Refund & Shipping Policy', 'template' => 'page-refund-policy.php'),
    );

    foreach ($pages as $slug => $data) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_type' => 'page',
                'post_title' => $data['title'],
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_content' => '',
            ));
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
}
add_action('init', 'gbh_create_required_wp_pages', 5);

// 3. Dynamic URL Resolver Helper
function gbh_get_page_url($slug)
{
    $page = get_page_by_path($slug);
    if ($page) {
        return get_permalink($page->ID);
    }

    // Check if pretty permalinks are enabled
    $permalink_structure = get_option('permalink_structure');
    if (!empty($permalink_structure)) {
        return home_url('/' . trim($slug, '/') . '/');
    }

    return home_url('/?page_name=' . urlencode($slug));
}

// 4. Template Redirect Override Guard
function gbh_template_redirect_override($template)
{
    if (is_admin())
        return $template;

    $req_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $path = trim(parse_url($req_uri, PHP_URL_PATH), '/');

    // Routing rules
    $route_map = array(
        'shop' => 'archive-product.php',
        'reels' => 'archive-reels.php',
        'blog' => 'archive-blog.php',
        'about-us' => 'page-about-us.php',
        'contact-us' => 'page-contact-us.php',
        'cart' => 'page-cart.php',
        'checkout' => 'page-checkout.php',
        'thank-you' => 'page-thank-you.php',
        'privacy-policy' => 'privacy-policy.php',
        'terms-and-conditions' => 'page-terms-and-conditions.php',
        'refund-policy' => 'page-refund-policy.php',
    );

    if (isset($route_map[$path])) {
        $file = get_template_directory() . '/' . $route_map[$path];
        if (file_exists($file))
            return $file;
    }

    if (is_tax('product_cat') || is_tax('product_season') || is_post_type_archive('product')) {
        if (file_exists(get_template_directory() . '/archive-product.php')) {
            return get_template_directory() . '/archive-product.php';
        }
    }

    if (isset($_GET['post_type'])) {
        if ($_GET['post_type'] === 'product' && file_exists(get_template_directory() . '/archive-product.php')) {
            return get_template_directory() . '/archive-product.php';
        }
        if ($_GET['post_type'] === 'reels' && file_exists(get_template_directory() . '/archive-reels.php')) {
            return get_template_directory() . '/archive-reels.php';
        }
    }

    if (is_single()) {
        $post_type = get_post_type();
        if ($post_type === 'product' && file_exists(get_template_directory() . '/single-product.php')) {
            return get_template_directory() . '/single-product.php';
        }
        if ($post_type === 'reels' && file_exists(get_template_directory() . '/single-reels.php')) {
            return get_template_directory() . '/single-reels.php';
        }
        if (($post_type === 'post' || $post_type === 'blog') && file_exists(get_template_directory() . '/single-blog.php')) {
            return get_template_directory() . '/single-blog.php';
        }
    }

    return $template;
}
add_filter('template_include', 'gbh_template_redirect_override', 99);

// 5. Automatic Sample Content Seeder
function gbh_seed_sample_content()
{
    $prod_count = wp_count_posts('product');
    if (isset($prod_count->publish) && intval($prod_count->publish) === 0) {
        $sample_products = array(
            array(
                'title' => 'Tomato Sapling Tray (6 Live Plants)',
                'excerpt' => '6 healthy, well-rooted hybrid cherry tomato saplings, 3 weeks old. Ready for balcony pot transplanting.',
                'content' => 'Grown with organic vermicompost and neem cake in Jaipur nursery. Guaranteed high fruit yield within 60-70 days.',
                'cat' => 'Saplings',
                'season' => 'Monsoon',
                'price' => '249',
                'offer_price' => '199',
                'badge' => 'Jaipur Only',
                'seeds' => '6 Saplings',
                'type' => 'Hybrid Cherry',
                'germ_temp' => '20-28°C',
                'germ_time' => '6-8 Days',
                'harvest' => '60-70 Days',
                'pot_size' => '12 Inch Pot / Grow Bag',
                'level' => 'Beginner Friendly'
            ),
            array(
                'title' => 'Monsoon Veggie Heirloom Seed Kit',
                'excerpt' => '8 heirloom variety seed packets (Okra, Ridge Gourd, Bitter Gourd, Chillies, Brinjal, Spinach, Coriander, Basil).',
                'content' => '100% Non-GMO open-pollinated seeds tested for 85%+ germination rate in Rajasthan & North Indian climate.',
                'cat' => 'Seeds',
                'season' => 'Monsoon',
                'price' => '449',
                'offer_price' => '349',
                'badge' => 'Bestseller',
                'seeds' => '8 Varieties (120+ Seeds)',
                'type' => '100% Heirloom Non-GMO',
                'germ_temp' => '22-32°C',
                'germ_time' => '4-10 Days',
                'harvest' => '45-60 Days',
                'pot_size' => '10-14 Inch Pots',
                'level' => 'Beginner Friendly'
            ),
            array(
                'title' => 'Premium Organic Vermicompost 5kg',
                'excerpt' => '100% pure organic earthworm castings enriched with neem cake, bone meal & beneficial soil microbes.',
                'content' => 'Odorless, weed-free, and rich in NPK nutrients for vigorous root development and leafy greens.',
                'cat' => 'Manures & Fertilizers',
                'season' => 'All Year',
                'price' => '399',
                'offer_price' => '299',
                'badge' => '100% Organic',
                'seeds' => '5kg Pack',
                'type' => 'Earthworm Castings',
                'germ_temp' => 'N/A',
                'germ_time' => 'N/A',
                'harvest' => 'Immediate Soil Boost',
                'pot_size' => 'All Pots & Garden Beds',
                'level' => 'Essential Care'
            ),
            array(
                'title' => 'Marigold Flowering Sapling Pack',
                'excerpt' => 'Pack of 4 fresh blooming saplings (Orange & Yellow varieties), ready to transplant.',
                'content' => 'Marigolds repel garden pests and bring vibrant festive colors to your home garden.',
                'cat' => 'Saplings',
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
                'badge' => 'Value Bundle',
                'seeds' => 'Starter Pack',
                'type' => 'All-In-One Gardening Kit',
                'germ_temp' => '20-30°C',
                'germ_time' => '5-8 Days',
                'harvest' => '40-60 Days',
                'pot_size' => 'Includes Tray',
                'level' => 'Complete Beginner'
            )
        );

        foreach ($sample_products as $sp) {
            $p_id = wp_insert_post(array(
                'post_type' => 'product',
                'post_title' => $sp['title'],
                'post_excerpt' => $sp['excerpt'],
                'post_content' => $sp['content'],
                'post_status' => 'publish',
            ));

            if ($p_id && !is_wp_error($p_id)) {
                update_post_meta($p_id, 'product_price', $sp['price']);
                update_post_meta($p_id, 'product_offer_price', $sp['offer_price']);
                update_post_meta($p_id, 'discount_label', $sp['badge']);
                update_post_meta($p_id, 'number_of_seeds', $sp['seeds']);
                update_post_meta($p_id, 'seed_type', $sp['type']);
                update_post_meta($p_id, 'germination_temperature', $sp['germ_temp']);
                update_post_meta($p_id, 'germination_time', $sp['germ_time']);
                update_post_meta($p_id, 'first_harvest', $sp['harvest']);
                update_post_meta($p_id, 'container_pot_size', $sp['pot_size']);
                update_post_meta($p_id, 'growing_level', $sp['level']);

                wp_set_object_terms($p_id, $sp['cat'], 'product_cat');
                wp_set_object_terms($p_id, $sp['season'], 'product_season');
            }
        }
    }

    // Seed Reels if empty
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

// Helper: Get product post by title safely (replaces deprecated get_page_by_title)
function gbh_get_product_by_title($title)
{
    $posts = get_posts(array(
        'post_type'        => 'product',
        'title'            => $title,
        'post_status'      => 'any',
        'numberposts'      => 1,
        'suppress_filters' => false,
    ));
    return !empty($posts) ? $posts[0] : null;
}

// ============================================================
// 5B. ENSURE STAR FEATURED PRODUCT EXISTS (CR §6)
// ============================================================
function gbh_ensure_star_product_exists()
{
    if (get_option('gbh_star_product_synced_v2')) {
        return;
    }

    $booster = gbh_get_product_by_title('Garden Basket Organic Plant Booster (500ml)');
    if (!$booster) {
        $p_id = wp_insert_post(array(
            'post_type'    => 'product',
            'post_title'   => 'Garden Basket Organic Plant Booster (500ml)',
            'post_name'    => 'garden-basket-organic-plant-booster-500ml',
            'post_excerpt' => 'All-in-one organic liquid bio-nutrition booster formulated with seaweed kelp, humic acids, and micronutrients. Delivers visible greener leaves in 5 days and 3x more vibrant flower blooms.',
            'post_content' => 'Garden Basket Organic Plant Booster is a 100% natural, laboratory-tested bio-stimulant formulated in Jaipur. Suitable for all balcony flowers, indoor foliage, terrace vegetables, and lawn grasses. Dilute 5ml per liter of water and spray or drench weekly.',
            'post_status'  => 'publish',
        ));

        if ($p_id && !is_wp_error($p_id)) {
            update_post_meta($p_id, 'product_price', '399');
            update_post_meta($p_id, 'product_offer_price', '299');
            update_post_meta($p_id, 'discount_label', '25% OFF');
            update_post_meta($p_id, 'seed_type', 'Bio-Liquid Fertilizer (500ml)');
            update_post_meta($p_id, 'growing_level', 'All Gardeners');
            wp_set_object_terms($p_id, 'Manures & Fertilizers', 'product_cat');
            wp_set_object_terms($p_id, 'All Year', 'product_season');
        }
    }
    update_option('gbh_star_product_synced_v2', 1);
}
add_action('init', 'gbh_ensure_star_product_exists', 22);

// ============================================================
// 6. CLIENT AGREED 9-CATEGORY TREE DATA DEFINITION (CR §2)
// ============================================================
function gbh_get_client_category_tree()
{
    return array(
        'seeds' => array(
            'name' => 'Seeds',
            'slug' => 'seeds',
            'icon' => '🌱',
            'subs' => array(
                array('name' => 'Flowers', 'slug' => 'flower-seeds'),
                array('name' => 'Vegetables', 'slug' => 'vegetable-seeds'),
                array('name' => 'Exotic', 'slug' => 'exotic-seeds'),
                array('name' => 'Forestry', 'slug' => 'forestry-seeds'),
            )
        ),
        'saplings' => array(
            'name' => 'Saplings',
            'slug' => 'saplings',
            'icon' => '🌿',
            'badge' => 'Jaipur Only',
            'subs' => array()
        ),
        'bulbs' => array(
            'name' => 'Bulbs',
            'slug' => 'bulbs',
            'icon' => '🧅',
            'subs' => array(
                array('name' => 'Lily Bulbs', 'slug' => 'lily-bulbs'),
            )
        ),
        'manures-fertilizers' => array(
            'name' => 'Manures & Fertilizers',
            'slug' => 'manures-fertilizers',
            'icon' => '🪴',
            'subs' => array()
        ),
        'combos' => array(
            'name' => 'Combos',
            'slug' => 'combos',
            'icon' => '🎁',
            'subs' => array(
                array('name' => 'Vegetable Seed Combos', 'slug' => 'vegetable-seed-combos'),
                array('name' => 'Forestry Seed Combos', 'slug' => 'forestry-seed-combos'),
            )
        ),
        'sprayers' => array(
            'name' => 'Sprayers',
            'slug' => 'sprayers',
            'icon' => '🚿',
            'subs' => array()
        ),
        'tools' => array(
            'name' => 'Tools',
            'slug' => 'tools',
            'icon' => '🛠️',
            'subs' => array()
        ),
        'grow-bags' => array(
            'name' => 'Grow Bags',
            'slug' => 'grow-bags',
            'icon' => '🛍️',
            'subs' => array()
        ),
        'pots' => array(
            'name' => 'Pots',
            'slug' => 'pots',
            'icon' => '🌸',
            'subs' => array()
        ),
    );
}

// ============================================================
// 7. AUTO-REGISTER & SYNC 9-CATEGORY TREE IN WORDPRESS (CR §2)
// ============================================================
function gbh_setup_client_category_tree()
{
    if (get_option('gbh_client_tree_synced_v2')) {
        return;
    }

    // A. Rename legacy 'Seedlings' to 'Saplings' in product_cat
    $old_seedlings = get_term_by('name', 'Seedlings', 'product_cat');
    if (!$old_seedlings) {
        $old_seedlings = get_term_by('slug', 'seedlings', 'product_cat');
    }
    if ($old_seedlings && !is_wp_error($old_seedlings)) {
        wp_update_term($old_seedlings->term_id, 'product_cat', array(
            'name' => 'Saplings',
            'slug' => 'saplings'
        ));
    }

    // B. Register the 9 categories and respective subcategories
    $tree = gbh_get_client_category_tree();
    foreach ($tree as $main_key => $cat_data) {
        $parent_term = get_term_by('slug', $cat_data['slug'], 'product_cat');
        if (!$parent_term) {
            $parent_term = get_term_by('name', $cat_data['name'], 'product_cat');
        }

        $parent_id = 0;
        if (!$parent_term) {
            $inserted = wp_insert_term($cat_data['name'], 'product_cat', array(
                'slug' => $cat_data['slug'],
                'parent' => 0
            ));
            if (!is_wp_error($inserted)) {
                $parent_id = $inserted['term_id'];
            }
        } else {
            $parent_id = $parent_term->term_id;
            wp_update_term($parent_id, 'product_cat', array('name' => $cat_data['name']));
        }

        // Subcategories
        if ($parent_id && !empty($cat_data['subs'])) {
            foreach ($cat_data['subs'] as $sub) {
                $sub_term = get_term_by('slug', $sub['slug'], 'product_cat');
                if (!$sub_term) {
                    $sub_term = get_term_by('name', $sub['name'], 'product_cat');
                }
                if (!$sub_term) {
                    wp_insert_term($sub['name'], 'product_cat', array(
                        'slug' => $sub['slug'],
                        'parent' => $parent_id
                    ));
                } else {
                    wp_update_term($sub_term->term_id, 'product_cat', array(
                        'name' => $sub['name'],
                        'parent' => $parent_id
                    ));
                }
            }
        }
    }
    update_option('gbh_client_tree_synced_v2', 1);
}
add_action('init', 'gbh_setup_client_category_tree', 10);

// ============================================================
// 8. AUTO-SEED SHOWCASE PRODUCTS FOR ALL 9 CATEGORIES (CR §2 & §5)
// ============================================================
function gbh_seed_category_showcase_products()
{
    if (get_option('gbh_client_seed_synced_v2')) {
        return;
    }

    $catalog = array(
        array(
            'title'       => 'Garden Basket Organic Plant Booster (500ml)',
            'excerpt'     => 'All-in-one organic liquid nutrition booster for flowers, veggies, and potted plants.',
            'content'     => 'Our signature organic plant growth booster formulated in Jaipur. Packed with micronutrients, humic acid, and sea kelp extracts to encourage lush foliage and abundant blooms.',
            'cats'        => array('manures-fertilizers'),
            'price'       => '399',
            'offer_price' => '299',
            'badge'       => 'Hero Product',
            'type'        => 'Bio-Liquid Nutrition',
            'season'      => 'All Year'
        ),
        array(
            'title'       => 'Fragrant Asiatic Lily Bulbs (Pack of 5)',
            'excerpt'     => 'Premium Dutch imported flowering lily bulbs producing large, intensely fragrant blooms.',
            'content'     => 'High viability flowering bulbs suitable for balcony pots and garden borders in Indian climate.',
            'cats'        => array('bulbs', 'lily-bulbs'),
            'price'       => '499',
            'offer_price' => '399',
            'badge'       => 'New Season',
            'type'        => 'Flowering Bulb',
            'season'      => 'Winter'
        ),
        array(
            'title'       => 'Zinnia & Marigold Flower Seed Mix',
            'excerpt'     => 'Vibrant pollinator-attracting flower seeds with 85%+ germination rate.',
            'content'     => 'Brighten your balcony with easy-to-grow, pest-repelling flower blooms that flower all season long.',
            'cats'        => array('seeds', 'flower-seeds'),
            'price'       => '199',
            'offer_price' => '149',
            'badge'       => 'Pollinator Friendly',
            'type'        => 'Flowering Seed Mix',
            'season'      => 'Summer'
        ),
        array(
            'title'       => 'Exotic Swiss Chard & Kale Seeds Pack',
            'excerpt'     => 'Nutrient-rich exotic leafy green seeds for kitchen gardens and indoor containers.',
            'content'     => 'Grow superfoods right on your windowsill with premium non-GMO tested heirloom seed varieties.',
            'cats'        => array('seeds', 'exotic-seeds'),
            'price'       => '249',
            'offer_price' => '199',
            'badge'       => 'Exotic Variety',
            'type'        => 'Heirloom Greens',
            'season'      => 'Winter'
        ),
        array(
            'title'       => 'Kitchen Garden Vegetable Seed Combo',
            'excerpt'     => 'Complete combo kit containing 10 essential Indian cooking vegetable seed packs.',
            'content'     => 'Includes Tomato, Okra, Chilli, Coriander, Spinach, Radish, Methi, Bottle Gourd, Brinjal, and Cucumber.',
            'cats'        => array('combos', 'vegetable-seed-combos', 'seeds', 'vegetable-seeds'),
            'price'       => '599',
            'offer_price' => '449',
            'badge'       => 'Bestseller Combo',
            'type'        => '10-Pack Kitchen Kit',
            'season'      => 'All Year'
        ),
        array(
            'title'       => 'Rajasthan Native Forestry Seed Combo',
            'excerpt'     => 'Hardy drought-tolerant indigenous tree seed collection: Khejri, Neem, Rohida, and Shisham.',
            'content'     => 'Ideal for afforestation, farm boundaries, and eco-restoration projects across dry and arid regions.',
            'cats'        => array('combos', 'forestry-seed-combos', 'seeds', 'forestry-seeds'),
            'price'       => '699',
            'offer_price' => '549',
            'badge'       => 'Eco Initiative',
            'type'        => 'Native Forestry Pack',
            'season'      => 'Monsoon'
        ),
        array(
            'title'       => 'Continuous Pressure Garden Sprayer 2L',
            'excerpt'     => 'Adjustable brass nozzle hand sprayer for liquid fertilizers, neem oil, and misting.',
            'content'     => 'Durable polyethylene tank with locking trigger mechanism for effortless one-handed spraying.',
            'cats'        => array('sprayers'),
            'price'       => '449',
            'offer_price' => '349',
            'badge'       => 'Essential Tool',
            'type'        => 'Manual Compression',
            'season'      => 'All Year'
        ),
        array(
            'title'       => 'Heavy Duty HDPE Grow Bags 12x12 (Pack of 5)',
            'excerpt'     => 'Tear-resistant UV-stabilized breathable grow bags with drainage holes for terrace gardening.',
            'content'     => 'Engineered for optimal aeration and root pruning, preventing circling roots and boosting growth.',
            'cats'        => array('grow-bags'),
            'price'       => '349',
            'offer_price' => '249',
            'badge'       => 'UV Stabilized',
            'type'        => '220 GSM HDPE',
            'season'      => 'All Year'
        ),
        array(
            'title'       => 'Handmade Terracotta Clay Planters (Set of 2)',
            'excerpt'     => 'Traditional Jaipur artisan terracotta earthenware pots with natural porous clay breathing walls.',
            'content'     => 'Handcrafted by local pottery communities in Rajasthan. Keeps soil cool in scorching summer heat.',
            'cats'        => array('pots'),
            'price'       => '599',
            'offer_price' => '449',
            'badge'       => 'Artisan Handmade',
            'type'        => 'Natural Red Clay',
            'season'      => 'All Year'
        ),
    );

    foreach ($catalog as $item) {
        $existing = gbh_get_product_by_title($item['title']);
        if (!$existing) {
            $p_id = wp_insert_post(array(
                'post_type'    => 'product',
                'post_title'   => $item['title'],
                'post_excerpt' => $item['excerpt'],
                'post_content' => $item['content'],
                'post_status'  => 'publish'
            ));
            if ($p_id && !is_wp_error($p_id)) {
                update_post_meta($p_id, 'product_price', $item['price']);
                update_post_meta($p_id, 'product_offer_price', $item['offer_price']);
                update_post_meta($p_id, 'discount_label', $item['badge']);
                update_post_meta($p_id, 'seed_type', $item['type']);
                
                // Assign taxonomy terms
                wp_set_object_terms($p_id, $item['cats'], 'product_cat');
                wp_set_object_terms($p_id, $item['season'], 'product_season');
            }
        } else {
            // Ensure categories are linked even if post exists
            wp_set_object_terms($existing->ID, $item['cats'], 'product_cat');
        }
    }
    update_option('gbh_client_seed_synced_v2', 1);
}
add_action('init', 'gbh_seed_category_showcase_products', 25);


