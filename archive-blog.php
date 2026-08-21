<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
    <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.bundle.js"></script>
    <?php get_header(); ?>
<main class="main--container">

<!-- ============================================================
     BLOG HERO SECTION
     ============================================================ -->
<section class="page-hero doc-hero doc-hero-center">
  <p class="breadcrumb"><a href="/">Home</a> · Gardening Guides & Blog</p>
  <h1 class="hero-title">Gardening <em>Guides</em> & Tips.</h1>
  <p class="hero-desc">
    Expert potting mix ratios, monsoon plant care tips, seedling guides, and organic urban farming advice from our
    Jaipur nursery team.
  </p>
</section>

<!-- ============================================================
     BLOG POSTS CATALOG GRID
     ============================================================ -->
<section>
  <div class="about-story-cards">
    <?php
    // Custom query to fetch posts (blog entries) if not using default loop
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $blog_query = new WP_Query(array(
      'post_type' => 'post',
      'posts_per_page' => 9,
      'paged' => $paged
    ));

    if ($blog_query->have_posts()):
      while ($blog_query->have_posts()):
        $blog_query->the_post();
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
        $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening';
        ?>
        <article class="product-card featured-blog-card" data-permalink="<?php the_permalink(); ?>"
          onclick="window.location.href='<?php the_permalink(); ?>';">
          <div>
            <div class="product-img blog-img-wrap">
              <?php if ($banner_img): ?>
                <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" class="blog-img">
              <?php else: ?>
                <div class="blog-img-fallback">📖</div>
              <?php endif; ?>
              <span class="badge-new badge-cat"><?php echo esc_html($cat_name); ?></span>
            </div>

            <div class="product-body blog-card-body">
              <div class="blog-meta-header">
                <span><?php echo get_the_date('M j, Y'); ?></span>
                <span>⏱️ <?php echo esc_html($read_time); ?></span>
              </div>

              <h2 class="blog-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>

              <div class="blog-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
              </div>
            </div>
          </div>

          <div class="blog-card-footer">
            <a href="<?php the_permalink(); ?>" class="btn-ghost btn-ghost-small">
              Read Full Article ➔
            </a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="blog-not-found">
        <p>No blog posts found. Check back soon for fresh gardening guides!</p>
      </div>
    <?php endif;
    wp_reset_postdata(); ?>
  </div>

  <!-- Pagination -->
  <div class="pagination-wrapper">
    <?php
    echo paginate_links(array(
      'total' => $blog_query->max_num_pages,
      'prev_text' => '← Previous',
      'next_text' => 'Next →',
    ));
    ?>
  </div>
</section>

</main>
<?php get_footer(); ?>