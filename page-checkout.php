<?php
/**
 * Template Name: Checkout Page
 */

get_header();

$cart = gbh_get_cart_data();
?>

<!-- ============================================================
     CHECKOUT HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/cart/')); ?>">Bag</a> · Checkout</p>
  <h1>Almost in the <em>soil</em>.</h1>
  <p>Just a few details and your garden will be on its way.</p>
</section>

<!-- ============================================================
     CHECKOUT FORM & ORDER SUMMARY
     ============================================================ -->
<section>
  <?php if (!empty($cart['items'])): ?>
  <div class="checkout-layout">
    <form id="gbh-checkout-form" class="checkout-form" method="POST">
      <input type="hidden" id="payment_method_input" name="payment_method" value="UPI / Razorpay">

      <!-- Step 1: Contact -->
      <div class="step">
        <h3><span class="num">1</span> Contact Information</h3>
        <div class="form-grid">
          <div class="form-group full">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@email.com" required>
          </div>
          <div class="form-group full">
            <label>Phone Number (WhatsApp for delivery updates)</label>
            <input type="tel" name="phone" placeholder="+91 9876543210" required>
          </div>
        </div>
      </div>

      <!-- Step 2: Delivery Address -->
      <div class="step">
        <h3><span class="num">2</span> Delivery Address</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name">
          </div>
          <div class="form-group full">
            <label>Street Address</label>
            <input type="text" name="address" placeholder="House no., street, area" required>
          </div>
          <div class="form-group full">
            <label>Landmark (optional)</label>
            <input type="text" name="landmark" placeholder="Near park, school, etc.">
          </div>
          <div class="form-group">
            <label>City</label>
            <input type="text" name="city" value="Jaipur">
          </div>
          <div class="form-group">
            <label>Pincode</label>
            <input type="text" name="pincode" value="302001" required>
          </div>
          <div class="form-group full">
            <label>Delivery Time Slot (Jaipur Same-Day Orders)</label>
            <select name="delivery_slot">
              <option value="Today · 4 PM – 7 PM">Today · 4 PM – 7 PM</option>
              <option value="Today · 7 PM – 9 PM">Today · 7 PM – 9 PM</option>
              <option value="Tomorrow Morning · 9 AM – 12 PM">Tomorrow Morning · 9 AM – 12 PM</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Step 3: Payment Options -->
      <div class="step">
        <h3><span class="num">3</span> Select Payment Option</h3>

        <div class="pay-option selected">
          <span class="ic">📱</span>
          <div>
            <div class="label">UPI / Razorpay</div>
            <div class="sub">Pay instantly via Google Pay, PhonePe, Paytm, Cards or Net Banking</div>
          </div>
        </div>

        <div class="pay-option">
          <span class="ic">💵</span>
          <div>
            <div class="label">Cash on Delivery (COD)</div>
            <div class="sub">Pay cash to delivery executive (Available within Jaipur)</div>
          </div>
        </div>

        <div class="pay-option">
          <span class="ic">💳</span>
          <div>
            <div class="label">Partial COD</div>
            <div class="sub">Pay ₹100 advance online, rest on delivery</div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn-primary btn-place-order" style="width:100%;text-align:center;padding:18px;">
        Place Order · <?php echo esc_html($cart['total_formatted']); ?>
      </button>
    </form>

    <!-- Order Summary Sidebar -->
    <aside class="cart-summary">
      <h3>Your Order</h3>
      <?php foreach ($cart['items'] as $item): ?>
        <div class="row">
          <span><?php echo esc_html($item['title']); ?> × <?php echo esc_html($item['quantity']); ?></span>
          <span><?php echo esc_html($item['line_total_formatted']); ?></span>
        </div>
      <?php endforeach; ?>

      <div class="row" style="margin-top:12px;border-top:1px solid rgba(44,26,14,0.1);padding-top:12px;">
        <span>Delivery Fee</span>
        <span><?php echo esc_html($cart['delivery_fee_formatted']); ?></span>
      </div>

      <?php if ($cart['discount'] > 0): ?>
        <div class="row">
          <span>Discount</span>
          <span style="color:var(--leaf);"><?php echo esc_html($cart['discount_formatted']); ?></span>
        </div>
      <?php endif; ?>

      <div class="row total">
        <span>Total Amount</span>
        <span><?php echo esc_html($cart['total_formatted']); ?></span>
      </div>

      <p style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);margin-top:16px;letter-spacing:0.06em;text-align:center;">
        🔒 256-Bit SSL Secure Checkout · 100% Satisfaction Guaranteed
      </p>
    </aside>
  </div>
  <?php else: ?>
  <div class="empty-cart-view" style="text-align:center;padding:60px 20px;max-width:540px;margin:0 auto;">
    <div style="font-size:4rem;margin-bottom:16px;">🛒 🌿</div>
    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:12px;font-size:2rem;">Your bag is empty</h2>
    <p style="color:var(--clay);margin-bottom:28px;line-height:1.6;">Add items to your shopping bag before proceeding to checkout.</p>
    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-primary" style="padding:14px 32px;">
      Explore Nursery Shop ➔
    </a>
  </div>
  <?php endif; ?>
</section>


<?php get_footer(); ?>