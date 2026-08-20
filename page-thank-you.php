<?php
/**
 * Template Name: Order Success
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/thankYou/thankYou.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/thankYou/thankYou.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/thankYou/thankYou.bundle.js"></script>

    <?php get_header(); ?>
<?php
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$order_num = isset($_GET['order_num']) ? sanitize_text_field($_GET['order_num']) : 'GBH-89214';

$customer_name = $order_id ? get_post_meta($order_id, '_gbh_customer_name', true) : 'Gardener';
$delivery_slot = $order_id ? get_post_meta($order_id, '_gbh_delivery_slot', true) : 'Today · 4 PM – 7 PM';
$total_amount = $order_id ? get_post_meta($order_id, '_gbh_total_amount', true) : '1125';
$address = $order_id ? get_post_meta($order_id, '_gbh_address', true) : 'Jaipur, Rajasthan';
?>

<!-- ============================================================
     THANK YOU / ORDER CONFIRMATION
     ============================================================ -->
<section style="padding-top:160px;min-height:70vh;display:flex;align-items:center;justify-content:center;">
  <div class="thankyou-box">
    <div style="font-size:4rem;margin-bottom:12px;">🌱 🎉</div>
    <span class="order-id-badge">Order ID: <?php echo esc_html($order_num); ?></span>
    
    <h1 style="font-family:var(--f-display);font-size:2.4rem;color:var(--soil);margin-bottom:12px;">
      Thank You, <?php echo esc_html($customer_name); ?>!
    </h1>
    
    <p style="font-size:1.05rem;color:var(--clay);line-height:1.7;margin-bottom:28px;">
      Your garden order has been placed successfully. We are carefully packing your seeds & saplings at our Jaipur nursery.
    </p>

    <div style="background:var(--white);padding:24px;border-radius:4px;text-align:left;margin-bottom:32px;border:1px solid rgba(44,26,14,0.1);">
      <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
        <span style="font-family:var(--f-mono);font-size:0.75rem;color:var(--clay);text-transform:uppercase;">Delivery Address</span>
        <span style="font-size:0.9rem;color:var(--soil);"><?php echo esc_html($address); ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
        <span style="font-family:var(--f-mono);font-size:0.75rem;color:var(--clay);text-transform:uppercase;">Scheduled Slot</span>
        <span style="font-size:0.9rem;color:var(--leaf);font-weight:bold;"><?php echo esc_html($delivery_slot); ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(44,26,14,0.08);padding-top:12px;">
        <span style="font-family:var(--f-mono);font-size:0.75rem;color:var(--clay);text-transform:uppercase;">Total Amount</span>
        <span style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);font-weight:bold;">₹<?php echo esc_html(number_format(floatval($total_amount), 0)); ?></span>
      </div>
    </div>

    <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-primary">
        Continue Shopping
      </a>
      <a href="https://wa.me/919876543210?text=Hi%20Garden%20Basket%20Hub,%20I%20have%20a%20question%20about%20Order%20<?php echo urlencode($order_num); ?>" target="_blank" class="btn-primary" style="background:var(--leaf);">
        💬 Track on WhatsApp
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>