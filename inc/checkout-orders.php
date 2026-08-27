<?php
/**
 * Checkout & Order Placement Processing Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * AJAX: Place Order Handler
 */
function gbh_ajax_place_order()
{
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
        'post_type' => 'gbh_order',
        'post_title' => 'Order ' . $order_num . ' — ' . $first_name . ' ' . $last_name,
        'post_status' => 'publish',
        'post_content' => 'Customer Phone: ' . $phone . "\nEmail: " . $email,
    ));

    if (is_wp_error($order_id)) {
        wp_send_json_error(array('message' => 'Failed to process order. Please try again.'));
    }

    // Save Order Meta Data
    $full_name = trim($first_name . ' ' . $last_name);
    update_post_meta($order_id, '_gbh_order_num', $order_num);
    update_post_meta($order_id, '_gbh_email', $email);
    update_post_meta($order_id, '_gbh_phone', $phone);
    update_post_meta($order_id, '_gbh_customer_name', $full_name);
    update_post_meta($order_id, '_gbh_address', $address);
    update_post_meta($order_id, '_gbh_landmark', $landmark);
    update_post_meta($order_id, '_gbh_city', $city);
    update_post_meta($order_id, '_gbh_pincode', $pincode);
    update_post_meta($order_id, '_gbh_delivery_slot', $delivery_slot);
    update_post_meta($order_id, '_gbh_payment_method', $payment_method);
    update_post_meta($order_id, '_gbh_total_amount', $cart_data['total']);
    update_post_meta($order_id, '_gbh_order_items', json_encode($cart_data['items']));
    update_post_meta($order_id, '_gbh_order_status', 'Processing');

    // Standardized meta fields for Shiprocket & Email integration
    update_post_meta($order_id, '_customer_name', $full_name);
    update_post_meta($order_id, '_customer_email', $email);
    update_post_meta($order_id, '_customer_phone', $phone);
    update_post_meta($order_id, '_shipping_address', $address . ($landmark ? ' (' . $landmark . ')' : ''));
    update_post_meta($order_id, '_shipping_city', $city);
    update_post_meta($order_id, '_shipping_pincode', $pincode);
    update_post_meta($order_id, '_payment_method', $payment_method);
    update_post_meta($order_id, '_order_items', $cart_data['items']);
    update_post_meta($order_id, '_order_total', $cart_data['total']);
    update_post_meta($order_id, '_delivery_slot', $delivery_slot);

    // Save Razorpay Transaction IDs if present
    if (isset($_POST['razorpay_payment_id']) && !empty($_POST['razorpay_payment_id'])) {
        update_post_meta($order_id, '_razorpay_payment_id', sanitize_text_field($_POST['razorpay_payment_id']));
        if (isset($_POST['razorpay_order_id'])) {
            update_post_meta($order_id, '_razorpay_order_id', sanitize_text_field($_POST['razorpay_order_id']));
        }
        update_post_meta($order_id, '_payment_status', 'Paid');
    } else {
        update_post_meta($order_id, '_payment_status', (strtolower($payment_method) === 'cod') ? 'COD' : 'Pending');
    }

    // Auto-trigger Shiprocket Logistics Order Push
    if (function_exists('gbh_shiprocket_create_order')) {
        gbh_shiprocket_create_order($order_id);
    }

    // Auto-trigger Customer & Admin Transactional HTML Email Confirmation
    if (function_exists('gbh_send_order_confirmation_email')) {
        gbh_send_order_confirmation_email($order_id);
    }

    // Clear Cart in Session & Cookie
    $_SESSION['gbh_cart'] = array();
    unset($_SESSION['gbh_discount']);
    if (!headers_sent()) {
        setcookie('gbh_cart_cookie', '', time() - 3600, '/');
    }

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
