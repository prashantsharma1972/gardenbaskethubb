<?php
/**
 * Shiprocket Auto-Logistics & Delivery Integration Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH')) exit;

/**
 * Fetch JWT Auth Token from Shiprocket API
 */
function gbh_shiprocket_get_token() {
    $token = get_transient('_gbh_shiprocket_token');
    if ($token) return $token;

    $email = GBH_SHIPROCKET_EMAIL;
    $password = GBH_SHIPROCKET_PASSWORD;

    if (empty($email) || empty($password)) {
        return false;
    }

    $response = wp_remote_post('https://apiv2.shiprocket.in/v1/external/auth/login', array(
        'headers' => array('Content-Type' => 'application/json'),
        'body'    => json_encode(array('email' => $email, 'password' => $password)),
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
function gbh_shiprocket_create_order($order_id) {
    $token = gbh_shiprocket_get_token();
    if (!$token) return false;

    $customer_name = get_post_meta($order_id, '_customer_name', true);
    $customer_phone = get_post_meta($order_id, '_customer_phone', true);
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $shipping_address = get_post_meta($order_id, '_shipping_address', true);
    $city = get_post_meta($order_id, '_shipping_city', true);
    $pincode = get_post_meta($order_id, '_shipping_pincode', true);
    $payment_method = get_post_meta($order_id, '_payment_method', true);
    $items = get_post_meta($order_id, '_order_items', true);
    $total = get_post_meta($order_id, '_order_total', true);

    $order_items_payload = array();
    if (is_array($items)) {
        foreach ($items as $item) {
            $order_items_payload[] = array(
                'name'          => isset($item['title']) ? $item['title'] : 'Gardening Product',
                'sku'           => 'GBH-' . (isset($item['id']) ? $item['id'] : (isset($item['product_id']) ? $item['product_id'] : 'PROD')),
                'units'         => isset($item['qty']) ? intval($item['qty']) : (isset($item['quantity']) ? intval($item['quantity']) : 1),
                'selling_price' => isset($item['price']) ? floatval($item['price']) : 199.0
            );
        }
    }

    $pickup_loc = GBH_SHIPROCKET_PICKUP_LOCATION;

    $payload = array(
        'order_id'              => 'GBH-' . $order_id,
        'order_date'            => date('Y-m-d H:i'),
        'pickup_location'       => $pickup_loc,
        'billing_customer_name' => $customer_name ? $customer_name : 'Customer',
        'billing_last_name'     => '',
        'billing_address'       => $shipping_address ? $shipping_address : 'Jaipur',
        'billing_city'          => $city ? $city : 'Jaipur',
        'billing_pincode'       => $pincode ? $pincode : '302001',
        'billing_state'         => 'Rajasthan',
        'billing_country'       => 'India',
        'billing_email'         => $customer_email ? $customer_email : 'customer@gardenbaskethubb.com',
        'billing_phone'         => $customer_phone ? $customer_phone : '9876543210',
        'shipping_is_billing'   => true,
        'order_items'           => $order_items_payload,
        'payment_method'        => (strtolower($payment_method) === 'cod') ? 'COD' : 'Prepaid',
        'sub_total'             => floatval($total),
        'length'                => 15,
        'width'                 => 15,
        'height'                => 15,
        'weight'                => 0.5
    );

    $response = wp_remote_post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json'
        ),
        'body'    => json_encode($payload),
        'timeout' => 20
    ));

    if (!is_wp_error($response)) {
        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['order_id'])) {
            update_post_meta($order_id, '_shiprocket_order_id', $body['order_id']);
            update_post_meta($order_id, '_shiprocket_shipment_id', isset($body['shipment_id']) ? $body['shipment_id'] : '');
            update_post_meta($order_id, '_shiprocket_status', 'Created');
            return true;
        }
    }
    return false;
}
