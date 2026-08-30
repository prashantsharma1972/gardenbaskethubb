<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/checkout/checkout.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/checkout/checkout.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/checkout/checkout.bundle.js"></script>
  <?php get_header(); ?>
  <main>
    <?php
    $cart = gbh_get_cart_data();
    ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <!-- ============================================================
     CHECKOUT HERO
     ============================================================ -->
    <section class="page-hero">
      <p class="breadcrumb"><a href="/cart/">Bag</a> · Checkout</p>
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

            <div class="row summary-divider">
              <span>Delivery Fee</span>
              <span><?php echo esc_html($cart['delivery_fee_formatted']); ?></span>
            </div>

            <?php if ($cart['discount'] > 0): ?>
              <div class="row">
                <span>Discount</span>
                <span class="color-leaf"><?php echo esc_html($cart['discount_formatted']); ?></span>
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
        <div class="empty-cart-view-container">
          <div class="empty-icon">🛒 🌿</div>
          <h2 class="empty-title">Your bag is empty</h2>
          <p class="empty-desc">Add items to your shopping bag before proceeding to checkout.</p>
          <a href="/shop/" class="btn-primary empty-btn">
            Explore Nursery Shop ➔
          </a>
        </div>
      <?php endif; ?>
    </section>


  </main>
  <?php get_footer(); ?>