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

    $is_tester = function_exists('gbh_is_tester_email') && gbh_is_tester_email($email);
    $order_num = ($is_tester ? 'TEST-' : 'GBH-') . strtoupper(wp_generate_password(6, false));

    // Create Order Post
    $order_title = ($is_tester ? '[TEST ORDER] ' : '') . 'Order ' . $order_num . ' — ' . $first_name . ' ' . $last_name;
    $order_id = wp_insert_post(array(
        'post_type' => 'gbh_order',
        'post_title' => $order_title,
        'post_status' => 'publish',
        'post_content' => ($is_tester ? "--- TEST STAGING ORDER ---\n" : '') . 'Customer Phone: ' . $phone . "\nEmail: " . $email,
    ));

    if (is_wp_error($order_id)) {
        wp_send_json_error(array('message' => 'Failed to process order. Please try again.'));
    }

    // Save Order Meta Data
    $full_name = trim($first_name . ' ' . $last_name);
    update_post_meta($order_id, '_is_test_order', $is_tester ? 'yes' : 'no');
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
    update_post_meta($order_id, '_gbh_order_status', $is_tester ? 'Test Processing' : 'Processing');

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

    // Determine if payment is COD or Online (Razorpay / UPI)
    $is_cod = (strtolower($payment_method) === 'cod' || stripos($payment_method, 'cash on delivery') !== false);

    error_log('[GBH Checkout] Processing order placement: ' . $order_num . ' | Method: ' . $payment_method . ' | Tester: ' . ($is_tester ? 'YES' : 'NO'));

    if (!$is_cod) {
        // Online Payment Flow (Razorpay / UPI)
        $payment_id = isset($_POST['razorpay_payment_id']) ? sanitize_text_field($_POST['razorpay_payment_id']) : '';
        $razorpay_order_id = isset($_POST['razorpay_order_id']) ? sanitize_text_field($_POST['razorpay_order_id']) : '';
        $signature = isset($_POST['razorpay_signature']) ? sanitize_text_field($_POST['razorpay_signature']) : '';

        if (empty($payment_id)) {
            error_log('[GBH Checkout] Error: Online payment chosen but razorpay_payment_id is missing.');
            update_post_meta($order_id, '_payment_status', 'Failed');
            update_post_meta($order_id, '_gbh_order_status', 'Payment Incomplete');
            update_post_meta($order_id, '_payment_error', 'Online payment selected but no transaction ID received.');
            wp_send_json_error(array('message' => 'Online payment was not completed. Please try again or choose Cash on Delivery.'));
        }

        update_post_meta($order_id, '_razorpay_payment_id', $payment_id);
        update_post_meta($order_id, '_razorpay_order_id', $razorpay_order_id);
        update_post_meta($order_id, '_razorpay_signature', $signature);
        update_post_meta($order_id, '_gbh_paid_amount', $is_tester ? 1.00 : $cart_data['total']);

        $signature_valid = false;
        if (function_exists('gbh_verify_razorpay_signature')) {
            $signature_valid = gbh_verify_razorpay_signature($razorpay_order_id, $payment_id, $signature);
        }

        if ($signature_valid) {
            update_post_meta($order_id, '_payment_status', 'Paid');
            update_post_meta($order_id, '_signature_verified', 'Yes');
            update_post_meta($order_id, '_gbh_order_status', $is_tester ? 'Test Processing (Paid)' : 'Processing');
            error_log('[GBH Checkout] Payment verified successfully for Order #' . $order_id);

            // Safe to auto-trigger Shiprocket Logistics Order Push for verified paid orders
            if (function_exists('gbh_shiprocket_create_order')) {
                gbh_shiprocket_create_order($order_id);
            }

            // Auto-trigger Customer & Admin Transactional HTML Email Confirmation
            if (function_exists('gbh_send_order_confirmation_email')) {
                gbh_send_order_confirmation_email($order_id);
            }
        } else {
            // Signature verification failed! Prevent logistics push and alert user
            update_post_meta($order_id, '_payment_status', 'Signature Mismatch');
            update_post_meta($order_id, '_signature_verified', 'Failed');
            update_post_meta($order_id, '_gbh_order_status', 'Payment Verification Failed');
            update_post_meta($order_id, '_payment_error', 'Cryptographic signature mismatch. Possible tampering or secret desync.');
            error_log('[GBH Checkout] CRITICAL: Signature verification failed for Order #' . $order_id . ' | Payment ID: ' . $payment_id);

            wp_send_json_error(array(
                'message' => 'Payment verification failed (Signature Mismatch). If your account was debited, please contact our support immediately with Payment Reference: ' . esc_html($payment_id),
                'order_num' => $order_num
            ));
        }
    } else {
        // Cash on Delivery (COD) Flow
        update_post_meta($order_id, '_payment_status', 'COD');
        update_post_meta($order_id, '_signature_verified', 'N/A');
        update_post_meta($order_id, '_gbh_order_status', $is_tester ? 'Test Processing (COD)' : 'Pending (COD)');
        error_log('[GBH Checkout] COD Order placed for Order #' . $order_id);

        // Auto-trigger Shiprocket Logistics Order Push for COD
        if (function_exists('gbh_shiprocket_create_order')) {
            gbh_shiprocket_create_order($order_id);
        }

        // Auto-trigger Customer & Admin Transactional HTML Email Confirmation
        if (function_exists('gbh_send_order_confirmation_email')) {
            gbh_send_order_confirmation_email($order_id);
        }
    }

    // Clear Cart in Session & Cookie upon successful verification / placement
    $_SESSION['gbh_cart'] = array();
    unset($_SESSION['gbh_discount']);
    if (!headers_sent()) {
        setcookie('gbh_cart_cookie', '', time() - 3600, '/');
    }

    $redirect_url = add_query_arg(array(
        'order_id' => $order_id,
        'order_num' => $order_num,
    ), home_url('/thank-you/'));

    error_log('[GBH Checkout] Order complete. Redirecting to: ' . $redirect_url);

    wp_send_json_success(array(
        'message' => 'Order placed successfully!',
        'order_num' => $order_num,
        'redirect_url' => $redirect_url
    ));
}
add_action('wp_ajax_gbh_place_order', 'gbh_ajax_place_order');
add_action('wp_ajax_nopriv_gbh_place_order', 'gbh_ajax_place_order');
