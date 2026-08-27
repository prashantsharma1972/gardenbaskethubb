<?php
// Calculate current cart count
$cart_data = gbh_get_cart_data();
$cart_count = $cart_data['total_count'];
?>
    <title><?php wp_title('|', true, 'right'); ?></title>

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
    <header class="header">
        <div class="header-wrapper">
            <div class="header-main">
                <a href="/" class="smartit-home nav-logo">
                    Garden <span>Basket</span> Hub
                </a>

                <div class="nav-container">
                    <nav class="site-nav">
                        <ul class="nav-links desktop-nav">
                            <li><a href="/shop/">Shop</a></li>
                            <li><a href="/reels/">Reels</a></li>
                            <li><a href="/blog/">Blog</a></li>
                            <li><a href="/about-us/">About Us</a></li>
                            <li>
                                <a href="/cart/" title="Shopping Bag"
                                    aria-label="Shopping Bag">
                                    🛒 <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <a href="/contact-us/" class="get-consultation nav-cta">
                    Get in Touch
                </a>
            </div>
        </div>

        <div class="mobile-nav mobile-nav-controls">
            <button id="gbh-mobile-toggle" class="hamburger mobile-toggle" aria-label="Toggle Menu">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <a href="/" class="smartit-home nav-logo">
                Garden <span>Basket</span> Hub
            </a>
            <a href="/cart/" class="mobile-cart-icon" aria-label="View Shopping Bag">
                🛒 <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
        </div>

        <div id="gbh-mobile-overlay" class="header-back-drop mobile-overlay"></div>
    </header>
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
            <li><a href="/about-us/">🌿 About Us</a></li>
            <li><a href="/contact-us/">📍 Contact Jaipur Nursery</a></li>
        </ul>

        <div class="mobile-drawer-footer">
            <a href="/cart/" class="btn-primary mobile-cart-btn cart-btn-full">
                View Bag (<span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span> Items)
            </a>
            <a href="https://wa.me/919876543210" target="_blank" class="mobile-wa-btn">
                💬 WhatsApp Expert Support
            </a>
        </div>
    </div>