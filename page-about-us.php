<?php
/**
 * Garden Basket Hub — About Us Page (Professional Redesign)
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/aboutUs/aboutUs.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/aboutUs/aboutUs.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/aboutUs/aboutUs.bundle.js"></script>
  <?php get_header(); ?>
  <main>

    <!-- ============================================================
     HERO
     ============================================================ -->
    <section class="page-hero about-hero">
        <p class="breadcrumb"><a href="/">Home</a> · Our Story</p>
        <h1>Rooted in <em>Jaipur</em>,<br>growing happiness since 2019.</h1>
        <p class="hero-sub">Founded in 2019 — fresh saplings, heirloom non-GMO seeds, organic boosters &amp; a love for the gardening community.</p>
        <div class="hero-actions">
            <a href="/shop/" class="btn-primary">Explore Our Shop ➔</a>
            <a href="/contact-us/" class="btn-ghost">Talk to Us</a>
        </div>
    </section>

    <!-- ============================================================
     STATS BAR
     ============================================================ -->
    <section class="stats-bar-section">
        <div class="container">
            <div class="stats-bar">
                <div class="stat-item">
                    <span class="stat-n">5,000+</span>
                    <span class="stat-l">Happy Gardeners</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-n">120+</span>
                    <span class="stat-l">Seed Varieties</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-n">60+</span>
                    <span class="stat-l">Live Saplings</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-n">Same-Day</span>
                    <span class="stat-l">Jaipur Delivery</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
     CR §10: AUTHENTIC SHOP PHOTO COLLAGE & STORY
     ============================================================ -->
    <section class="about-shop-collage-section">
        <div class="container">
            <div class="shop-collage-grid">
                <!-- Visual Collage Column -->
                <div class="collage-visuals">
                    <div class="collage-badge-floating">
                        <span>📍 Est. 2019 in Jaipur</span>
                    </div>
                    <div class="collage-main-frame">
                        <img src="/wp-content/uploads/2026/10/our-story-jaipur-shop-front.webp" 
                             alt="Garden Basket Shop Storefront in Jaipur" 
                             class="collage-img-main" loading="lazy">
                        <div class="collage-caption">
                            <span>🏡 Our Jaipur Nursery &amp; Shopfront</span>
                        </div>
                    </div>
                    <div class="collage-sub-frames">
                        <div class="sub-frame frame-entrance">
                            <img src="/wp-content/uploads/2026/10/our-story-jaipur-shop-entrance.webp" 
                                 alt="Garden Basket Shop Entrance" loading="lazy">
                            <span class="sub-caption">Shop Entrance</span>
                        </div>
                        <div class="sub-frame frame-saplings">
                            <img src="/wp-content/uploads/2026/10/our-story-fresh-saplings-rack.webp" 
                                 alt="Fresh Saplings Nursery Rack" loading="lazy">
                            <span class="sub-caption">Fresh Jaipur Saplings</span>
                        </div>
                    </div>
                </div>

                <!-- Story Narrative Column -->
                <div class="collage-story-content">
                    <p class="section-label">Real Local Roots</p>
                    <h2 class="section-title">Step into our Jaipur nursery shop</h2>
                    <p class="collage-lead">
                        <strong>Garden Basket started in 2019</strong> with a simple mission: bringing authentic, thriving green life into urban Jaipur homes and balconies.
                    </p>
                    <p class="collage-text">
                        What you see on our website comes directly from our physical nursery racks. Every potted sapling is hand-tended under Jaipur's natural sunlight, and every heirloom seed batch is personally germ-tested by our local team before dispatch.
                    </p>
                    
                    <div class="collage-features">
                        <div class="c-feat">
                            <span class="c-feat-ic">🏡</span>
                            <div>
                                <strong>Physical Store in Jaipur</strong>
                                <span>Visit us in person or order same-day hand delivery</span>
                            </div>
                        </div>
                        <div class="c-feat">
                            <span class="c-feat-ic">🌿</span>
                            <div>
                                <strong>No Warehouses, Direct Plants</strong>
                                <span>100% healthy living roots nurtured since 2019</span>
                            </div>
                        </div>
                    </div>

                    <div class="collage-cta-box">
                        <a href="https://maps.app.goo.gl/PNbyJo98EydJKEWw7?g_st=ic" target="_blank" rel="noopener noreferrer" class="btn-primary">
                            📍 Locate Our Shop on Google Maps ➔
                        </a>
                        <a href="https://wa.me/919414216343?text=Hi%20Garden%20Basket%20Hub!%20I%20would%20like%20to%20visit%20your%20Jaipur%20shop" target="_blank" rel="noopener noreferrer" class="btn-ghost">
                            💬 WhatsApp the Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
     OUR STORY — Compact Timeline
     ============================================================ -->
    <section class="about-story-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <p class="section-label">How it began</p>
                    <h2 class="section-title">The Garden Basket Hub story</h2>
                </div>
            </div>

            <div class="story-timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">🌱</div>
                    <div class="timeline-body">
                        <h3>Started in 2019 — Local Roots, Big Green Dreams</h3>
                        <p>Founded in 2019 in Jaipur, what began as hand-raising saplings and providing quality seeds to neighbours has grown into Garden Basket Hub — a dedicated shop delivering guaranteed freshness, heirloom seeds, and garden supplies to passionate growers in Jaipur and across India.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon">🌿</div>
                    <div class="timeline-body">
                        <h3>We only sell what we grow</h3>
                        <p>Every seed packet, seedling, and tool is something we've tested in our own gardens. No untested products, no cheap imports — just what works in Indian soil.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon">🤝</div>
                    <div class="timeline-body">
                        <h3>Built for the community</h3>
                        <p>Our compost is sourced from local Jaipur farms. Our pots are made by Rajasthani artisans. Our delivery partners are local riders. Buying from us supports an entire ecosystem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
     VALUES GRID — Why GBH
     ============================================================ -->
    <section class="about-values-section section-sand">
        <div class="container">
            <div class="section-header">
                <div>
                    <p class="section-label">What sets us apart</p>
                    <h2 class="section-title">Why Jaipur gardeners choose us</h2>
                </div>
            </div>

            <div class="values-row">
                <div class="value-tile">
                    <div class="value-tile-icon">🚚</div>
                    <div class="value-tile-body">
                        <h4>Same-Day Delivery</h4>
                        <p>Fresh saplings delivered within hours across Jaipur in protective sleeves — not left in a warehouse for days.</p>
                    </div>
                </div>
                <div class="value-tile">
                    <div class="value-tile-icon">🌿</div>
                    <div class="value-tile-body">
                        <h4>100% Organic</h4>
                        <p>Enriched with local Jaipur vermicompost and neem. Zero chemical pesticides — ever.</p>
                    </div>
                </div>
                <div class="value-tile">
                    <div class="value-tile-icon">💬</div>
                    <div class="value-tile-body">
                        <h4>WhatsApp Plant Doctor</h4>
                        <p>Free plant care advice from our nursery team, 8AM–8PM, 7 days a week. Just send a photo.</p>
                    </div>
                </div>
                <div class="value-tile">
                    <div class="value-tile-icon">🏺</div>
                    <div class="value-tile-body">
                        <h4>Handcrafted Pots</h4>
                        <p>Authentic terracotta clay pots crafted by traditional Rajasthan potters — not factory-made plastic.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
     FAQ ACCORDION — Pure CSS Checkbox Hack, Left-Aligned
     ============================================================ -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <p class="section-label">Got questions?</p>
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-sub-desc">Everything about orders, delivery, seeds &amp; plant care from our Jaipur nursery.</p>
                </div>
            </div>

            <div class="faq-list">

                <div class="faq-item">
                    <input type="checkbox" id="faq-1" class="faq-toggle" hidden>
                    <label for="faq-1" class="faq-question">
                        <span>Do you deliver outside Jaipur?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>Yes! We offer <strong>same-day delivery within Jaipur</strong> (302xxx pincodes). Seeds, soil, tools &amp; pots ship pan-India via courier in 3–5 business days. Live seedlings are currently Jaipur-only.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-2" class="faq-toggle" hidden>
                    <label for="faq-2" class="faq-question">
                        <span>How do I check same-day delivery availability?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>Enter your pincode in the <strong>"Check Delivery"</strong> field on any product page. Orders before 12PM are typically delivered the same evening in Jaipur.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-3" class="faq-toggle" hidden>
                    <label for="faq-3" class="faq-question">
                        <span>Are your seeds 100% organic and non-GMO?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>Absolutely. All heirloom seed varieties are <strong>100% open-pollinated, non-hybrid, and non-GMO</strong>. Tested for 85%+ germination in Rajasthan climate. No synthetic coatings or treatments.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-4" class="faq-toggle" hidden>
                    <label for="faq-4" class="faq-question">
                        <span>What if my plants arrive damaged?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>We pack seedlings in specialized protective sleeves. If a sapling arrives wilted, <strong>WhatsApp us a photo within 24 hours</strong> and we'll send a free replacement — our Live Plant Guarantee.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-5" class="faq-toggle" hidden>
                    <label for="faq-5" class="faq-question">
                        <span>What payment methods do you accept?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>All major online payment options including UPI (Google Pay, PhonePe, Paytm, BHIM), Credit/Debit Cards, and Net Banking — powered securely by Razorpay. All orders are 100% prepaid for prompt packing and dispatch.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-6" class="faq-toggle" hidden>
                    <label for="faq-6" class="faq-question">
                        <span>Can I order in bulk for my society or school?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>Yes! We offer <strong>wholesale/bulk pricing</strong> for housing societies, schools, offices &amp; NGOs. Email <a href="mailto:prashant753@gmail.com" style="color:var(--leaf);font-weight:600;">prashant753@gmail.com</a> or WhatsApp us at +91 9414216343 with your requirements.</p>
                    </div>
                </div>

            </div>

            <div class="faq-cta">
                <a href="/contact-us/" class="btn-primary">Still have questions? Contact us ➔</a>
            </div>
        </div>
    </section>

  </main>
  <?php get_footer(); ?>