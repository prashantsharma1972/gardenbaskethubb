<?php
/**
 * E-Commerce Cart Engine & AJAX Handlers Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

// 1. Session & Cookie Persistence Setup
function gbh_init_cart_session()
{
    if (!session_id() && !headers_sent()) {
        session_start();
    }

    // Auto-restore cart from cookie if session is empty
    if (!isset($_SESSION['gbh_cart']) || empty($_SESSION['gbh_cart'])) {
        if (isset($_COOKIE['gbh_cart_cookie']) && !empty($_COOKIE['gbh_cart_cookie'])) {
            $cookie_data = json_decode(stripslashes($_COOKIE['gbh_cart_cookie']), true);
            if (is_array($cookie_data)) {
                $_SESSION['gbh_cart'] = $cookie_data;
            }
        }
    }
}
add_action('init', 'gbh_init_cart_session', 1);

// Helper to save cart to session + cookie
function gbh_save_cart($cart_data)
{
    $_SESSION['gbh_cart'] = $cart_data;
    if (!headers_sent()) {
        setcookie('gbh_cart_cookie', json_encode($cart_data), time() + (86400 * 30), '/');
    }
}

// 2. Server-side Cart Data Calculation
function gbh_get_cart_data()
{
    $cart = isset($_SESSION['gbh_cart']) ? $_SESSION['gbh_cart'] : array();
    $items = array();
    $subtotal = 0;
    $total_count = 0;

    foreach ($cart as $key => $item) {
        $product_id = intval($item['product_id']);
        $qty = intval($item['quantity']);
        $variant = isset($item['variant']) ? $item['variant'] : '';

        $title = get_the_title($product_id);
        if (!$title)
            continue;

        // Fetch price with fallback
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
        if ($price <= 0)
            $price = 199;

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
        'final_total' => $total,
    );
}

// 3. AJAX: Add to Cart
function gbh_ajax_add_to_cart()
{
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
            'quantity' => $quantity,
            'variant' => $variant,
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

// 4. AJAX: Get Cart
function gbh_ajax_get_cart()
{
    $cart_data = gbh_get_cart_data();
    wp_send_json_success($cart_data);
}
add_action('wp_ajax_gbh_get_cart', 'gbh_ajax_get_cart');
add_action('wp_ajax_nopriv_gbh_get_cart', 'gbh_ajax_get_cart');

// 5. AJAX: Update Cart Item Quantity / Removal
function gbh_ajax_update_cart()
{
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

// 6. AJAX: Apply Coupon
function gbh_ajax_apply_coupon()
{
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $coupon = isset($_POST['coupon']) ? strtoupper(trim(sanitize_text_field($_POST['coupon']))) : '';

    if (empty($coupon)) {
        wp_send_json_error(array('message' => 'Please enter a coupon code.'));
        return;
    }

    /**
     * GBH Coupon Code Registry
     * Format: 'CODE' => [ 'discount' => ₹amount, 'label' => 'Description' ]
     *
     * To add/change a coupon — just edit this array.
     */
    $valid_coupons = array(
        'ORGANIC10'   => array('discount' => 100,  'label' => '₹100 Off on Organic Products'),
        'MONSOON10'   => array('discount' => 120,  'label' => '₹120 Off Monsoon Special'),
        'GARDEN10'    => array('discount' => 120,  'label' => '₹120 Off Garden Essentials'),
        'JAIPUR100'   => array('discount' => 100,  'label' => '₹100 Off Jaipur Delivery Special'),
        'MONSOON200'  => array('discount' => 200,  'label' => '₹200 Off Monsoon Bumper Sale'),
        'WELCOME50'   => array('discount' => 50,   'label' => '₹50 Off Welcome Discount'),
        'SEED15'      => array('discount' => 150,  'label' => '₹150 Off Seeds & Seedlings'),
    );

    if (isset($valid_coupons[$coupon])) {
        $discount = $valid_coupons[$coupon]['discount'];
        $label    = $valid_coupons[$coupon]['label'];

        $_SESSION['gbh_discount'] = $discount;

        wp_send_json_success(array(
            'message' => '🎉 Coupon <strong>' . esc_html($coupon) . '</strong> applied! ' . esc_html($label),
            'cart'    => gbh_get_cart_data()
        ));
    } else {
        wp_send_json_error(array('message' => '❌ Invalid coupon code. Try <strong>ORGANIC10</strong> or <strong>MONSOON10</strong> for discounts!'));
    }
}
add_action('wp_ajax_gbh_apply_coupon', 'gbh_ajax_apply_coupon');
add_action('wp_ajax_nopriv_gbh_apply_coupon', 'gbh_ajax_apply_coupon');

// 7. AJAX: Check Pincode
function gbh_ajax_check_pincode()
{
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

// 8. AJAX: Product Catalog Filtering
function gbh_ajax_filter_products()
{
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
            'field' => 'slug',
            'terms' => $cats,
        );
    }

    if (!empty($seasons)) {
        $tax_query[] = array(
            'taxonomy' => 'product_season',
            'field' => 'slug',
            'terms' => $seasons,
        );
    }

    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    if ($min_price > 0 || $max_price > 0) {
        $price_query = array('relation' => 'AND');
        if ($min_price > 0) {
            $price_query[] = array(
                'key' => 'product_offer_price',
                'value' => $min_price,
                'type' => 'NUMERIC',
                'compare' => '>='
            );
        }
        if ($max_price > 0) {
            $price_query[] = array(
                'key' => 'product_offer_price',
                'value' => $max_price,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        }
        $args['meta_query'] = $price_query;
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
            if (!$price && function_exists('get_field'))
                $price = get_field('product_price', $p_id);

            $offer_price = get_post_meta($p_id, 'product_offer_price', true);
            if (!$offer_price && function_exists('get_field'))
                $offer_price = get_field('product_offer_price', $p_id);

            $discount_label = get_post_meta($p_id, 'discount_label', true);
            if (!$discount_label && function_exists('get_field'))
                $discount_label = get_field('discount_label', $p_id);

            $thumb_url = get_the_post_thumbnail_url($p_id, 'gbh-card');
            if (!$thumb_url && function_exists('get_field'))
                $thumb_url = get_field('product_image', $p_id);
            if (!$thumb_url)
                $thumb_url = get_post_meta($p_id, 'product_image', true);
            ?>
            <div class="product-card" data-product-id="<?php echo esc_attr($p_id); ?>" data-permalink="<?php the_permalink(); ?>">
                <div class="product-img">
                    <a href="<?php the_permalink(); ?>"
                        style="display:block;width:100%;height:100%;text-decoration:none;color:inherit;">
                        <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            🌱
                        <?php endif; ?>
                    </a>

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
