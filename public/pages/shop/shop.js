import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './shop.scss';

(function($) {
    'use strict';

    // 1. Filtering, Searching, and Sorting

    // 2. Pure JS Filtering, Searching, and Sorting
    function runFilters() {
        let searchQuery = ($('#search-products').val() || '').toLowerCase().trim();
        let $activeFilter = $('.filter-container .filter.active');
        let selectedSlug = ($activeFilter.data('slug') || '').toLowerCase().trim();
        let selectedTitle = ($activeFilter.data('title') || '').toLowerCase().trim();

        // If no filter or 'all' is selected
        let isAll = !selectedSlug || selectedSlug === 'all';

        let $cards = $('#gbh-product-grid .product-card');
        let visibleCount = 0;

        $cards.each(function() {
            let $card = $(this);
            let catTokens = ($card.data('category') || '').toLowerCase();
            let title = ($card.data('title') || '').toLowerCase();

            // Match category by slug or title
            let matchCat = isAll;
            if (!isAll) {
                if (selectedSlug && catTokens.indexOf(selectedSlug) !== -1) {
                    matchCat = true;
                } else if (selectedTitle && catTokens.indexOf(selectedTitle) !== -1) {
                    matchCat = true;
                }
            }

            let matchSearch = !searchQuery || title.indexOf(searchQuery) !== -1;

            if (matchCat && matchSearch) {
                $card.show();
                visibleCount++;
            } else {
                $card.hide();
            }
        });

        // Update toolbar results count text
        if (isAll && !searchQuery) {
            $('.shop-toolbar .results').text('Showing all products (' + visibleCount + ')');
        } else {
            $('.shop-toolbar .results').text('Found ' + visibleCount + ' product' + (visibleCount === 1 ? '' : 's'));
        }

        // Toggle "No products found" message if needed
        if (visibleCount === 0) {
            if ($('#no-products-msg').length === 0) {
                $('#gbh-product-grid').append(
                    '<div id="no-products-msg" style="grid-column: 1/-1; text-align: center; padding: 48px 20px; background: #faf8f5; border-radius: 8px; border: 1px dashed rgba(44,26,14,0.15);">' +
                        '<p style="font-size: 1.15rem; color: #432818; margin-bottom: 8px; font-weight: 500;">No products match this selection.</p>' +
                        '<p style="font-size: 0.9rem; color: #7a6050; margin-bottom: 20px;">Explore all gardening essentials or search for other items.</p>' +
                        '<button type="button" class="reset-filter-btn" style="background:#2d6a4f; color:#fff; border:none; padding:10px 22px; border-radius:4px; font-size:0.88rem; font-weight:600; cursor:pointer;">View All Products</button>' +
                    '</div>'
                );
            }
        } else {
            $('#no-products-msg').remove();
        }
    }

    // Sync URL query params with active category
    function updateCategoryUrl(slug) {
        if (window.history && window.history.replaceState) {
            let url = new URL(window.location.href);
            if (slug && slug !== 'all') {
                url.searchParams.set('category', slug);
            } else {
                url.searchParams.delete('category');
            }
            window.history.replaceState({}, '', url.toString());
        }
    }

    // Category click handler
    $(document).on('click', '.filter-container .filter', function() {
        let $this = $(this);
        let slug = ($this.data('slug') || '').toLowerCase();

        if ($this.hasClass('active') && slug !== 'all') {
            // Uncheck back to All Products
            $('.filter-container .filter').removeClass('active');
            $('.filter-container .filter[data-slug="all"]').addClass('active');
            updateCategoryUrl('all');
        } else {
            $('.filter-container .filter').removeClass('active');
            $this.addClass('active');
            updateCategoryUrl(slug);
        }

        // Auto collapse mobile drawer if open
        if (window.innerWidth <= 900) {
            $('#mobile-filter-toggle').prop('checked', false);
        }

        runFilters();
    });

    // Reset button inside empty state
    $(document).on('click', '.reset-filter-btn', function(e) {
        e.preventDefault();
        $('.filter-btns .clear').trigger('click');
    });

    // Search input
    $('#search-products').on('input', function() {
        runFilters();
    });

    // Clear All
    $('.filter-btns .clear').on('click', function() {
        $('.filter-container .filter').removeClass('active');
        $('.filter-container .filter[data-slug="all"]').addClass('active');
        $('#search-products').val('');
        updateCategoryUrl('all');
        runFilters();
    });

    // Show Results button (useful on mobile to close filter drawer)
    $('.filter-btns .results').on('click', function() {
        if (window.innerWidth <= 900) {
            $('#mobile-filter-toggle').prop('checked', false);
        }
        runFilters();
    });

    // Sorting
    $('.sorting p').on('click', function() {
        let sortType = $(this).data('find'); // newest, low-high, high-low
        let label = $(this).data('attr');
        $('#sort-by').text(label);
        
        let $grid = $('#gbh-product-grid');
        let $cards = $grid.find('.product-card').get();

        $cards.sort(function(a, b) {
            let priceA = parseFloat($(a).data('price')) || 0;
            let priceB = parseFloat($(b).data('price')) || 0;
            let dateA = parseInt($(a).data('date')) || 0;
            let dateB = parseInt($(b).data('date')) || 0;

            if (sortType === 'low-high') {
                return priceA - priceB;
            } else if (sortType === 'high-low') {
                return priceB - priceA;
            } else {
                // newest
                return dateB - dateA;
            }
        });

        $.each($cards, function(idx, itm) {
            $grid.append(itm);
        });

        runFilters(); // Ensure visibility matches filters after sorting
        
        // Hide dropdown
        $('.sorting').hide();
    });
    
    // Toggle sort dropdown
    $('.sort-by-heading').on('click', function(e) {
        e.stopPropagation();
        $('.sorting').toggle();
    });

    $(document).on('click', function() {
        $('.sorting').hide();
    });

    // Parse URL on initialization (e.g. ?category=seeds or ?search=tomato)
    function applyUrlParams() {
        let urlParams = new URLSearchParams(window.location.search);
        let catParam = urlParams.get('category');
        let searchParam = urlParams.get('s') || urlParams.get('search');

        if (searchParam) {
            $('#search-products').val(searchParam);
        }

        if (catParam) {
            let targetSlug = catParam.toLowerCase().trim();
            let $target = $('.filter-container .filter[data-slug="' + targetSlug + '"]');
            
            if ($target.length) {
                $('.filter-container .filter').removeClass('active');
                $target.addClass('active');
            } else {
                // Try matching by data-title
                $('.filter-container .filter').each(function() {
                    let s = ($(this).data('slug') || '').toLowerCase();
                    let t = ($(this).data('title') || '').toLowerCase();
                    if (s === targetSlug || t === targetSlug) {
                        $('.filter-container .filter').removeClass('active');
                        $(this).addClass('active');
                        return false;
                    }
                });
            }
        }
        runFilters();
    }

    $(document).ready(function() {
        applyUrlParams();
    });

    window.addEventListener('popstate', function() {
        applyUrlParams();
    });

})(jQuery);