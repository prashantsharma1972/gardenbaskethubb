<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/singleReels/singleReels.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/singleReels/singleReels.css">
  <script type="module" defer fetchpriority="low"
    src="/wp-content/themes/gardenbaskethubb/build/singleReels/singleReels.bundle.js"></script>
  <?php get_header(); ?>
  <main class="main--container">

    <?php while (have_posts()):
      the_post();
      $r_id = get_the_ID();
      $video_url = get_post_meta($r_id, 'reel_video_url', true);
      if (!$video_url && function_exists('get_field'))
        $video_url = get_field('reel_video_url');

      $view_count = get_post_meta($r_id, 'reel_view_count', true);
      if (!$view_count && function_exists('get_field'))
        $view_count = get_field('reel_view_count');
      if (!$view_count)
        $view_count = '3.4K views';

      $cover_img = get_the_post_thumbnail_url($r_id, 'large');
      ?>

      <section class="page-hero hero-pt-140">
        <p class="breadcrumb"><a href="/">Home</a> · <a href="/reels/">Reels</a> · Guide</p>
        <h1><?php the_title(); ?></h1>
        <p><span><?php echo esc_html($view_count); ?></span> · Expert tips from Jaipur Nursery</p>
      </section>

      <section>
        <div class="single-reel-container">
          <div class="reel-video-wrapper">
            <?php if ($video_url): ?>
              <iframe src="<?php echo esc_url($video_url); ?>" class="reel-iframe" allowfullscreen></iframe>
            <?php else: ?>
              <div class="reel-placeholder"
                style="<?php echo $cover_img ? "background-image:url('" . esc_url($cover_img) . "');" : ''; ?>">
                <div class="reel-placeholder-icon">🎥 🌱</div>
                <h3 class="reel-placeholder-title"><?php the_title(); ?></h3>
                <p class="reel-placeholder-desc">Watch our full guide on YouTube & Instagram</p>
                <a href="https://youtube.com" target="_blank" class="btn-primary reel-btn-leaf">Watch Video Guide ➔</a>
              </div>
            <?php endif; ?>
          </div>

          <div class="reel-info">
            <h3 class="reel-info-title">About this guide</h3>
            <?php the_content(); ?>
          </div>

          <div class="reel-actions">
            <a href="/reels/" class="btn-primary">
              ➔ Explore All Gardening Reels
            </a>
          </div>
        </div>
      </section>

    <?php endwhile; ?>

  </main>
  <?php get_footer(); ?>