<title>
    <?php wp_title(''); ?>
</title>
<?php wp_head(); ?>

<link rel="apple-touch-icon" sizes="180x180" href=<?php echo get_theme_file_uri('favicons/apple-touch-icon.png'); ?>>
<link rel="icon" type="image/png" sizes="32x32" href=<?php echo get_theme_file_uri('favicons/favicon-32x32.png'); ?>>
<link rel="icon" type="image/png" sizes="16x16" href=<?php echo get_theme_file_uri('favicons/favicon-16x16.png'); ?>>
<link rel="manifest" href=<?php echo get_theme_file_uri('favicons/site.webmanifest'); ?>>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Raleway:wght@300;400;500&family=Roboto:wght@400;500&family=Raleway:wght@500&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
    function loadJS(FILE_URL, defer = true) {
        let scriptEle = document.createElement("script");
        scriptEle.setAttribute("src", FILE_URL);
        scriptEle.setAttribute("type", "text/javascript");
        scriptEle.setAttribute("defer", defer);
        document.head.appendChild(scriptEle);
        scriptEle.addEventListener("error", (ev) => {
            console.log("Error on loading file", ev);
        });
    }
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FL8K2XF8TR"></script>

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-FL8K2XF8TR');
</script>
<!-- Google tag (gtag.js) -->

</head>

<body>

    <header class="header">

        <!-- Main Navbar -->
        <div class="header-wrapper" data-aos="fade-down" data-aos-duration="2000">

            <!-- Main Header -->
            <div class="header-main">
                <a href="/" class="gardenbaskethubb-home" aria-label="gardenbaskethubb">
                    <img class="logo-gardenbaskethubb"
                        src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/Signature-Logo.webp" width="132"
                        height="62" alt="Signature Logo">
                </a>
                <div class="nav-container">
                    <nav>
                        <a href="/" class="nav-item">Home</a>
                        <a href="/about-shrey" class="nav-item">About Shrey</a>
                        <a href="/gardenbaskethubb-shows" class="nav-item">The gardenbaskethubb Show</a>
                        <a href="/social-highlights" class="nav-item">Social Highlights</a>
                        <a href="/contact-us" class="nav-item">Contact</a>
                        <a href="/search" aria-label="Search" class="nav-item"><svg width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.26861 0C8.17842 0 10.5372 2.35945 10.5372 5.26998C10.5372 6.57532 10.059 7.77525 9.27276 8.69953L9.49161 8.91843H10.1319L14.1847 12.9723L12.9689 14.1884L8.91611 10.1346V9.49408L8.69726 9.27517C7.77323 10.0616 6.57361 10.54 5.26861 10.54C2.35884 10.54 0 8.18055 0 5.26998C0 2.35945 2.35884 0 5.26861 0ZM5.26861 1.62153C3.24222 1.62153 1.62111 3.24307 1.62111 5.26998C1.62111 7.2969 3.24222 8.91843 5.26861 8.91843C7.295 8.91843 8.91611 7.2969 8.91611 5.26998C8.91611 3.24307 7.295 1.62153 5.26861 1.62153Z"
                                    fill="#070908" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>

        </div>

        <!-- Side Bar Toggle Button -->
        <div class="mobile-toggle-bar" data-aos="fade-down" data-aos-duration="2000">

            <a href="/" class="gardenbaskethubb-home" aria-label="gardenbaskethubb">
                <img class="logo-gardenbaskethubb"
                    src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/Signature-Logo.webp" width="132"
                    height="62" alt="Signature Logo">
            </a>

            <button id="toggle-btn" aria-label="Toggle Button">
                <span id="toggle-icon"><svg width="83" height="94" viewBox="0 0 83 94" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 82.2666H5.72V81.1146L15.944 76.5866V77.0506L5.72 72.5226V71.3706H17V72.5866H7.432V72.1066L17 76.3786V77.2586L7.432 81.5466V81.0666H17V82.2666ZM17 65.3482H5.72L5.72 58.1482H6.808V64.0522H10.728V58.5002H11.832V64.0522H15.896V58.1482H17V65.3482ZM17 52.742H5.72V51.702L15.32 44.47V44.838H5.72V43.606H17V44.63L7.4 51.862V51.51H17V52.742ZM17.144 33.1409C17.144 34.6662 16.7547 35.8022 15.976 36.5489C15.1973 37.2849 14.0507 37.6529 12.536 37.6529H5.72V36.3409H12.472C13.6347 36.3409 14.5093 36.0849 15.096 35.5729C15.6827 35.0609 15.976 34.2502 15.976 33.1409C15.976 32.0955 15.6827 31.3009 15.096 30.7569C14.5093 30.2129 13.6347 29.9409 12.472 29.9409H5.72V28.6289H12.536C14.0507 28.6289 15.1973 29.0129 15.976 29.7809C16.7547 30.5382 17.144 31.6582 17.144 33.1409Z"
                            fill="#2B2B2B" />
                        <path d="M76.3203 32.8999H32.6797V34.8098H76.3203V32.8999Z" fill="#2B2B2B" />
                        <path d="M76.3203 54.8159H32.6797V56.7258H76.3203V54.8159Z" fill="#2B2B2B" />
                        <path d="M76.3203 77.8159H32.6797V79.7258H76.3203V77.8159Z" fill="#2B2B2B" />
                    </svg>
                </span>
            </button>

        </div>

        <!-- Side Bar -->
        <div id="side-navbar">
            <a href="/" class="gardenbaskethubb-home side-bar-logo" aria-label="gardenbaskethubb">
                <img class="logo-gardenbaskethubb"
                    src="https://gardenbaskethubb.com/wp-content/uploads/2025/01/Signature-Logo.webp" width="132"
                    height="62" alt="Signature Logo">
            </a>
            <ul>
                <li><a href="/" class="nav-item">Home</a></li>
                <li><a href="/about-shrey" class="nav-item">About Shrey</a></li>
                <li><a href="/gardenbaskethubb-shows" class="nav-item">The gardenbaskethubb Show</a></li>
                <li><a href="/social-highlights" class="nav-item">Social Highlights</a></li>
                <li><a href="/contact-us" class="nav-item">Contact</a></li>
                <li><a href="/search" aria-label="Search" class="nav-item"><svg width="15" height="15"
                            viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.26861 0C8.17842 0 10.5372 2.35945 10.5372 5.26998C10.5372 6.57532 10.059 7.77525 9.27276 8.69953L9.49161 8.91843H10.1319L14.1847 12.9723L12.9689 14.1884L8.91611 10.1346V9.49408L8.69726 9.27517C7.77323 10.0616 6.57361 10.54 5.26861 10.54C2.35884 10.54 0 8.18055 0 5.26998C0 2.35945 2.35884 0 5.26861 0ZM5.26861 1.62153C3.24222 1.62153 1.62111 3.24307 1.62111 5.26998C1.62111 7.2969 3.24222 8.91843 5.26861 8.91843C7.295 8.91843 8.91611 7.2969 8.91611 5.26998C8.91611 3.24307 7.295 1.62153 5.26861 1.62153Z"
                                fill="#070908" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Icons visible on scroll -->
        <div class="icon-container" data-aos="fade-left" data-aos-duration="2000">
            <a href="/" class="icon home" aria-label="Home">
                <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.7524 9.092H16.0804V15.092C16.0804 15.537 15.8864 16.092 15.0804 16.092H11.0804V10.092H7.08043V16.092H3.08043C2.27443 16.092 2.08043 15.537 2.08043 15.092V9.092H0.408428C-0.189572 9.092 -0.061572 8.768 0.348428 8.344L8.37243 0.312C8.56743 0.11 8.82343 0.01 9.08043 0C9.33743 0.01 9.59343 0.109 9.78843 0.312L17.8114 8.343C18.2224 8.768 18.3504 9.092 17.7524 9.092Z"
                        fill="#DFDFDF" />
                </svg>
            </a>
            <a href="https://www.instagram.com/imgardenbaskethubb/" target="_blank" class="icon instagram"
                aria-label="Instagram">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_74_40" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="20"
                        height="20">
                        <path d="M20 0H0V20H20V0Z" fill="white" />
                    </mask>
                    <g mask="url(#mask0_74_40)">
                        <path
                            d="M9.9973 6.6651C8.1611 6.6651 6.6626 8.1636 6.6626 9.9998C6.6626 11.836 8.1611 13.3345 9.9973 13.3345C11.8335 13.3345 13.332 11.836 13.332 9.9998C13.332 8.1636 11.8335 6.6651 9.9973 6.6651ZM19.9989 9.9998C19.9989 8.6189 20.0114 7.2505 19.9338 5.8721C19.8563 4.27105 19.491 2.85012 18.3203 1.67935C17.147 0.506075 15.7286 0.143338 14.1276 0.065787C12.7466 -0.0117642 11.3782 0.000744095 9.9998 0.000744095C8.6189 0.000744095 7.2505 -0.0117642 5.8721 0.065787C4.27105 0.143338 2.85012 0.50858 1.67935 1.67935C0.506075 2.85262 0.143337 4.27105 0.065787 5.8721C-0.0117642 7.253 0.000744095 8.6214 0.000744095 9.9998C0.000744095 11.3782 -0.0117642 12.7491 0.065787 14.1276C0.143337 15.7286 0.50858 17.1495 1.67935 18.3203C2.85262 19.4935 4.27105 19.8563 5.8721 19.9338C7.253 20.0114 8.6214 19.9989 9.9998 19.9989C11.3807 19.9989 12.7491 20.0114 14.1276 19.9338C15.7286 19.8563 17.1495 19.491 18.3203 18.3203C19.4935 17.147 19.8563 15.7286 19.9338 14.1276C20.0139 12.7491 19.9989 11.3807 19.9989 9.9998ZM9.9973 15.1307C7.15795 15.1307 4.86644 12.8392 4.86644 9.9998C4.86644 7.16045 7.15795 4.86895 9.9973 4.86895C12.8367 4.86895 15.1282 7.16045 15.1282 9.9998C15.1282 12.8392 12.8367 15.1307 9.9973 15.1307ZM15.3383 5.8571C14.6754 5.8571 14.14 5.32175 14.14 4.6588C14.14 3.99587 14.6754 3.46052 15.3383 3.46052C16.0012 3.46052 16.5366 3.99587 16.5366 4.6588C16.5368 4.81622 16.506 4.97213 16.4458 5.1176C16.3857 5.2631 16.2974 5.39525 16.1861 5.50655C16.0748 5.61785 15.9426 5.70615 15.7971 5.7663C15.6517 5.82645 15.4957 5.8573 15.3383 5.8571Z"
                            fill="#DFDFDF" />
                    </g>
                </svg>
            </a>
            <a href="https://x.com/iamgardenbaskethubb" target="_blank" class="icon twitter" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_3430_3402)">
                        <path
                            d="M11.8616 8.46864L19.147 0H17.4206L11.0947 7.3532L6.04225 0H0.214844L7.85515 11.1193L0.214844 20H1.94134L8.62162 12.2348L13.9574 20H19.7848L11.8612 8.46864H11.8616ZM9.49695 11.2173L8.72283 10.1101L2.56342 1.29967H5.21521L10.1859 8.40994L10.9601 9.51718L17.4214 18.7594H14.7696L9.49695 11.2177V11.2173Z"
                            fill="#DFDFDF" />
                    </g>
                    <defs>
                        <clipPath id="clip0_3430_3402">
                            <rect width="20" height="20" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/imgardenbaskethubb/" target="_blank" class="icon linkedin"
                aria-label="Linkedin">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_74_49" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="20"
                        height="20">
                        <path d="M20 0H0V20H20V0Z" fill="white" />
                    </mask>
                    <g mask="url(#mask0_74_49)">
                        <path
                            d="M4.33842 20V6.50605H0.241704V20H4.33842ZM2.29059 4.66256C3.71919 4.66256 4.60843 3.62638 4.60843 2.3315C4.58181 1.00742 3.71924 0 2.3177 0C0.91638 0 0 1.00744 0 2.3315C0 3.62644 0.889015 4.66256 2.26385 4.66256H2.29059ZM6.60595 20H10.7027V12.4643C10.7027 12.061 10.7292 11.6581 10.8375 11.3699C11.1336 10.564 11.8077 9.7295 12.9394 9.7295C14.4218 9.7295 15.0148 10.9669 15.0148 12.7809V19.9999H19.1113V12.2626C19.1113 8.1178 17.0902 6.18925 14.3948 6.18925C12.1848 6.18925 11.2144 7.5417 10.6754 8.4628H10.7028V6.50575H6.60605C6.6598 7.77195 6.60595 20 6.60595 20Z"
                            fill="#DFDFDF" />
                    </g>
                </svg>
            </a>
            <a href="https://www.youtube.com/@thegardenbaskethubb/featured" target="_blank" class="icon youtube"
                aria-label="Youtube">
                <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.5826 2.18695C19.4688 1.76346 19.2455 1.37727 18.9352 1.06703C18.625 0.756775 18.2386 0.53335 17.8148 0.41911C16.2544 5.96046e-08 10 0 10 0C10 0 3.74553 -1.19209e-07 2.18527 0.41688C1.76121 0.53075 1.37461 0.75405 1.0643 1.06435C0.75399 1.37466 0.53089 1.76105 0.41741 2.1847C-8.9407e-08 3.7452 0 7 0 7C0 7 -8.9407e-08 10.2548 0.41741 11.8131C0.64732 12.6736 1.3259 13.3513 2.18527 13.5809C3.74553 14 10 14 10 14C10 14 16.2544 14 17.8148 13.5809C18.6764 13.3513 19.3527 12.6736 19.5826 11.8131C20 10.2548 20 7 20 7C20 7 20 3.7452 19.5826 2.18695ZM8.0134 9.98725V4.01275L13.1919 6.9777L8.0134 9.98725Z"
                        fill="#DFDFDF" />
                </svg>
            </a>
            <a href="https://www.facebook.com/ShreyShrma76" target="_blank" class="icon facebook" aria-label="Facebook">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.2 0H0.8C0.3575 0 0 0.3575 0 0.8V19.2C0 19.6425 0.3575 20 0.8 20H19.2C19.6425 20 20 19.6425 20 19.2V0.8C20 0.3575 19.6425 0 19.2 0ZM16.89 5.8375H15.2925C14.04 5.8375 13.7975 6.4325 13.7975 7.3075V9.235H16.7875L16.3975 12.2525H13.7975V20H10.68V12.255H8.0725V9.235H10.68V7.01C10.68 4.4275 12.2575 3.02 14.5625 3.02C15.6675 3.02 16.615 3.1025 16.8925 3.14V5.8375H16.89Z"
                        fill="#DFDFDF" />
                </svg>
            </a>
        </div>

    </header>

    <div style="height:var(--header-height);width:100%;"></div>