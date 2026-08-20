<?php
/**
 * Garden Basket Hub — Professional Cart API Engine
 * This file handles all cart-related AJAX requests securely.
 */

if (!defined('ABSPATH')) exit;

class GBH_Cart_API {

    public static function init() {
        add_action('wp_ajax_gbh_add_to_cart', array(__CLASS__, 'add_to_cart'));
        add_action('wp_ajax_nopriv_gbh_add_to_cart', array(__CLASS__, 'add_to_cart'));
        
        add_action('wp_ajax_gbh_get_cart', array(__CLASS__, 'get_cart'));
        add_action('wp_ajax_nopriv_gbh_get_cart', array(__CLASS__, 'get_cart'));
        
        add_action('wp_ajax_gbh_update_cart', array(__CLASS__, 'update_cart'));
        add_action('wp_ajax_nopriv_gbh_update_cart', array(__CLASS__, 'update_cart'));
    }

    public static function get_cart_data() {
        if (!isset($_SESSION['gbh_cart'])) {
            $_SESSION['gbh_cart'] = array();
        }
        
        $cart = $_SESSION['gbh_cart'];
        $items = array();
        $subtotal = 0;
        $total_count = 0;

        foreach ($cart as $key => $item) {
            $product_id = intval($item['product_id']);
            $qty = intval($item['quantity']);
            
            $title = get_the_title($product_id);
            if (!$title) continue;

            $price = get_post_meta($product_id, 'product_price', true);
            if (!$price) $price = 199; // Fallback

            $line_total = $price * $qty;
            $subtotal += $line_total;
            $total_count += $qty;

            $img_url = get_the_post_thumbnail_url($product_id, 'gbh-thumb');

            $items[] = array(
                'key' => $key,
                'product_id' => $product_id,
                'title' => $title,
                'price' => $price,
                'quantity' => $qty,
                'image' => $img_url,
                'line_total' => $line_total,
                'line_total_formatted' => '₹' . number_format($line_total, 0),
            );
        }

        $delivery_fee = ($subtotal > 0 && $subtotal < 799) ? 49 : 0;
        $total = $subtotal + $delivery_fee;

        return array(
            'items' => $items,
            'total_count' => $total_count,
            'subtotal' => $subtotal,
            'delivery_fee' => $delivery_fee,
            'total' => $total,
        );
    }

    public static function add_to_cart() {
        check_ajax_referer('gbh_cart_nonce', 'nonce');

        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

        if (!$product_id) wp_send_json_error(array('message' => 'Invalid product ID'));

        if (!isset($_SESSION['gbh_cart'])) $_SESSION['gbh_cart'] = array();

        $cart_key = $product_id . '_default';
        if (isset($_SESSION['gbh_cart'][$cart_key])) {
            $_SESSION['gbh_cart'][$cart_key]['quantity'] += $quantity;
        } else {
            $_SESSION['gbh_cart'][$cart_key] = array(
                'product_id' => $product_id,
                'quantity'   => $quantity,
            );
        }

        wp_send_json_success(array(
            'message' => 'Item added successfully',
            'cart' => self::get_cart_data()
        ));
    }

    public static function get_cart() {
        wp_send_json_success(self::get_cart_data());
    }

    public static function update_cart() {
        check_ajax_referer('gbh_cart_nonce', 'nonce');

        $key = isset($_POST['key']) ? sanitize_text_field($_POST['key']) : '';
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

        if (isset($_SESSION['gbh_cart'][$key])) {
            if ($quantity <= 0) {
                unset($_SESSION['gbh_cart'][$key]);
            } else {
                $_SESSION['gbh_cart'][$key]['quantity'] = $quantity;
            }
        }

        wp_send_json_success(self::get_cart_data());
    }
}

GBH_Cart_API::init();
