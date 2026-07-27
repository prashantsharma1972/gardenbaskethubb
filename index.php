<?php
/**
 * Main Template File — Garden Basket Hub Fallback
 */

get_header();
?>

<section class="page-hero">
  <div class="container">
    <h1><?php single_post_title(); ?></h1>
  </div>
</section>

<section>
  <div class="container" style="max-width:960px;margin:0 auto;">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom:40px;">
          <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:12px;">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <div class="entry-content" style="color:#5c4436;line-height:1.8;">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p>No content found.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>