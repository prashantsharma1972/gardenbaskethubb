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

    <link rel="stylesheet" href=<?php echo get_theme_file_uri('/build/notFound/notFound.css?a8'); ?>>
    <script type="module" defer src=<?php echo get_theme_file_uri('/build/notFound/notFound.bundle.js?a8'); ?>></script>

    <?php
    get_header();
    ?>

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