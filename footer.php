<!-- ============================================================
     SHARED FOOTER
     ============================================================ -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" style="color:var(--sand)">
        Garden <span>Basket</span> Hub
      </a>
      <p>Rooted in Jaipur. Growing things — and the community around them — one organic seed at a time.</p>
    </div>
    
    <div class="footer-col">
      <h4>Shop Essentials</h4>
      <ul>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Organic Seeds</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Fresh Seedlings (Jaipur)</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Vermicompost & Soil</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Gardening Tools</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Pots & Planters</a></li>
      </ul>
    </div>
    
    <div class="footer-col">
      <h4>Information & Legal</h4>
      <ul>
        <li><a href="<?php echo esc_url(gbh_get_page_url('about-us')); ?>">About Us & Nursery</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>">Gardening Blog & Guides</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('reels')); ?>">Gardening Video Guides</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('privacy-policy')); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('terms-and-conditions')); ?>">Terms & Conditions</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('refund-policy')); ?>">Refund & Shipping Policy</a></li>
      </ul>
    </div>

    
    <div class="footer-col">
      <h4>Nursery Contact</h4>
      <ul>
        <li><a href="https://wa.me/919876543210" target="_blank">WhatsApp Direct Help</a></li>
        <li><a href="mailto:hello@gardenbaskethub.in">hello@gardenbaskethub.in</a></li>
        <li><a href="<?php echo esc_url(gbh_get_page_url('contact-us')); ?>">Mansarovar Nursery, Jaipur, RJ</a></li>
      </ul>
    </div>
  </div>


  <div class="footer-bottom">
    <p>©️ <?php echo date('Y'); ?> Garden Basket Hub. All rights reserved. · Crafted in Jaipur with 🌿</p>
    <div class="footer-socials">
      <!-- Instagram SVG -->
      <a href="https://instagram.com" target="_blank" title="Instagram" aria-label="Instagram">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
      </a>
      <!-- WhatsApp SVG -->
      <a href="https://wa.me/919876543210" target="_blank" title="WhatsApp" aria-label="WhatsApp">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
      </a>
      <!-- YouTube SVG -->
      <a href="https://youtube.com" target="_blank" title="YouTube" aria-label="YouTube">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
      </a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>