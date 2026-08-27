<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/blog/blog.bundle.js"></script>
  <?php get_header(); ?>
  
  <main class="main--container">
    <?php while (have_posts()):
      the_post();
      $b_id = get_the_ID();
      $read_time = get_post_meta($b_id, 'read_time', true);
      if (!$read_time && function_exists('get_field')) {
        $read_time = get_field('read_time', $b_id);
      }
      if (!$read_time) {
        $read_time = '5 min read';
      }

      $banner_img = get_the_post_thumbnail_url($b_id, 'large');
      if (!$banner_img && function_exists('get_field')) {
        $banner_img = get_field('banner_image', $b_id);
      }
      $categories = get_the_category($b_id);
      $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening Guide';
      ?>

      <!-- BLOG BREADCRUMB -->
      <section class="pdp-breadcrumb-bar">
        <div class="pdp-breadcrumb-inner">
          <p class="breadcrumb-item"><a href="/blog">Blogs</a></p>
          <span class="breadcrumb-sep">&rsaquo;</span>
          <p class="breadcrumb-item breadcrumb-current"><?php echo the_title(); ?></p>
        </div>
      </section>

      <!-- BLOG HERO -->
      <section class="blog-hero-section">
        <div class="blog-hero-inner">
          <div class="blog-hero-content">
            <span class="badge-new badge-cat"><?php echo esc_html($cat_name); ?></span>
            <h1 class="blog-hero-title"><?php echo the_title(); ?></h1>
          </div>
          <div class="blog-hero-meta">
            <div class="blog-author">
              <strong class="blog-author-name">Garden Basket Hub Team</strong>
              <div class="blog-author-role">Nursery Experts</div>
              <div class="blog-author-date">
                <span>📅 <?php echo get_the_date('F j, Y'); ?></span>
                <span>⏱️ <?php echo esc_html($read_time); ?></span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- BLOG BODY -->
      <section class="blog-body-section">
        <?php if ($banner_img): ?>
          <div class="blog-banner">
            <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>">
          </div>
        <?php endif; ?>
        <div class="blog-content-body">
          <?php the_content(); ?>
        </div>
      </section>

      <!-- RELATED BLOG POSTS -->
      <section class="blog-related-section">
        <div class="blog-related-header">
          <div>
            <p class="section-label">More Planting Advice</p>
            <h2 class="section-title">Related Gardening Articles</h2>
          </div>
          <a href="/blog/" class="btn-ghost">View All Guides ➔</a>
        </div>

        <div class="blog-related-grid">
          <?php
          $related_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'post__not_in' => array($b_id),
          ));

          if ($related_query->have_posts()):
            while ($related_query->have_posts()):
              $related_query->the_post();
              $rel_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              ?>
              <div class="related-card">
                <?php if ($rel_thumb): ?>
                  <img src="<?php echo esc_url($rel_thumb); ?>" alt="<?php the_title(); ?>" class="related-card-img-cover">
                <?php endif; ?>
                <div class="related-card-body">
                  <span class="related-card-date"><?php echo get_the_date('M j, Y'); ?></span>
                  <h3 class="related-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <p class="related-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn-ghost">Read Guide ➔</a>
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