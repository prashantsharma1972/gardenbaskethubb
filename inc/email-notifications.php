<?php
/**
 * Transactional HTML Email Notifications Module
 * Garden Basket Hub
 */

if (!defined('ABSPATH')) exit;

/**
 * Send Order Confirmation HTML Email to Customer & Store Admin
 */
function gbh_send_order_confirmation_email($order_id) {
    $customer_name  = get_post_meta($order_id, '_customer_name', true);
    $customer_email = get_post_meta($order_id, '_customer_email', true);
    $items          = get_post_meta($order_id, '_order_items', true);
    $total          = get_post_meta($order_id, '_order_total', true);
    $delivery_slot  = get_post_meta($order_id, '_delivery_slot', true);
    $pincode        = get_post_meta($order_id, '_shipping_pincode', true);
    $payment_method = get_post_meta($order_id, '_payment_method', true);

    $subject = '🌱 Order Confirmed! #' . $order_id . ' — Garden Basket Hub';
    
    $items_html = '';
    if (is_array($items)) {
        foreach ($items as $it) {
            $name = isset($it['title']) ? $it['title'] : 'Product';
            $qty  = isset($it['qty']) ? intval($it['qty']) : (isset($it['quantity']) ? intval($it['quantity']) : 1);
            $price = isset($it['price']) ? floatval($it['price']) : 199.0;
            $items_html .= '<tr><td style="padding:10px;border-bottom:1px solid #eee;">' . esc_html($name) . ' x ' . $qty . '</td><td style="padding:10px;border-bottom:1px solid #eee;text-align:right;">₹' . intval($price * $qty) . '</td></tr>';
        }
    }

    $message = '
    <div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;">
        <div style="background:#3A6B35;color:#fff;padding:24px;text-align:center;">
            <h2 style="margin:0;font-size:24px;">Garden Basket Hub</h2>
            <p style="margin:8px 0 0;font-size:14px;">Thank you for your order, ' . esc_html($customer_name) . '!</p>
        </div>
        <div style="padding:24px;">
            <p>Your order <strong>#' . $order_id . '</strong> has been placed and is being prepared at our Jaipur nursery.</p>
            <p><strong>Payment Method:</strong> ' . esc_html($payment_method) . '</p>
            <p><strong>Delivery Slot:</strong> ' . esc_html($delivery_slot ? $delivery_slot : 'Same-Day Jaipur Delivery') . '</p>
            <p><strong>Delivery Pincode:</strong> ' . esc_html($pincode) . '</p>
            
            <table style="width:100%;border-collapse:collapse;margin:20px 0;">
                <thead>
                    <tr style="background:#f9f9f9;"><th style="padding:10px;text-align:left;">Item</th><th style="padding:10px;text-align:right;">Total</th></tr>
                </thead>
                <tbody>' . $items_html . '</tbody>
            </table>
            
            <div style="text-align:right;font-size:18px;font-weight:bold;color:#2C1A0E;margin-top:16px;">
                Total Amount: ₹' . esc_html($total) . '
            </div>
        </div>
        <div style="background:#f5efe6;padding:16px;text-align:center;font-size:12px;color:#7a6050;">
            Garden Basket Hub · Jaipur, Rajasthan · Need help? Reply to this email or WhatsApp us!
        </div>
    </div>';

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if ($customer_email) {
        wp_mail($customer_email, $subject, $message, $headers);
    }
    
    // Also notify store admin
    wp_mail(get_option('admin_email', 'hello@gardenbaskethubb.com'), '🔔 New Order Received #' . $order_id, $message, $headers);
}
