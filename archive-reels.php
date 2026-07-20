<?php
/**
 * Gardening Reels Gallery Archive Template
 */

get_header();
?>

<!-- ============================================================
     REELS HERO
     ============================================================ -->
<section class="page-hero">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Reels</p>
  <h1>Watch the <em>garden</em> grow.</h1>
  <p>Trending reels from our nursery, customer gardens, and quick gardening tips you can use today.</p>
</section>

<!-- ============================================================
     REELS GRID & FILTERS
     ============================================================ -->
<section>
  <div class="reel-filters">
    <div class="reel-pill active">All Reels</div>
    <div class="reel-pill">🌱 Seedling Care</div>
    <div class="reel-pill">🥬 Monsoon Veg</div>
    <div class="reel-pill">🪴 Customer Gardens</div>
    <div class="reel-pill">🛠️ Tool Demos</div>
    <div class="reel-pill">🌿 Composting</div>
  </div>

  <div class="reels-grid">
    <?php
    $reels_query = new WP_Query(array(
        'post_type' => 'reels',
        'posts_per_page' => 12,
    ));

    if ($reels_query->have_posts()):
      while ($reels_query->have_posts()): $reels_query->the_post();
        $r_id = get_the_ID();
        $video_url = get_field('reel_video_url');
        $view_count = get_field('reel_view_count') ? get_field('reel_view_count') : '3.2K views';
        $cover_img = get_the_post_thumbnail_url($r_id, 'large');
    ?>
      <div class="reel-card" style="<?php echo $cover_img ? "background-image:url('" . esc_url($cover_img) . "');background-size:cover;" : ''; ?>">
        <div class="play">▶️</div>
        <div class="meta">
          <h4><?php the_title(); ?></h4>
          <span><?php echo esc_html($view_count); ?></span>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>

    <?php else: ?>
      <!-- Static Demo Cards matching sample-code.php -->
      <div class="reel-card r1"><div class="play">▶️</div><div class="meta"><h4>Monsoon gardening tips</h4><span>2.4K views</span></div></div>
      <div class="reel-card r2"><div class="play">▶️</div><div class="meta"><h4>How to repot your plant</h4><span>3.1K views</span></div></div>
      <div class="reel-card r3"><div class="play">▶️</div><div class="meta"><h4>Terracotta pots from Jaipur</h4><span>1.8K views</span></div></div>
      <div class="reel-card r4"><div class="play">▶️</div><div class="meta"><h4>Seed saving 101</h4><span>5.2K views</span></div></div>
      <div class="reel-card r5"><div class="play">▶️</div><div class="meta"><h4>Customer garden tour</h4><span>2.9K views</span></div></div>
      <div class="reel-card r6"><div class="play">▶️</div><div class="meta"><h4>Composting at home</h4><span>4.1K views</span></div></div>
      <div class="reel-card r7"><div class="play">▶️</div><div class="meta"><h4>Why your seedlings die</h4><span>6.7K views</span></div></div>
      <div class="reel-card r8"><div class="play">▶️</div><div class="meta"><h4>Best monsoon vegetables</h4><span>3.5K views</span></div></div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
