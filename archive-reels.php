<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/reels/reels.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/reels/reels.css">
  <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/reels/reels.bundle.js"></script>
  <?php get_header(); ?>
  
  <main class="main--container">

    <!-- ============================================================
     PAGE HERO
     ============================================================ -->
    <section class="banner-section">
      <div class="container">
        <h1 class="main_heading">Gardening <em>Reels</em>.</h1>
        <p class="sub_description">Watch and learn quick tips and tricks for your garden.</p>
      </div>
    </section>

    <!-- ============================================================
     REELS GRID
     ============================================================ -->
    <section class="blogs">
      <div class="filter-section">
        <div class="filters-type-with-search">
          <div data-type="category" class="filter-type">
            <span class="icons">
              <svg class="add">
                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#add'></use>
              </svg>
              <svg class="subtract">
                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#hyphen'></use>
              </svg>
            </span>
            Reel Tag
          </div>
          <div class="search">
            <svg class="search__icon"><use href='/wp-content/themes/gardenbaskethubb/public/sprites/shop.svg#search'></use></svg>
            <input placeholder="Search reels..." type="text" id="search-reels">
          </div>
        </div>
        <div class="filters-container">
          <div data-type="category" class="filter-container">
            <?php
            $reels_tags = get_terms(['taxonomy' => 'reels_tag', 'hide_empty' => false]);
            if (!empty($reels_tags) && !is_wp_error($reels_tags)) {
              foreach ($reels_tags as $tag) {
                echo '<span class="filter" data-title="' . esc_attr($tag->name) . '" data-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
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

      <div class="reels-grid" id="gbh-reels-grid">
        <?php if (have_posts()): ?>
          <?php while (have_posts()):
            the_post();
            $r_id = get_the_ID();
            $video_url = get_field('video_url');
            $thumbnail = get_the_post_thumbnail_url($r_id, 'large');
            if (!$thumbnail && function_exists('get_field')) {
                $thumbnail = get_field('thumbnail_image', $r_id);
            }
            $style = $thumbnail ? 'background-image: url(' . esc_url($thumbnail) . ');' : '';
            
            $terms = get_the_terms($r_id, 'reels_tag');
            $cat_name = ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Tutorial';
            ?>
            
            <a href="<?php the_permalink(); ?>" class="reel-card play-reel-btn" 
              style="<?php echo $style; ?>"
              data-reel-id="<?php echo esc_attr($r_id); ?>" 
              data-video-url="<?php echo esc_url($video_url); ?>"
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

    <!-- Modal for playing reels -->
    <div class="reel-modal">
        <div class="reel-modal-overlay"></div>
        <div class="reel-modal-content">
            <button class="reel-modal-close">&times;</button>
            <h3 class="reel-modal-title">Gardening Guide</h3>
            <div class="reel-modal-body">
            <!-- Player appended via JS -->
            </div>
        </div>
    </div>

  </main>
  <?php get_footer(); ?>
</html>