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

    <ul class="nav-links">
        <li><a href="<?php echo esc_url(home_url('/shop/')); ?>">Shop</a></li>
        <li><a href="<?php echo esc_url(home_url('/reels/')); ?>">Reels</a></li>
        <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">Our Story</a></li>
        <li>
            <a href="<?php echo esc_url(home_url('/cart/')); ?>">
                Cart <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="nav-cta">
                Get in Touch
            </a>
        </li>
    </ul>
</nav>