<?php
/**
 * Homepage Template — Garden Basket Hub
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/frontPage/frontPage.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/frontPage/frontPage.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/frontPage/frontPage.bundle.js"></script>

    <?php get_header(); ?>

<!-- ============================================================
     HOMEPAGE HERO SECTION
     ============================================================ -->
<section class="page-hero"
  style="padding:180px 80px 100px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);">
  <p class="section-label">🌿 Rooted in Jaipur · Same-Day Delivery</p>
  <h1 style="font-size:clamp(2.8rem, 5vw, 4.5rem);">Growing happiness, <em>one seed</em> at a time.</h1>
  <p style="font-size:1.15rem;max-width:620px;margin:20px auto 36px;">
    Fresh pesticide-free seedlings, heirloom organic seeds, nutrient-rich vermicompost, and essential gardening tools
    delivered directly to your doorstep.
  </p>
  <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-primary" style="padding:16px 36px;font-size:1rem;">
      Explore Shop ➔
    </a>
    <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="btn-ghost"
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
    <a href="<?php echo esc_url(home_url('/shop/')); ?>"
      style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
      <div style="font-size:3.5rem;margin-bottom:12px;">🌱</div>
      <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Seeds</h3>
      <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">120+
        Varieties</span>
    </a>

    <a href="<?php echo esc_url(home_url('/shop/')); ?>"
      style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
      <div style="font-size:3.5rem;margin-bottom:12px;">🌿</div>
      <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Seedlings</h3>
      <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Jaipur
        Only</span>
    </a>

    <a href="<?php echo esc_url(home_url('/shop/')); ?>"
      style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
      <div style="font-size:3.5rem;margin-bottom:12px;">🪴</div>
      <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Compost & Soil</h3>
      <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">100%
        Organic</span>
    </a>

    <a href="<?php echo esc_url(home_url('/shop/')); ?>"
      style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
      <div style="font-size:3.5rem;margin-bottom:12px;">🛠️</div>
      <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Tools</h3>
      <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Durable
        Kits</span>
    </a>

    <a href="<?php echo esc_url(home_url('/shop/')); ?>"
      style="background:var(--sand);padding:32px 20px;border-radius:4px;text-align:center;text-decoration:none;transition:transform 0.2s;">
      <div style="font-size:3.5rem;margin-bottom:12px;">🌸</div>
      <h3 style="font-family:var(--f-display);font-size:1.1rem;color:var(--soil);">Pots & Planters</h3>
      <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-transform:uppercase;">Terracotta &
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
    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn-ghost">View All Products ➔</a>
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
          <div class="product-name"><a href="<?php echo esc_url(home_url('/shop/')); ?>">Tomato Seedling Tray</a></div>
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
          <div class="product-name"><a href="<?php echo esc_url(home_url('/shop/')); ?>">Monsoon Veg Seed Kit</a></div>
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
          <div class="product-name"><a href="<?php echo esc_url(home_url('/shop/')); ?>">Organic Vermicompost 5kg</a>
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
    <a href="<?php echo esc_url(home_url('/reels/')); ?>" class="btn-ghost">Watch All Reels ➔</a>
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

<?php get_footer(); ?>