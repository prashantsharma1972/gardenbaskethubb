<?php
/**
 * Blog Archive / Guides Catalog Template — Garden Basket Hub
 */

get_header();
?>

<!-- ============================================================
     BLOG HERO SECTION
     ============================================================ -->
<section class="page-hero" style="padding:160px 80px 80px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);text-align:center;">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Gardening Guides & Blog</p>
  <h1 style="font-size:clamp(2.5rem, 4.5vw, 4rem);margin-bottom:20px;">Gardening <em>Guides</em> & Tips.</h1>
  <p style="font-size:1.1rem;max-width:640px;margin:0 auto 32px;color:#5c4436;line-height:1.7;">
    Expert potting mix ratios, monsoon plant care tips, seedling guides, and organic urban farming advice from our Jaipur nursery team.
  </p>
</section>

<!-- ============================================================
     BLOG POSTS CATALOG GRID
     ============================================================ -->
<section style="padding:60px 80px 100px;">
  <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:32px;" class="about-story-cards">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        $b_id = get_the_ID();
        $read_time = get_post_meta($b_id, 'read_time', true);
        if (!$read_time && function_exists('get_field')) $read_time = get_field('read_time', $b_id);
        if (!$read_time) $read_time = '5 min read';

        $banner_img = get_the_post_thumbnail_url($b_id, 'large');
        if (!$banner_img && function_exists('get_field')) $banner_img = get_field('banner_image', $b_id);
        $categories = get_the_category($b_id);
        $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening';
    ?>
        <article class="product-card" style="display:flex;flex-direction:column;justify-content:space-between;cursor:pointer;" data-permalink="<?php the_permalink(); ?>">
          <div>
            <div class="product-img" style="height:200px;background:var(--sand);position:relative;">
              <?php if ($banner_img): ?>
                <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" style="width:100%;height:100%;object-fit:cover;">
              <?php else: ?>
                📖
              <?php endif; ?>
              <span class="badge-new" style="position:absolute;top:14px;left:14px;background:var(--leaf);color:var(--white);"><?php echo esc_html($cat_name); ?></span>
            </div>

            <div class="product-body" style="padding:24px;">
              <div style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;display:flex;justify-content:space-between;align-items:center;">
                <span><?php echo get_the_date('M j, Y'); ?></span>
                <span>⏱️ <?php echo esc_html($read_time); ?></span>
              </div>

              <h2 style="font-family:var(--f-display);font-size:1.25rem;color:var(--soil);margin-bottom:10px;line-height:1.3;">
                <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
              </h2>

              <div style="font-size:0.9rem;color:#7a6050;line-height:1.6;margin-bottom:20px;">
                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
              </div>
            </div>
          </div>

          <div style="padding:0 24px 24px;">
            <a href="<?php the_permalink(); ?>" class="btn-ghost" style="font-size:0.85rem;font-weight:500;color:var(--leaf);">
              Read Full Article ➔
            </a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <div style="grid-column:1/-1;text-align:center;padding:60px;">
        <p style="font-size:1.2rem;color:var(--clay);">No blog posts found. Check back soon for fresh gardening guides!</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <div style="margin-top:56px;text-align:center;">
    <?php the_posts_pagination(array(
      'prev_text' => '← Previous',
      'next_text' => 'Next →',
    )); ?>
  </div>
</section>

<?php get_footer(); ?>