<?php
// Calculate current cart count
$cart_data = GBH_Cart_API::get_cart_data();
$cart_count = $cart_data['total_count'];
?>
<title> <?php wp_title(''); ?> </title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<script>
    function loadJS(FILE_URL, defer = true) {
        let scriptEle = document.createElement("script");
        scriptEle.setAttribute("src", FILE_URL);
        scriptEle.setAttribute("type", "text/javascript");
        scriptEle.setAttribute("defer", defer);
        document.head.appendChild(scriptEle);
    }
</script>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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