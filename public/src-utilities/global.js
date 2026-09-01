(function($) {
    'use strict';

    // ============================================================
    // CART COUNT BADGE — Sync on every page load via AJAX
    // Fixes the issue where navigating between pages shows stale
    // PHP-rendered count instead of the live session cart count.
    // ============================================================
    $(document).ready(function() {
        if (typeof gbh_ajax_obj === 'undefined') return;

        $.ajax({
            url: gbh_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'gbh_get_cart',
                nonce: gbh_ajax_obj.nonce
            },
            success: function(res) {
                if (res.success && res.data && res.data.cart) {
                    var count = res.data.cart.total_count || 0;
                    $('.cart-count-badge').text(count);
                }
            }
        });
    });

    // ============================================================
    // Mobile Menu Drawer Toggle (jQuery-based, syncs with inline)
    // ============================================================
    $(document).on('click', '#gbh-mobile-toggle', function(e) {
        e.preventDefault();
        $('#gbh-mobile-drawer').addClass('open');
        $('#gbh-mobile-overlay').addClass('active');
        $('body').css('overflow', 'hidden');
    });

    $(document).on('click', '#gbh-mobile-close, #gbh-mobile-overlay', function(e) {
        e.preventDefault();
        $('#gbh-mobile-drawer').removeClass('open');
        $('#gbh-mobile-overlay').removeClass('active');
        $('body').css('overflow', '');
    });

    // ============================================================
    // Contact Form Handler (submit to Google Sheets / placeholder)
    // ============================================================
    $(document).on('submit', '.contact-form', function(e) {
        e.preventDefault();
        let $form = $(this);
        let $btn = $form.find('button[type="submit"]');
        $btn.prop('disabled', true).text('Sending message...');

        setTimeout(function() {
            $btn.prop('disabled', false).text('Send Message');
            $form[0].reset();
            if (window.gbh && window.gbh.showToast) {
                window.gbh.showToast('Thank you! Your message has been sent to our Jaipur nursery team.', 'success');
            }
        }, 800);
    });

    // ============================================================
    // Product Card Click — Navigate to Single Product (PDP)
    // ============================================================
    $(document).on('click', '.product-card', function(e) {
        if ($(e.target).closest('.add-btn, .btn-buy-now, input, button, select').length > 0) {
            return; // allow button actions without navigating
        }
        let permalink = $(this).attr('data-permalink') || $(this).find('.product-name a').attr('href');
        if (permalink && permalink !== '#' && permalink !== '') {
            window.location.href = permalink;
        }
    });

})(jQuery);