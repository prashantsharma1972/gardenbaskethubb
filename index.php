<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="style" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
    <link rel="stylesheet" href="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.css">
    <script type="module" defer fetchpriority="low"
        src="/wp-content/themes/gardenbaskethubb/build/blogs/blogs.bundle.js"></script>
    <?php get_header(); ?>
    <main class="main--container">

        <section class="banner-section">
            <div class="container">
                <h1 class="main_heading">Our Blogs</h1>
                <p class="sub_description">Explore Our Gardening Blogs & Tips</p>
            </div>
        </section>

        <section class="blogs">
            <div class="filter-section">
                <div class="filters-type-with-search">
                    <div data-type="category" class="filter-type">
                        <span class="icons">
                            <svg class="add">
                                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/blogs.svg#add'>
                            </svg>
                            <svg class="subtract">
                                <use href='/wp-content/themes/gardenbaskethubb/public/sprites/blogs.svg#hyphen'>
                            </svg>
                        </span>
                        Category
                    </div>
                    <div class="search">
                        <svg class="search__icon">
                            <use href='/wp-content/themes/gardenbaskethubb/public/sprites/blogs.svg#search'>
                        </svg>
                        <input placeholder="Search" type="text" name="search-blogs" id="search-blogs">
                    </div>
                </div>
                <div class=" filters-container">
                    <div data-type="category" class="filter-container">
                        <!-- Query Blogs Tags -->
                        <?php
                        $post_tags = get_tags(['taxonomy' => 'post_tag']); // Using default post_tag
                        if (!empty($post_tags)) {
                            foreach ($post_tags as $post_tag) {
                                echo '<span class="filter" data-title="' . $post_tag->name . '" data-id="' . $post_tag->term_id . '">' . $post_tag->name . '</span>';
                            }
                        }
                        ?>
                    </div>
                    <div class="filter-btns">
                        <button class="clear">Clear All</button>
                        <button class="results">Show Results</button>
                    </div>
                </div>
            </div>
            <div class="filter-sortby">
                <p class="sort-by-heading"><span class="sort-by">Sort By: <span id="sort-by">Latest</span></span>
                    <span class="svg-arrow"><svg width="13" height="13" class="drop-down"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></span>
                </p>
                <div class="sorting">
                    <p data-attr="Latest" data-find="desc">Latest</p>
                    <p data-attr="Oldest" data-find="asc">Oldest</p>
                </div>
            </div>
            <div class="loading" id="blog-loader">
                <svg xmlns="http://ww.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200px"
                    height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <defs>
                        <linearGradient id="myGradient2" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#FF80AD" />
                            <stop offset="100%" stop-color="#FFD164" />
                        </linearGradient>
                    </defs>
                    <g transform="translate(0 -7.5)">
                        <circle cx="50" cy="41" r="10" fill="#f5f5f5">
                            <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite"
                                keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                            <animate attributeName="r" dur="1s" repeatCount="indefinite" calcMode="spline"
                                keyTimes="0;0.5;1" values="0;15;0" keySplines="0.2 0 0.8 1;0.2 0 0.8 1"></animate>
                        </circle>
                        <circle cx="50" cy="41" r="10" fill="url(#myGradient2)">
                            <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite"
                                keyTimes="0;1" values="180 50 50;540 50 50"></animateTransform>
                            <animate attributeName="r" dur="1s" repeatCount="indefinite" calcMode="spline"
                                keyTimes="0;0.5;1" values="15;0;15" keySplines="0.2 0 0.8 1;0.2 0 0.8 1"></animate>
                        </circle>
                    </g>
                </svg>
            </div>
            <div class="resource-list">
                <?php while (have_posts()) {
                    the_post();
                    $Permalinks = get_permalink($post->ID);
                    // Default WordPress Thumbnail
                    $listing_image = get_the_post_thumbnail_url($post->ID, 'gbh-card') ?: '/wp-content/themes/gardenbaskethubb/public/images/default-blog.webp';
                    ?>
                    <div class="resource-data">
                        <div class="blog-feature-image">
                            <img width="832" height="419" loading="lazy" src="<?php echo esc_url($listing_image); ?>"
                                alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: get_the_title()); ?>"
                                class="resource-img">
                        </div>
                        <div class="blog-content">
                            <div class="blog-timeline">
                                <p>
                                    <span class="svg-image"><svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                            height="15px" viewBox="0 0 24 24">
                                            <g fill="none" fill-rule="evenodd" stroke="#200E32" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" transform="translate(3 2)">
                                                <line x1=".093" x2="17.917" y1="7.404" y2="7.404"></line>
                                                <line x1="13.442" x2="13.451" y1="11.31" y2="11.31"></line>
                                                <line x1="9.005" x2="9.014" y1="11.31" y2="11.31"></line>
                                                <line x1="4.558" x2="4.567" y1="11.31" y2="11.31"></line>
                                                <line x1="13.442" x2="13.451" y1="15.196" y2="15.196"></line>
                                                <line x1="9.005" x2="9.014" y1="15.196" y2="15.196"></line>
                                                <line x1="4.558" x2="4.567" y1="15.196" y2="15.196"></line>
                                                <line x1="13.044" x2="13.044" y1="3.291" y2="3.291"></line>
                                                <line x1="4.966" x2="4.966" y1="3.291" y2="3.291"></line>
                                                <path
                                                    d="M13.2382655,1.57919622 L4.77096342,1.57919622 C1.83427331,1.57919622 0,3.21513002 0,6.22222222 L0,15.2718676 C0,18.3262411 1.83427331,20 4.77096342,20 L13.2290015,20 C16.1749556,20 18,18.3546099 18,15.3475177 L18,6.22222222 C18.0092289,3.21513002 16.1842196,1.57919622 13.2382655,1.57919622 Z">
                                                </path>
                                            </g>
                                        </svg></span>
                                    <span class="date-time">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </p>
                            </div>

                            <div class="blog-title">
                                <h2 class="blog-heading">
                                    <?php the_title(); ?>
                                </h2>
                            </div>

                            <div class="blog-description">
                                <p>
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            </div>

                            <div class="author-div flex-div">
                                <p>
                                    <a href="<?php echo $Permalinks; ?>">
                                        <span>Explore</span>
                                        <span><svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.768555 6.06467H12.7614M12.7614 6.06467L7.36464 0.66748M12.7614 6.06467L7.36464 11.4619"
                                                    stroke="black" stroke-width="1.19922" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </section>

    </main>
    <?php get_footer(); ?>