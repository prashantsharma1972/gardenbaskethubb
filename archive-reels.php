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
     REELS HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="/">Home</a> · Reels</p>
  <h1>Watch the <em>garden</em> grow.</h1>
  <p>Trending reels from our nursery, customer gardens, and quick gardening tips you can use today.</p>
</section>

<!-- ============================================================
     REELS GRID
     ============================================================ -->
<section>


  <div class="reels-grid">
    <?php
    $reels_query = new WP_Query(array(
      'post_type' => 'reels',
      'posts_per_page' => 12,
    ));

    if ($reels_query->have_posts()):
      while ($reels_query->have_posts()):
        $reels_query->the_post();
        $r_id = get_the_ID();
        $video_url = get_post_meta($r_id, 'reel_video_url', true);
        if (!$video_url && function_exists('get_field'))
          $video_url = get_field('reel_video_url', $r_id);

        $view_count = get_post_meta($r_id, 'reel_view_count', true);
        if (!$view_count && function_exists('get_field'))
          $view_count = get_field('reel_view_count', $r_id);
        if (!$view_count)
          $view_count = '3.2K views';

        $cover_img = get_the_post_thumbnail_url($r_id, 'large');
        ?>
        <div class="reel-card" data-permalink="<?php the_permalink(); ?>"
          data-title="<?php echo esc_attr(get_the_title()); ?>" data-video="<?php echo esc_url($video_url); ?>"
          style="<?php echo $cover_img ? "background-image:url('" . esc_url($cover_img) . "');background-size:cover;" : ''; ?>">
          <div class="play">▶️</div>
          <div class="meta">
            <h4><?php the_title(); ?></h4>
            <span><?php echo esc_html($view_count); ?></span>
          </div>
        </div>
      <?php endwhile;
      wp_reset_postdata(); ?>

    <?php else: ?>
      <!-- Static Demo Cards -->
      <div class="reel-card r1" data-title="Monsoon gardening tips"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Monsoon gardening tips</h4><span>2.4K views</span>
        </div>
      </div>
      <div class="reel-card r2" data-title="How to repot your plant"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>How to repot your plant</h4><span>3.1K views</span>
        </div>
      </div>
      <div class="reel-card r3" data-title="Terracotta pots from Jaipur"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Terracotta pots from Jaipur</h4><span>1.8K views</span>
        </div>
      </div>
      <div class="reel-card r4" data-title="Seed saving 101" data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Seed saving 101</h4><span>5.2K views</span>
        </div>
      </div>
      <div class="reel-card r5" data-title="Customer garden tour" data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Customer garden tour</h4><span>2.9K views</span>
        </div>
      </div>
      <div class="reel-card r6" data-title="Composting at home" data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Composting at home</h4><span>4.1K views</span>
        </div>
      </div>
      <div class="reel-card r7" data-title="Why your seedlings die"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Why your seedlings die</h4><span>6.7K views</span>
        </div>
      </div>
      <div class="reel-card r8" data-title="Best monsoon vegetables"
        data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Best monsoon vegetables</h4><span>3.5K views</span>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Reel Video Modal Lightbox -->
<div id="gbh-reel-modal" class="reel-modal">
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