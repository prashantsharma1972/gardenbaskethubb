<?php
/**
 * Shop Archive Template — Garden Basket Hub
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/shop/shop.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/shop/shop.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/shop/shop.bundle.js"></script>

    <?php get_header(); ?>

<!-- ============================================================
     PAGE HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Shop</p>
  <h1>The whole <em>garden</em>, in one place.</h1>
  <p>Filter by category, season, or what you're growing. Fresh seedlings ship same-day in Jaipur.</p>
</section>

<!-- ============================================================
     SHOP CATALOG LAYOUT
     ============================================================ -->
<section>
  <div class="shop-layout">
    <!-- Filter Sidebar -->
    <aside class="filter-sidebar">
      <h4>Category</h4>
      <label><input type="checkbox" name="cat" value="seeds" checked> Seeds</label>
      <label><input type="checkbox" name="cat" value="seedlings"> Seedlings (Jaipur)</label>
      <label><input type="checkbox" name="cat" value="compost"> Compost & Soil</label>
      <label><input type="checkbox" name="cat" value="tools"> Tools & Accessories</label>
      <label><input type="checkbox" name="cat" value="pots"> Pots & Planters</label>

      <h4>Season</h4>
      <label><input type="checkbox" name="season" value="monsoon"> Monsoon</label>
      <label><input type="checkbox" name="season" value="winter"> Winter</label>
      <label><input type="checkbox" name="season" value="summer"> Summer</label>
      <label><input type="checkbox" name="season" value="all"> All Year</label>

      <h4>Price Range</h4>
      <div class="price-input">
        <input type="number" placeholder="Min ₹" min="0">
        <input type="number" placeholder="Max ₹" min="0">
      </div>

      <h4>Delivery Option</h4>
      <label><input type="checkbox" name="del" value="jaipur"> Same-Day Jaipur</label>
      <label><input type="checkbox" name="del" value="india"> Pan India Shipping</label>
      <label><input type="checkbox" name="del" value="cod"> COD Available</label>
    </aside>

    <!-- Product Grid Area -->
    <div>
      <div class="shop-toolbar">
        <?php
        $products_query = new WP_Query(array(
          'post_type' => 'product',
          'posts_per_page' => 24,
        ));
        $count = $products_query->found_posts;
        ?>
        <span class="results" id="gbh-results-count">Showing <?php echo esc_html($count > 0 ? $count : '24'); ?> products</span>

        <select id="gbh-sort-products">
          <option value="featured">Sort: Featured</option>
          <option value="low-high">Price: Low to High</option>
          <option value="high-low">Price: High to Low</option>
          <option value="newest">Newest First</option>
        </select>
      </div>

      <div class="product-grid" id="gbh-product-grid">

        <?php if ($products_query->have_posts()): ?>
          <?php while ($products_query->have_posts()):
            $products_query->the_post();
            $p_id = get_the_ID();
            $price = get_field('product_price');
            $offer_price = get_field('product_offer_price');
            $discount_label = get_field('discount_label');
            $thumb_url = get_the_post_thumbnail_url($p_id, 'gbh-card');
            if (!$thumb_url)
              $thumb_url = get_field('product_image');
            ?>
            <div class="product-card" data-product-id="<?php echo esc_attr($p_id); ?>" data-permalink="<?php the_permalink(); ?>">
              <div class="product-img">
                <a href="<?php the_permalink(); ?>" style="display:block;width:100%;height:100%;text-decoration:none;color:inherit;">
                  <?php if ($thumb_url): ?>
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                  <?php else: ?>
                    🌱
                  <?php endif; ?>
                </a>


                <?php if ($discount_label): ?>
                  <span class="badge-hot"><?php echo esc_html($discount_label); ?></span>
                <?php else: ?>
                  <span class="badge-jaipur">Jaipur Only</span>
                <?php endif; ?>
              </div>

              <div class="product-body">
                <div class="product-category">
                  <?php
                  $terms = get_the_terms($p_id, 'product_cat');
                  echo ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Gardening';
                  ?>
                </div>

                <div class="product-name">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>

                <div class="product-desc">
                  <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                </div>

                <div class="product-footer">
                  <div class="product-price">
                    <?php if ($offer_price): ?>
                      ₹<?php echo esc_html($offer_price); ?>
                      <?php if ($price): ?><del>₹<?php echo esc_html($price); ?></del><?php endif; ?>
                    <?php else: ?>
                      ₹<?php echo esc_html($price ? $price : '199'); ?>
                    <?php endif; ?>
                  </div>

                  <button class="add-btn" data-product-id="<?php echo esc_attr($p_id); ?>">
                    Add to bag
                  </button>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>

        <?php else: ?>
          <!-- Demo Fallback Cards if DB has no products created yet -->
          <div class="product-card">
            <div class="product-img">🌱 <span class="badge-jaipur">Jaipur Only</span></div>
            <div class="product-body">
              <div class="product-category">Seedlings</div>
              <div class="product-name"><a href="#">Tomato Seedling Tray</a></div>
              <div class="product-desc">6 healthy seedlings, 3 weeks old. Same-day delivery in Jaipur.</div>
              <div class="product-footer">
                <div class="product-price">₹199 <small>/ tray</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌿 <span class="badge-new">New</span></div>
            <div class="product-body">
              <div class="product-category">Seeds</div>
              <div class="product-name"><a href="#">Monsoon Veg Seed Kit</a></div>
              <div class="product-desc">8 heirloom varieties, perfect for monsoon planting.</div>
              <div class="product-footer">
                <div class="product-price">₹349 <small>/ kit</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🪴 <span class="badge-hot">Bestseller</span></div>
            <div class="product-body">
              <div class="product-category">Compost</div>
              <div class="product-name"><a href="#">Organic Vermicompost 5kg</a></div>
              <div class="product-desc">Premium quality, ideal for terrace & balcony gardens.</div>
              <div class="product-footer">
                <div class="product-price">₹299 <small>/ 5kg</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌸 <span class="badge-jaipur">Jaipur Only</span></div>
            <div class="product-body">
              <div class="product-category">Seedlings</div>
              <div class="product-name"><a href="#">Marigold Sapling Pack</a></div>
              <div class="product-desc">Fresh flowering saplings, ready to transplant.</div>
              <div class="product-footer">
                <div class="product-price">₹149 <small>/ pack of 4</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🛠️</div>
            <div class="product-body">
              <div class="product-category">Tools</div>
              <div class="product-name"><a href="#">Gardening Tool Set</a></div>
              <div class="product-desc">5-piece essential kit — trowel, fork, pruner, gloves & more.</div>
              <div class="product-footer">
                <div class="product-price">₹599 <small>/ set</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌼 <span class="badge-hot">Popular</span></div>
            <div class="product-body">
              <div class="product-category">Bundle</div>
              <div class="product-name"><a href="#">Monsoon Starter Kit</a></div>
              <div class="product-desc">Seeds + compost + tool — everything to start gardening.</div>
              <div class="product-footer">
                <div class="product-price">₹799 <small>/ kit</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>