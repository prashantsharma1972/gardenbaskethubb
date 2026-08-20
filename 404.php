<?php
/**
 * 404 Page Not Found Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/notFound/notFound.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/notFound/notFound.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/notFound/notFound.bundle.js"></script>

    <?php get_header(); ?>

    <main class="main--container">
        <section class="notfound">
            <div class="success container pt5">
                <div class="areaText">
                    <h1 class="headingclass white-text mb0"> Something's Wrong Here.</h1><br>
                    <p class="white-text mt0">We're sorry, but the page you're trying to reach <br
                            class="hide-on-med-and-down"> has either been moved, renamed, or no longer exists.<br
                            class="hide-on-med-and-down"></p>
                </div>
            </div>
        </section>

    </main>

    <?php get_footer(); ?>

    </body>

</html>