import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './reels.scss';

(function($) {
    'use strict';

    // 14. Reel Video Modal Lightbox Handler
    $(document).on('click', '.reel-card', function(e) {
        let $card = $(this);
        let permalink = $card.data('permalink');
        let title = $card.data('title') || $card.find('h4').text().trim();
        let videoUrl = $card.data('video');

        if (permalink && !videoUrl) {
            window.location.href = permalink;
            return;
        }

        let $modal = $('#gbh-reel-modal');
        if (!$modal.length) {
            $modal = $(`
                <div id="gbh-reel-modal" class="reel-modal">
                    <div class="reel-modal-overlay"></div>
                    <div class="reel-modal-content">
                        <button class="reel-modal-close">&times;</button>
                        <h3 class="reel-modal-title"></h3>
                        <div class="reel-modal-body"></div>
                    </div>
                </div>
            `).appendTo('body');
        }

        $modal.find('.reel-modal-title').text(title);
        if (videoUrl) {
            $modal.find('.reel-modal-body').html(`<iframe src="${videoUrl}" style="width:100%;height:100%;border:none;" allow="autoplay" allowfullscreen></iframe>`);
        } else {
            $modal.find('.reel-modal-body').html(`
                <div style="text-align:center;padding:40px;color:var(--sand);">
                    <div style="font-size:3rem;margin-bottom:12px;">🎥 🌿</div>
                    <h4>${title}</h4>
                    <p style="margin-top:8px;font-size:0.9rem;">Visit our Jaipur Nursery channel for full reels & gardening guides.</p>
                </div>
            `);
        }

        $modal.addClass('active');
        $('body').css('overflow', 'hidden');
    });

    $(document).on('click', '.reel-modal-close, .reel-modal-overlay', function() {
        let $modal = $('#gbh-reel-modal');
        $modal.removeClass('active');
        $modal.find('.reel-modal-body').empty();
        $('body').css('overflow', '');
    });

})(jQuery);