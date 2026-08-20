<?php
/**
 * Template Name: Success Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" as="style" href="<?php echo GBH_THEME_URI; ?>/build/success/success.css">
    <link rel="stylesheet" href="<?php echo GBH_THEME_URI; ?>/build/success/success.css">
    <script type="module" defer fetchpriority="low" src="<?php echo GBH_THEME_URI; ?>/build/success/success.bundle.js"></script>

    <?php get_header(); ?>

    <main class="main--container">
        <section class="notfound">
            <div class="success container pt5">
                <div class="areaText">
                    <h1 class="headingclass white-text mb0"> Thanks!</h1><br>
                    <p class="white-text mt0 textchange"></p>
                    <p class="emailid"></p>
                </div>
            </div>
        </section>

    </main>

    <?php get_footer(); ?>

    </body>

</html>