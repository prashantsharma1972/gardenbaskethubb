<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.css">
    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.css">
    <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/singleProduct/singleProduct.bundle.js"></script>
    <?php get_header(); ?>
<main class="main--container">

<?php while (have_posts()):
  the_post();
  $product_id = get_the_ID();

  // Fetch Normalized Meta & ACF Fields
  $title = get_the_title();
  $price = get_post_meta($product_id, 'product_price', true);
  if (!$price && function_exists('get_field'))
    $price = get_field('product_price');

  $offer_price = get_post_meta($product_id, 'product_offer_price', true);
  if (!$offer_price && function_exists('get_field'))
    $offer_price = get_field('product_offer_price');

  $discount_label = get_post_meta($product_id, 'discount_label', true);
  if (!$discount_label && function_exists('get_field'))
    $discount_label = get_field('discount_label');

  $number_of_seeds = get_post_meta($product_id, 'number_of_seeds', true);
  if (!$number_of_seeds && function_exists('get_field'))
    $number_of_seeds = get_field('number_of_seeds');

  $seed_type = get_post_meta($product_id, 'seed_type', true);
  if (!$seed_type && function_exists('get_field'))
    $seed_type = get_field('seed_type');

  $sowing_season = get_post_meta($product_id, 'sowing_season', true);
  if (!$sowing_season && function_exists('get_field'))
    $sowing_season = get_field('sowing_season');

  $germ_temp = get_post_meta($product_id, 'germination_temperature', true);
  if (!$germ_temp && function_exists('get_field'))
    $germ_temp = get_field('germination_temperature');

  $germ_time = get_post_meta($product_id, 'germination_time', true);
  if (!$germ_time && function_exists('get_field'))
    $germ_time = get_field('germination_time');

  $germ_rate = get_post_meta($product_id, 'germination_rate', true);
  if (!$germ_rate && function_exists('get_field'))
    $germ_rate = get_field('germination_rate');

  $first_harvest = get_post_meta($product_id, 'first_harvest', true);
  if (!$first_harvest && function_exists('get_field'))
    $first_harvest = get_field('first_harvest');

  $container_size = get_post_meta($product_id, 'container_pot_size', true);
  if (!$container_size && function_exists('get_field'))
    $container_size = get_field('container_pot_size');
  if (!$container_size && function_exists('get_field'))
    $container_size = get_field('container__pot_size');

  $growing_level = get_post_meta($product_id, 'growing_level', true);
  if (!$growing_level && function_exists('get_field'))
    $growing_level = get_field('growing_level');

  $sku = get_post_meta($product_id, 'sku', true);
  if (!$sku && function_exists('get_field'))
    $sku = get_field('sku');
  if (!$sku)
    $sku = 'GBH-SEEDS-' . $product_id;

  // Additional Care & Guide Fields
  $care_tips = get_post_meta($product_id, 'plant_care_tips', true);
  if (!$care_tips && function_exists('get_field'))
    $care_tips = get_field('plant_care_tips');

  $how_to_grow = get_post_meta($product_id, 'how_to_grow', true);
  if (!$how_to_grow && function_exists('get_field'))
    $how_to_grow = get_field('how_to_grow');

  $pests_diseases = get_post_meta($product_id, 'pests_and_diseases', true);
  if (!$pests_diseases && function_exists('get_field'))
    $pests_diseases = get_field('pests_and_diseases');

  $harvesting_guide = get_post_meta($product_id, 'harvesting_guide', true);
  if (!$harvesting_guide && function_exists('get_field'))
    $harvesting_guide = get_field('harvesting_guide');


  // Images
  $main_img = get_the_post_thumbnail_url($product_id, 'large');
  if (!$main_img) {
    $main_img = get_field('product_image');
  }

  // Gallery Thumbnails
  $gallery_images = array();
  if ($main_img)
    $gallery_images[] = $main_img;

  // Check ACF image 1, 2, 3 or gallery array
  $acf_gallery = get_field('product_gallery');
  if ($acf_gallery && is_array($acf_gallery)) {
    foreach ($acf_gallery as $g_item) {
      $url = is_array($g_item) ? $g_item['url'] : $g_item;
      if ($url && !in_array($url, $gallery_images))
        $gallery_images[] = $url;
    }
  } else {
    for ($i = 1; $i <= 3; $i++) {
      $img_url = get_field('product_image_' . $i);
      if ($img_url && !in_array($img_url, $gallery_images)) {
        $gallery_images[] = $img_url;
      }
    }
  }
  ?>

  <!-- ============================================================
     PRODUCT DETAIL SECTION (PDP)
     ============================================================ -->
  <section style="padding-top:140px;" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="pdp">
      <!-- Gallery Column -->
      <div class="pdp-gallery">
        <div class="pdp-main-img">
          <?php if ($main_img): ?>
            <img src="<?php echo esc_url($main_img); ?>" alt="<?php echo esc_attr($title); ?>">
          <?php else: ?>
            🌱
          <?php endif; ?>

          <?php if ($discount_label): ?>
            <span class="badge-hot"
              style="position:absolute;top:14px;left:14px;"><?php echo esc_html($discount_label); ?></span>
          <?php else: ?>
            <span class="badge-jaipur" style="position:absolute;top:14px;left:14px;">Jaipur Special · Same-Day</span>
          <?php endif; ?>
        </div>

        <?php if (!empty($gallery_images) && count($gallery_images) > 1): ?>
          <div class="pdp-thumbs">
            <?php foreach ($gallery_images as $index => $thumb_url): ?>
              <div class="pdp-thumb <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo esc_url($thumb_url); ?>" alt="Thumbnail">
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Product Info Column -->
      <div class="pdp-info">
        <p class="breadcrumb">
          <a href="/">Home</a> ·
          <a href="/shop/">Shop</a> ·
          <?php the_terms($product_id, 'product_cat', '', ', '); ?>
        </p>

        <h1><?php echo esc_html($title); ?></h1>

        <div class="rating">★ ★ ★ ★ ★ <span>(128 verified reviews)</span></div>

        <div class="price">
          <?php if ($offer_price): ?>
            ₹<?php echo esc_html($offer_price); ?>
            <?php if ($price): ?><del>₹<?php echo esc_html($price); ?></del><?php endif; ?>
          <?php elseif ($price): ?>
            ₹<?php echo esc_html($price); ?>
          <?php else: ?>
            ₹199
          <?php endif; ?>
          <small>inclusive of all taxes</small>
        </div>

        <div class="desc">
          <?php if (has_excerpt()): ?>
            <?php the_excerpt(); ?>
          <?php else: ?>
            <?php the_content(); ?>
          <?php endif; ?>
        </div>

        <!-- Quick Specs Grid -->
        <div class="pdp-specs-grid">
          <?php if ($number_of_seeds): ?>
            <div class="pdp-spec-item"><strong>Seeds Quantity</strong> <?php echo esc_html($number_of_seeds); ?></div>
          <?php endif; ?>

          <?php if ($seed_type): ?>
            <div class="pdp-spec-item"><strong>Seed Type</strong> <?php echo esc_html($seed_type); ?></div>
          <?php endif; ?>

          <?php if ($sowing_season): ?>
            <div class="pdp-spec-item"><strong>Sowing Season</strong> <?php echo esc_html($sowing_season); ?></div>
          <?php endif; ?>

          <?php if ($germ_temp): ?>
            <div class="pdp-spec-item"><strong>Germination Temp</strong> <?php echo esc_html($germ_temp); ?></div>
          <?php endif; ?>

          <?php if ($germ_time): ?>
            <div class="pdp-spec-item"><strong>Germination Time</strong> <?php echo esc_html($germ_time); ?></div>
          <?php endif; ?>

          <?php if ($germ_rate): ?>
            <div class="pdp-spec-item"><strong>Germination Rate</strong> <?php echo esc_html($germ_rate); ?></div>
          <?php endif; ?>

          <?php if ($first_harvest): ?>
            <div class="pdp-spec-item"><strong>Harvest Time</strong> <?php echo esc_html($first_harvest); ?></div>
          <?php endif; ?>

          <?php if ($growing_level): ?>
            <div class="pdp-spec-item"><strong>Difficulty Level</strong> <?php echo esc_html($growing_level); ?></div>
          <?php endif; ?>
        </div>

        <!-- Purchase Options -->
        <div class="pdp-options">
          <?php if ($container_size): ?>
            <div class="opt-row">
              <label>Recommended Pot Size</label>
              <div class="opt-pills">
                <div class="opt-pill selected"><?php echo esc_html($container_size); ?></div>
              </div>
            </div>
          <?php endif; ?>

          <div class="qty-row">
            <label
              style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--clay);">Qty</label>
            <div class="qty-stepper">
              <button class="qty-minus">–</button>
              <input type="text" value="1" class="qty-input">
              <button class="qty-plus">+</button>
            </div>
          </div>
        </div>

        <!-- Call to Action Buttons -->
        <div class="pdp-cta">
          <button class="btn-primary add-btn" data-product-id="<?php echo esc_attr($product_id); ?>">
            Add to Bag
          </button>
          <button class="btn-secondary btn-buy-now" data-product-id="<?php echo esc_attr($product_id); ?>">
            Buy Now
          </button>
        </div>


        <!-- Pincode Check Widget -->
        <div class="pincode-check">
          <label>Check delivery availability in your area</label>
          <div class="row">
            <input type="text" placeholder="Enter 6-digit Pincode (e.g. 302001)">
            <button>Check</button>
          </div>
        </div>

        <!-- Trust Badges -->
        <div class="pdp-trust">
          <div class="pdp-trust-item"><span class="ic">🚚</span>Same-day delivery in Jaipur</div>
          <div class="pdp-trust-item"><span class="ic">🌿</span>100% Organic & Non-GMO</div>
          <div class="pdp-trust-item"><span class="ic">💬</span>Free WhatsApp Gardening Advice</div>
          <div class="pdp-trust-item"><span class="ic">♻️</span>Eco-friendly Packaging</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
     PLANT CARE & GROWING GUIDES (ACCORDION TABS)
     ============================================================ -->
  <section class="care-tabs-section">
    <div class="care-tabs-nav">
      <button class="tab-btn active" data-tab="tab-growing">🌱 How to Grow</button>
      <button class="tab-btn" data-tab="tab-care">💧 Plant Care Tips</button>
      <button class="tab-btn" data-tab="tab-pests">🪲 Pests & Diseases</button>
      <button class="tab-btn" data-tab="tab-harvest">🌾 Harvesting</button>
    </div>

    <div id="tab-growing" class="tab-content active">
      <h3>How to Grow <?php echo esc_html($title); ?></h3>
      <br>
      <?php if ($how_to_grow): ?>
        <?php echo wp_kses_post($how_to_grow); ?>
      <?php else: ?>
        <p>Sow seeds directly in pots or grow bags at a depth of 2–2.5 cm. Maintain spacing of 30–45 cm between plants. Keep
          soil evenly moist during germination. Seeds usually germinate within 7–14 days in favorable weather conditions.
        </p>
      <?php endif; ?>
    </div>

    <div id="tab-care" class="tab-content">
      <h3>Plant Care Requirements</h3>
      <br>
      <?php if ($care_tips): ?>
        <?php echo wp_kses_post($care_tips); ?>
      <?php else: ?>
        <p><strong>Sunlight:</strong> 6–8 hours of direct sunlight daily.<br>
          <strong>Watering:</strong> Keep soil moist, especially during peak summer.<br>
          <strong>Soil:</strong> Fertile, well-drained loamy soil with rich organic compost.
        </p>
      <?php endif; ?>
    </div>

    <div id="tab-pests" class="tab-content">
      <h3>Pest & Disease Prevention</h3>
      <br>
      <?php if ($pests_diseases): ?>
        <?php echo wp_kses_post($pests_diseases); ?>
      <?php else: ?>
        <p>Common garden pests include aphids and whiteflies. Spray organic <strong>Neem Oil solution</strong> every 10–15
          days as a preventative measure. Ensure proper ventilation around the plant base to avoid fungal diseases.</p>
      <?php endif; ?>
    </div>

    <div id="tab-harvest" class="tab-content">
      <h3>Harvesting Guide</h3>
      <br>
      <?php if ($harvesting_guide): ?>
        <?php echo wp_kses_post($harvesting_guide); ?>
      <?php else: ?>
        <p>Harvest tender fruits/vegetables regularly when they reach optimal size. Continuous harvesting encourages more
          flowering and fresh yield throughout the growing season.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- ============================================================
     RELATED PRODUCTS SECTION
     ============================================================ -->
  <section style="background:var(--sand);">
    <p class="section-label">More from our nursery</p>
    <h2 class="section-title">Related Gardening Essentials</h2>

    <div class="product-grid">
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
          $r_thumb = get_the_post_thumbnail_url($r_id, 'gbh-card');
          ?>
          <div class="product-card">
            <div class="product-img">
              <?php if ($r_thumb): ?>
                <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title(); ?>">
              <?php else: ?>
                🌱
              <?php endif; ?>
            </div>
            <div class="product-body">
              <div class="product-category">Garden Essential</div>
              <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
              <div class="product-desc"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
              <div class="product-footer">
                <div class="product-price">₹<?php echo esc_html($r_price ? $r_price : '199'); ?></div>
                <button class="add-btn" data-product-id="<?php echo esc_attr($r_id); ?>">Add to bag</button>
              </div>
            </div>
          </div>
        <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </section>

<?php endwhile; ?>

</main>
<?php get_footer(); ?>