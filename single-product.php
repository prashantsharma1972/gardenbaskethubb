<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.css">
    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.css">
    <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.bundle.js"></script>
    <?php get_header(); ?>
  <main>
    <?php while (have_posts()):
      the_post();
      $product_id = get_the_ID();

      // Fetch Normalized Meta & ACF Fields
      $title = get_the_title();
      $price = get_post_meta($product_id, 'product_price', true);
      if (!$price && function_exists('get_field')) $price = get_field('product_price');

      $offer_price = get_post_meta($product_id, 'product_offer_price', true);
      if (!$offer_price && function_exists('get_field')) $offer_price = get_field('product_offer_price');

      $how_to_grow = get_post_meta($product_id, 'how_to_grow', true);
      if (!$how_to_grow && function_exists('get_field')) $how_to_grow = get_field('how_to_grow');

      $care_tips = get_post_meta($product_id, 'plant_care_tips', true);
      if (!$care_tips && function_exists('get_field')) $care_tips = get_field('plant_care_tips');

      $pests_diseases = get_post_meta($product_id, 'pests_and_diseases', true);
      if (!$pests_diseases && function_exists('get_field')) $pests_diseases = get_field('pests_and_diseases');

      $harvesting_guide = get_post_meta($product_id, 'harvesting_guide', true);
      if (!$harvesting_guide && function_exists('get_field')) $harvesting_guide = get_field('harvesting_guide');

      $main_img = get_the_post_thumbnail_url($product_id, 'large');
      if (!$main_img) {
        $main_img = get_field('product_image');
      }
      ?>

      <!-- BREADCRUMB -->
      <section class="pdp-breadcrumb-bar">
        <div class="pdp-breadcrumb-inner">
          <p class="breadcrumb-item"><a href="/shop">Shop</a></p>
          <span class="breadcrumb-sep">&rsaquo;</span>
          <p class="breadcrumb-item breadcrumb-current"><?php echo esc_html($title); ?></p>
        </div>
      </section>

      <!-- MAIN PDP SECTION -->
      <section style="padding-top:140px;">
        <div class="pdp">

          <!-- Gallery Column -->
          <div class="pdp-gallery">
            <div class="pdp-main-img">
              <?php if ($main_img): ?>
                <img src="<?php echo esc_url($main_img); ?>" alt="<?php echo esc_attr($title); ?>">
              <?php endif; ?>
            </div>
          </div>

          <!-- Info Column -->
          <div class="pdp-info">
            <p class="breadcrumb"><a href="/">Home</a> · <a href="/shop">Shop</a> · <?php echo esc_html($title); ?></p>
            <h1><?php echo esc_html($title); ?></h1>

            <div class="price">
              <?php if ($offer_price): ?>
                ₹<?php echo esc_html($offer_price); ?>
                <small style="text-decoration: line-through;">₹<?php echo esc_html($price); ?></small>
              <?php else: ?>
                ₹<?php echo esc_html($price ? $price : '199'); ?>
              <?php endif; ?>
            </div>

            <p class="desc">
              <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
            </p>

            <div class="pdp-options">
              <div class="qty-row">
                <label style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--clay);">Qty</label>
                <div class="qty-stepper">
                  <button type="button" class="qty-minus">−</button>
                  <input type="number" value="1" min="1" max="99">
                  <button type="button" class="qty-plus">+</button>
                </div>
              </div>
            </div>

            <div class="pdp-cta">
              <button class="btn-primary add-btn" data-product-id="<?php echo esc_attr($product_id); ?>">
                Add to Bag
              </button>
              <button class="btn-secondary btn-buy-now" data-product-id="<?php echo esc_attr($product_id); ?>">
                Buy Now
              </button>
            </div>

            <div class="pincode-check">
              <label>Check delivery availability in your area</label>
              <div class="row">
                <input type="text" placeholder="Enter 6-digit Pincode (e.g. 302001)">
                <button>Check</button>
              </div>
            </div>

            <div class="pdp-trust">
              <div class="pdp-trust-item"><span class="ic">🚚</span> Same-day delivery in Jaipur</div>
              <div class="pdp-trust-item"><span class="ic">🌿</span> 100% Organic &amp; Non-GMO</div>
              <div class="pdp-trust-item"><span class="ic">💬</span> Free WhatsApp Advice</div>
              <div class="pdp-trust-item"><span class="ic">♻️</span> Eco-friendly Packaging</div>
            </div>
          </div>

        </div>
      </section>

      <!-- CARE TABS SECTION -->
      <section class="pdp-care-tabs">
        <div class="tabs-nav">
          <button class="tab-btn active" data-tab="tab-growing">🌱 How to Grow</button>
          <button class="tab-btn" data-tab="tab-care">💧 Plant Care Tips</button>
          <button class="tab-btn" data-tab="tab-pests">🪲 Pests &amp; Diseases</button>
          <button class="tab-btn" data-tab="tab-harvest">🌾 Harvesting</button>
        </div>
        <div class="tabs-body">
          <div id="tab-growing" class="tab-content active">
            <h3 class="tab-heading">How to Grow <?php echo esc_html($title); ?></h3>
            <?php echo $how_to_grow ? wp_kses_post($how_to_grow) : '<p>Sow seeds directly in pots or grow bags at a depth of 2–2.5 cm. Maintain spacing of 30–45 cm between plants. Keep soil evenly moist during germination.</p>'; ?>
          </div>
          <div id="tab-care" class="tab-content">
            <h3 class="tab-heading">Plant Care Requirements</h3>
            <?php echo $care_tips ? wp_kses_post($care_tips) : '<p><strong>Sunlight:</strong> 6–8 hours of direct sunlight daily.<br><strong>Watering:</strong> Keep soil moist.</p>'; ?>
          </div>
          <div id="tab-pests" class="tab-content">
            <h3 class="tab-heading">Pest &amp; Disease Prevention</h3>
            <?php echo $pests_diseases ? wp_kses_post($pests_diseases) : '<p>Spray organic Neem Oil solution every 10–15 days as a preventative measure.</p>'; ?>
          </div>
          <div id="tab-harvest" class="tab-content">
            <h3 class="tab-heading">Harvesting Guide</h3>
            <?php echo $harvesting_guide ? wp_kses_post($harvesting_guide) : '<p>Harvest tender fruits/vegetables regularly when they reach optimal size.</p>'; ?>
          </div>
        </div>
      </section>

      <!-- RELATED PRODUCTS SECTION -->
      <section class="pdp-related-section">
        <div class="pdp-related-header">
          <p class="section-label">More from our nursery</p>
          <h2 class="section-title">Related Gardening Essentials</h2>
        </div>

        <div class="pdp-related-grid">
          <?php
          $related = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 3,
            'post__not_in' => array($product_id),
          ));

          if ($related->have_posts()):
            while ($related->have_posts()):
              $related->the_post();
              $r_id = get_the_ID();
              $r_price = get_field('product_offer_price') ? get_field('product_offer_price') : get_field('product_price');
              $r_thumb = get_the_post_thumbnail_url($r_id, 'medium');
              ?>
              <div class="related-card">
                <div class="related-card-img">
                  <?php if ($r_thumb): ?>
                    <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title(); ?>">
                  <?php else: ?>
                    <div class="related-card-img-fallback">🌱</div>
                  <?php endif; ?>
                </div>
                <div class="related-card-body">
                  <div class="related-card-label">Garden Essential</div>
                  <h3 class="related-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <p class="related-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                  <div class="related-card-footer">
                    <div class="related-card-price">₹<?php echo esc_html($r_price ? $r_price : '199'); ?></div>
                    <button class="add-btn related-card-add-btn" data-product-id="<?php echo esc_attr($r_id); ?>">Add to bag ➔</button>
                  </div>
                </div>
              </div>
          <?php endwhile;
            wp_reset_postdata();
          endif; ?>
        </div>
      </section>

    <?php endwhile; ?>
  </main>
  
  <?php get_footer(); ?>
</body>
</html>