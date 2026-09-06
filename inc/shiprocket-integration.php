<?php
/**
 * Shiprocket Auto-Logistics & Delivery Integration Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH'))
    exit;

/**
 * Fetch JWT Auth Token from Shiprocket API
 */
function gbh_shiprocket_get_token()
{
    $token = get_transient('_gbh_shiprocket_token');
    if ($token)
        return $token;

    $email = GBH_SHIPROCKET_EMAIL;
    $password = GBH_SHIPROCKET_PASSWORD;

    if (empty($email) || empty($password)) {
        return false;
    }

    $response = wp_remote_post('https://apiv2.shiprocket.in/v1/external/auth/login', array(
        'headers' => array('Content-Type' => 'application/json'),
        'body' => json_encode(array('email' => $email, 'password' => $password)),
        'timeout' => 20
    ));

    if (!is_wp_error($response)) {
        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['token'])) {
            set_transient('_gbh_shiprocket_token', $body['token'], 86400);
            return $body['token'];
        }
    }
    return false;
}

/**
 * Auto-Push Order to Shiprocket Panel
 */
function gbh_shiprocket_create_order($order_id)
{
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $is_tester = function_exists('gbh_is_tester_email') && gbh_is_tester_email($customer_email);

    error_log('[GBH Shiprocket] Initiating Shiprocket push for Order #' . $order_id . ' (Tester: ' . ($is_tester ? 'YES' : 'NO') . ')');

    $token = gbh_shiprocket_get_token();
    if (!$token) {
        error_log('[GBH Shiprocket] Auth failed: Unable to obtain JWT token.');
        update_post_meta($order_id, '_shiprocket_status', 'Auth Failed');
        update_post_meta($order_id, '_shiprocket_error', 'Unable to retrieve Shiprocket JWT auth token. Please verify email and password.');
        return false;
    }

    $customer_name = get_post_meta($order_id, '_customer_name', true);
    $customer_phone = get_post_meta($order_id, '_customer_phone', true);
    $shipping_address = get_post_meta($order_id, '_shipping_address', true);
    $city = get_post_meta($order_id, '_shipping_city', true);
    $pincode = get_post_meta($order_id, '_shipping_pincode', true);
    $payment_method = get_post_meta($order_id, '_payment_method', true);
    $items = get_post_meta($order_id, '_order_items', true);
    $total = get_post_meta($order_id, '_order_total', true);

    // If tester email, prominently tag customer name and order ID so it's unmistakably a test
    if ($is_tester) {
        $shiprocket_order_id = 'TEST-GBH-' . $order_id . '-' . time();
        $display_customer_name = '[TEST - DO NOT SHIP] ' . ($customer_name ? $customer_name : 'QA Tester');
        $display_address = '[TEST ORDER - DO NOT DISPATCH] ' . ($shipping_address ? $shipping_address : 'Jaipur');
    } else {
        $shiprocket_order_id = 'GBH-' . $order_id;
        $display_customer_name = $customer_name ? $customer_name : 'Customer';
        $display_address = $shipping_address ? $shipping_address : 'Jaipur';
    }

    $order_items_payload = array();
    if (is_array($items)) {
        foreach ($items as $item) {
            $order_items_payload[] = array(
                'name' => isset($item['title']) ? $item['title'] : 'Gardening Product',
                'sku' => 'GBH-' . (isset($item['id']) ? $item['id'] : (isset($item['product_id']) ? $item['product_id'] : 'PROD')),
                'units' => isset($item['qty']) ? intval($item['qty']) : (isset($item['quantity']) ? intval($item['quantity']) : 1),
                'selling_price' => isset($item['price']) ? floatval($item['price']) : 199.0
            );
        }
    }

    $pickup_loc = GBH_SHIPROCKET_PICKUP_LOCATION;

    $payload = array(
        'order_id' => $shiprocket_order_id,
        'order_date' => date('Y-m-d H:i'),
        'pickup_location' => $pickup_loc,
        'billing_customer_name' => $display_customer_name,
        'billing_last_name' => '',
        'billing_address' => $display_address,
        'billing_city' => $city ? $city : 'Jaipur',
        'billing_pincode' => $pincode ? $pincode : '302001',
        'billing_state' => 'Rajasthan',
        'billing_country' => 'India',
        'billing_email' => $customer_email ? $customer_email : 'customer@gardenbaskethubb.com',
        'billing_phone' => $customer_phone ? $customer_phone : '9876543210',
        'shipping_is_billing' => true,
        'order_items' => $order_items_payload,
        'payment_method' => (strtolower($payment_method) === 'cod') ? 'COD' : 'Prepaid',
        'sub_total' => floatval($total),
        'length' => 15,
        'width' => 15,
        'height' => 15,
        'weight' => 0.5
    );

    // Save outbound payload for debugging
    update_post_meta($order_id, '_shiprocket_payload', json_encode($payload));

    $response = wp_remote_post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode($payload),
        'timeout' => 20
    ));

    if (is_wp_error($response)) {
        error_log('[GBH Shiprocket] HTTP Connection Error: ' . $response->get_error_message());
        update_post_meta($order_id, '_shiprocket_status', 'HTTP Error');
        update_post_meta($order_id, '_shiprocket_error', $response->get_error_message());
        return false;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    update_post_meta($order_id, '_shiprocket_raw_response', json_encode($body));

    if (isset($body['order_id'])) {
        error_log('[GBH Shiprocket] Order successfully pushed to Shiprocket: SR Order ID=' . $body['order_id'] . ', Shipment ID=' . (isset($body['shipment_id']) ? $body['shipment_id'] : 'N/A'));
        update_post_meta($order_id, '_shiprocket_order_id', $body['order_id']);
        update_post_meta($order_id, '_shiprocket_shipment_id', isset($body['shipment_id']) ? $body['shipment_id'] : '');
        update_post_meta($order_id, '_shiprocket_status', $is_tester ? 'Created (Test Order - Do Not Ship)' : 'Created');
        return true;
    } else {
        $error_msg = isset($body['message']) ? $body['message'] : 'Shiprocket order creation returned an unhandled error.';
        error_log('[GBH Shiprocket] Order creation returned error: ' . json_encode($body));
        update_post_meta($order_id, '_shiprocket_status', 'Failed');
        update_post_meta($order_id, '_shiprocket_error', is_array($error_msg) ? json_encode($error_msg) : $error_msg);
        return false;
    }
}

