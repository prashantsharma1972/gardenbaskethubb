<?php
/**
 * Single Reel Template — Garden Basket Hub
 */

get_header();
?>

<?php while (have_posts()) : the_post();
    $r_id = get_the_ID();
    $video_url = get_post_meta($r_id, 'reel_video_url', true);
    if (!$video_url && function_exists('get_field')) $video_url = get_field('reel_video_url');
    
    $view_count = get_post_meta($r_id, 'reel_view_count', true);
    if (!$view_count && function_exists('get_field')) $view_count = get_field('reel_view_count');
    if (!$view_count) $view_count = '3.4K views';

    $cover_img = get_the_post_thumbnail_url($r_id, 'large');
?>

<section class="page-hero" style="padding-top:140px;">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · <a href="<?php echo esc_url(home_url('/reels/')); ?>">Reels</a> · Guide</p>
  <h1><?php the_title(); ?></h1>
  <p><span><?php echo esc_html($view_count); ?></span> · Expert tips from Jaipur Nursery</p>
</section>

<section>
  <div style="max-width:540px;margin:0 auto;text-align:center;">
    <div style="aspect-ratio:9/16;background:var(--soil);border-radius:8px;overflow:hidden;position:relative;box-shadow:0 12px 36px rgba(0,0,0,0.2);">
      <?php if ($video_url): ?>
        <iframe src="<?php echo esc_url($video_url); ?>" style="width:100%;height:100%;border:none;" allowfullscreen></iframe>
      <?php else: ?>
        <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--sand);padding:24px;<?php echo $cover_img ? "background-image:url('" . esc_url($cover_img) . "');background-size:cover;background-position:center;" : ''; ?>">
          <div style="font-size:4rem;margin-bottom:12px;">🎥 🌱</div>
          <h3 style="font-family:var(--f-display);"><?php the_title(); ?></h3>
          <p style="font-size:0.9rem;margin-top:8px;opacity:0.9;">Watch our full guide on YouTube & Instagram</p>
          <a href="https://youtube.com" target="_blank" class="btn-primary" style="margin-top:20px;background:var(--leaf);">Watch Video Guide ➔</a>
        </div>
      <?php endif; ?>
    </div>

    <div style="margin-top:32px;text-align:left;line-height:1.8;color:#5c4436;">
      <h3 style="font-family:var(--f-display);color:var(--soil);margin-bottom:12px;">About this guide</h3>
      <?php the_content(); ?>
    </div>

    <div style="margin-top:40px;">
      <a href="<?php echo esc_url(home_url('/reels/')); ?>" class="btn-primary">
        ➔ Explore All Gardening Reels
      </a>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
