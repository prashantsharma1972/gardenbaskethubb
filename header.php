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
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" title="Garden Basket Hub">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/garden-basket-hub-logo.png'); ?>"
                alt="Garden Basket Hub" class="site-logo-img">
        </a>

        <!-- Desktop Links -->
        <?php $gbh_nav_tree = function_exists('gbh_get_client_category_tree') ? gbh_get_client_category_tree() : array(); ?>
        <ul class="nav-links">
            <li class="nav-item-dropdown">
                <a href="/shop/">Shop All Essentials <span class="dropdown-chevron">▾</span></a>
                <div class="dropdown-menu-box">
                    <?php foreach ($gbh_nav_tree as $cat_key => $cat_item): ?>
                        <div class="cat-menu-item">
                            <a href="/shop/?category=<?php echo esc_attr($cat_item['slug']); ?>" class="cat-main-link">
                                <span><?php echo esc_html($cat_item['icon']); ?></span>
                                <span><?php echo esc_html($cat_item['name']); ?></span>
                                <?php if (!empty($cat_item['badge'])): ?>
                                    <span class="badge-jaipur-mini"><?php echo esc_html($cat_item['badge']); ?></span>
                                <?php endif; ?>
                            </a>
                            <?php if (!empty($cat_item['subs'])): ?>
                                <div class="subcat-links">
                                    <?php foreach ($cat_item['subs'] as $sub_item): ?>
                                        <a
                                            href="/shop/?category=<?php echo esc_attr($sub_item['slug']); ?>"><?php echo esc_html($sub_item['name']); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    <a href="/shop/" class="dropdown-footer-link">
                        <span>Browse All Gardening Supplies ➔</span>
                        <span>Jaipur Nursery &amp; Pan-India Shipping</span>
                    </a>
                </div>
            </li>
            <li><a href="/reels/">Reels</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/about-us/">Our Story</a></li>
            <li><a href="#track-order" class="nav-track-btn" id="gbh-track-order-btn"
                    title="Track Your Order via Shiprocket">Track Order 🚚</a></li>
            <li>
                <button type="button" class="btn-location-pill" id="gbh-location-btn"
                    aria-label="Select Delivery Location">
                    <span class="loc-pin">📍</span>
                    <span class="loc-label">Delivering to:</span>
                    <strong id="gbh-current-loc-name">Jaipur</strong>
                    <span class="loc-change-tag">Change</span>
                </button>
            </li>
            <li><a href="/cart/" class="nav-cart-link">Cart <span
                        class="cart-count-badge"><?php echo esc_html($cart_count); ?></span></a></li>
            <li><a href="/contact-us/" class="nav-cta">Get in Touch</a></li>
        </ul>

        <!-- Mobile Controls (Cart & Hamburger) -->
        <div class="mobile-nav-controls">
            <a href="/cart/" class="mobile-cart-icon" aria-label="View Shopping Bag">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="cart-svg">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
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
            <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" title="Garden Basket Hub">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/garden-basket-hub-logo.png'); ?>"
                    alt="Garden Basket Hub" class="site-logo-img">
            </a>
            <button id="gbh-mobile-close" class="mobile-close" aria-label="Close Menu">&times;</button>
        </div>

        <div style="padding: 12px 24px;">
            <button type="button" class="btn-location-pill" id="gbh-drawer-location-btn"
                style="width:100%; justify-content:center; padding:8px 14px;">
                <span class="loc-pin">📍</span>
                <span class="loc-label">Delivering to:</span>
                <strong id="gbh-drawer-loc-name">Jaipur</strong>
                <span class="loc-change-tag">(Change)</span>
            </button>
        </div>

        <ul class="mobile-nav-links">
            <li><a href="<?php echo esc_url(home_url('/')); ?>">🏡 Home</a></li>
            <li>
                <a href="/shop/">🌱 Shop All Essentials</a>
                <div class="mobile-category-group">
                    <div class="mobile-cat-heading">Categories</div>
                    <div class="mobile-cat-grid">
                        <?php foreach ($gbh_nav_tree as $cat_key => $cat_item): ?>
                            <a href="/shop/?category=<?php echo esc_attr($cat_item['slug']); ?>">
                                <span><?php echo esc_html($cat_item['icon']); ?></span>
                                <span><?php echo esc_html($cat_item['name']); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </li>
            <li><a href="/reels/">🎥 Gardening Reels</a></li>
            <li><a href="/blog/">📖 Gardening Blog</a></li>
            <li><a href="/about-us/">🌿 Our Story</a></li>
            <li><a href="#track-order" id="gbh-drawer-track-order-btn">🚚 Track Your Order</a></li>
            <li><a href="/contact-us/">📍 Contact our Shop</a></li>
        </ul>

        <div class="mobile-drawer-footer">
            <a href="/cart/" class="btn-primary mobile-cart-btn cart-btn-full"
                style="display:block; text-align:center;">
                View Bag <span class="cart-count-badge"><?php echo esc_html($cart_count); ?></span>
            </a>
            <a href="https://wa.me/919414216343?text=Hello%20Garden%20Basket%20Hub!%20I%20need%20help%20with%20plants"
                target="_blank" rel="noopener noreferrer" class="btn-primary"
                style="background:#25D366; display:block; text-align:center; margin-top:12px;">
                💬 WhatsApp Expert Support
            </a>
        </div>
    </div>

    <!-- ============================================================
         CR §5.1: DELIVERY LOCATION SELECTION MODAL
         ============================================================ -->
    <div id="gbh-location-modal" class="gbh-modal-backdrop" style="display:none;">
        <div class="gbh-modal-card location-modal-card">
            <button type="button" class="gbh-modal-close" id="gbh-loc-modal-close"
                aria-label="Close Location Modal">&times;</button>
            <div class="loc-modal-header">
                <div class="loc-modal-icon">🌸</div>
                <h3>Where should we deliver your plants &amp; supplies?</h3>
                <p>Live potted saplings are hand-delivered safely within Jaipur. Non-perishable heirloom seeds, plant
                    boosters, grow bags, and garden tools ship across all of India!</p>
            </div>
            <div class="loc-options-grid">
                <div class="loc-option-card selected" data-location="jaipur">
                    <div class="loc-card-badge">Full Catalog &amp; Live Saplings</div>
                    <div class="loc-card-radio"></div>
                    <div class="loc-card-title">📍 Jaipur City</div>
                    <div class="loc-card-desc">Same-day / next-day hand delivery of fresh potted saplings, organic
                        boosters, pots, and all garden supplies.</div>
                </div>
                <div class="loc-option-card" data-location="outside_jaipur">
                    <div class="loc-card-badge">Pan-India Express Shipping</div>
                    <div class="loc-card-radio"></div>
                    <div class="loc-card-title">🇮🇳 Outside Jaipur / Rest of India</div>
                    <div class="loc-card-desc">Heirloom seeds, bio-fertilizers, grow bags, sprayers, and tools shipped
                        directly to your doorstep anywhere in India.</div>
                    <div class="loc-card-subnote">*(Live nursery saplings excluded to guarantee plant health)*</div>
                </div>
            </div>
            <div class="loc-modal-actions">
                <button type="button" class="btn-primary" id="gbh-confirm-location-btn">Confirm Location &amp; Shop
                    ➔</button>
            </div>
        </div>
    </div>

    <!-- ============================================================
         CR §5.2: SAPLING RESTRICTION INFORMATIVE MODAL
         ============================================================ -->
    <div id="gbh-sapling-modal" class="gbh-modal-backdrop" style="display:none;">
        <div class="gbh-modal-card sapling-notice-card">
            <button type="button" class="gbh-modal-close" id="gbh-sapling-modal-close"
                aria-label="Close Notice">&times;</button>
            <div class="sapling-modal-header">
                <div class="sapling-modal-icon">🌿</div>
                <h3>Available for Jaipur Delivery Only</h3>
                <p>Live potted saplings are delicate living plants. We hand-deliver them exclusively within
                    <strong>Jaipur</strong> to guarantee 100% freshness, vigorous roots, and zero transit shock.
                </p>
            </div>
            <div class="sapling-modal-options">
                <div class="sapling-tip-box">
                    <strong>🇮🇳 Shipping to Rest of India?</strong>
                    <span>You can order our wide collection of high-germination flower &amp; vegetable seeds, Organic
                        Plant Booster, grow bags, and garden tools — all delivered safely across India!</span>
                </div>
            </div>
            <div class="sapling-modal-actions">
                <button type="button" class="btn-secondary" id="gbh-switch-to-jaipur-btn">📍 Switch Location to
                    Jaipur</button>
                <a href="/shop/?category=seeds" class="btn-primary" id="gbh-browse-seeds-btn">Explore Seeds &amp;
                    Supplies ➔</a>
            </div>
        </div>
    </div>

    <!-- ============================================================
         CR §8: ORDER TRACKING MODAL & SHIPROCKET LOOKUP
         ============================================================ -->
    <div id="gbh-track-order-modal" class="gbh-modal-backdrop" style="display:none;">
        <div class="gbh-modal-card track-order-modal-card">
            <button type="button" class="gbh-modal-close" id="gbh-track-modal-close"
                aria-label="Close Track Order Modal">&times;</button>
            <div class="loc-modal-header">
                <div class="loc-modal-icon">🚚</div>
                <h3>Track Your Nursery Order</h3>
                <p>Enter your Garden Basket Hub Order ID (e.g. <strong>GBH-1042</strong>) or Shiprocket AWB Tracking
                    Code to check real-time courier status.</p>
            </div>

            <form id="gbh-track-order-form" style="margin: 20px 0 16px;">
                <div class="track-input-group">
                    <input type="text" id="gbh-track-query" placeholder="Order ID or AWB (e.g. GBH-1042)" required
                        autocomplete="off">
                    <button type="submit" id="gbh-track-submit-btn">Track Status ➔</button>
                </div>
            </form>

            <div id="gbh-track-result-box" class="track-result-box">
                <!-- Dynamically populated by JavaScript -->
            </div>

            <div
                style="border-top: 1px solid rgba(44, 26, 14, 0.08); padding-top: 14px; text-align: center; font-size: 0.82rem; color: var(--clay);">
                <span>Need quick help with your shipment? </span>
                <a href="https://wa.me/919414216343?text=Hello%20Garden%20Basket%20Hub!%20I%20need%20tracking%20assistance%20for%20my%20order"
                    target="_blank" rel="noopener noreferrer"
                    style="color: #25D366; font-weight: 600; text-decoration: none;">
                    💬 WhatsApp Jaipur Support (+91 9414216343)
                </a>
            </div>
        </div>
    </div>

    <!-- Resilient Mobile Drawer Toggle Handler across all pages -->
    <script>
        (function () {
            function initMobileNav() {
                var toggleBtn = document.getElementById('gbh-mobile-toggle');
                var closeBtn = document.getElementById('gbh-mobile-close');
                var overlay = document.getElementById('gbh-mobile-overlay');
                var drawer = document.getElementById('gbh-mobile-drawer');

                if (!toggleBtn || !drawer) return;

                function openDrawer(e) {
                    if (e) e.preventDefault();
                    drawer.classList.add('open');
                    if (overlay) overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }

                function closeDrawer(e) {
                    if (e) e.preventDefault();
                    drawer.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }

                toggleBtn.onclick = openDrawer;
                if (closeBtn) closeBtn.onclick = closeDrawer;
                if (overlay) overlay.onclick = closeDrawer;
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMobileNav);
            } else {
                initMobileNav();
            }
        })();
    </script>