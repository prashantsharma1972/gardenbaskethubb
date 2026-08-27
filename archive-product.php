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
  <main class="main--container">

    <!-- ============================================================
     PAGE HERO
     ============================================================ -->
    <section class="banner-section">
      <div class="container">
        <h1 class="main_heading">The whole <em>garden</em>, in one place.</h1>
        <p class="sub_description">Filter by category, season, or what you're growing. Fresh seedlings ship same-day in
          Jaipur.</p>
      </div>
    </section>

    <!-- ============================================================
     SHOP CATALOG LAYOUT
     ============================================================ -->
    <section class="blogs">
      <div class="filter-section">
        <div class="filters-type-with-search">
          <div data-type="category" class="filter-type">
            <span class="icons">
              <svg class="add">
                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#add'>
              </svg>
              <svg class="subtract">
                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#hyphen'>
              </svg>
            </span>
            Product Category
          </div>
          <div class="search">
            <svg class="search__icon">
              <use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#search'>
            </svg>
            <input placeholder="Search" type="text" name="search-products" id="search-products">
          </div>
        </div>
        <div class=" filters-container">
          <div data-type="category" class="filter-container">
            <!-- Query Product Categories -->
            <?php
            $product_cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
            if (!empty($product_cats) && !is_wp_error($product_cats)) {
              foreach ($product_cats as $cat) {
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
      <div class="filter-sortby">
        <p class="sort-by-heading"><span class="sort-by">Sort By: <span id="sort-by">Newest First</span></span>
          <span class="svg-arrow"><svg width="13" height="13" class="drop-down" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
              </path>
            </svg></span>
        </p>
        <div class="sorting">
          <p data-attr="Newest First" data-find="newest">Newest First</p>
          <p data-attr="Price: Low to High" data-find="low-high">Price: Low to High</p>
          <p data-attr="Price: High to Low" data-find="high-low">Price: High to Low</p>
        </div>
      </div>
      <div class="loading" id="product-loader" style="display:none;">
        <!-- Loader graphic here -->
      </div>
      <div class="resource-list product-grid" id="gbh-product-grid">

        <?php if (have_posts()): ?>
          <?php while (have_posts()):
            the_post();
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
            <div class="resource-data product-card" 
              data-product-id="<?php echo esc_attr($p_id); ?>"
              data-category="<?php echo esc_attr(strtolower($cat_name)); ?>"
              data-title="<?php echo esc_attr(strtolower($title)); ?>"
              data-price="<?php echo esc_attr($offer_price ? $offer_price : ($price ? $price : 199)); ?>"
              data-date="<?php echo get_the_time('U', $p_id); ?>"
              data-permalink="<?php the_permalink(); ?>">
              <div class="blog-feature-image product-img">
                <a href="<?php the_permalink(); ?>" class="product-img-link">
                  <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                      class="resource-img">
                  <?php else: ?>
                    🌱
                  <?php endif; ?>
                </a>

                <?php if ($discount_label): ?>
                  <span class="badge-hot"><?php echo esc_html($discount_label); ?></span>
                <?php endif; ?>
              </div>

              <div class="blog-content product-body">
                <div class="blog-timeline product-category">
                  <p>
                    <?php
                    $terms = get_the_terms($p_id, 'product_cat');
                    echo ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Gardening';
                    ?>
                  </p>
                </div>

                <div class="blog-title product-name">
                  <h2 class="blog-heading">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a>
                  </h2>
                </div>

                <div class="author-div flex-div product-footer">
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
          <p>No products found.</p>
        <?php endif; ?>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>