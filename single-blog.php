<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blog/blog.css">
  <script type="module" defer fetchpriority="low" src="/wp-content/themes/gardenbaskethubb/build/blog/blog.bundle.js"></script>
  <?php get_header(); ?>
  
  <main>
    <?php while (have_posts()):
      the_post();
      $b_id = get_the_ID();
      $read_time = get_post_meta($b_id, 'read_time', true);
      if (!$read_time && function_exists('get_field')) {
        $read_time = get_field('read_time', $b_id);
      }
      if (!$read_time) {
        $read_time = '5 min read';
      }

      $banner_img = get_the_post_thumbnail_url($b_id, 'large');
      if (!$banner_img && function_exists('get_field')) {
        $banner_img = get_field('banner_image', $b_id);
      }
      $categories = get_the_category($b_id);
      $cat_name = (!empty($categories)) ? $categories[0]->name : 'Gardening Guide';
      ?>

      <section class="breadcrumb-header my-6 lg:my-10 lg:space-y-14 h-[50px] flex items-center">
          <div class="flexdiv flex 2xl:pl-[50px] xl:pl-[30px] pl-5 items-center">
              <p class="text-[#b8b8b8] text-[10px] sm:text-[16px]">
                  <a class="text-[#b8b8b8]" href="/blog">Blogs</a>
              </p>
              <p class="text-[#b8b8b8] px-[10px] text-[18px]"> >> </p>
              <p class="current text-[#61baf1] text-[10px] sm:text-[16px]">
                  <?php echo the_title(); ?>
              </p>
          </div>
      </section>

      <section class="banner_section max-w-[1820px] mx-auto sm:mt-[50px] lg:mt-[100px]">
          <div class="relative pr-5 lg:pr-0 pl-5 lg:px-5 lg:grid lg:grid-cols-[2fr_5fr_50px] lg:gap-10">
              <div></div>
              <div class="flex flex-col sm:grid sm:grid-cols-[1fr_auto_1fr] lg:grid-cols-[1fr_auto_1fr] align-top justify-start relative">
                  <div class="banner-content order-1 sm:order-[unset] relative bg-white col-start-1 col-end-3 row-start-1 h-fit lg:mt-5 pb-5 sm:pb-8">
                      <h1 class="font-mulish pr-[10px] text-[#434343] font-medium text-xl sm:text-2xl xl:text-4xl">
                          <?php echo the_title(); ?>
                      </h1>
                  </div>
                  <div class="author-name order-3 mt-5 sm:mt-0 sm:order-[unset] sm:absolute bottom-0 left-0 flex items-start gap-4">
                      <div>
                          <strong class="blog-author-name text-sm text-gray-700">Garden Basket Hub Team</strong>
                          <div class="blog-author-title text-xs text-gray-500">Nursery Experts</div>
                          <div class="text-xs text-gray-500 mt-1">
                              <span>📅 <?php echo get_the_date('F j, Y'); ?></span> | 
                              <span>⏱️ <?php echo esc_html($read_time); ?></span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="content_section max-w-[1820px] mx-auto mt-10 px-5 lg:px-20">
          <?php if ($banner_img): ?>
              <div class="blog-banner mb-10">
                  <img src="<?php echo esc_url($banner_img); ?>" alt="<?php the_title(); ?>" class="w-full rounded-lg shadow-md object-cover">
              </div>
          <?php endif; ?>
          <div class="blog-content prose max-w-none text-gray-800">
              <?php the_content(); ?>
          </div>
      </section>

      <!-- RELATED BLOG POSTS -->
      <section class="related_section max-w-[1820px] mx-auto mt-20 px-5 lg:px-20 bg-gray-50 py-10">
          <div class="section-header mb-10 flex justify-between items-center">
              <div>
                  <p class="section-label text-sm uppercase tracking-widest text-gray-500 mb-2">More Planting Advice</p>
                  <h2 class="section-title text-3xl font-bold text-gray-800">Related Gardening Articles</h2>
              </div>
              <a href="/blog/" class="text-blue-500 font-medium hover:underline">View All Guides ➔</a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                      <div class="related-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                          <?php if ($rel_thumb): ?>
                              <img src="<?php echo esc_url($rel_thumb); ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover">
                          <?php endif; ?>
                          <div class="p-6">
                              <span class="text-xs text-gray-500 block mb-2"><?php echo get_the_date('M j, Y'); ?></span>
                              <h3 class="text-xl font-semibold text-gray-800 mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                              <p class="text-gray-600 mb-4"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
                              <a href="<?php the_permalink(); ?>" class="text-blue-500 font-medium hover:underline">Read Guide ➔</a>
                          </div>
                      </div>
                  <?php endwhile;
                  wp_reset_postdata();
              endif; ?>
          </div>
      </section>

    <?php endwhile; ?>
  </main>
  
  <?php get_footer(); ?>
</body>
</html>