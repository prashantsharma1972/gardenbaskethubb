<?php
/**
 * Single Blog Post View — Garden Basket Hub
 */

get_header();
?>

<?php while (have_posts()) : the_post();
  $b_id = get_the_ID();
  $read_time = get_post_meta($b_id, 'read_time', true);
  if (!$read_time && function_exists('get_field')) $read_time = get_field('read_time', $b_id);
  if (!$read_time) $read_time = '5 min read';

  $banner_img = get_the_post_thumbnail_url($b_id, 'large');
  if (!$banner_img && function_exists('get_field')) $banner_img = get_field('banner_image', $b_id);
  $categories = get_the_category($b_id);
  $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening Guide';
?>

<!-- ============================================================
     BLOG POST HERO
     ============================================================ -->
<article>
  <header class="page-hero" style="padding:160px 80px 60px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);text-align:center;">
    <p class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · 
      <a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>">Blog</a> · 
      <?php echo esc_html($cat_name); ?>
    </p>

    <h1 style="font-size:clamp(2.2rem, 4vw, 3.5rem);max-width:860px;margin:0 auto 20px;line-height:1.2;"><?php the_title(); ?></h1>

    <div style="display:flex;align-items:center;justify-content:center;gap:20px;font-family:var(--f-mono);font-size:0.8rem;color:var(--clay);letter-spacing:0.06em;flex-wrap:wrap;">
      <span>📅 <?php echo get_the_date('F j, Y'); ?></span>
      <span>⏱️ <?php echo esc_html($read_time); ?></span>
      <span>✍️ Garden Basket Hub Nursery Team</span>
    </div>
  </header>

  <!-- ============================================================
       FEATURED BANNER IMAGE & ARTICLE CONTENT
       ============================================================ -->
  <section style="padding:0 80px 80px;">
    <?php if ($banner_img): ?>
      <div style="max-width:900px;margin:0 auto 48px;border-radius:12px;overflow:hidden;box-shadow:0 12px 32px rgba(44,26,14,0.08);">
        <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" style="width:100%;max-height:500px;object-fit:cover;display:block;">
      </div>
    <?php endif; ?>

    <div style="max-width:760px;margin:0 auto;line-height:1.8;font-size:1.05rem;color:#4a382c;" class="blog-article-content">
      <?php the_content(); ?>
    </div>

    <!-- Author & Social Share Footer -->
    <div style="max-width:760px;margin:56px auto 0;padding-top:32px;border-top:1px solid rgba(44,26,14,0.1);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px;">
      <div style="display:flex;align-items:center;gap:16px;">
        <div style="width:48px;height:48px;border-radius:50%;background:var(--leaf);color:var(--white);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🌿</div>
        <div>
          <strong style="display:block;font-family:var(--f-display);color:var(--soil);font-size:1.05rem;">Garden Basket Hub Team</strong>
          <span style="font-size:0.85rem;color:var(--clay);">Jaipur Nursery & Urban Farming Experts</span>
        </div>
      </div>

      <a href="https://wa.me/919876543210?text=<?php echo urlencode('Check out this article: ' . get_permalink()); ?>" target="_blank" class="btn-primary" style="padding:10px 20px;font-size:0.85rem;">
        💬 Share on WhatsApp
      </a>
    </div>
  </section>
</article>

<!-- ============================================================
     RELATED BLOG POSTS
     ============================================================ -->
<section style="background:var(--sand);padding:80px;">
  <div style="max-width:1000px;margin:0 auto;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:40px;">
      <div>
        <p class="section-label">More Planting Advice</p>
        <h2 class="section-title">Related Gardening Articles</h2>
      </div>
      <a href="<?php echo esc_url(gbh_get_page_url('blog')); ?>" class="btn-ghost">View All Guides ➔</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(2, 1fr);gap:28px;" class="about-story-cards">
      <?php
      $related_query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'post__not_in' => array($b_id),
      ));

      if ($related_query->have_posts()):
        while ($related_query->have_posts()): $related_query->the_post();
          $rel_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
      ?>
          <div style="background:var(--white);padding:28px;border-radius:8px;border:1px solid rgba(44,26,14,0.08);cursor:pointer;" class="product-card" data-permalink="<?php the_permalink(); ?>">
            <span style="font-family:var(--f-mono);font-size:0.7rem;color:var(--leaf);letter-spacing:0.1em;text-transform:uppercase;display:block;margin-bottom:8px;"><?php echo get_the_date('M j, Y'); ?></span>
            <h3 style="font-family:var(--f-display);font-size:1.2rem;color:var(--soil);margin-bottom:10px;"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h3>
            <p style="font-size:0.88rem;color:#7a6050;line-height:1.6;margin-bottom:16px;"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn-ghost" style="font-size:0.85rem;color:var(--leaf);">Read Guide ➔</a>
          </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>