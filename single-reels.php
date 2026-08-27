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

      <section class="breadcrumb-header my-6 lg:my-10 lg:space-y-14 h-[50px] flex items-center">
          <div class="flexdiv flex 2xl:pl-[50px] xl:pl-[30px] pl-5 items-center">
              <p class="text-[#b8b8b8] text-[10px] sm:text-[16px]">
                  <a class="text-[#b8b8b8]" href="/reels">Reels</a>
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
                          <div class="text-sm text-gray-500 mt-1">
                              <span>👁️ <?php echo esc_html($view_count); ?></span> | 
                              <span>Expert tips from Jaipur Nursery</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="content_section max-w-[1820px] mx-auto mt-10 px-5 lg:px-20">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
              <div class="reel-video-wrapper bg-gray-100 rounded-lg overflow-hidden shadow-sm relative h-[600px]">
                <?php if ($video_url): ?>
                  <iframe src="<?php echo esc_url($video_url); ?>" class="absolute inset-0 w-full h-full border-none" allowfullscreen></iframe>
                <?php else: ?>
                  <div class="reel-placeholder w-full h-full flex flex-col items-center justify-center bg-cover bg-center" style="<?php echo $cover_img ? "background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('" . esc_url($cover_img) . "');" : ''; ?>">
                    <div class="text-6xl mb-4">🎥 🌱</div>
                    <h3 class="text-white text-2xl font-bold mb-2 text-center px-4"><?php the_title(); ?></h3>
                    <p class="text-gray-200 mb-6">Watch our full guide on YouTube & Instagram</p>
                    <a href="https://youtube.com" target="_blank" class="bg-[#4E8A48] hover:bg-[#2D6A28] text-white px-6 py-3 rounded-full font-medium transition">Watch Video Guide ➔</a>
                  </div>
                <?php endif; ?>
              </div>

              <div class="reel-info py-8">
                <h3 class="text-2xl font-bold text-[#2C1A0E] mb-6">About this guide</h3>
                <div class="prose max-w-none text-gray-700 mb-10">
                    <?php the_content(); ?>
                </div>

                <div class="reel-actions border-t border-gray-200 pt-8 mt-8">
                  <a href="/reels/" class="inline-block bg-[#2C1A0E] hover:bg-[#4E8A48] text-white px-8 py-3 rounded transition font-medium">
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