<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Calculate current cart count
$cart_data = gbh_get_cart_data();
$cart_count = $cart_data['total_count'];
?>

<!-- ============================================================
     SITE NAVIGATION BAR
     ============================================================ -->
<nav class="site-nav">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
        Garden <span>Basket</span> Hub
    </a>

    <ul class="nav-links desktop-nav">
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Shop</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('reels')); ?>">Reels</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>">Blog</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('about-us')); ?>">About Us</a></li>
        <li>
            <a href="<?php echo esc_url(gbh_get_page_url('cart')); ?>" title="Shopping Bag" aria-label="Shopping Bag">
                🛒 <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(gbh_get_page_url('contact-us')); ?>" class="nav-cta">
                Get in Touch
            </a>
        </li>
    </ul>

    <!-- Mobile Navigation Trigger & Cart Badge -->
    <div class="mobile-nav-controls">
        <a href="<?php echo esc_url(gbh_get_page_url('cart')); ?>" class="mobile-cart-icon" aria-label="View Shopping Bag">
            🛒 <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
        </a>
        <button id="gbh-mobile-toggle" class="mobile-toggle" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- Mobile Drawer Overlay -->
<div id="gbh-mobile-overlay" class="mobile-overlay"></div>

<!-- Mobile Navigation Slide-out Drawer -->
<div id="gbh-mobile-drawer" class="mobile-drawer">
    <div class="mobile-drawer-header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
            Garden <span>Basket</span> Hub
        </a>
        <button id="gbh-mobile-close" class="mobile-close" aria-label="Close Menu">&times;</button>
    </div>

    <ul class="mobile-nav-links">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">🏡 Home</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">🌱 Shop All Essentials</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('reels')); ?>">🎥 Gardening Reels</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>">📖 Gardening Blog</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('about-us')); ?>">🌿 About Us</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('contact-us')); ?>">📍 Contact Jaipur Nursery</a></li>
    </ul>

    <div class="mobile-drawer-footer">
        <a href="<?php echo esc_url(gbh_get_page_url('cart')); ?>" class="btn-primary mobile-cart-btn" style="width:100%;text-align:center;">
            View Bag (<span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span> Items)
        </a>
        <a href="https://wa.me/919876543210" target="_blank" class="mobile-wa-btn">
            💬 WhatsApp Expert Support
        </a>
    </div>
</div>