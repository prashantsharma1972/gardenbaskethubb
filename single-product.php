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
      if (!$price) $price = get_post_meta($product_id, '_regular_price', true);
      if (!$price) $price = get_post_meta($product_id, '_price', true);

      $offer_price = get_post_meta($product_id, 'product_offer_price', true);
      if (!$offer_price && function_exists('get_field')) $offer_price = get_field('product_offer_price');
      if (!$offer_price) $offer_price = get_post_meta($product_id, '_sale_price', true);

      $discount_badge = get_post_meta($product_id, 'discount_label', true);
      if (!$discount_badge && function_exists('get_field')) $discount_badge = get_field('discount_label');

      $stock_status = get_post_meta($product_id, '_stock_status', true);
      if (!$stock_status && function_exists('get_field')) $stock_status = get_field('_stock_status');

      $pack_size = get_post_meta($product_id, 'number_of_seeds', true);
      if (!$pack_size && function_exists('get_field')) $pack_size = get_field('number_of_seeds');

      $variety = get_post_meta($product_id, 'seed_type', true);
      if (!$variety && function_exists('get_field')) $variety = get_field('seed_type');

      $sowing_season = get_post_meta($product_id, 'sowing_season', true);
      if (!$sowing_season && function_exists('get_field')) $sowing_season = get_field('sowing_season');

      $how_to_grow = get_post_meta($product_id, 'how_to_grow', true);
      if (!$how_to_grow && function_exists('get_field')) $how_to_grow = get_field('how_to_grow');

      $care_tips = get_post_meta($product_id, 'plant_care_tips', true);
      if (!$care_tips && function_exists('get_field')) $care_tips = get_field('plant_care_tips');

      $pests_diseases = get_post_meta($product_id, 'pests_and_diseases', true);
      if (!$pests_diseases && function_exists('get_field')) $pests_diseases = get_field('pests_and_diseases');

      $harvesting_guide = get_post_meta($product_id, 'harvesting_guide', true);
      if (!$harvesting_guide && function_exists('get_field')) $harvesting_guide = get_field('harvesting_guide');

      $main_img = get_the_post_thumbnail_url($product_id, 'large');
      if (!$main_img && function_exists('get_field')) {
        $main_img = get_field('product_image');
      }

      $gallery_images = array();
      if ($main_img) {
        $gallery_images[] = $main_img;
      }
      for ($i = 1; $i <= 5; $i++) {
        $gal_val = function_exists('get_field') ? get_field('product_image_' . $i) : '';
        if (!$gal_val) {
          $gal_val = get_post_meta($product_id, 'product_image_' . $i, true);
        }
        if (is_array($gal_val) && !empty($gal_val['url'])) {
          $gal_val = $gal_val['url'];
        } elseif (is_numeric($gal_val)) {
          $gal_val = wp_get_attachment_image_url((int) $gal_val, 'large');
        }
        if (!empty($gal_val) && is_string($gal_val)) {
          $gallery_images[] = $gal_val;
        }
      }
      $gallery_images = array_values(array_filter(array_unique($gallery_images)));
      $is_pdp_sapling = function_exists('gbh_is_sapling_product') ? gbh_is_sapling_product($product_id) : false;
      $pdp_terms = get_the_terms($product_id, 'product_cat');
      $pdp_cat_name = ($pdp_terms && !is_wp_error($pdp_terms)) ? $pdp_terms[0]->name : '';
      $short_crumb_title = mb_strlen($title, 'UTF-8') > 45 ? mb_substr($title, 0, 45, 'UTF-8') . '…' : $title;
      ?>

      <!-- MAIN PDP SECTION -->
      <section class="pdp-hero-section">
        <div class="pdp" data-product-id="<?php echo esc_attr($product_id); ?>" data-is-sapling="<?php echo $is_pdp_sapling ? '1' : '0'; ?>">

          <!-- Gallery Column -->
          <div class="pdp-gallery">
            <div class="swiper pdp-gallery-swiper">
              <div class="swiper-wrapper">
                <?php if (!empty($gallery_images)):
                  foreach ($gallery_images as $img): ?>
                    <div class="swiper-slide pdp-main-img">
                      <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
                    </div>
                <?php endforeach; else: ?>
                  <div class="swiper-slide pdp-main-img">
                    <div class="pdp-img-fallback">🌱</div>
                  </div>
                <?php endif; ?>
              </div>
              <?php if (count($gallery_images) > 1): ?>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Info Column -->
          <div class="pdp-info">
            <p class="breadcrumb">
              <a href="/">Home</a> · <a href="/shop">Shop</a><?php if ($pdp_cat_name): ?> · <?php echo esc_html($pdp_cat_name); ?><?php endif; ?> · <span><?php echo esc_html($short_crumb_title); ?></span>
            </p>
            <h1><?php echo esc_html($title); ?></h1>

            <?php
            $has_pdp_discount = ($offer_price && (!$price || floatval($offer_price) < floatval($price)));
            $pdp_desc = function_exists('gbh_clean_text_snippet')
              ? gbh_clean_text_snippet(get_the_excerpt(), 32)
              : wp_trim_words(get_the_excerpt(), 32, '...');
            $is_out_of_stock = ($stock_status === 'outofstock');
            ?>
            <div class="price">
              <?php if ($has_pdp_discount): ?>
                <span class="price-current">₹<?php echo esc_html($offer_price); ?></span>
                <?php if ($price): ?><small class="price-mrp">₹<?php echo esc_html($price); ?></small><?php endif; ?>
              <?php else: ?>
                <span class="price-current">₹<?php echo esc_html($price ? $price : ($offer_price ? $offer_price : '199')); ?></span>
              <?php endif; ?>

              <?php if ($discount_badge): ?>
                <span class="pdp-badge-discount"><?php echo esc_html($discount_badge); ?></span>
              <?php endif; ?>

              <span class="pdp-stock-pill <?php echo $is_out_of_stock ? 'is-out' : 'is-in'; ?>">
                <?php echo $is_out_of_stock ? 'Out of Stock' : 'In Stock'; ?>
              </span>
            </div>

            <?php if ($pdp_desc): ?>
              <p class="desc"><?php echo esc_html($pdp_desc); ?></p>
            <?php endif; ?>

            <?php if ($pack_size || $variety || $sowing_season): ?>
              <div class="pdp-spec-chips">
                <?php if ($pack_size): ?><span class="pdp-spec-chip"><strong>Pack:</strong> <?php echo esc_html($pack_size); ?></span><?php endif; ?>
                <?php if ($variety): ?><span class="pdp-spec-chip"><strong>Type:</strong> <?php echo esc_html($variety); ?></span><?php endif; ?>
                <?php if ($sowing_season): ?><span class="pdp-spec-chip"><strong>Season:</strong> <?php echo esc_html($sowing_season); ?></span><?php endif; ?>
              </div>
            <?php endif; ?>

            <div class="pdp-options">
              <div class="qty-row">
                <label>Qty</label>
                <div class="qty-stepper">
                  <button type="button" class="qty-minus">−</button>
                  <input type="number" value="1" min="1" max="99">
                  <button type="button" class="qty-plus">+</button>
                </div>
              </div>
            </div>

            <div class="pdp-cta">
              <button class="btn-primary add-btn" data-product-id="<?php echo esc_attr($product_id); ?>" data-is-sapling="<?php echo $is_pdp_sapling ? '1' : '0'; ?>" <?php echo $is_out_of_stock ? 'disabled' : ''; ?>>
                <?php echo $is_out_of_stock ? 'Out of Stock' : 'Add to Bag'; ?>
              </button>
              <button class="btn-secondary btn-buy-now" data-product-id="<?php echo esc_attr($product_id); ?>" data-is-sapling="<?php echo $is_pdp_sapling ? '1' : '0'; ?>" <?php echo $is_out_of_stock ? 'disabled' : ''; ?>>
                Buy Now
              </button>
            </div>

            <div class="pincode-check">
              <label>Check delivery availability in your area</label>
              <div class="row">
                <input type="text" id="gbh-pincode-input" maxlength="6" placeholder="Enter 6-digit Pincode (e.g. 302001)">
                <button type="button" id="gbh-pincode-check-btn">Check</button>
              </div>
              <div id="gbh-pincode-result" style="margin-top:8px; font-size:0.85rem; display:none;"></div>
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

      <!-- CARE ACCORDION SECTION -->
      <section class="pdp-care-tabs">
        <details class="gbh-accordion" open>
          <summary>🌱 How to Grow &amp; Planting Guide</summary>
          <div class="gbh-accordion-content">
            <?php echo $how_to_grow ? wp_kses_post($how_to_grow) : '<p>Sow seeds directly in pots or grow bags at a depth of 2–2.5 cm. Maintain spacing of 30–45 cm between plants. Keep soil evenly moist during germination.</p>'; ?>
          </div>
        </details>
        
        <details class="gbh-accordion">
          <summary>💧 Plant Care Requirements</summary>
          <div class="gbh-accordion-content">
            <?php echo $care_tips ? wp_kses_post($care_tips) : '<p><strong>Sunlight:</strong> 6–8 hours of direct sunlight daily.<br><strong>Watering:</strong> Keep soil moist.</p>'; ?>
          </div>
        </details>
        
        <details class="gbh-accordion">
          <summary>🪲 Pest &amp; Disease Prevention</summary>
          <div class="gbh-accordion-content">
            <?php echo $pests_diseases ? wp_kses_post($pests_diseases) : '<p>Spray organic Neem Oil solution every 10–15 days as a preventative measure.</p>'; ?>
          </div>
        </details>
        
        <details class="gbh-accordion">
          <summary>🪴 Harvesting Guide</summary>
          <div class="gbh-accordion-content">
            <?php echo $harvesting_guide ? wp_kses_post($harvesting_guide) : '<p>Harvest tender fruits/vegetables regularly when they reach optimal size.</p>'; ?>
          </div>
        </details>
      </section>

      <!-- RELATED PRODUCTS SECTION -->
      <section class="pdp-related-section">
        <div class="pdp-related-header">
          <p class="section-label">More from our nursery</p>
          <h2 class="section-title">Related Gardening Essentials</h2>
        </div>

        <div class="swiper pdp-related-swiper">
          <div class="swiper-wrapper">
          <?php
          $related = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'post__not_in' => array($product_id),
          ));

          if ($related->have_posts()):
            while ($related->have_posts()):
              $related->the_post();
              $r_id = get_the_ID();
              $r_price = get_post_meta($r_id, 'product_price', true);
              if (!$r_price && function_exists('get_field')) $r_price = get_field('product_price', $r_id);
              if (!$r_price) $r_price = get_post_meta($r_id, '_regular_price', true);
              if (!$r_price) $r_price = get_post_meta($r_id, '_price', true);

              $r_offer = get_post_meta($r_id, 'product_offer_price', true);
              if (!$r_offer && function_exists('get_field')) $r_offer = get_field('product_offer_price', $r_id);
              if (!$r_offer) $r_offer = get_post_meta($r_id, '_sale_price', true);
              $r_has_discount = ($r_offer && (!$r_price || floatval($r_offer) < floatval($r_price)));

              $r_terms = get_the_terms($r_id, 'product_cat');
              $r_cat   = ($r_terms && !is_wp_error($r_terms)) ? $r_terms[0]->name : 'Garden Essential';
              $r_thumb = get_the_post_thumbnail_url($r_id, 'large');
              $r_desc  = function_exists('gbh_clean_text_snippet')
                ? gbh_clean_text_snippet(get_the_excerpt(), 25)
                : wp_trim_words(get_the_excerpt(), 25, '...');
              ?>
              <div class="swiper-slide related-card">
                <div class="related-card-img">
                  <a href="<?php the_permalink(); ?>" class="related-card-img-link">
                    <?php if ($r_thumb): ?>
                      <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php else: ?>
                      <div class="related-card-img-fallback">🌱</div>
                    <?php endif; ?>
                  </a>
                </div>
                <div class="related-card-body">
                  <div class="related-card-label"><?php echo esc_html($r_cat); ?></div>
                  <h3 class="related-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <p class="related-card-excerpt"><?php echo esc_html($r_desc); ?></p>
                  <div class="related-card-footer">
                    <div class="related-card-price">
                      <?php if ($r_has_discount): ?>
                        ₹<?php echo esc_html($r_offer); ?>
                        <?php if ($r_price): ?><del>₹<?php echo esc_html($r_price); ?></del><?php endif; ?>
                      <?php else: ?>
                        ₹<?php echo esc_html($r_price ? $r_price : ($r_offer ? $r_offer : '199')); ?>
                      <?php endif; ?>
                    </div>
                    <button class="add-btn related-card-add-btn" data-product-id="<?php echo esc_attr($r_id); ?>">Add to bag</button>
                  </div>
                </div>
              </div>
          <?php endwhile;
            wp_reset_postdata();
          endif; ?>
          </div>
        </div>
      </section>

    <?php endwhile; ?>
  </main>
  
  <?php get_footer(); ?>
</body>
</html>
