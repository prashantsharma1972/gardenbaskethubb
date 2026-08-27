<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.css">
    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.css">
    <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.bundle.js"></script>
    <?php get_header(); ?>
<main class="main--container">
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
<section class="thankyou-section">
  <div class="thankyou-box">
    <div class="thankyou-icon">🌱 🎉</div>
    <span class="order-id-badge">Order ID: <?php echo esc_html($order_num); ?></span>

    <h1 class="thankyou-heading">
      Thank You, <?php echo esc_html($customer_name); ?>!
    </h1>

    <p class="thankyou-paragraph">
      Your garden order has been placed successfully. We are carefully packing your seeds & saplings at our Jaipur
      nursery.
    </p>

    <div class="thankyou-details-card">
      <div class="thankyou-details-row">
        <span class="thankyou-details-label">Delivery
          Address</span>
        <span class="thankyou-details-val"><?php echo esc_html($address); ?></span>
      </div>
      <div class="thankyou-details-row">
        <span class="thankyou-details-label">Scheduled
          Slot</span>
        <span class="thankyou-details-val-leaf"><?php echo esc_html($delivery_slot); ?></span>
      </div>
      <div class="thankyou-details-row total-row">
        <span class="thankyou-details-label">Total
          Amount</span>
        <span class="thankyou-details-val-total">₹<?php echo esc_html(number_format(floatval($total_amount), 0)); ?></span>
      </div>
    </div>

    <div class="thankyou-actions">
      <a href="/shop/" class="btn-primary">
        Continue Shopping
      </a>
      <a href="https://wa.me/919876543210?text=Hi%20Garden%20Basket%20Hub,%20I%20have%20a%20question%20about%20Order%20<?php echo urlencode($order_num); ?>"
        target="_blank" class="btn-primary btn-leaf">
        💬 Track on WhatsApp
      </a>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>