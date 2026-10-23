<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/contactUs/contactUs.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/contactUs/contactUs.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/contactUs/contactUs.bundle.js"></script>
  <?php get_header(); ?>
  
    <!-- ============================================================
     CONTACT HERO
     ============================================================ -->
    <section class="page-hero" style="text-align: center; width: 100%;">
      <p class="breadcrumb" style="justify-content: center;"><a href="/">Home</a> · Contact</p>
      <h1>Say <em>hello</em>.</h1>
      <p style="margin: 0 auto;">Plant questions, wholesale orders, partnerships or just gardening chats — we're here for it.</p>
    </section>

  <main>

    <!-- ============================================================
     CONTACT LAYOUT
     ============================================================ -->
    <section>
      <div class="contact-layout">
        <div class="contact-info">
          <h2>Contact our Shop</h2>
          <p>Welcome to Garden Basket Hub in Jaipur! Come say hi, explore our seasonal saplings, seeds, pots, and soil fertilizers in person.</p>

          <div class="contact-row">
            <span class="ic">📍</span>
            <div>
              <strong>Shop Address</strong>
              <span>Jaipur, Rajasthan · 302001</span>
              <div style="margin-top: 8px;">
                <a href="https://maps.app.goo.gl/PNbyJo98EydJKEWw7?g_st=ic" target="_blank" rel="noopener noreferrer" class="btn-locate-store" style="display:inline-flex;align-items:center;gap:6px;background:var(--leaf);color:#fff;padding:8px 16px;border-radius:6px;text-decoration:none;font-size:0.88rem;font-weight:600;">
                  📍 Locate Store on Google Maps ➔
                </a>
              </div>
            </div>
          </div>
          <div class="contact-row">
            <span class="ic">💬</span>
            <div>
              <strong>WhatsApp</strong>
              <span><a href="https://wa.me/919414216343?text=Hi%20Garden%20Basket%20Hub!" target="_blank" rel="noopener noreferrer" style="color:var(--leaf);text-decoration:none;font-weight:600;">+91 9414216343</a></span>
            </div>
          </div>
          <div class="contact-row">
            <span class="ic">📧</span>
            <div>
              <strong>Email</strong>
              <span><a href="mailto:prashant753@gmail.com" style="color:var(--leaf);text-decoration:none;font-weight:600;">prashant753@gmail.com</a></span>
            </div>
          </div>
          <div class="contact-row">
            <span class="ic">📷</span>
            <div>
              <strong>Instagram</strong>
              <span><a href="https://www.instagram.com/garden_basket_hubb?stkn=cXloNG9mdjAxemYx" target="_blank" rel="noopener noreferrer" style="color:var(--leaf);text-decoration:none;font-weight:600;">@garden_basket_hubb</a></span>
            </div>
          </div>
          <div class="contact-row">
            <span class="ic">🕒</span>
            <div><strong>Hours</strong><span>Mon – Sun · 9 AM to 8 PM</span></div>
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

  </main>
  <?php get_footer(); ?>