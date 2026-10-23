<?php
/**
 * Garden Basket Hub — Homepage Front Page Template
 * Dynamic: Products (6 recent), Reels (4 recent), Blogs (3 recent)
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/frontPage/frontPage.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/frontPage/frontPage.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/frontPage/frontPage.bundle.js"></script>
  <?php get_header(); ?>
  <main>

    <!-- ============================================================
     HOMEPAGE HERO SECTION (CR §4.1)
     ============================================================ -->
    <section class="page-hero home-hero" style="background-image: url('/wp-content/uploads/2026/10/hero-gardening-sunflowers-bg.webp');">
      <p class="breadcrumb">🌿 Rooted in Jaipur Since 2019 · Same-Day Delivery</p>
      <h1>Growing happiness, <em>one seed</em> at a time.</h1>
      <p>
        Fresh pesticide-free saplings, heirloom organic seeds, nutrient-rich vermicompost, and essential gardening
        tools delivered directly to your doorstep.
      </p>
      <div class="hero-actions" style="margin-top:24px;display:flex;gap:12px;justify-content:center;">
        <a href="/shop/" class="btn-primary">
          Explore Shop ➔
        </a>
        <a href="/about-us/" class="btn-ghost">
          Read Our Story
        </a>
      </div>
    </section>

    <!-- ============================================================
     FEATURED CATEGORIES (CR §4.2)
     ============================================================ -->
    <section class="platform-services home-categories-section" style="background-image: url('/wp-content/uploads/2026/10/section-climbing-ivy-vine-bg.webp');">
      <div class="container">
        <p class="section-label">Browse by category</p>
        <h2 class="section-title">Everything for your home garden</h2>

        <div class="cat-grid-wrapper">
          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🌱</div>
            <h3 class="cat-title">Seeds</h3>
            <span class="cat-meta">120+ Varieties</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🌿</div>
            <h3 class="cat-title">Saplings</h3>
            <span class="cat-meta">Jaipur Only</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🪴</div>
            <h3 class="cat-title">Compost &amp; Soil</h3>
            <span class="cat-meta">100% Organic</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🛠️</div>
            <h3 class="cat-title">Tools</h3>
            <span class="cat-meta">Durable Kits</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🌸</div>
            <h3 class="cat-title">Pots &amp; Planters</h3>
            <span class="cat-meta">Terracotta &amp; Plastic</span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============================================================
     FEATURED PRODUCTS — DYNAMIC FROM WORDPRESS CPT (6 Recent) (CR §4.2)
     ============================================================ -->
    <section class="experience section-sand home-bestsellers-section" style="background-image: url('/wp-content/uploads/2026/10/section-potted-plants-balcony-bg.webp');">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">Handpicked favorites</p>
            <h2 class="section-title">Best Sellers This Season</h2>
          </div>
          <a href="/shop/" class="btn-ghost">View All Products ➔</a>
        </div>

        <div class="product-grid">
          <?php
          $home_products = new WP_Query(array(
            'post_type'      => 'product',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
          ));

          if ($home_products->have_posts()):
            while ($home_products->have_posts()):
              $home_products->the_post();
              $hp_id = get_the_ID();

              // Price with dual fallback (get_post_meta + get_field)
              $hp_price = get_post_meta($hp_id, 'product_price', true);
              if (!$hp_price && function_exists('get_field')) $hp_price = get_field('product_price');

              $hp_offer = get_post_meta($hp_id, 'product_offer_price', true);
              if (!$hp_offer && function_exists('get_field')) $hp_offer = get_field('product_offer_price');

              $hp_badge = get_post_meta($hp_id, 'discount_label', true);
              if (!$hp_badge && function_exists('get_field')) $hp_badge = get_field('discount_label');

              // Thumbnail with fallback
              $hp_thumb = get_the_post_thumbnail_url($hp_id, 'gbh-card');
              if (!$hp_thumb && function_exists('get_field')) $hp_thumb = get_field('product_image');
              if (!$hp_thumb) $hp_thumb = get_post_meta($hp_id, 'product_image', true);

              // Product category taxonomy label
              $hp_terms = get_the_terms($hp_id, 'product_cat');
              $hp_cat = ($hp_terms && !is_wp_error($hp_terms)) ? $hp_terms[0]->name : 'Garden Essential';
              $is_hp_sapling = false;
              if ($hp_terms && !is_wp_error($hp_terms)) {
                  foreach ($hp_terms as $t) {
                      if ($t->slug === 'saplings' || strtolower($t->name) === 'saplings') {
                          $is_hp_sapling = true;
                          break;
                      }
                  }
              }
              ?>
              <div class="product-card" data-product-id="<?php echo esc_attr($hp_id); ?>" data-is-sapling="<?php echo $is_hp_sapling ? '1' : '0'; ?>" data-permalink="<?php the_permalink(); ?>">
                <div class="product-img">
                  <a href="<?php the_permalink(); ?>" style="display:block;width:100%;height:100%;text-decoration:none;color:inherit;">
                    <?php if ($hp_thumb): ?>
                      <img src="<?php echo esc_url($hp_thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php else: ?>
                      <div style="width:100%; height:100%; background:#f4f4f4; display:flex; align-items:center; justify-content:center; font-size:3rem;">🌱</div>
                    <?php endif; ?>
                  </a>

                  <?php if ($hp_badge): ?>
                    <span class="badge-hot"><?php echo esc_html($hp_badge); ?></span>
                  <?php elseif ($is_hp_sapling): ?>
                    <span class="badge-jaipur">Jaipur Only</span>
                  <?php endif; ?>
                </div>

                <div class="product-body">
                  <div class="product-category"><?php echo esc_html($hp_cat); ?></div>
                  <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <div class="product-desc"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></div>
                  <div class="product-footer">
                    <div class="product-price">
                      <?php if ($hp_offer): ?>
                        ₹<?php echo esc_html($hp_offer); ?>
                        <?php if ($hp_price): ?><del>₹<?php echo esc_html($hp_price); ?></del><?php endif; ?>
                      <?php else: ?>
                        ₹<?php echo esc_html($hp_price ? $hp_price : '199'); ?>
                      <?php endif; ?>
                    </div>
                    <button class="add-btn" data-product-id="<?php echo esc_attr($hp_id); ?>" data-is-sapling="<?php echo $is_hp_sapling ? '1' : '0'; ?>">Add to bag</button>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>

          <?php else: ?>
            <!-- Static Demo Cards if DB empty -->
            <div class="product-card" data-is-sapling="1">
              <div class="product-img">🌱 <span class="badge-jaipur">Jaipur Only</span></div>
              <div class="product-body">
                <div class="product-category">Saplings</div>
                <div class="product-name"><a href="/shop/?category=saplings">Tomato Sapling Tray</a></div>
                <div class="product-desc">6 healthy saplings, 3 weeks old. Same-day delivery in Jaipur.</div>
                <div class="product-footer">
                  <div class="product-price">₹199</div><button class="add-btn" data-is-sapling="1">Add to bag</button>
                </div>
              </div>
            </div>

            <div class="product-card">
              <div class="product-img">🌿 <span class="badge-hot">Bestseller</span></div>
              <div class="product-body">
                <div class="product-category">Seeds</div>
                <div class="product-name"><a href="/shop/">Monsoon Veg Seed Kit</a></div>
                <div class="product-desc">8 heirloom varieties, perfect for monsoon planting.</div>
                <div class="product-footer">
                  <div class="product-price">₹349</div><button class="add-btn">Add to bag</button>
                </div>
              </div>
            </div>

            <div class="product-card">
              <div class="product-img">🪴 <span class="badge-hot">Bestseller</span></div>
              <div class="product-body">
                <div class="product-category">Compost</div>
                <div class="product-name"><a href="/shop/">Organic Vermicompost 5kg</a></div>
                <div class="product-desc">Premium quality, ideal for terrace &amp; balcony gardens.</div>
                <div class="product-footer">
                  <div class="product-price">₹299</div><button class="add-btn">Add to bag</button>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- ============================================================
     CR §6: STAR FEATURED PRODUCT — ORGANIC PLANT BOOSTER SHOWCASE
     High-Converting Showcase with Live Quantity Stepper & 1-Click Add
     ============================================================ -->
    <?php
    $booster_post = function_exists('gbh_get_product_by_title')
        ? gbh_get_product_by_title('Garden Basket Organic Plant Booster (500ml)')
        : null;
    $booster_id = $booster_post ? $booster_post->ID : 0;
    if (!$booster_id) {
        $alt_booster_query = new WP_Query(array('post_type' => 'product', 's' => 'Plant Booster', 'posts_per_page' => 1));
        if ($alt_booster_query->have_posts()) {
            $alt_booster_query->the_post();
            $booster_id = get_the_ID();
            wp_reset_postdata();
        }
    }
    $booster_img = $booster_id ? get_the_post_thumbnail_url($booster_id, 'large') : '';
    ?>
    <section class="star-product-section" id="gbh-star-booster" style="background-image: url('/wp-content/uploads/2026/10/section-bougainvillea-floral-bg.webp');">
      <div class="container">
        <div class="star-product-card">
          <div class="star-product-grid">
            
            <!-- Visual Column -->
            <div class="star-product-media">
              <div class="star-badge-glow">⭐ Signature Bestseller</div>
              <div class="star-img-wrapper">
                <div class="star-img-display">
                  <?php if ($booster_img): ?>
                    <img src="<?php echo esc_url($booster_img); ?>" alt="Garden Basket Organic Plant Booster" loading="lazy">
                  <?php else: ?>
                    <span>🌿 🧪 🌸</span>
                  <?php endif; ?>
                </div>
                <div class="star-organic-seal">
                  <span>100%</span>
                  <strong>Organic</strong>
                </div>
              </div>
              <div class="star-media-thumbnails">
                <span class="star-thumb active">🧪 500ml Bio-Elixir</span>
                <span class="star-thumb">🌸 3x Flower Blooms</span>
                <span class="star-thumb">🥬 Veggie Yield Boost</span>
              </div>
            </div>

            <!-- Content & Conversion Column -->
            <div class="star-product-content">
              <div class="star-kicker">
                <span class="star-rating">★★★★★ 4.9/5 (180+ Happy Gardeners)</span>
                <span class="star-tag">Jaipur Formulated</span>
              </div>
              
              <h2 class="star-title">Garden Basket Organic Plant Booster <span class="star-size">(500ml)</span></h2>
              <p class="star-subtitle">All-in-one organic liquid nutrition booster for flowers, veggies, and potted plants.</p>
              
              <p class="star-desc">
                Formulated right in Jaipur, our signature bio-liquid plant booster combines cold-water seaweed kelp, humic acids, and essential micronutrients. Delivers visible greener leaves in 5 days and 3x more vibrant flower blooms.
              </p>

              <!-- 4 Feature Badges -->
              <div class="star-features-grid">
                <div class="star-feat-item">
                  <span class="feat-ic">🌱</span>
                  <div><strong>Root &amp; Shoot Vigor</strong><span>Fast nutrient uptake</span></div>
                </div>
                <div class="star-feat-item">
                  <span class="feat-ic">🌸</span>
                  <div><strong>3x More Blooms</strong><span>Abundant flowering &amp; fruiting</span></div>
                </div>
                <div class="star-feat-item">
                  <span class="feat-ic">🛡️</span>
                  <div><strong>Pest Resilience</strong><span>Boosts natural plant immunity</span></div>
                </div>
                <div class="star-feat-item">
                  <span class="feat-ic">🇮🇳</span>
                  <div><strong>Pan-India Delivery</strong><span>Ships safely across India</span></div>
                </div>
              </div>

              <!-- Pricing Bar -->
              <div class="star-price-box">
                <div class="star-price-wrap">
                  <span class="star-price-curr">₹299</span>
                  <del class="star-price-mrp">₹399</del>
                  <span class="star-save-pill">Save 25% (₹100 OFF)</span>
                </div>
                <div class="star-stock-indicator">🟢 In Stock · Ready for Immediate Dispatch</div>
              </div>

              <!-- Quantity Stepper & Direct 1-Click Add to Bag -->
              <div class="star-action-bar">
                <div class="star-qty-selector">
                  <label>Quantity</label>
                  <div class="qty-stepper star-stepper">
                    <button type="button" class="qty-minus" id="star-qty-minus">−</button>
                    <input type="number" id="star-booster-qty" value="1" min="1" max="50" readonly>
                    <button type="button" class="qty-plus" id="star-qty-plus">+</button>
                  </div>
                </div>

                <div class="star-cta-group">
                  <button type="button" class="btn-primary btn-star-add" id="star-add-to-bag-btn" 
                          data-product-id="<?php echo esc_attr($booster_id); ?>" 
                          data-product-name="Garden Basket Organic Plant Booster (500ml)">
                    🛒 Add to Bag ➔
                  </button>
                  <button type="button" class="btn-secondary btn-star-buy-now" id="star-buy-now-btn"
                          data-product-id="<?php echo esc_attr($booster_id); ?>">
                    ⚡ Buy Now
                  </button>
                </div>
              </div>

              <!-- Trust Footer -->
              <div class="star-trust-strip">
                <span>🚚 Fast Pan-India Shipping</span>
                <span>🌿 100% Non-Chemical Safe</span>
                <span>💬 Free WhatsApp Dosage Guidance</span>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
     GARDENING REELS — DYNAMIC FROM WORDPRESS CPT (4 Recent)
     ============================================================ -->
    <section class="staff-augmentation">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">Quick Video Guides</p>
            <h2 class="section-title">Learn as you grow</h2>
          </div>
          <a href="/reels/" class="btn-ghost">Watch All Reels ➔</a>
        </div>

        <div class="reels-grid">
          <?php
          $home_reels = new WP_Query(array(
            'post_type'      => 'reels',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
          ));

          if ($home_reels->have_posts()):
            $reel_classes = array('r1', 'r2', 'r3', 'r4', 'r5');
            $reel_index   = 0;
            while ($home_reels->have_posts()):
              $home_reels->the_post();
              $hr_id    = get_the_ID();
              $hr_views = get_post_meta($hr_id, 'reel_view_count', true);
              if (!$hr_views && function_exists('get_field')) $hr_views = get_field('reel_view_count');
              if (!$hr_views) $hr_views = get_post_meta($hr_id, 'view_count', true);

              $hr_thumb = get_the_post_thumbnail_url($hr_id, 'gbh-card');
              if (!$hr_thumb && function_exists('get_field')) $hr_thumb = get_field('product_image');

              $hr_class = isset($reel_classes[$reel_index]) ? $reel_classes[$reel_index] : 'r1';
              $reel_index++;
              ?>
              <a href="<?php the_permalink(); ?>" class="reel-card <?php echo esc_attr($hr_class); ?>"
                 style="text-decoration:none; display:flex; flex-direction:column; position:relative;">
                <?php if ($hr_thumb): ?>
                  <img src="<?php echo esc_url($hr_thumb); ?>" alt="<?php the_title_attribute(); ?>"
                       loading="lazy"
                       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:inherit;opacity:0.55;">
                <?php else: ?>
                  <div style="position:absolute;inset:0;width:100%;height:100%;background:#e0e7df;border-radius:inherit;opacity:0.55;"></div>
                <?php endif; ?>
                <div class="play">▶️</div>
                <div class="meta">
                  <h4><?php the_title(); ?></h4>
                  <?php if ($hr_views): ?><span><?php echo esc_html($hr_views); ?></span><?php endif; ?>
                </div>
              </a>
            <?php endwhile;
            wp_reset_postdata(); ?>

          <?php else: ?>
            <!-- Static Fallback Reel Cards if DB empty -->
            <a href="/reels/" class="reel-card r1" style="text-decoration:none; display:flex; flex-direction:column;">
              <div class="play">▶️</div>
              <div class="meta"><h4>Monsoon gardening tips</h4><span>2.4K views</span></div>
            </a>
            <a href="/reels/" class="reel-card r2" style="text-decoration:none; display:flex; flex-direction:column;">
              <div class="play">▶️</div>
              <div class="meta"><h4>How to repot your plant</h4><span>3.1K views</span></div>
            </a>
            <a href="/reels/" class="reel-card r3" style="text-decoration:none; display:flex; flex-direction:column;">
              <div class="play">▶️</div>
              <div class="meta"><h4>Terracotta pots from Jaipur</h4><span>1.8K views</span></div>
            </a>
            <a href="/reels/" class="reel-card r4" style="text-decoration:none; display:flex; flex-direction:column;">
              <div class="play">▶️</div>
              <div class="meta"><h4>Seed saving 101</h4><span>5.2K views</span></div>
            </a>
            <a href="/reels/" class="reel-card r5" style="text-decoration:none; display:flex; flex-direction:column;">
              <div class="play">▶️</div>
              <div class="meta"><h4>Bio-Elixir plant nutrition</h4><span>4.8K views</span></div>
            </a>
          <?php endif; ?>
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
              What you see on our website comes directly from our physical nursery racks. Every potted sapling is hand-tended under Jaipur's natural sunlight, and every heirloom seed batch is personally germ-tested before dispatch.
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
     WHY JAIPUR GARDENERS TRUST US (CR §4.2)
     ============================================================ -->
    <section class="experience section-sand home-trust-section" style="background-image: url('/wp-content/uploads/2026/10/section-white-jasmine-planters-bg.webp');">
      <div class="container">
        <div class="section-header-center">
          <p class="section-label">Jaipur Nursery Standards</p>
          <h2 class="section-title">Why local growers choose Garden Basket Hub</h2>
        </div>

        <div class="about-values-grid">
          <div class="value-card">
            <div class="value-icon">🚚</div>
            <h3 class="value-title">Same-Day Delivery</h3>
            <p class="value-desc">Fresh saplings delivered within hours across Jaipur in protective sleeves.</p>
          </div>

          <div class="value-card">
            <div class="value-icon">🌿</div>
            <h3 class="value-title">100% Organic Soil</h3>
            <p class="value-desc">Enriched with local Jaipur vermicompost and neem — zero chemical pesticides.</p>
          </div>

          <div class="value-card">
            <div class="value-icon">💬</div>
            <h3 class="value-title">WhatsApp Doctor</h3>
            <p class="value-desc">Free plant care advice from our nursery gardeners whenever you need help.</p>
          </div>

          <div class="value-card">
            <div class="value-icon">🏺</div>
            <h3 class="value-title">Handcrafted Pots</h3>
            <p class="value-desc">Authentic terracotta clay pots crafted by traditional Rajasthan potters.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
     JAIPUR SEASONAL PLANTING CALENDAR
     ============================================================ -->
    <section class="platform-services">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">Grow With The Seasons</p>
            <h2 class="section-title">Jaipur Sowing &amp; Planting Calendar</h2>
          </div>
          <a href="/shop/" class="btn-ghost">Shop Seasonal Seeds ➔</a>
        </div>

        <div class="about-story-cards">
          <div class="story-card card-monsoon">
            <span class="story-meta">July – September</span>
            <h3 class="story-title">🌧️ Monsoon Sowing</h3>
            <p class="story-desc">
              High humidity makes monsoon ideal for germinating heavy yield veggies: Tomatoes, Okra, Ridge Gourd, Bitter
              Gourd &amp; Marigold saplings.
            </p>
            <a href="/shop/" class="story-link">Browse Monsoon Seeds ➔</a>
          </div>

          <div class="story-card card-winter">
            <span class="story-meta">October – February</span>
            <h3 class="story-title">❄️ Winter Veggies</h3>
            <p class="story-desc">
              Cool Jaipur winters produce crisp leafy greens: Spinach, Carrots, Radish, Methi, Lettuce, Broccoli &amp;
              colorful Petunias.
            </p>
            <a href="/shop/" class="story-link">Browse Winter Seeds ➔</a>
          </div>

          <div class="story-card card-summer">
            <span class="story-meta">March – June</span>
            <h3 class="story-title">☀️ Summer Harvest</h3>
            <p class="story-desc">
              Heat-tolerant summer crops that love full sun: Mint, Cucumber, Watermelon, Zucchini, Gourds &amp;
              shade-loving house plants.
            </p>
            <a href="/shop/" class="story-link">Browse Summer Supplies ➔</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
     FEATURED TOP 3 GARDENING BLOGS — DYNAMIC FROM WORDPRESS (3 Recent)
     ============================================================ -->
    <section class="staff-augmentation section-sand">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">From Our Gardening Journal</p>
            <h2 class="section-title">Featured Gardening Guides &amp; Tips</h2>
          </div>
          <a href="/blog/" class="btn-ghost">View All Guides ➔</a>
        </div>

        <div class="product-grid blog-grid">
          <?php
          $featured_blogs = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
          ));

          if ($featured_blogs->have_posts()):
            while ($featured_blogs->have_posts()):
              $featured_blogs->the_post();
              $fb_id        = get_the_ID();
              $fb_thumb     = get_the_post_thumbnail_url($fb_id, 'medium');
              if (!$fb_thumb && function_exists('get_field')) $fb_thumb = get_field('banner_image', $fb_id);
              if (!$fb_thumb) $fb_thumb = get_post_meta($fb_id, 'banner_image', true);

              $fb_read_time = get_post_meta($fb_id, 'read_time', true);
              if (!$fb_read_time && function_exists('get_field')) $fb_read_time = get_field('read_time');

              // Blog category
              $fb_cats    = get_the_category($fb_id);
              $fb_cat_name = ($fb_cats && !is_wp_error($fb_cats)) ? $fb_cats[0]->name : '';
              ?>
              <div class="product-card blog-card">
                <div class="product-img blog-thumb">
                  <a href="<?php the_permalink(); ?>" style="display:block;width:100%;height:200px;background:#f4f4f4;border-radius:4px;overflow:hidden;">
                    <?php if ($fb_thumb): ?>
                      <img src="<?php echo esc_url($fb_thumb); ?>" alt="<?php the_title_attribute(); ?>"
                           loading="lazy"
                           style="width:100%; height:100%; object-fit:cover;">
                    <?php endif; ?>
                  </a>
                </div>
                <div class="product-body">
                  <div class="product-category" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                    <span><?php echo get_the_date('M j, Y'); ?></span>
                    <?php if ($fb_cat_name): ?>
                      <span style="background:var(--sprout);color:var(--leaf);padding:2px 8px;border-radius:999px;font-size:0.72rem;font-family:var(--f-mono);text-transform:uppercase;letter-spacing:0.06em;"><?php echo esc_html($fb_cat_name); ?></span>
                    <?php endif; ?>
                    <?php if ($fb_read_time): ?>
                      <span style="font-family:var(--f-mono);font-size:0.72rem;color:var(--clay);">📖 <?php echo esc_html($fb_read_time); ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <div class="product-desc"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></div>
                  <div class="product-footer" style="margin-top:auto; padding-top:16px;">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none; font-weight:500; color:var(--leaf); font-size:0.9rem;">Read Guide ➔</a>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>