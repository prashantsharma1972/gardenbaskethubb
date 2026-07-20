<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href='/wp-content/themes/gardenbaskethubb/build/blog/blog.css?a8'>
    <script type="module" defer src='/wp-content/themes/gardenbaskethubb/build/blog/blog.bundle.js?a8'></script>

    <?php
    $homeUrl = get_home_url();
    get_header();
    ?>

    <main class="main--container">

        <section class="hero-section">
            <div class="heading-content">
                <h4>
                    <?php the_title(); ?>
                </h4>
                <div class="blog-info-container">
                    <div class="blog-detail-author-date">
                        <div class="author-icon">
                            <img src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/author-img.webp"
                                width="45" height="46" alt="gardenbaskethubb">
                        </div>
                        <div class="date-view-container">
                            <p class="author-name">gardenbaskethubb</p>
                            <span class="date">
                                <?php echo get_the_date(); ?>
                            </span>

                        </div>
                    </div>
                    <div class="share-post">

                        <a data-link="<?php echo get_permalink(); ?>" id="copylink" class="copylink">
                            <div class="copied_text">
                                <p class="link_copied">Copied</p>
                            </div>
                            Share this post
                        </a>

                    </div>
                </div>
                <div class="audio-heading">
                    <p>Listen to the content</p>
                </div>
                <div class="audio-container">

                    <div class="progress-bar">
                        <div class="progress-bar-fill"></div>
                    </div>
                    <button class="play-pause-btn" aria-label="Play-Pause">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 1C5.925 1 1 5.925 1 12C1 18.075 5.925 23 12 23C18.075 23 23 18.075 23 12C23 5.925 18.075 1 12 1ZM17.183 13.415L10.4505 17.302C10.1945 17.4495 9.914 17.5235 9.6335 17.5235C9.353 17.5235 9.0725 17.4495 8.8165 17.302C8.305 17.0065 7.9995 16.478 7.9995 15.887V8.113C7.9995 7.5225 8.305 6.9935 8.8165 6.698C9.328 6.4025 9.9385 6.4025 10.45 6.698L17.1825 10.585C17.694 10.8805 17.9995 11.409 17.9995 12C17.9995 12.591 17.6945 13.1195 17.183 13.415Z"
                                fill="white" />
                        </svg>
                    </button>
                    <button class="control-btn mute-btn" aria-label="Mute">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.3596 19.3599C18.1026 19.3599 17.8456 19.2609 17.6506 19.0649C17.2606 18.6729 17.2626 18.0399 17.6546 17.6499C19.1666 16.1479 19.9996 14.1419 19.9996 11.9999C19.9996 9.8579 19.1666 7.8519 17.6546 6.3499C17.2626 5.9599 17.2606 5.3279 17.6506 4.9349C18.0396 4.5429 18.6716 4.5409 19.0646 4.9309C20.9576 6.8119 21.9996 9.3219 21.9996 11.9999C21.9996 14.6779 20.9576 17.1879 19.0646 19.0689C18.8696 19.2629 18.6146 19.3599 18.3596 19.3599Z"
                                fill="white" />
                            <path
                                d="M15.5296 16.53C15.2716 16.53 15.0136 16.431 14.8186 16.233C14.4296 15.84 14.4336 15.207 14.8266 14.819C15.5716 14.082 15.9996 13.054 15.9996 12C15.9996 10.946 15.5716 9.91798 14.8266 9.18098C14.4336 8.79298 14.4306 8.15998 14.8186 7.76698C15.2066 7.37498 15.8396 7.37098 16.2326 7.75898C17.3556 8.86898 17.9996 10.415 17.9996 12C17.9996 13.585 17.3556 15.131 16.2326 16.241C16.0376 16.434 15.7836 16.53 15.5296 16.53Z"
                                fill="white" />
                            <path
                                d="M12 21.9999C11.74 21.9999 11.484 21.8979 11.293 21.7069L6.586 16.9999H4C2.897 16.9999 2 16.1029 2 14.9999V8.99992C2 7.89692 2.897 6.99992 4 6.99992H6.586L11.293 2.29292C11.579 2.00592 12.009 1.92092 12.383 2.07592C12.757 2.23092 13 2.59592 13 2.99992V20.9999C13 21.4039 12.757 21.7689 12.383 21.9239C12.259 21.9749 12.129 21.9999 12 21.9999Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>

                <audio id="audio" src="<?php echo get_field('audio'); ?>"></audio>
            </div>
            <div class="banner-image">
                <div>
                    <img fetchpriority="high" width="1216" height="742" src="<?php echo get_field('banner_image'); ?>"
                        alt="<?php echo get_field('banner_alt_text'); ?>">
                </div>
            </div>
        </section>

        <section class="main-blog">

            <div class="blog-details">
                <?php the_content(); ?>
            </div>

        </section>

        <section class="newsletter-subscribe">
            <p class="form-top-heading">SIGN UP FOR NEWSLETTER</p>
            <h2>Let my journey save a mile for you!</h2>
            <p>Entrepreneurship doesn't come with a manual; the lessons I picked up along my way might help.</p>
            <form class="subscribe-form" id="cta-subscribe-form">
                <div class="subscribe-btn">
                    <div class="field-box">
                        <input type="email" name="lemail" id="form-email" placeholder="Enter your Email Address">
                    </div>
                    <button type="submit" class="button"><b>SUBSCRIBE</b></button>
                </div>
            </form>
        </section>

    </main>

    <?php get_footer(); ?>

    <?php echo get_field('schema_code'); ?>

    </body>

</html>