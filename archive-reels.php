<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/reels/reels.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/reels/reels.css">
  <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/reels/reels.bundle.js"></script>
  <?php get_header(); ?>
  
  <main>

    <!-- ============================================================
     PAGE HERO
     ============================================================ -->
    <section class="page-hero">
      <p class="breadcrumb"><a href="/">Home</a> · Reels</p>
      <h1>Gardening <em>Reels</em>.</h1>
      <p>Watch and learn quick tips and tricks for your garden.</p>
    </section>

    <!-- ============================================================
     REELS GRID
     ============================================================ -->
    <section class="shop-layout">
      <!-- Sidebar Filters -->
      <aside class="filter-sidebar">
        
        <div class="mobile-filter-dropdown">
            <input type="checkbox" id="mobile-filter-toggle-reels" class="filter-toggle-checkbox" style="display: none;">
            <label for="mobile-filter-toggle-reels" class="mobile-filter-summary">Filter & Sort Options</label>
            <div class="mobile-filter-content">
              <div class="search">
                <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input placeholder="Search reels..." type="text" id="search-reels">
              </div>

              <h4>Reel Tag</h4>
              <div class="filter-container">
                <?php
                $reel_cats = get_terms(['taxonomy' => 'reel_tag', 'hide_empty' => false]);
                if (!empty($reel_cats) && !is_wp_error($reel_cats)) {
                  foreach ($reel_cats as $cat) {
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

      <div class="reels-grid" id="gbh-reels-grid">
        <?php if (have_posts()): ?>
          <?php while (have_posts()):
            the_post();
            $r_id = get_the_ID();
            $video_url = get_field('video_url');
            $thumbnail = get_the_post_thumbnail_url($r_id, 'large');
            if (!$thumbnail && function_exists('get_field')) {
                $thumbnail = get_field('thumbnail_image', $r_id) ?: (get_field('product_image', $r_id) ?: get_field('banner_image', $r_id));
            }
            $style = $thumbnail ? 'background-image: url(' . esc_url($thumbnail) . ');' : 'background: #e0e7df;';
            
            $terms = get_the_terms($r_id, 'reels_tag');
            $cat_name = ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Tutorial';
            ?>
            
            <a href="<?php echo esc_url($video_url ? $video_url : '#'); ?>" class="reel-card" target="_blank"
              style="<?php echo $style; ?>"
              data-reel-id="<?php echo esc_attr($r_id); ?>" 
              data-category="<?php echo esc_attr(strtolower($cat_name)); ?>"
              data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>">
                
                <div class="play">▶</div>
                <div class="meta">
                    <h4><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h4>
                    <span><?php echo esc_html($cat_name); ?></span>
                </div>
            </a>
            
          <?php endwhile;
          wp_reset_postdata(); ?>
        <?php else: ?>
          <p>No reels found.</p>
        <?php endif; ?>
      </div>
      <div style="text-align:center;margin-top:48px;">
          <button class="btn-primary" id="load-more-reels">Load More Reels</button>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>
</html>