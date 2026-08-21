<?php
/**
 * Homepage Template — Garden Basket Hub
 */

get_header(); 
?>

  <!-- ============================================================
     HOMEPAGE HERO SECTION
     ============================================================ -->
  <section class="page-hero"
    style="padding: 130px 4vw 60px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);">
    <p class="section-label">🌿 Rooted in Jaipur · Same-Day Delivery</p>
    <h1 style="font-size:clamp(2.8rem, 5vw, 4.5rem);">Growing happiness, <em>one seed</em> at a time.</h1>
    <p style="font-size:1.15rem;max-width:620px;margin:20px auto 36px;">
      Fresh pesticide-free seedlings, heirloom organic seeds, nutrient-rich vermicompost, and essential gardening tools
      delivered directly to your doorstep.
    </p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>" class="btn-primary"
        style="padding:16px 36px;font-size:1rem;">
        Explore Shop ➔
      </a>
      <a href="<?php echo esc_url(gbh_get_page_url('about-us')); ?>" class="btn-ghost"
        style="padding:16px 24px;font-size:1rem;">
        Read Our Story
      </a>
    </div>
  </section>

  <!-- ============================================================
     FEATURED CATEGORIES
     ============================================================ -->
  <section style="padding:60px 80px 80px;">
    <p class="section-label">Browse by category</p>
    <h2 class="section-title">Everything for your home garden</h2>

    <div style="display:grid;grid-template-columns:repeat(5, 1fr);gap:20px;margin-top:40px;" class="cat-grid-wrapper">
      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
        style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
        <div style="font-size:3.5rem;margin-bottom:12px;">🌱</div>
        <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Seeds</h3>
        <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">120+
          Varieties</span>
      </a>

      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
        style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
        <div style="font-size:3.5rem;margin-bottom:12px;">🌿</div>
        <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Seedlings</h3>
        <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Jaipur
          Only</span>
      </a>

      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
        style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
        <div style="font-size:3.5rem;margin-bottom:12px;">🪴</div>
        <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Compost & Soil</h3>
        <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">100%
          Organic</span>
      </a>

      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
        style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
        <div style="font-size:3.5rem;margin-bottom:12px;">🛠️</div>
        <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Tools</h3>
        <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Durable
          Kits</span>
      </a>

      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
        style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
        <div style="font-size:3.5rem;margin-bottom:12px;">🌸</div>
        <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Pots & Planters</h3>
        <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Terracotta
          &
          Plastic</span>
      </a>
    </div>
  </section>

  <!-- ============================================================
     FEATURED PRODUCTS CATALOG
     ============================================================ -->
  <section style="background:var(--sand);">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:40px;">
      <div>
        <p class="section-label">Handpicked favorites</p>
        <h2 class="section-title">Best Sellers This Season</h2>
      </div>
      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>" class="btn-ghost">View All Products ➔</a>
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
                    <?php if ($hp_price): ?><del>₹<?php echo esc_html($hp_price); ?></del><?php endif; ?>
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
            <div class="product-name"><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Tomato Seedling Tray</a>
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
            <div class="product-name"><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Monsoon Veg Seed Kit</a>
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
            <div class="product-name"><a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>">Organic Vermicompost
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
  </section>

  <!-- ============================================================
     GARDENING REELS TEASER
     ============================================================ -->
  <section>
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:40px;">
      <div>
        <p class="section-label">Quick Video Guides</p>
        <h2 class="section-title">Learn as you grow</h2>
      </div>
      <a href="<?php echo esc_url(gbh_get_page_url('reels')); ?>" class="btn-ghost">Watch All Reels ➔</a>
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
  </section>

  <!-- ============================================================
     NEW SECTION 1: WHY JAIPUR GARDENERS TRUST US
     ============================================================ -->
  <section style="background:var(--sand);padding:80px;">
    <div style="text-align:center;margin-bottom:48px;">
      <p class="section-label">Jaipur Nursery Standards</p>
      <h2 class="section-title">Why local growers choose Garden Basket Hub</h2>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4, 1fr);gap:24px;" class="about-values-grid">
      <div
        style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
        <div style="font-size:2.8rem;margin-bottom:16px;">🚚</div>
        <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">Same-Day
          Delivery</h3>
        <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Fresh saplings delivered within hours across Jaipur
          in protective sleeves.</p>
      </div>

      <div
        style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
        <div style="font-size:2.8rem;margin-bottom:16px;">🌿</div>
        <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">100% Organic
          Soil</h3>
        <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Enriched with local Jaipur vermicompost and neem —
          zero chemical pesticides.</p>
      </div>

      <div
        style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
        <div style="font-size:2.8rem;margin-bottom:16px;">💬</div>
        <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">WhatsApp Doctor
        </h3>
        <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Free plant care advice from our nursery gardeners
          whenever you need help.</p>
      </div>

      <div
        style="background:var(--white);padding:32px 24px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);">
        <div style="font-size:2.8rem;margin-bottom:16px;">🏺</div>
        <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;">Handcrafted Pots
        </h3>
        <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;">Authentic terracotta clay pots crafted by traditional
          Rajasthan potters.</p>
      </div>
    </div>
  </section>

  <!-- ============================================================
     NEW SECTION 2: JAIPUR SEASONAL PLANTING CALENDAR
     ============================================================ -->
  <section style="padding:80px;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;">
      <div>
        <p class="section-label">Grow With The Seasons</p>
        <h2 class="section-title">Jaipur Sowing & Planting Calendar</h2>
      </div>
      <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>" class="btn-ghost">Shop Seasonal Seeds ➔</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:28px;" class="about-story-cards">
      <div style="background:#EBF5E9;padding:36px 28px;border-radius:10px;border:1px solid rgba(58,107,53,0.15);">
        <span
          style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--leaf);display:block;margin-bottom:10px;">July
          – September</span>
        <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:12px;">🌧️ Monsoon
          Sowing</h3>
        <p style="font-size:0.92rem;color:#4a5d48;line-height:1.6;margin-bottom:16px;">
          High humidity makes monsoon ideal for germinating heavy yield veggies: Tomatoes, Okra, Ridge Gourd, Bitter
          Gourd & Marigold saplings.
        </p>
        <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
          style="font-family:var(--f-body);font-size:0.85rem;font-weight:500;color:var(--leaf);text-decoration:none;">Browse
          Monsoon Seeds ➔</a>
      </div>

      <div style="background:#FDF7ED;padding:36px 28px;border-radius:10px;border:1px solid rgba(232,148,42,0.2);">
        <span
          style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--marigold);display:block;margin-bottom:10px;">October
          – February</span>
        <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:12px;">❄️ Winter
          Veggies</h3>
        <p style="font-size:0.92rem;color:#6b5239;line-height:1.6;margin-bottom:16px;">
          Cool Jaipur winters produce crisp leafy greens: Spinach, Carrots, Radish, Methi, Lettuce, Broccoli & colorful
          Petunias.
        </p>
        <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
          style="font-family:var(--f-body);font-size:0.85rem;font-weight:500;color:var(--marigold);text-decoration:none;">Browse
          Winter Seeds ➔</a>
      </div>

      <div style="background:var(--sand);padding:36px 28px;border-radius:10px;border:1px solid rgba(44,26,14,0.1);">
        <span
          style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--clay);display:block;margin-bottom:10px;">March
          – June</span>
        <h3 style="font-family:var(--f-display);font-size:1.4rem;color:var(--soil);margin-bottom:12px;">☀️ Summer
          Harvest</h3>
        <p style="font-size:0.92rem;color:#5c4436;line-height:1.6;margin-bottom:16px;">
          Heat-tolerant summer crops that love full sun: Mint, Cucumber, Watermelon, Zucchini, Gourds & shade-loving
          house plants.
        </p>
        <a href="<?php echo esc_url(gbh_get_page_url('shop')); ?>"
          style="font-family:var(--f-body);font-size:0.85rem;font-weight:500;color:var(--clay);text-decoration:none;">Browse
          Summer Supplies ➔</a>
      </div>
    </div>
  </section>

  <!-- ============================================================
     NEW SECTION 3: FEATURED TOP 3 GARDENING BLOGS
     ============================================================ -->
  <section style="background:var(--sand);padding:80px;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;">
      <div>
        <p class="section-label">From Our Gardening Journal</p>
        <h2 class="section-title">Featured Gardening Guides & Tips</h2>
      </div>
      <a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>" class="btn-ghost">View All Guides ➔</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:28px;" class="about-story-cards">
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
          <div
            style="background:var(--white);padding:28px;border-radius:10px;border:1px solid rgba(44,26,14,0.08);box-shadow:0 4px 16px rgba(0,0,0,0.02);cursor:pointer;display:flex;flex-direction:column;justify-content:space-between;"
            class="product-card" data-permalink="<?php the_permalink(); ?>">
            <div>
              <div
                style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:10px;display:flex;justify-content:space-between;">
                <span><?php echo get_the_date('M j, Y'); ?></span>
                <span>⏱️ <?php echo esc_html($fb_read_time); ?></span>
              </div>
              <h3
                style="font-family:var(--f-display);font-size:1.25rem;color:var(--soil);margin-bottom:12px;line-height:1.3;">
                <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
              </h3>
              <p style="font-size:0.9rem;color:#7a6050;line-height:1.6;margin-bottom:20px;">
                <?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?>
              </p>
            </div>
            <div>
              <a href="<?php the_permalink(); ?>" class="btn-ghost"
                style="font-size:0.85rem;color:var(--leaf);font-weight:500;">
                Read Guide ➔
              </a>
            </div>
          </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </section>

  <?php get_footer(); ?>