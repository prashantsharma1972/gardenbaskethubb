<?php
// Calculate current cart count
$cart_data = gbh_get_cart_data();
$cart_count = $cart_data['total_count'];
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
    <nav>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">Garden <span>Basket</span> Hub</a>
        
        <!-- Desktop Links -->
        <ul class="nav-links">
            <li><a href="/shop/">Shop</a></li>
            <li><a href="/reels/">Reels</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/about-us/">Our Story</a></li>
            <li><a href="/cart/" class="nav-cart-link">Cart <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span></a></li>
            <li><a href="/contact-us/" class="nav-cta">Get in Touch</a></li>
        </ul>

        <!-- Mobile Controls (Hamburger) -->
        <div class="mobile-nav-controls" style="display:none;">
            <a href="/cart/" class="mobile-cart-icon" aria-label="View Shopping Bag">
                🛒 <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
            <button id="gbh-mobile-toggle" class="hamburger mobile-toggle" aria-label="Toggle Menu">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
        </div>
    </nav>
    <div id="gbh-mobile-overlay" class="header-back-drop mobile-overlay"></div>
    <div class="header-spacer"></div>

    <!-- Mobile Navigation Slide-out Drawer -->
    <div id="gbh-mobile-drawer" class="mobile-drawer">
        <div class="mobile-drawer-header">
            <a href="/" class="nav-logo">
                Garden <span>Basket</span> Hub
            </a>
            <button id="gbh-mobile-close" class="mobile-close" aria-label="Close Menu">&times;</button>
        </div>

        <ul class="mobile-nav-links">
            <li><a href="/">🏡 Home</a></li>
            <li><a href="/shop/">🌱 Shop All Essentials</a></li>
            <li><a href="/reels/">🎥 Gardening Reels</a></li>
            <li><a href="/blog/">📖 Gardening Blog</a></li>
            <li><a href="/about-us/">🌿 Our Story</a></li>
            <li><a href="/contact-us/">📍 Contact Jaipur Nursery</a></li>
        </ul>

        <div class="mobile-drawer-footer">
            <a href="/cart/" class="btn-primary mobile-cart-btn cart-btn-full" style="display:block; text-align:center;">
                View Bag <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
            <a href="https://wa.me/919876543210" target="_blank" class="btn-primary" style="background:#25D366; display:block; text-align:center; margin-top:12px;">
                💬 WhatsApp Expert Support
            </a>
        </div>
    </div>