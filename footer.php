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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('gbh-mobile-toggle');
            const closeBtn = document.getElementById('gbh-mobile-close');
            const drawer = document.getElementById('gbh-mobile-drawer');
            const overlay = document.getElementById('gbh-mobile-overlay');

            if (toggleBtn && drawer && overlay) {
                const toggleMenu = () => {
                    drawer.classList.toggle('open');
                    overlay.classList.toggle('active');
                };
                toggleBtn.addEventListener('click', toggleMenu);
                closeBtn?.addEventListener('click', toggleMenu);
                overlay.addEventListener('click', toggleMenu);
            }
        });
    </script>
<?php wp_footer(); ?>
</body>

</html>