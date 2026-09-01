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
        <h1>Rooted in <em>Jaipur</em>,<br>growing happiness.</h1>
        <p class="hero-sub">A family nursery with big dreams — fresh seedlings, heirloom seeds &amp; a love for the community that grows them.</p>
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
                    <span class="stat-l">Live Seedlings</span>
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
                        <h3>A small nursery, big dreams</h3>
                        <p>What began as selling seeds and saplings to neighbours in Jaipur grew into Garden Basket Hub — a full online nursery delivering freshness across the city and India.</p>
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
                        <p>UPI (GPay, PhonePe, Paytm), Credit/Debit Cards, Net Banking — all via Razorpay. <strong>Cash on Delivery (COD)</strong> available for Jaipur orders.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq-6" class="faq-toggle" hidden>
                    <label for="faq-6" class="faq-question">
                        <span>Can I order in bulk for my society or school?</span>
                        <span class="faq-icon">+</span>
                    </label>
                    <div class="faq-answer">
                        <p>Yes! We offer <strong>wholesale/bulk pricing</strong> for housing societies, schools, offices &amp; NGOs. Email <a href="mailto:hello@gardenbaskethubb.com" style="color:var(--leaf);font-weight:600;">hello@gardenbaskethubb.com</a> or WhatsApp us with your requirements.</p>
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