<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.bundle.js"></script>
  <?php get_header(); ?>
  <main>

    <!-- ============================================================
     BLOG HERO SECTION
     ============================================================ -->
    <section class="page-hero doc-hero doc-hero-center">
      <p class="breadcrumb"><a href="/">Home</a> · Gardening Guides & Blog</p>
      <h1 class="hero-title">Gardening <em>Guides</em> & Tips.</h1>
      <p class="hero-desc">
        Expert potting mix ratios, monsoon plant care tips, seedling guides, and organic urban farming advice from our
        Jaipur nursery team.
      </p>
    </section>

    <!-- ============================================================
     BLOG POSTS CATALOG GRID
     ============================================================ -->
    <section class="shop-layout">
      <!-- Sidebar Filters -->
      <aside class="filter-sidebar">
        <div class="mobile-filter-dropdown">
            <input type="checkbox" id="mobile-filter-toggle-blog" class="filter-toggle-checkbox" style="display: none;">
            <label for="mobile-filter-toggle-blog" class="mobile-filter-summary">Filter & Sort Options</label>
            <div class="mobile-filter-content">
              <div class="search">
                <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input placeholder="Search articles..." type="text" name="search-products" id="search-products">
              </div>

              <h4>Category</h4>
              <div class="filter-container">
                <?php
                $blog_cats = get_terms(['taxonomy' => 'category', 'hide_empty' => false]);
                if (!empty($blog_cats) && !is_wp_error($blog_cats)) {
                  foreach ($blog_cats as $cat) {
                    if ($cat->name === 'Uncategorized') continue;
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

      <div class="product-grid" id="gbh-blog-grid">
        <?php
        // Custom query to fetch posts (blog entries) if not using default loop
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $blog_query = new WP_Query(array(
          'post_type' => 'post',
          'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
          'paged' => $paged
        ));

        if ($blog_query->have_posts()):
          while ($blog_query->have_posts()):
            $blog_query->the_post();
            $b_id = get_the_ID();
            $read_time = get_post_meta($b_id, 'read_time', true);
            if (!$read_time && function_exists('get_field'))
              $read_time = get_field('read_time', $b_id);
            if (!$read_time)
              $read_time = '5 min read';

            $banner_img = get_the_post_thumbnail_url($b_id, 'large');
            if (!$banner_img && function_exists('get_field'))
              $banner_img = get_field('banner_image', $b_id);
            $categories = get_the_category($b_id);
            $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening';
            ?>
            <article class="product-card featured-blog-card" 
              data-category="<?php echo esc_attr(strtolower($cat_name)); ?>"
              data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>"
              data-date="<?php echo get_the_time('U', $b_id); ?>"
              data-permalink="<?php the_permalink(); ?>"
              onclick="window.location.href='<?php the_permalink(); ?>';">
              <div>
                <div class="product-img blog-img-wrap">
                  <?php if ($banner_img): ?>
                    <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" class="blog-img">
                  <?php else: ?>
                    <div class="blog-img-fallback" style="width:100%; height:100%; background:#f4f4f4;"></div>
                  <?php endif; ?>
                  <span class="badge-new badge-cat"><?php echo esc_html($cat_name); ?></span>
                </div>

                <div class="product-body">
                  <div class="product-category">
                    <?php echo get_the_date('M j, Y'); ?> &middot; ⏱️ <?php echo esc_html($read_time); ?>
                  </div>

                  <div class="product-name">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </div>

                  <div class="product-desc">
                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                  </div>
                  
                  <div class="product-footer" style="margin-top:auto; padding-top:16px;">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none; font-weight:500; color:var(--leaf); font-size:0.9rem;">Read Full Article ➔</a>
                  </div>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="blog-not-found">
            <p>No blog posts found. Check back soon for fresh gardening guides!</p>
          </div>
        <?php endif;
        wp_reset_postdata(); ?>
      </div>

      <!-- Pagination -->
      <div class="pagination-wrapper">
        <?php
        echo paginate_links(array(
          'total' => $blog_query->max_num_pages,
          'prev_text' => '← Previous',
          'next_text' => 'Next →',
        ));
        ?>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>
