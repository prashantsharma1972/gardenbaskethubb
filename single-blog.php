<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/blog/blog.bundle.js"></script>
  <?php get_header(); ?>
  
  <main>
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

      <!-- BLOG HERO -->
      <section class="page-hero" style="padding-bottom: 24px;">
        <p class="breadcrumb"><a href="/blog">Blogs</a> · <?php echo esc_html($cat_name); ?></p>
        <h1 style="max-width:800px; margin:0 auto 16px;"><?php echo the_title(); ?></h1>
        
        <div style="display:flex; justify-content:center; align-items:center; gap:16px; color:var(--text-light); font-size:0.95rem;">
            <span>📅 <?php echo get_the_date('M j, Y'); ?></span>
            <span>⏱️ <?php echo esc_html($read_time); ?></span>
            <span>✍️ Garden Basket Hub Team</span>
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

        <div class="product-grid" style="grid-template-columns: repeat(3, 1fr); gap: 32px; padding: 24px 0;">
          <?php
          $related_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post__not_in' => array($b_id),
          ));

          if ($related_query->have_posts()):
            while ($related_query->have_posts()):
              $related_query->the_post();
              $rel_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              ?>
              <div class="product-card">
                <?php if ($rel_thumb): ?>
                  <div class="product-img">
                    <img src="<?php echo esc_url($rel_thumb); ?>" alt="<?php the_title(); ?>" style="width:100%; height:200px; object-fit:cover; border-radius:4px;">
                  </div>
                <?php endif; ?>
                <div class="product-body">
                  <div class="product-category"><?php echo get_the_date('M j, Y'); ?></div>
                  <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <div class="product-desc"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></div>
                  <div class="product-footer" style="margin-top:auto; padding-top:16px;">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none; font-weight:500; color:var(--leaf); font-size:0.9rem;">Read Guide ➔</a>
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