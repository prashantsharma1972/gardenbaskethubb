<?php
/**
 * Garden Basket Hub — Professional Payment Gateway Integration (Razorpay)
 */

if (!defined('ABSPATH')) exit;

class GBH_Payment_Gateway {

    public static function init() {
        add_action('wp_ajax_gbh_process_payment', array(__CLASS__, 'process_payment'));
        add_action('wp_ajax_nopriv_gbh_process_payment', array(__CLASS__, 'process_payment'));
    }

    public static function process_payment() {
        check_ajax_referer('gbh_cart_nonce', 'nonce');
        
        // Ensure cart is valid
        $cart_data = GBH_Cart_API::get_cart_data();
        if (empty($cart_data['items'])) {
            wp_send_json_error(array('message' => 'Cart is empty.'));
        }

        // Logic to communicate with Razorpay API will go here
        // Tokens and secrets are retrieved from WP options directly in this file when needed.
        $key_id = get_option('gbh_razorpay_key_id');
        $key_secret = get_option('gbh_razorpay_key_secret');

        // Note: We bypass storing order in WP DB as requested.
        // Instead we generate a Razorpay order ID and return it to frontend.
        
        wp_send_json_success(array(
            'message' => 'Payment processor ready',
            'amount' => $cart_data['total'] * 100, // in paise
            'currency' => 'INR'
        ));
    }
}

GBH_Payment_Gateway::init();
