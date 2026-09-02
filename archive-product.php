<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/shop/shop.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/shop/shop.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/shop/shop.bundle.js"></script>
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/shop/shop.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/shop/shop.bundle.js"></script>
  <?php get_header(); ?>
  <main>
    <!-- ============================================================
     PAGE HERO
     ============================================================ -->
    <section class="page-hero">
      <p class="breadcrumb"><a href="/">Home</a> · Shop</p>
      <h1>The whole <em>garden</em>, in one place.</h1>
      <p>Filter by category, season, or what you're growing. Fresh seedlings ship same-day in Jaipur.</p>
    </section>

    <!-- ============================================================
     SHOP CATALOG LAYOUT
     ============================================================ -->
    <section>
      <div class="shop-layout">
        
        <!-- Sidebar Filters -->
        <aside class="filter-sidebar">
          
          <div class="mobile-filter-dropdown">
            <input type="checkbox" id="mobile-filter-toggle" class="filter-toggle-checkbox" style="display: none;">
            <label for="mobile-filter-toggle" class="mobile-filter-summary">Filter & Sort Options</label>
            <div class="mobile-filter-content">
              <div class="search">
                <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input placeholder="Search products..." type="text" name="search-products" id="search-products">
              </div>

              <h4>Category</h4>
              <div class="filter-container">
                <?php
                $product_cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                if (!empty($product_cats) && !is_wp_error($product_cats)) {
                  foreach ($product_cats as $cat) {
                    // Render spans that look like checkboxes (handled by CSS) for the existing JS logic
                    echo '<span class="filter" data-title="' . esc_attr($cat->name) . '" data-id="' . esc_attr($cat->term_id) . '">' . esc_html($cat->name) . '</span>';
                  }
                }
                ?>
              </div>

              <div class="filter-btns">
                <button class="clear">Clear All</button>
                <button class="results">Show Results</button>
              </div>
            </div>
          </div>
        </aside>

        <!-- Product Grid Area -->
        <div>
          <div class="shop-toolbar filter-sortby">
            <span class="results">Showing all products</span>
            
            <div style="position: relative;">
              <p class="sort-by-heading" style="margin:0; cursor:pointer;">
                <span class="sort-by">Sort By: <span id="sort-by">Newest First</span></span>
                <span class="svg-arrow">
                  <svg width="13" height="13" class="drop-down" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </span>
              </p>
              <div class="sorting">
                <p data-attr="Newest First" data-find="newest">Newest First</p>
                <p data-attr="Price: Low to High" data-find="low-high">Price: Low to High</p>
                <p data-attr="Price: High to Low" data-find="high-low">Price: High to Low</p>
              </div>
            </div>
          </div>

          <div class="loading" id="product-loader" style="display:none; padding: 40px; text-align: center;">
            Loading...
          </div>

          <div class="product-grid" id="gbh-product-grid">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                  'orderby' => 'date',
                  'order' => 'DESC',
                'paged' => $paged,
            );
            $products_query = new WP_Query($product_args);
            
            if ($products_query->have_posts()):
              while ($products_query->have_posts()):
                $products_query->the_post();
                $p_id = get_the_ID();
                $title = get_field('product_title') ?: get_the_title();
                $price = get_field('product_price');
                $offer_price = get_field('product_offer_price');
                $discount_label = get_field('discount_label');
                $image_url = get_field('product_image') ?: get_the_post_thumbnail_url($p_id, 'gbh-card');
                $image_alt = get_field('product_image_alt') ?: get_the_title();
                
                $terms = get_the_terms($p_id, 'product_cat');
                $cat_name = ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Gardening';
                ?>
                
                <div class="product-card" 
                  data-product-id="<?php echo esc_attr($p_id); ?>"
                  data-category="<?php echo esc_attr(strtolower($cat_name)); ?>"
                  data-title="<?php echo esc_attr(strtolower($title)); ?>"
                  data-price="<?php echo esc_attr($offer_price ? $offer_price : ($price ? $price : 199)); ?>"
                  data-date="<?php echo get_the_time('U', $p_id); ?>"
                  data-permalink="<?php the_permalink(); ?>">
                  
                  <div class="product-img">
                    <a href="<?php the_permalink(); ?>" class="product-img-link">
                      <?php if ($image_url): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                      <?php else: ?>
                        <div style="width:100%; height:100%; background:#f4f4f4;"></div>
                      <?php endif; ?>
                    </a>
                    <?php if ($discount_label): ?>
                      <span class="badge-hot"><?php echo esc_html($discount_label); ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="product-body">
                    <div class="product-category"><?php echo esc_html($cat_name); ?></div>
                    <div class="product-name">
                      <h2><a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a></h2>
                    </div>
                    <!-- Assuming description comes from excerpt, keeping it short -->
                    <div class="product-desc">
                      <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                    </div>
                    
                    <div class="product-footer">
                      <div class="product-price">
                        <?php if ($offer_price): ?>
                          ₹<?php echo esc_html($offer_price); ?>
                          <?php if ($price): ?><small style="text-decoration: line-through;">₹<?php echo esc_html($price); ?></small><?php endif; ?>
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
              <p>No products found in our garden today.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php get_footer(); ?>
