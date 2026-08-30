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
  <main>
    <?php while (have_posts()):
      the_post();
      $r_id = get_the_ID();
      $video_url = get_post_meta($r_id, 'reel_video_url', true);
      if (!$video_url && function_exists('get_field')) $video_url = get_field('reel_video_url');

      $view_count = get_post_meta($r_id, 'reel_view_count', true);
      if (!$view_count && function_exists('get_field')) $view_count = get_field('reel_view_count');
      if (!$view_count) $view_count = '3.4K views';

      $cover_img = get_the_post_thumbnail_url($r_id, 'large');
      ?>

      <!-- BREADCRUMB -->
      <section class="pdp-breadcrumb-bar">
        <div class="pdp-breadcrumb-inner">
          <p class="breadcrumb-item"><a href="/reels">Reels</a></p>
          <span class="breadcrumb-sep">&rsaquo;</span>
          <p class="breadcrumb-item breadcrumb-current"><?php echo the_title(); ?></p>
        </div>
      </section>

      <!-- REEL HERO -->
      <section class="single-reel-hero">
        <h1 class="single-reel-title"><?php echo the_title(); ?></h1>
        <div class="single-reel-meta">
          <span>👁️ <?php echo esc_html($view_count); ?></span>
          <span>Expert tips from Jaipur Nursery</span>
        </div>
      </section>

      <!-- REEL CONTENT -->
      <section class="single-reel-content">
        <div class="single-reel-layout">

          <!-- VIDEO COLUMN -->
          <div class="single-reel-video-col">
            <?php if ($video_url): ?>
              <div class="single-reel-embed">
                <iframe src="<?php echo esc_url($video_url); ?>" allowfullscreen></iframe>
              </div>
            <?php else: ?>
              <div class="reel-placeholder" <?php echo $cover_img ? "style=\"background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('" . esc_url($cover_img) . "');\"" : ''; ?>>
                <div class="reel-placeholder-icon">🎥 🌱</div>
                <h3 class="reel-placeholder-title"><?php the_title(); ?></h3>
                <p class="reel-placeholder-sub">Watch our full guide on YouTube &amp; Instagram</p>
                <a href="https://youtube.com" target="_blank" class="btn-reel-watch">Watch Video Guide ➔</a>
              </div>
            <?php endif; ?>
          </div>

          <!-- INFO COLUMN -->
          <div class="single-reel-info">
            <h3 class="single-reel-info-heading">About this guide</h3>
            <div class="single-reel-body">
              <?php the_content(); ?>
            </div>
            <div class="single-reel-actions">
              <a href="/reels/" class="btn-primary">
                ➔ Explore All Gardening Reels
              </a>
            </div>
          </div>

        </div>
      </section>

    <?php endwhile; ?>
  </main>

  <?php get_footer(); ?>
</body>
</html>