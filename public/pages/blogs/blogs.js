import './blogs.scss';
import './../../src-utilities/header';
import './../../src-utilities/country';
import './../../src-utilities/footer';
import gsap, { ScrollTrigger } from 'gsap/all';
gsap.registerPlugin(ScrollTrigger);

(function($) {
    'use strict';

    // Pure JS Filtering and Searching for Blogs
    function runFilters() {
        let searchQuery = $('#search-blogs').val();
        if (searchQuery) searchQuery = searchQuery.toLowerCase().trim();
        else searchQuery = '';

        let selectedCategory = $('.filter-container .filter.active').data('title');
        if (selectedCategory) selectedCategory = selectedCategory.toLowerCase();

        let $cards = $('#gbh-blog-grid .featured-blog-card');
        let visibleCount = 0;

        $cards.each(function() {
            let $card = $(this);
            let cat = ($card.data('category') || '').toLowerCase();
            let title = ($card.data('title') || '').toLowerCase();
            
            let matchCat = !selectedCategory || cat.includes(selectedCategory);
            let matchSearch = !searchQuery || title.includes(searchQuery);

            if (matchCat && matchSearch) {
                $card.show();
                visibleCount++;
            } else {
                $card.hide();
            }
        });

        // Toggle "No blogs found" message
        if (visibleCount === 0) {
            if ($('#no-blogs-msg').length === 0) {
                $('#gbh-blog-grid').append('<p id="no-blogs-msg" style="grid-column: 1/-1; text-align: center; padding: 2rem;">No blogs match your criteria.</p>');
            }
        } else {
            $('#no-blogs-msg').remove();
        }
    }

    // Category click
    $(document).on('click', '.filter-container .filter', function() {
        let $this = $(this);
        if ($this.hasClass('active')) {
            $this.removeClass('active');
        } else {
            $('.filter-container .filter').removeClass('active');
            $this.addClass('active');
        }
        runFilters();
    });

    // Search input
    $('#search-blogs').on('input', function() {
        runFilters();
    });

    // Clear All
    $('.filter-btns .clear').on('click', function() {
        $('.filter-container .filter').removeClass('active');
        $('#search-blogs').val('');
        runFilters();
    });

})(jQuery);
