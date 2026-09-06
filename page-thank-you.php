<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/thankYou/thankYou.bundle.js"></script>
  <?php get_header(); ?>
  <main class="main--container">
    <?php
    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    $order_num = isset($_GET['order_num']) ? sanitize_text_field($_GET['order_num']) : '';

    if ($order_id) {
        $order_num = $order_num ?: get_post_meta($order_id, '_gbh_order_num', true);
        $customer_name = get_post_meta($order_id, '_customer_name', true) ?: get_post_meta($order_id, '_gbh_customer_name', true) ?: 'Valued Gardener';
        $customer_email = get_post_meta($order_id, '_customer_email', true) ?: get_post_meta($order_id, '_gbh_email', true);
        $customer_phone = get_post_meta($order_id, '_customer_phone', true) ?: get_post_meta($order_id, '_gbh_phone', true);
        $shipping_address = get_post_meta($order_id, '_shipping_address', true) ?: get_post_meta($order_id, '_gbh_address', true);
        $city = get_post_meta($order_id, '_shipping_city', true) ?: get_post_meta($order_id, '_gbh_city', true) ?: 'Jaipur';
        $pincode = get_post_meta($order_id, '_shipping_pincode', true) ?: get_post_meta($order_id, '_gbh_pincode', true);
        $delivery_slot = get_post_meta($order_id, '_delivery_slot', true) ?: get_post_meta($order_id, '_gbh_delivery_slot', true) ?: 'Standard Jaipur Delivery';
        $payment_method = get_post_meta($order_id, '_payment_method', true) ?: get_post_meta($order_id, '_gbh_payment_method', true) ?: 'UPI / Razorpay';
        $payment_status = get_post_meta($order_id, '_payment_status', true) ?: 'Paid';
        $total_amount = get_post_meta($order_id, '_order_total', true) ?: get_post_meta($order_id, '_gbh_total_amount', true) ?: '0';
        $paid_amount = get_post_meta($order_id, '_gbh_paid_amount', true);
        $razorpay_payment_id = get_post_meta($order_id, '_razorpay_payment_id', true);
        $is_test = (get_post_meta($order_id, '_is_test_order', true) === 'yes' || strpos($order_num, 'TEST-') === 0);

        $items = get_post_meta($order_id, '_order_items', true);
        if (!is_array($items)) {
            $raw_items = get_post_meta($order_id, '_gbh_order_items', true);
            $items = $raw_items ? json_decode($raw_items, true) : array();
        }
    } else {
        $order_num = 'GBH-89214';
        $customer_name = 'Gardener';
        $customer_email = 'customer@gardenbaskethubb.com';
        $customer_phone = '+91 98765 43210';
        $shipping_address = 'C-Scheme, Ashok Nagar';
        $city = 'Jaipur';
        $pincode = '302001';
        $delivery_slot = 'Same-Day Jaipur Delivery (4 PM – 7 PM)';
        $payment_method = 'UPI / Razorpay';
        $payment_status = 'Paid';
        $total_amount = '1125';
        $paid_amount = '1125';
        $razorpay_payment_id = 'pay_simulated123';
        $is_test = false;
        $items = array(
            array(
                'title' => 'Monstera Deliciosa (Swiss Cheese Plant)',
                'quantity' => 1,
                'price' => 499,
                'image' => ''
            ),
            array(
                'title' => 'Organic Vermicompost & Potting Soil Mix',
                'quantity' => 2,
                'price' => 299,
                'image' => ''
            )
        );
    }
    $is_cod = (strtolower($payment_method) === 'cod' || stripos($payment_method, 'cash on delivery') !== false);
    ?>

    <!-- ============================================================
     THANK YOU / ORDER CONFIRMATION
     ============================================================ -->
    <section class="thankyou-section">
      <div class="thankyou-box thank-you-card">
        <div class="thankyou-icon">🌱 🎉</div>

        <div class="thankyou-badge-row">
          <span class="order-id-badge">Order #<?php echo esc_html($order_num); ?></span>
          <?php if ($is_test): ?>
            <span class="badge-test">🧪 Staging Test Order</span>
          <?php endif; ?>
          <?php if ($is_cod): ?>
            <span class="badge-payment badge-cod">💵 Cash on Delivery</span>
          <?php else: ?>
            <span class="badge-payment badge-paid">✅ Payment Verified</span>
          <?php endif; ?>
        </div>

        <h1 class="thankyou-heading">
          Thank You, <?php echo esc_html($customer_name); ?>!
        </h1>

        <p class="thankyou-paragraph">
          Your garden order has been placed successfully. We are carefully packing your nursery plants & supplies at our Jaipur nursery.
          <?php if ($customer_email): ?>
            <br><span class="email-note">A confirmation receipt has been sent to <strong><?php echo esc_html($customer_email); ?></strong>.</span>
          <?php endif; ?>
        </p>

        <!-- Visual 3-Step Order Progress Tracker -->
        <div class="order-tracker">
          <div class="tracker-step step-completed">
            <div class="tracker-circle">✓</div>
            <div class="tracker-label">Confirmed</div>
          </div>
          <div class="tracker-line active"></div>
          <div class="tracker-step step-active">
            <div class="tracker-circle">🌱</div>
            <div class="tracker-label">Packing</div>
          </div>
          <div class="tracker-line"></div>
          <div class="tracker-step">
            <div class="tracker-circle">🚚</div>
            <div class="tracker-label">Dispatched</div>
          </div>
        </div>

        <!-- Ordered Items Breakdown -->
        <?php if (!empty($items) && is_array($items)): ?>
          <div class="thankyou-items-card">
            <h3 class="card-section-title">Purchased Items</h3>
            <div class="thankyou-items-list">
              <?php foreach ($items as $item): 
                $item_title = isset($item['title']) ? $item['title'] : 'Gardening Product';
                $item_qty = isset($item['qty']) ? intval($item['qty']) : (isset($item['quantity']) ? intval($item['quantity']) : 1);
                $item_price = isset($item['price']) ? floatval($item['price']) : 0;
                $item_img = isset($item['image']) ? $item['image'] : '';
                $item_total = $item_price * $item_qty;
              ?>
                <div class="thankyou-item-row">
                  <div class="item-img-col">
                    <?php if ($item_img): ?>
                      <img src="<?php echo esc_url($item_img); ?>" alt="<?php echo esc_attr($item_title); ?>" class="thankyou-item-thumb">
                    <?php else: ?>
                      <div class="thankyou-item-thumb-placeholder">🌿</div>
                    <?php endif; ?>
                  </div>
                  <div class="item-info-col">
                    <span class="item-title"><?php echo esc_html($item_title); ?></span>
                    <span class="item-meta">Qty: <?php echo esc_html($item_qty); ?> · ₹<?php echo esc_html(number_format($item_price, 0)); ?> each</span>
                  </div>
                  <div class="item-price-col">
                    ₹<?php echo esc_html(number_format($item_total, 0)); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Order & Delivery Details Summary Card -->
        <div class="thankyou-details-card">
          <h3 class="card-section-title">Order & Delivery Details</h3>

          <div class="thankyou-details-row">
            <span class="thankyou-details-label">Delivery Address</span>
            <span class="thankyou-details-val">
              <?php echo esc_html($shipping_address); ?><?php echo ($city || $pincode) ? ', ' . esc_html($city) . ' (' . esc_html($pincode) . ')' : ''; ?>
            </span>
          </div>

          <div class="thankyou-details-row">
            <span class="thankyou-details-label">Scheduled Slot</span>
            <span class="thankyou-details-val-leaf"><?php echo esc_html($delivery_slot); ?></span>
          </div>

          <div class="thankyou-details-row">
            <span class="thankyou-details-label">Payment Method</span>
            <span class="thankyou-details-val">
              <?php echo esc_html($payment_method); ?>
              <?php if ($razorpay_payment_id): ?>
                <span class="ref-id">Ref: <?php echo esc_html($razorpay_payment_id); ?></span>
              <?php endif; ?>
            </span>
          </div>

          <?php if ($customer_phone): ?>
            <div class="thankyou-details-row">
              <span class="thankyou-details-label">Contact Phone</span>
              <span class="thankyou-details-val"><?php echo esc_html($customer_phone); ?></span>
            </div>
          <?php endif; ?>

          <div class="thankyou-details-row total-row">
            <span class="thankyou-details-label">Total Amount</span>
            <div class="total-val-wrapper">
              <span class="thankyou-details-val-total">₹<?php echo esc_html(number_format(floatval($total_amount), 0)); ?></span>
              <?php if ($is_test && floatval($paid_amount) == 1.00): ?>
                <span class="penny-test-note">(₹1.00 Verification Paid)</span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Action CTAs -->
        <div class="thankyou-actions">
          <a href="/shop/" class="btn-primary">
            Continue Shopping
          </a>
          <a href="https://wa.me/919876543210?text=Hi%20Garden%20Basket%20Hub,%20I%20have%20an%20inquiry%20about%20Order%20<?php echo urlencode($order_num); ?>"
            target="_blank" class="btn-primary btn-leaf">
            💬 Track via WhatsApp
          </a>
        </div>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>