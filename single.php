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
  if (!$read_time && function_exists('get_field'))
    $read_time = get_field('read_time', $b_id);
  if (!$read_time)
    $read_time = '5 min read';

  $banner_img = get_the_post_thumbnail_url($b_id, 'large');
  if (!$banner_img && function_exists('get_field'))
    $banner_img = get_field('banner_image', $b_id);
  $categories = get_the_category($b_id);
  $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening Guide';
  ?>

  <!-- ============================================================
     BLOG POST HERO
     ============================================================ -->
  <article>
    <header class="page-hero doc-hero doc-hero-center">
      <p class="breadcrumb">
        <a href="/">Home</a> ·
        <a href="/blog/">Blog</a> ·
        <?php echo esc_html($cat_name); ?>
      </p>

      <h1 class="hero-title"><?php the_title(); ?></h1>

      <div class="blog-hero-meta">
        <span>📅 <?php echo get_the_date('F j, Y'); ?></span>
        <span>⏱️ <?php echo esc_html($read_time); ?></span>
        <span>✍️ Garden Basket Hub Nursery Team</span>
      </div>
    </header>

    <!-- ============================================================
       FEATURED BANNER IMAGE & ARTICLE CONTENT
       ============================================================ -->
    <section>
      <?php if ($banner_img): ?>
        <div class="blog-banner-wrap">
          <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" class="blog-banner-img">
        </div>
      <?php endif; ?>

      <div class="blog-article-content">
        <?php the_content(); ?>
      </div>

      <!-- Author & Social Share Footer -->
      <div class="blog-author-footer">
        <div class="blog-author-info">
          <div class="blog-author-avatar">🌿</div>
          <div>
            <strong class="blog-author-name">Garden Basket Hub Team</strong>
            <span class="blog-author-title">Jaipur Nursery & Urban Farming Experts</span>
          </div>
        </div>

        <a href="https://wa.me/919876543210?text=<?php echo urlencode('Check out this article: ' . get_permalink()); ?>"
          target="_blank" class="btn-primary share-btn">
          💬 Share on WhatsApp
        </a>
      </div>
    </section>
  </article>

  <!-- ============================================================
     RELATED BLOG POSTS
     ============================================================ -->
  <section class="section-sand">
    <div class="related-blogs-container">
      <div class="section-header">
        <div>
          <p class="section-label">More Planting Advice</p>
          <h2 class="section-title">Related Gardening Articles</h2>
        </div>
        <a href="/blog/" class="btn-ghost">View All Guides ➔</a>
      </div>

      <div class="related-blogs-grid">
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
            <div class="product-card related-blog-card" data-permalink="<?php the_permalink(); ?>"
              onclick="window.location.href='<?php the_permalink(); ?>';">
              <span class="related-blog-date"><?php echo get_the_date('M j, Y'); ?></span>
              <h3 class="related-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="related-blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" class="btn-ghost related-blog-link">Read Guide ➔</a>
            </div>
          <?php endwhile;
          wp_reset_postdata(); endif; ?>
      </div>
    </div>
  </section>

<?php endwhile; ?>

</main>
<?php get_footer(); ?>