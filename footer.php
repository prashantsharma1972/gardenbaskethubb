<!-- ============================================================
     SHARED FOOTER
     ============================================================ -->
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" style="color:var(--sand)">Garden <span>Basket</span> Hub</a>
                <p>Rooted in Jaipur. Growing things — and the community around them — one seed at a time.</p>
            </div>

            <div class="footer-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="/shop/">Seeds</a></li>
                    <li><a href="/shop/">Seedlings</a></li>
                    <li><a href="/shop/">Compost & Soil</a></li>
                    <li><a href="/shop/">Tools & Machines</a></li>
                    <li><a href="/shop/">Bundles</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Info</h4>
                <ul>
                    <li><a href="/about-us/">Our Story</a></li>
                    <li><a href="/refund-policy/">Refund Policy</a></li>
                    <li><a href="/privacy-policy/">Privacy Policy</a></li>
                    <li><a href="/terms-and-conditions/">Terms & Conditions</a></li>
                    <li><a href="/blog/">Plant Care Guides</a></li>
                    <li><a href="/contact-us/">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li><a href="https://wa.me/919876543210" target="_blank">WhatsApp Us</a></li>
                    <li><a href="#">Instagram DM</a></li>
                    <li><a href="mailto:hello@gardenbaskethub.in">hello@gardenbaskethub.in</a></li>
                    <li><a href="/contact-us/">Jaipur, Rajasthan</a></li>
                    <li><a href="/contact-us/">Wholesale</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?php echo date('Y'); ?> Garden Basket Hub. All rights reserved. · Made in Jaipur with 🌿</p>
            <div class="footer-socials">
                <a href="#" title="Instagram">📷</a>
                <a href="https://wa.me/919876543210" title="WhatsApp">💬</a>
                <a href="#" title="YouTube">▶️</a>
            </div>
        </div>
    </footer>

    <!-- ============================================================
     STICKY FLOATING WHATSAPP CHAT BUTTON
     Shows on every page — click opens WhatsApp chat
     ============================================================ -->
    <a id="gbh-whatsapp-float"
       href="https://wa.me/919876543210?text=Hello%20Garden%20Basket%20Hub!%20I%20need%20help%20with%20my%20order%20%F0%9F%8C%BF"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat with us on WhatsApp"
       title="Chat with Garden Basket Hub on WhatsApp">
        <!-- WhatsApp SVG Logo -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="28" height="28" fill="none" aria-hidden="true">
            <path fill="#fff" d="M24 4C13 4 4 13 4 24c0 3.6 1 7 2.7 9.9L4 44l10.4-2.7A19.9 19.9 0 0 0 24 44c11 0 20-9 20-20S35 4 24 4Z"/>
            <path fill="#25D366" d="M24 6.3A17.7 17.7 0 0 0 6.3 24c0 3.3.9 6.4 2.5 9.1l.3.5-1.6 5.9 6-1.6.5.3A17.7 17.7 0 1 0 24 6.3Z"/>
            <path fill="#fff" fill-rule="evenodd" d="M18 14.5c-.4-.9-.8-1-1.2-1H15.6c-.4 0-1 .1-1.5.7-.5.5-2 2-2 4.8s2 5.5 2.3 5.9c.3.4 4 6.3 9.8 8.6 1.4.6 2.5.9 3.3 1.1 1.4.4 2.7.4 3.6.2 1.1-.2 3.4-1.4 3.9-2.7.5-1.3.5-2.5.3-2.7-.1-.2-.5-.3-1-.6-.6-.3-3.4-1.6-3.9-1.8-.5-.2-.9-.3-1.3.3-.4.6-1.5 1.8-1.8 2.2-.3.4-.7.4-1.2.2-.6-.3-2.4-.9-4.6-2.8-1.7-1.5-2.8-3.3-3.2-3.9-.3-.5 0-.8.3-1l1.1-1.3c.3-.3.4-.6.6-1 .2-.4.1-.7-.1-1l-1.7-4.2Z" clip-rule="evenodd"/>
        </svg>
        <span class="gbh-wa-tooltip">💬 Chat with us!</span>
    </a>

    <style>
    /* === Sticky WhatsApp Float Button === */
    #gbh-whatsapp-float {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 9999;
        width: 58px;
        height: 58px;
        background: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45), 0 2px 8px rgba(0,0,0,0.18);
        text-decoration: none;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1),
                    box-shadow 0.25s ease;
        animation: gbh-wa-pulse 2.8s ease-in-out infinite;
    }

    #gbh-whatsapp-float:hover {
        transform: scale(1.12);
        box-shadow: 0 6px 28px rgba(37, 211, 102, 0.55), 0 4px 12px rgba(0,0,0,0.22);
        animation: none;
    }

    /* Tooltip */
    .gbh-wa-tooltip {
        position: absolute;
        right: 68px;
        top: 50%;
        transform: translateY(-50%);
        background: #1a1a1a;
        color: #fff;
        font-family: var(--f-body, 'DM Sans', sans-serif);
        font-size: 0.78rem;
        font-weight: 500;
        white-space: nowrap;
        padding: 6px 12px;
        border-radius: 8px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s ease, transform 0.2s ease;
        transform: translateY(-50%) translateX(6px);
    }

    .gbh-wa-tooltip::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -5px;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left-color: #1a1a1a;
    }

    #gbh-whatsapp-float:hover .gbh-wa-tooltip {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
    }

    /* Pulse animation */
    @keyframes gbh-wa-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5), 0 4px 20px rgba(37,211,102,0.35); }
        60%  { box-shadow: 0 0 0 12px rgba(37, 211, 102, 0), 0 4px 20px rgba(37,211,102,0.35); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0), 0 4px 20px rgba(37,211,102,0.35); }
    }

    /* Mobile: move up slightly above mobile nav area */
    @media (max-width: 600px) {
        #gbh-whatsapp-float {
            bottom: 20px;
            right: 16px;
            width: 50px;
            height: 50px;
        }
        .gbh-wa-tooltip {
            display: none; /* hide tooltip on mobile (tap interface) */
        }
    }
    </style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>