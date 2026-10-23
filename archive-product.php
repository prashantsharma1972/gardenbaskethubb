<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/shop/shop.css">
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
      <p>Filter by category, season, or what you're growing. Fresh saplings ship same-day in Jaipur.</p>
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

              <h4>Categories</h4>
              <div class="filter-container">
                <?php
                $current_tax_slug = '';
                if (is_tax('product_cat')) {
                    $queried_term = get_queried_object();
                    if ($queried_term && !empty($queried_term->slug)) {
                        $current_tax_slug = strtolower($queried_term->slug);
                    }
                } elseif (!empty($_GET['category'])) {
                    $current_tax_slug = strtolower(sanitize_text_field($_GET['category']));
                }

                $tree = function_exists('gbh_get_client_category_tree') ? gbh_get_client_category_tree() : array();
                $is_all_active = empty($current_tax_slug) || $current_tax_slug === 'all';
                ?>
                <span class="filter filter-all <?php echo $is_all_active ? 'active' : ''; ?>" data-slug="all" data-title="All Products">
                  <span class="cat-name">All Products</span>
                </span>
                <?php
                foreach ($tree as $main_key => $cat_item) {
                    $is_parent_active = ($current_tax_slug === strtolower($cat_item['slug']));
                    echo '<div class="filter-group">';
                    echo '<span class="filter filter-parent ' . ($is_parent_active ? 'active' : '') . '" data-slug="' . esc_attr($cat_item['slug']) . '" data-title="' . esc_attr($cat_item['name']) . '">';
                    echo '<span class="cat-icon">' . esc_html($cat_item['icon']) . '</span> ';
                    echo '<span class="cat-name">' . esc_html($cat_item['name']) . '</span>';
                    if (!empty($cat_item['badge'])) {
                        echo '<span class="badge-jaipur-mini">' . esc_html($cat_item['badge']) . '</span>';
                    }
                    echo '</span>';

                    if (!empty($cat_item['subs'])) {
                        echo '<div class="filter-subs-group">';
                        foreach ($cat_item['subs'] as $sub_item) {
                            $is_sub_active = ($current_tax_slug === strtolower($sub_item['slug']));
                            echo '<span class="filter filter-sub ' . ($is_sub_active ? 'active' : '') . '" data-parent="' . esc_attr($cat_item['slug']) . '" data-slug="' . esc_attr($sub_item['slug']) . '" data-title="' . esc_attr($sub_item['name']) . '">';
                            echo '<span class="cat-sub-bullet">↳</span> ';
                            echo '<span class="cat-name">' . esc_html($sub_item['name']) . '</span>';
                            echo '</span>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
              </div>

              <div class="filter-btns">
                <button class="clear" type="button">Clear All</button>
                <button class="results" type="button">Show Results</button>
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
                $price = get_field('product_price') ?: get_post_meta($p_id, 'product_price', true);
                $offer_price = get_field('product_offer_price') ?: get_post_meta($p_id, 'product_offer_price', true);
                $discount_label = get_field('discount_label') ?: get_post_meta($p_id, 'discount_label', true);
                $image_url = get_field('product_image') ?: get_the_post_thumbnail_url($p_id, 'gbh-card');
                if (!$image_url) $image_url = get_post_meta($p_id, 'product_image', true);
                $image_alt = get_field('product_image_alt') ?: get_the_title();
                
                $terms = get_the_terms($p_id, 'product_cat');
                $cat_tokens = array();
                $display_cat_name = 'Gardening';
                $is_jaipur_only = false;

                if ($terms && !is_wp_error($terms)) {
                    $display_cat_name = $terms[0]->name;
                    foreach ($terms as $t) {
                        $cat_tokens[] = strtolower($t->name);
                        $cat_tokens[] = strtolower($t->slug);
                        if ($t->slug === 'saplings' || strtolower($t->name) === 'saplings') {
                            $is_jaipur_only = true;
                        }
                        if ($t->parent) {
                            $parent_term = get_term($t->parent, 'product_cat');
                            if ($parent_term && !is_wp_error($parent_term)) {
                                $cat_tokens[] = strtolower($parent_term->name);
                                $cat_tokens[] = strtolower($parent_term->slug);
                                if ($parent_term->slug === 'saplings') {
                                    $is_jaipur_only = true;
                                }
                            }
                        }
                    }
                }
                $cat_filter_attr = implode(' ', array_unique($cat_tokens));
                ?>
                
                <div class="product-card" 
                  data-product-id="<?php echo esc_attr($p_id); ?>"
                  data-is-sapling="<?php echo $is_jaipur_only ? '1' : '0'; ?>"
                  data-category="<?php echo esc_attr($cat_filter_attr); ?>"
                  data-title="<?php echo esc_attr(strtolower($title)); ?>"
                  data-price="<?php echo esc_attr($offer_price ? $offer_price : ($price ? $price : 199)); ?>"
                  data-date="<?php echo get_the_time('U', $p_id); ?>"
                  data-permalink="<?php the_permalink(); ?>">
                  
                  <div class="product-img">
                    <a href="<?php the_permalink(); ?>" class="product-img-link">
                      <?php if ($image_url): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                      <?php else: ?>
                        <div style="width:100%; height:100%; background:#f4f4f4; display:flex; align-items:center; justify-content:center; font-size:3rem;">🌱</div>
                      <?php endif; ?>
                    </a>
                    <?php if ($discount_label): ?>
                      <span class="badge-hot"><?php echo esc_html($discount_label); ?></span>
                    <?php elseif ($is_jaipur_only): ?>
                      <span class="badge-jaipur">Jaipur Only</span>
                    <?php endif; ?>
                  </div>

                  <div class="product-body">
                    <div class="product-category"><?php echo esc_html($display_cat_name); ?></div>
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

                      <button class="add-btn" data-product-id="<?php echo esc_attr($p_id); ?>" data-is-sapling="<?php echo $is_jaipur_only ? '1' : '0'; ?>">
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
