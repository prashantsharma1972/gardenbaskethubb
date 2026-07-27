<?php
/**
 * Template Name: About Us / Our Story
 */

get_header();
?>

<!-- ============================================================
     ABOUT HERO SECTION
     ============================================================ -->
<section class="page-hero" style="padding:160px 80px 80px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);text-align:center;">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Our Story</p>
  <h1 style="font-size:clamp(2.5rem, 4.5vw, 4rem);margin-bottom:20px;">Rooted in <em>Jaipur</em>, growing happiness.</h1>
  <p style="font-size:1.1rem;max-width:640px;margin:0 auto 32px;color:#5c4436;line-height:1.7;">
    From a small local nursery in Jaipur to an all-in-one organic gardening hub — we are on a mission to bring fresh seedlings, heirloom seeds, and green living into every home.
  </p>
  <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
    <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>" class="btn-primary" style="padding:14px 32px;">Explore Our Shop ➔</a>
    <a href="<?php echo esc_url(gbh_get_page_url('contact-us')); ?>" class="btn-ghost" style="padding:14px 24px;">Visit Our Nursery</a>
  </div>
</section>

<!-- ============================================================
     STORY CARDS (SLEEK 3-COLUMN LAYOUT)
     ============================================================ -->
<section style="padding:60px 80px 80px;">
  <div style="text-align:center;margin-bottom:56px;">
    <p class="section-label">Our Heritage & Mission</p>
    <h2 class="section-title">The story behind Garden Basket Hub</h2>
  </div>

  <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:32px;" class="about-story-cards">
    <div style="background:var(--white);padding:40px 32px;border-radius:10px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 8px 24px rgba(44,26,14,0.04);transition:transform 0.3s;">
      <div style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--clay);margin-bottom:12px;">01 · Origins</div>
      <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:16px;">Born in Jaipur</h3>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;margin-bottom:12px;">
        What started as a home garden experiment in Jaipur grew into an organic nursery dedicated to helping urban growers cultivate fresh, chemical-free food right on their balconies and terraces.
      </p>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;">
        We make home gardening accessible, straightforward, and deeply satisfying for growers at every level.
      </p>
    </div>

    <div style="background:var(--sand);padding:40px 32px;border-radius:10px;border:1px solid rgba(44,26,14,0.1);box-shadow:0 8px 24px rgba(44,26,14,0.04);transition:transform 0.3s;">
      <div style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--leaf);margin-bottom:12px;">02 · Standards</div>
      <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:16px;">100% Organic Sourcing</h3>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;margin-bottom:12px;">
        Every seed variety is tested for high germination rates. Our saplings are raised in pure organic vermicompost without synthetic chemical sprays or growth stimulants.
      </p>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;">
        Local Jaipur orders are delivered same-day in protective sleeves so live plants arrive fresh and vibrant.
      </p>
    </div>

    <div style="background:var(--white);padding:40px 32px;border-radius:10px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 8px 24px rgba(44,26,14,0.04);transition:transform 0.3s;">
      <div style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--clay);margin-bottom:12px;">03 · Community</div>
      <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:16px;">Local Artisans & Support</h3>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;margin-bottom:12px;">
        Our terracotta pots are hand-thrown by traditional potters in Rajasthan, supporting local crafts and sustainable pottery traditions.
      </p>
      <p style="color:#5c4436;line-height:1.7;font-size:0.95rem;">
        Plus, our WhatsApp Plant Doctor team provides ongoing care advice so your garden stays healthy all year long.
      </p>
    </div>
  </div>
</section>


<!-- ============================================================
     VALUES FEATURE CARDS
     ============================================================ -->
<section style="background:var(--sand);padding:80px;">
  <div style="text-align:center;margin-bottom:56px;">
    <p class="section-label">Why growers trust us</p>
    <h2 class="section-title">The Garden Basket Hub Promise</h2>
  </div>

  <div style="display:grid;grid-template-columns:repeat(4, 1fr);gap:24px;" class="about-values-grid">
    <div style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
      <div style="font-size:2.8rem;margin-bottom:16px;">🌱</div>
      <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">Pesticide-Free</h3>
      <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">All saplings and seeds are grown using natural neem oil and organic compost.</p>
    </div>

    <div style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
      <div style="font-size:2.8rem;margin-bottom:16px;">🚚</div>
      <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">Same-Day Jaipur</h3>
      <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Fresh seedlings arrive hydrated on the exact day you order within Jaipur.</p>
    </div>

    <div style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
      <div style="font-size:2.8rem;margin-bottom:16px;">💬</div>
      <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">WhatsApp Support</h3>
      <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Get direct guidance from our nursery experts on soil mixing, watering, and care.</p>
    </div>

    <div style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
      <div style="font-size:2.8rem;margin-bottom:16px;">🏺</div>
      <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">Artisan Pottery</h3>
      <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Eco-friendly terracotta and clay pots hand-crafted by Rajasthan artisans.</p>
    </div>
  </div>
</section>

<!-- ============================================================
     STATS STRIP
     ============================================================ -->
<section style="padding:60px 80px;">
  <div class="stats-strip" style="display:grid;grid-template-columns:repeat(4, 1fr);gap:32px;background:var(--soil);color:var(--sand);padding:48px 32px;border-radius:8px;text-align:center;">
    <div class="stat">
      <div class="stat-num" style="font-family:var(--f-display);font-size:2.5rem;color:var(--sprout);margin-bottom:4px;">5,000+</div>
      <div class="stat-label" style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(240,230,211,0.7);">Happy Gardeners</div>
    </div>
    <div class="stat">
      <div class="stat-num" style="font-family:var(--f-display);font-size:2.5rem;color:var(--sprout);margin-bottom:4px;">120+</div>
      <div class="stat-label" style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(240,230,211,0.7);">Organic Seed Varieties</div>
    </div>
    <div class="stat">
      <div class="stat-num" style="font-family:var(--f-display);font-size:2.5rem;color:var(--sprout);margin-bottom:4px;">60+</div>
      <div class="stat-label" style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(240,230,211,0.7);">Fresh Seedling Packs</div>
    </div>
    <div class="stat">
      <div class="stat-num" style="font-family:var(--f-display);font-size:2.5rem;color:var(--sprout);margin-bottom:4px;">Same-Day</div>
      <div class="stat-label" style="font-family:var(--f-mono);font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(240,230,211,0.7);">Jaipur Delivery</div>
    </div>
  </div>
</section>

<!-- ============================================================
     CALL TO ACTION BANNER
     ============================================================ -->
<section style="padding:0 80px 100px;text-align:center;">
  <div style="background:var(--sand);padding:64px;border-radius:12px;border:1px solid rgba(44,26,14,0.1);">
    <h2 style="font-family:var(--f-display);font-size:2.4rem;color:var(--soil);margin-bottom:16px;">Ready to start your home garden?</h2>
    <p style="font-size:1.05rem;color:#5c4436;max-width:540px;margin:0 auto 32px;">Browse our monsoon seeds and fresh seedling trays delivered directly from our Jaipur nursery.</p>
    <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>" class="btn-primary" style="padding:16px 36px;font-size:1rem;">Shop Garden Essentials ➔</a>
  </div>
</section>

<?php get_footer(); ?>