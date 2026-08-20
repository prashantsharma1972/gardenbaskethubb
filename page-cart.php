<?php
/**
 * Template Name: Shopping Bag / Cart Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/cart/cart.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/cart/cart.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/cart/cart.bundle.js"></script>

    <?php get_header(); ?>
<?php
$cart = GBH_Cart_API::get_cart_data();
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
  <?php if (!empty($cart['items'])): ?>
  <div class="cart-layout">
    <!-- Items Table -->
    <div class="cart-table">
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
            <h4><a href="<?php echo esc_url(get_permalink($item['product_id'])); ?>"><?php echo esc_html($item['title']); ?></a></h4>
            <?php if (!empty($item['variant'])): ?>
              <div class="meta"><?php echo esc_html($item['variant']); ?></div>
            <?php else: ?>
              <div class="meta">Jaipur Nursery · Pan-India Shipping</div>
            <?php endif; ?>
            <div class="price"><?php echo esc_html($item['price_formatted']); ?></div>
          </div>

          <div class="cart-actions">
            <div class="qty-stepper">
              <button class="btn-qty-minus">−</button>
              <input type="text" class="cart-qty-input" value="<?php echo esc_attr($item['quantity']); ?>">
              <button class="btn-qty-plus">+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Order Summary Sidebar -->
    <aside class="cart-summary">
      <h3>Order Summary</h3>
      <div class="row">
        <span>Subtotal (<span class="summary-cart-count"><?php echo esc_html($cart['total_count']); ?></span> items)</span>
        <span class="summary-subtotal"><?php echo esc_html($cart['subtotal_formatted']); ?></span>
      </div>

      <div class="row">
        <span>Delivery Charge</span>
        <span class="summary-delivery"><?php echo esc_html($cart['delivery_fee_formatted']); ?></span>
      </div>

      <?php if ($cart['discount'] > 0): ?>
        <div class="row">
          <span>Discount (Coupon Applied)</span>
          <span style="color:var(--leaf);" class="summary-discount"><?php echo esc_html($cart['discount_formatted']); ?></span>
        </div>
      <?php endif; ?>

      <div class="coupon">
        <input type="text" placeholder="Coupon code (MONSOON10)">
        <button type="button" class="btn-apply-coupon">Apply</button>
      </div>

      <div class="row total">
        <span>Total Amount</span>
        <span class="summary-total"><?php echo esc_html($cart['total_formatted']); ?></span>
      </div>

      <a href="<?php echo esc_url(home_url('/checkout/')); ?>" class="btn-primary checkout-btn">
        Proceed to Checkout
      </a>
      <p style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-align:center;margin-top:16px;letter-spacing:0.06em;">
        ✦ Free shipping pan India above ₹799
      </p>
    </aside>
  </div>
  <?php else: ?>
  <div class="empty-cart-view" style="text-align:center;padding:60px 20px;max-width:540px;margin:0 auto;">
    <div style="font-size:4rem;margin-bottom:16px;">🛒 🌿</div>
    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:12px;font-size:2rem;">Your garden bag is empty</h2>
    <p style="color:var(--clay);margin-bottom:28px;line-height:1.6;">You haven't added any seeds, seedlings, or gardening tools to your bag yet.</p>
    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-primary" style="padding:14px 32px;">
      Explore Nursery Shop ➔
    </a>
  </div>
  <?php endif; ?>
</section>


<?php get_footer(); ?>