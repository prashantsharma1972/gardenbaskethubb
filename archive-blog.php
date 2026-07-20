<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href='/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css?a8'>
    <script type="module" defer src='/wp-content/themes/gardenbaskethubb/build/blogs/blogs.bundle.js?a8'></script>
    <?php
    $homeUrl = get_home_url();
    get_header();
    ?>

    <main class="main--container">

        <section class="blog-header-section">
            <div class="blog-img-text-container">
                <img src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/home-banner-1.webp" alt="">
                <div class="text-container">
                    <p>I make it Simple,</p>
                    <p> I make it Valuable,and</p>
                    <p> I do it for the Long term.</p>
                </div>
            </div>
        </section>

        <section class="blogs">
            <div class="resource-list">
                <?php
                while (have_posts()) {
                    the_post();
                    $Permalinks = get_permalink($post->ID);
                    ?>
                    <div class="resource">
                        <div class="date">
                            <p> <?php echo get_the_date(); ?>
                            </p>
                            <div class="read-time">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_640_2281)">
                                        <path
                                            d="M11.2366 2.64797L9.97703 1.38844C9.79396 1.20537 9.49717 1.20537 9.31413 1.38844C9.13108 1.57151 9.13105 1.8683 9.31413 2.05134L9.61244 2.34966L9.00067 2.96142C8.20431 2.29706 7.23602 1.896 6.20313 1.80265V0.9375H6.625C6.88389 0.9375 7.09375 0.727641 7.09375 0.46875C7.09375 0.209859 6.88389 0 6.625 0H4.84375C4.58486 0 4.375 0.209859 4.375 0.46875C4.375 0.727641 4.58486 0.9375 4.84375 0.9375H5.26563V1.80265C2.69397 2.03505 0.625 4.19456 0.625 6.89062C0.625 9.71442 2.91018 12 5.73438 12C8.55817 12 10.8438 9.71482 10.8438 6.89062C10.8438 5.68334 10.4276 4.54017 9.66358 3.62433L10.2753 3.01256L10.5737 3.31088C10.7567 3.49392 11.0535 3.49395 11.2366 3.31088C11.4196 3.12783 11.4196 2.83104 11.2366 2.64797ZM5.73438 11.0625C3.43401 11.0625 1.5625 9.19099 1.5625 6.89062C1.5625 4.59026 3.43401 2.71875 5.73438 2.71875C8.03474 2.71875 9.90625 4.59026 9.90625 6.89062C9.90625 9.19099 8.03477 11.0625 5.73438 11.0625ZM8.17007 6.89062C8.17007 7.14952 7.96021 7.35938 7.70132 7.35938H5.7344C5.47551 7.35938 5.26565 7.14952 5.26565 6.89062V4.13262C5.26565 3.87373 5.47551 3.66387 5.7344 3.66387C5.99329 3.66387 6.20315 3.87373 6.20315 4.13262V6.42188H7.70132C7.96021 6.42188 8.17007 6.63173 8.17007 6.89062Z"
                                            fill="#212121" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_640_2281">
                                            <rect width="12" height="12" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Read Time : <span><?php echo get_field("read_time"); ?></span>
                            </div>
                        </div>
                        <div class="resource-img">
                            <img src="<?php echo get_field("banner_image"); ?>" alt="">
                        </div>
                        <h5 class="resource-heading">
                            <?php the_title() ?>
                        </h5>
                        <div class="resource-content">
                            <p>
                                <?php echo get_the_excerpt(); ?>
                            </p>
                        </div>
                        <div class="resource-btn">
                            <a href="<?php echo $Permalinks ?>" class="anim-button"><b>Read</b>
                                <div></div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

    </main>

    <?php get_footer(); ?>

    </body>

</html>