<?php
/**
 * Template Name: Contact Us
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/contactUs/contactUs.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/contactUs/contactUs.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/contactUs/contactUs.bundle.js"></script>

    <?php get_header(); ?>

<!-- ============================================================
     CONTACT HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Contact</p>
  <h1>Say <em>hello</em>.</h1>
  <p>Plant questions, wholesale orders, partnerships or just gardening chats — we're here for it.</p>
</section>

<!-- ============================================================
     CONTACT LAYOUT
     ============================================================ -->
<section>
  <div class="contact-layout">
    <div class="contact-info">
      <h2>Visit the garden</h2>
      <p>Our nursery is open every day except Tuesdays. Come say hi, pet the shop cat, and pick your seedlings in
        person.</p>

      <div class="contact-row">
        <span class="ic">📍</span>
        <div><strong>Nursery</strong><span>Jaipur, Rajasthan · 302001</span></div>
      </div>
      <div class="contact-row">
        <span class="ic">💬</span>
        <div><strong>WhatsApp</strong><span>+91 98765 43210</span></div>
      </div>
      <div class="contact-row">
        <span class="ic">📧</span>
        <div><strong>Email</strong><span>hello@gardenbaskethub.in</span></div>
      </div>
      <div class="contact-row">
        <span class="ic">📷</span>
        <div><strong>Instagram</strong><span>@gardenbaskethub</span></div>
      </div>
      <div class="contact-row">
        <span class="ic">🕒</span>
        <div><strong>Hours</strong><span>Wed – Mon · 9 AM to 7 PM</span></div>
      </div>
    </div>

    <form class="contact-form" action="#" method="POST">
      <div class="form-group">
        <label>Your Name</label>
        <input type="text" placeholder="What should we call you?" required>
      </div>
      <div class="form-group">
        <label>Email or WhatsApp</label>
        <input type="text" placeholder="So we can reply" required>
      </div>
      <div class="form-group">
        <label>Topic</label>
        <select>
          <option>Plant question</option>
          <option>Order issue</option>
          <option>Wholesale enquiry</option>
          <option>Partnership / collab</option>
          <option>Something else</option>
        </select>
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea placeholder="Tell us about your garden..."></textarea>
      </div>
      <button type="submit" class="btn-primary" style="width:100%;padding:16px;">Send Message</button>
    </form>
  </div>
</section>

<?php get_footer(); ?>