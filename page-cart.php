<?php
/**
 * Template Name: Shopping Bag / Cart Page
 */

get_header();

$cart = gbh_get_cart_data();
?>

<!-- ============================================================
     CART PAGE HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Your Bag</p>
  <h1>Your <em>garden bag</em></h1>
  <p>Review your seedlings and supplies before checkout.</p>
</section>

<!-- ============================================================
     CART CONTENT & SUMMARY
     ============================================================ -->
<section>
  <div class="cart-layout">
    <!-- Items Table -->
    <div class="cart-table">
      <?php if (!empty($cart['items'])): ?>
        <?php foreach ($cart['items'] as $item): ?>
          <div class="cart-row" data-cart-key="<?php echo esc_attr($item['key']); ?>">
            <div class="cart-thumb">
              <?php if (!empty($item['image'])): ?>
                <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
              <?php else: ?>
                🌱
              <?php endif; ?>
            </div>

            <div class="cart-info">
              <h4><?php echo esc_html($item['title']); ?></h4>
              <?php if (!empty($item['variant'])): ?>
                <div class="meta"><?php echo esc_html($item['variant']); ?></div>
              <?php else: ?>
                <div class="meta">Jaipur Nursery · Pan-India Delivery</div>
              <?php endif; ?>
              <div class="price"><?php echo esc_html($item['price_formatted']); ?></div>
            </div>

            <div class="cart-actions">
              <div class="qty-stepper">
                <button>−</button>
                <input type="text" value="<?php echo esc_attr($item['quantity']); ?>">
                <button>+</button>
              </div>
              <button class="remove">Remove</button>
            </div>
          </div>
        <?php endforeach; ?>

      <?php else: ?>
        <!-- Demo Static Cart View if empty -->
        <div class="cart-row" data-cart-key="demo-1">
          <div class="cart-thumb">🌱</div>
          <div class="cart-info">
            <h4>Tomato Seedling Tray</h4>
            <div class="meta">Cherry · Tray of 6 · Jaipur Only</div>
            <div class="price">₹199</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="1"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>

        <div class="cart-row" data-cart-key="demo-2">
          <div class="cart-thumb">🌿</div>
          <div class="cart-info">
            <h4>Monsoon Veg Seed Kit</h4>
            <div class="meta">8 Varieties · Pan India</div>
            <div class="price">₹349</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="2"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>

        <div class="cart-row" data-cart-key="demo-3">
          <div class="cart-thumb">🪴</div>
          <div class="cart-info">
            <h4>Organic Vermicompost</h4>
            <div class="meta">5 kg pack · Jaipur Delivery</div>
            <div class="price">₹299</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="1"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Order Summary Sidebar -->
    <aside class="cart-summary">
      <h3>Order Summary</h3>
      <div class="row">
        <span>Subtotal (<?php echo esc_html($cart['total_count'] > 0 ? $cart['total_count'] : 4); ?> items)</span>
        <span><?php echo esc_html($cart['subtotal_formatted'] !== '₹0' ? $cart['subtotal_formatted'] : '₹1,196'); ?></span>
      </div>

      <div class="row">
        <span>Delivery Charge</span>
        <span><?php echo esc_html($cart['delivery_fee_formatted']); ?></span>
      </div>

      <?php if ($cart['discount'] > 0): ?>
        <div class="row">
          <span>Discount (Coupon Applied)</span>
          <span style="color:var(--leaf);"><?php echo esc_html($cart['discount_formatted']); ?></span>
        </div>
      <?php endif; ?>

      <div class="coupon">
        <input type="text" placeholder="Coupon code (MONSOON10)">
        <button type="button">Apply</button>
      </div>

      <div class="row total">
        <span>Total</span>
        <span><?php echo esc_html($cart['total_formatted'] !== '₹0' ? $cart['total_formatted'] : '₹1,125'); ?></span>
      </div>

      <a href="<?php echo esc_url(home_url('/checkout/')); ?>" class="btn-primary checkout-btn">
        Proceed to Checkout
      </a>
      <p
        style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-align:center;margin-top:16px;letter-spacing:0.06em;">
        ✦ Free shipping pan India above ₹799</p>
    </aside>
  </div>
</section>

<?php get_footer(); ?>