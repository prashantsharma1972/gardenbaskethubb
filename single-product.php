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

      <section class="breadcrumb-header my-6 lg:my-10 lg:space-y-14 h-[50px] flex items-center">
          <div class="flexdiv flex 2xl:pl-[50px] xl:pl-[30px] pl-5 items-center">
              <p class="text-[#b8b8b8] text-[10px] sm:text-[16px]">
                  <a class="text-[#b8b8b8]" href="/shop">Shop</a>
              </p>
              <p class="text-[#b8b8b8] px-[10px] text-[18px]"> >> </p>
              <p class="current text-[#61baf1] text-[10px] sm:text-[16px]">
                  <?php echo esc_html($title); ?>
              </p>
          </div>
      </section>

      <section class="banner_section max-w-[1820px] mx-auto sm:mt-[50px] lg:mt-[100px]">
          <div class="relative pr-5 lg:pr-0 pl-5 lg:px-5 lg:grid lg:grid-cols-[2fr_5fr] lg:gap-10">
              <div class="pdp-gallery">
                  <div class="pdp-main-img mb-5">
                      <?php if ($main_img): ?>
                          <img src="<?php echo esc_url($main_img); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full rounded-lg shadow-sm">
                      <?php endif; ?>
                  </div>
              </div>
              <div class="flex flex-col align-top justify-start relative lg:mt-5 pb-5 sm:pb-8">
                  <h1 class="font-mulish pr-[10px] text-[#434343] font-medium text-2xl sm:text-3xl xl:text-5xl mb-4">
                      <?php echo esc_html($title); ?>
                  </h1>
                  <div class="price-block mb-6">
                      <?php if ($offer_price): ?>
                          <span class="text-3xl font-bold text-gray-900">₹<?php echo esc_html($offer_price); ?></span>
                          <span class="text-lg text-gray-500 line-through ml-2">₹<?php echo esc_html($price); ?></span>
                      <?php else: ?>
                          <span class="text-3xl font-bold text-gray-900">₹<?php echo esc_html($price ? $price : '199'); ?></span>
                      <?php endif; ?>
                  </div>
                  
                  <div class="pdp-cta flex gap-4 mb-8">
                      <button class="bg-[#2C1A0E] hover:bg-[#4E8A48] text-white px-8 py-3 rounded transition add-btn" data-product-id="<?php echo esc_attr($product_id); ?>">
                          Add to Bag
                      </button>
                      <button class="border border-[#2C1A0E] text-[#2C1A0E] hover:bg-gray-50 px-8 py-3 rounded transition btn-buy-now" data-product-id="<?php echo esc_attr($product_id); ?>">
                          Buy Now
                      </button>
                  </div>

                  <div class="pincode-check bg-gray-50 p-6 rounded-lg mb-8 max-w-md">
                      <label class="block text-sm font-medium text-gray-700 mb-2">Check delivery availability in your area</label>
                      <div class="flex gap-2">
                          <input type="text" placeholder="Enter 6-digit Pincode (e.g. 302001)" class="flex-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#4E8A48]">
                          <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm transition">Check</button>
                      </div>
                  </div>

                  <div class="pdp-trust grid grid-cols-2 gap-4 text-sm text-gray-600">
                      <div class="flex items-center gap-2"><span>🚚</span> Same-day delivery in Jaipur</div>
                      <div class="flex items-center gap-2"><span>🌿</span> 100% Organic & Non-GMO</div>
                      <div class="flex items-center gap-2"><span>💬</span> Free WhatsApp Advice</div>
                      <div class="flex items-center gap-2"><span>♻️</span> Eco-friendly Packaging</div>
                  </div>
              </div>
          </div>
      </section>

      <section class="care-tabs-section max-w-[1820px] mx-auto mt-16 px-5 lg:px-20">
          <div class="border-b border-gray-200">
              <nav class="-mb-px flex gap-8">
                  <button class="tab-btn border-[#4E8A48] text-[#4E8A48] border-b-2 py-4 px-1 text-sm font-medium" data-tab="tab-growing">🌱 How to Grow</button>
                  <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 py-4 px-1 text-sm font-medium" data-tab="tab-care">💧 Plant Care Tips</button>
                  <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 py-4 px-1 text-sm font-medium" data-tab="tab-pests">🪲 Pests & Diseases</button>
                  <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 py-4 px-1 text-sm font-medium" data-tab="tab-harvest">🌾 Harvesting</button>
              </nav>
          </div>
          <div class="py-8 prose max-w-none text-gray-700">
              <div id="tab-growing" class="tab-content block">
                  <h3 class="text-xl font-bold mb-4">How to Grow <?php echo esc_html($title); ?></h3>
                  <?php echo $how_to_grow ? wp_kses_post($how_to_grow) : '<p>Sow seeds directly in pots or grow bags at a depth of 2–2.5 cm. Maintain spacing of 30–45 cm between plants. Keep soil evenly moist during germination.</p>'; ?>
              </div>
              <div id="tab-care" class="tab-content hidden">
                  <h3 class="text-xl font-bold mb-4">Plant Care Requirements</h3>
                  <?php echo $care_tips ? wp_kses_post($care_tips) : '<p><strong>Sunlight:</strong> 6–8 hours of direct sunlight daily.<br><strong>Watering:</strong> Keep soil moist.</p>'; ?>
              </div>
              <div id="tab-pests" class="tab-content hidden">
                  <h3 class="text-xl font-bold mb-4">Pest & Disease Prevention</h3>
                  <?php echo $pests_diseases ? wp_kses_post($pests_diseases) : '<p>Spray organic Neem Oil solution every 10–15 days as a preventative measure.</p>'; ?>
              </div>
              <div id="tab-harvest" class="tab-content hidden">
                  <h3 class="text-xl font-bold mb-4">Harvesting Guide</h3>
                  <?php echo $harvesting_guide ? wp_kses_post($harvesting_guide) : '<p>Harvest tender fruits/vegetables regularly when they reach optimal size.</p>'; ?>
              </div>
          </div>
      </section>

      <section class="related_section max-w-[1820px] mx-auto mt-10 px-5 lg:px-20 bg-[#F7F2E8] py-16">
          <div class="mb-10 text-center">
              <p class="text-sm uppercase tracking-widest text-[#8B4A2B] mb-2">More from our nursery</p>
              <h2 class="text-3xl font-bold text-[#2C1A0E]">Related Gardening Essentials</h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
                      <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition group">
                          <div class="relative h-64 overflow-hidden">
                              <?php if ($r_thumb): ?>
                                  <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                              <?php else: ?>
                                  <div class="w-full h-full flex items-center justify-center bg-gray-100 text-4xl">🌱</div>
                              <?php endif; ?>
                          </div>
                          <div class="p-6">
                              <div class="text-xs text-[#8B4A2B] mb-2 uppercase tracking-wider">Garden Essential</div>
                              <h3 class="text-lg font-semibold text-[#2C1A0E] mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                              <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                              <div class="flex justify-between items-center mt-auto">
                                  <div class="text-xl font-bold text-gray-900">₹<?php echo esc_html($r_price ? $r_price : '199'); ?></div>
                                  <button class="add-btn text-[#4E8A48] font-medium hover:underline" data-product-id="<?php echo esc_attr($r_id); ?>">Add to bag ➔</button>
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