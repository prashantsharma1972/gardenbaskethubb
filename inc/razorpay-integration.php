<?php
/**
 * Razorpay Payment Gateway Integration Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * AJAX: Create Razorpay Order ID
 * Invoked from checkout form when user chooses UPI / Online Payment / Partial COD
 */
function gbh_ajax_create_razorpay_order()
{
    check_ajax_referer('gbh_cart_nonce', 'nonce');

    $cart_data = gbh_get_cart_data();
    if (empty($cart_data['items'])) {
        wp_send_json_error(array('message' => 'Cart is empty'));
    }

    $customer_email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $is_tester = function_exists('gbh_is_tester_email') && gbh_is_tester_email($customer_email);

    // Penny Test: If tester email, charge ₹1.00 (100 paise)
    if ($is_tester) {
        $amount_in_paise = 100; // ₹1.00 for live payment gateway verification
        $receipt = 'GBH_TEST_' . time();
        $notes = array('test_mode' => 'true', 'tester_email' => $customer_email);
    } else {
        $amount_in_paise = intval(round($cart_data['final_total'] * 100));
        $receipt = 'GBH_' . time();
        $notes = array('cart_total' => $cart_data['final_total']);
    }

    $key_id = GBH_RAZORPAY_KEY_ID;
    $key_secret = GBH_RAZORPAY_KEY_SECRET;

    if ($key_id && $key_id !== 'rzp_live_YOUR_KEY_ID_HERE' && $key_secret && $key_secret !== 'YOUR_SECRET_HERE') {
        $api_url = 'https://api.razorpay.com/v1/orders';
        $auth_header = 'Basic ' . base64_encode($key_id . ':' . $key_secret);

        $payload = array(
            'amount' => $amount_in_paise,
            'currency' => 'INR',
            'receipt' => $receipt,
            'notes' => $notes,
            'payment_capture' => 1
        );

        $response = wp_remote_post($api_url, array(
            'headers' => array(
                'Authorization' => $auth_header,
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode($payload),
            'timeout' => 20
        ));

        if (is_wp_error($response)) {
            error_log('[GBH Razorpay] Gateway Connection Error: ' . $response->get_error_message());
            wp_send_json_error(array('message' => 'Razorpay Gateway Connection Error: ' . $response->get_error_message()));
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['error'])) {
            $err_desc = isset($body['error']['description']) ? $body['error']['description'] : 'Payment order creation failed.';
            error_log('[GBH Razorpay] API Error: ' . json_encode($body['error']));
            wp_send_json_error(array('message' => 'Razorpay Error: ' . $err_desc));
        }

        if (isset($body['id'])) {
            error_log('[GBH Razorpay] Order created successfully: ' . $body['id'] . ' (' . ($is_tester ? '₹1 Penny Test' : '₹' . ($amount_in_paise / 100)) . ')');
            wp_send_json_success(array(
                'razorpay_order_id' => $body['id'],
                'key_id' => $key_id,
                'amount' => $amount_in_paise,
                'currency' => 'INR',
                'is_tester' => $is_tester,
                'debug' => array(
                    'mode' => 'live_api',
                    'order_id' => $body['id'],
                    'amount_paise' => $amount_in_paise,
                    'is_tester' => $is_tester
                )
            ));
        }
    }

    // Fallback/Simulated Razorpay order ID for seamless local testing if API keys are offline
    error_log('[GBH Razorpay] Running in simulated mode (API keys not configured or unreachable)');
    wp_send_json_success(array(
        'razorpay_order_id' => 'order_simulated_' . time(),
        'key_id' => ($key_id && $key_id !== 'rzp_live_YOUR_KEY_ID_HERE') ? $key_id : 'rzp_test_GBH_SIMULATED',
        'amount' => $amount_in_paise,
        'currency' => 'INR',
        'is_tester' => $is_tester,
        'debug' => array(
            'mode' => 'simulated',
            'amount_paise' => $amount_in_paise,
            'is_tester' => $is_tester
        )
    ));
}
add_action('wp_ajax_gbh_create_razorpay_order', 'gbh_ajax_create_razorpay_order');
add_action('wp_ajax_nopriv_gbh_create_razorpay_order', 'gbh_ajax_create_razorpay_order');

/**
 * Verify Razorpay HMAC-SHA256 Signature
 * Follows official Razorpay Developer guidelines
 */
function gbh_verify_razorpay_signature($razorpay_order_id, $razorpay_payment_id, $signature)
{
    $key_secret = GBH_RAZORPAY_KEY_SECRET;

    // Handle simulated order ID in local offline testing
    if (strpos($razorpay_order_id, 'order_simulated_') === 0 && (empty($key_secret) || $key_secret === 'YOUR_SECRET_HERE')) {
        error_log('[GBH Razorpay] Simulated order detected in local environment. Bypassing HMAC verification.');
        return true;
    }

    // Strict validation: None of the parameters can be empty
    if (empty($razorpay_order_id) || empty($razorpay_payment_id) || empty($signature) || empty($key_secret) || $key_secret === 'YOUR_SECRET_HERE') {
        error_log('[GBH Razorpay] Verification failed: Missing required parameters. order_id=' . $razorpay_order_id . ', payment_id=' . $razorpay_payment_id);
        return false;
    }

    $expected_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, $key_secret);
    $is_valid = hash_equals($expected_signature, $signature);

    if (!$is_valid) {
        error_log('[GBH Razorpay] Signature Mismatch! Expected: ' . $expected_signature . ', Received: ' . $signature);
    } else {
        error_log('[GBH Razorpay] Signature Verified successfully for Payment ID: ' . $razorpay_payment_id);
    }

    return $is_valid;
}
