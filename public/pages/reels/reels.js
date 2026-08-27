import './reels.scss';
import './../../src-utilities/header';
import './../../src-utilities/country';
import './../../src-utilities/footer';

(function($) {
    'use strict';

    // 1. Pure JS Filtering and Searching for Reels
    function runFilters() {
        let searchQuery = $('#search-reels').val();
        if (searchQuery) searchQuery = searchQuery.toLowerCase().trim();
        else searchQuery = '';

        let selectedCategory = $('.filter-container .filter.active').data('title');
        if (selectedCategory) selectedCategory = selectedCategory.toLowerCase();

        let $cards = $('#gbh-reels-grid .reel-card');
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

        // Toggle "No reels found" message
        if (visibleCount === 0) {
            if ($('#no-reels-msg').length === 0) {
                $('#gbh-reels-grid').append('<p id="no-reels-msg" style="grid-column: 1/-1; text-align: center; padding: 2rem;">No reels match your criteria.</p>');
            }
        } else {
            $('#no-reels-msg').remove();
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
    $('#search-reels').on('input', function() {
        runFilters();
    });

    // Clear All
    $('.filter-btns .clear').on('click', function() {
        $('.filter-container .filter').removeClass('active');
        $('#search-reels').val('');
        runFilters();
    });

    // 2. Reels Modal Playback
    let $modal = $('.reel-modal');
    let $modalBody = $('.reel-modal-body');
    let $modalClose = $('.reel-modal-close');
    let $modalOverlay = $('.reel-modal-overlay');

    function closeModal() {
        $modalBody.empty(); // destroy iframe/video
        $modal.hide();
    }

    $(document).on('click', '.play-reel-btn, .reel-card .btn-ghost', function(e) {
        e.preventDefault();
        let $card = $(this).closest('.reel-card');
        let videoUrl = $card.data('video-url');
        
        if (!videoUrl) {
            if(window.gbh && window.gbh.showToast) window.gbh.showToast('No video available for this reel.', 'error');
            return;
        }
        
        let embedHtml = '';
        
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            // Extract Youtube ID
            let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            let match = videoUrl.match(regExp);
            if (match && match[2].length === 11) {
                let yId = match[2];
                embedHtml = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + yId + '?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        } else if (videoUrl.includes('vimeo.com')) {
            // Extract Vimeo ID
            let vId = videoUrl.split('/').pop();
            embedHtml = '<iframe src="https://player.vimeo.com/video/' + vId + '?autoplay=1" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
        } else if (videoUrl.endsWith('.mp4') || videoUrl.endsWith('.webm')) {
            // Direct video file
            embedHtml = '<video src="' + videoUrl + '" width="100%" height="100%" controls autoplay></video>';
        } else {
            // Fallback iframe
            embedHtml = '<iframe src="' + videoUrl + '" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>';
        }

        $modalBody.html(embedHtml);
        $modal.show();
    });

    $modalClose.on('click', closeModal);
    $modalOverlay.on('click', closeModal);

})(jQuery);