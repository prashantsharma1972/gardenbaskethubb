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
     HOMEPAGE HERO SECTION
     ============================================================ -->
    <section class="hero-section page-hero home-hero">
      <div class="container">
        <p class="section-label">🌿 Rooted in Jaipur · Same-Day Delivery</p>
        <h1 class="hero-title">Growing happiness, <em>one seed</em> at a time.</h1>
        <p class="hero-desc">
          Fresh pesticide-free seedlings, heirloom organic seeds, nutrient-rich vermicompost, and essential gardening
          tools
          delivered directly to your doorstep.
        </p>
        <div class="hero-actions">
          <a href="/shop/" class="btn-primary">
            Explore Shop ➔
          </a>
          <a href="/about-us/" class="btn-ghost">
            Read Our Story
          </a>
        </div>
      </div>
    </section>

    <!-- ============================================================
     FEATURED CATEGORIES
     ============================================================ -->
    <section class="platform-services">
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
            <h3 class="cat-title">Seedlings</h3>
            <span class="cat-meta">Jaipur Only</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🪴</div>
            <h3 class="cat-title">Compost & Soil</h3>
            <span class="cat-meta">100% Organic</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🛠️</div>
            <h3 class="cat-title">Tools</h3>
            <span class="cat-meta">Durable Kits</span>
          </a>

          <a href="/shop/" class="cat-card">
            <div class="cat-icon">🌸</div>
            <h3 class="cat-title">Pots & Planters</h3>
            <span class="cat-meta">Terracotta & Plastic</span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============================================================
     FEATURED PRODUCTS CATALOG
     ============================================================ -->
    <section class="experience section-sand">
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
            'post_type' => 'product',
            'posts_per_page' => 6,
          ));

          if ($home_products->have_posts()):
            while ($home_products->have_posts()):
              $home_products->the_post();
              $hp_id = get_the_ID();
              $hp_price = get_field('product_price');
              $hp_offer = get_field('product_offer_price');
              $hp_badge = get_field('discount_label');
              $hp_thumb = get_the_post_thumbnail_url($hp_id, 'gbh-card');
              if (!$hp_thumb)
                $hp_thumb = get_field('product_image');
              ?>
              <div class="product-card" data-product-id="<?php echo esc_attr($hp_id); ?>">
                <div class="product-img">
                  <?php if ($hp_thumb): ?>
                    <img src="<?php echo esc_url($hp_thumb); ?>" alt="<?php the_title(); ?>">
                  <?php else: ?>
                    🌱
                  <?php endif; ?>

                  <?php if ($hp_badge): ?>
                    <span class="badge-hot"><?php echo esc_html($hp_badge); ?></span>
                  <?php else: ?>
                    <span class="badge-jaipur">Jaipur Nursery</span>
                  <?php endif; ?>
                </div>

                <div class="product-body">
                  <div class="product-category">Garden Essential</div>
                  <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <div class="product-desc"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>
                  <div class="product-footer">
                    <div class="product-price">
                      <?php if ($hp_offer): ?>
                        ₹<?php echo esc_html($hp_offer); ?>
                        <?php if ($hp_price): ?><small style="text-decoration: line-through;">₹<?php echo esc_html($hp_price); ?></small><?php endif; ?>
                      <?php else: ?>
                        ₹<?php echo esc_html($hp_price ? $hp_price : '199'); ?>
                      <?php endif; ?>
                    </div>
                    <button class="add-btn" data-product-id="<?php echo esc_attr($hp_id); ?>">Add to bag</button>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>

          <?php else: ?>
            <!-- Static Demo Cards if DB empty -->
            <div class="product-card">
              <div class="product-img">🌱 <span class="badge-jaipur">Jaipur Only</span></div>
              <div class="product-body">
                <div class="product-category">Seedlings</div>
                <div class="product-name"><a href="/shop/">Tomato Seedling Tray</a>
                </div>
                <div class="product-desc">6 healthy seedlings, 3 weeks old. Same-day delivery in Jaipur.</div>
                <div class="product-footer">
                  <div class="product-price">₹199</div><button class="add-btn">Add to bag</button>
                </div>
              </div>
            </div>

            <div class="product-card">
              <div class="product-img">🌿 <span class="badge-new">New</span></div>
              <div class="product-body">
                <div class="product-category">Seeds</div>
                <div class="product-name"><a href="/shop/">Monsoon Veg Seed Kit</a>
                </div>
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
                <div class="product-name"><a href="/shop/">Organic Vermicompost
                    5kg</a>
                </div>
                <div class="product-desc">Premium quality, ideal for terrace & balcony gardens.</div>
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
     GARDENING REELS TEASER
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
          <div class="reel-card r1">
            <div class="play">▶️</div>
            <div class="meta">
              <h4>Monsoon gardening tips</h4><span>2.4K views</span>
            </div>
          </div>
          <div class="reel-card r2">
            <div class="play">▶️</div>
            <div class="meta">
              <h4>How to repot your plant</h4><span>3.1K views</span>
            </div>
          </div>
          <div class="reel-card r3">
            <div class="play">▶️</div>
            <div class="meta">
              <h4>Terracotta pots from Jaipur</h4><span>1.8K views</span>
            </div>
          </div>
          <div class="reel-card r4">
            <div class="play">▶️</div>
            <div class="meta">
              <h4>Seed saving 101</h4><span>5.2K views</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
     NEW SECTION 1: WHY JAIPUR GARDENERS TRUST US
     ============================================================ -->
    <section class="experience section-sand">
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
     NEW SECTION 2: JAIPUR SEASONAL PLANTING CALENDAR
     ============================================================ -->
    <section class="platform-services">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">Grow With The Seasons</p>
            <h2 class="section-title">Jaipur Sowing & Planting Calendar</h2>
          </div>
          <a href="/shop/" class="btn-ghost">Shop Seasonal Seeds ➔</a>
        </div>

        <div class="about-story-cards">
          <div class="story-card card-monsoon">
            <span class="story-meta">July – September</span>
            <h3 class="story-title">🌧️ Monsoon Sowing</h3>
            <p class="story-desc">
              High humidity makes monsoon ideal for germinating heavy yield veggies: Tomatoes, Okra, Ridge Gourd, Bitter
              Gourd & Marigold saplings.
            </p>
            <a href="/shop/" class="story-link">Browse Monsoon Seeds ➔</a>
          </div>

          <div class="story-card card-winter">
            <span class="story-meta">October – February</span>
            <h3 class="story-title">❄️ Winter Veggies</h3>
            <p class="story-desc">
              Cool Jaipur winters produce crisp leafy greens: Spinach, Carrots, Radish, Methi, Lettuce, Broccoli &
              colorful
              Petunias.
            </p>
            <a href="/shop/" class="story-link">Browse Winter Seeds ➔</a>
          </div>

          <div class="story-card card-summer">
            <span class="story-meta">March – June</span>
            <h3 class="story-title">☀️ Summer Harvest</h3>
            <p class="story-desc">
              Heat-tolerant summer crops that love full sun: Mint, Cucumber, Watermelon, Zucchini, Gourds & shade-loving
              house plants.
            </p>
            <a href="/shop/" class="story-link">Browse Summer Supplies ➔</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================
     NEW SECTION 3: FEATURED TOP 3 GARDENING BLOGS
     ============================================================ -->
    <section class="staff-augmentation section-sand">
      <div class="container">
        <div class="section-header">
          <div>
            <p class="section-label">From Our Gardening Journal</p>
            <h2 class="section-title">Featured Gardening Guides & Tips</h2>
          </div>
          <a href="/blog/" class="btn-ghost">View All Guides ➔</a>
        </div>

        <div class="about-story-cards">
          <?php
          $featured_blogs = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
          ));

          if ($featured_blogs->have_posts()):
            while ($featured_blogs->have_posts()):
              $featured_blogs->the_post();
              $fb_id = get_the_ID();
              $fb_read_time = get_post_meta($fb_id, 'read_time', true);
              if (!$fb_read_time && function_exists('get_field'))
                $fb_read_time = get_field('read_time', $fb_id);
              if (!$fb_read_time)
                $fb_read_time = '5 min read';
              $fb_thumb = get_the_post_thumbnail_url($fb_id, 'medium');
              ?>
              <div class="product-card featured-blog-card" data-permalink="<?php the_permalink(); ?>">
                <div>
                  <div class="blog-meta-header">
                    <span><?php echo get_the_date('M j, Y'); ?></span>
                    <span>⏱️ <?php echo esc_html($fb_read_time); ?></span>
                  </div>
                  <h3 class="blog-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>
                  <p class="blog-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?>
                  </p>
                </div>
                <div>
                  <a href="<?php the_permalink(); ?>" class="btn-ghost btn-ghost-small">
                    Read Guide ➔
                  </a>
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