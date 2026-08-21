(function($) {
    'use strict';

    // 12. Mobile Menu Drawer Toggle
    $(document).on('click', '#gbh-mobile-toggle', function(e) {
        e.preventDefault();
        $('#gbh-mobile-drawer').addClass('active');
        $('#gbh-mobile-overlay').addClass('active');
        $('body').css('overflow', 'hidden');
    });

    $(document).on('click', '#gbh-mobile-close, #gbh-mobile-overlay', function(e) {
        e.preventDefault();
        $('#gbh-mobile-drawer').removeClass('active');
        $('#gbh-mobile-overlay').removeClass('active');
        $('body').css('overflow', '');
    });

    // 15. Contact Form Handler
    $(document).on('submit', '.contact-form', function(e) {
        e.preventDefault();
        let $form = $(this);
        let $btn = $form.find('button[type="submit"]');
        $btn.prop('disabled', true).text('Sending message...');

        setTimeout(function() {
            $btn.prop('disabled', false).text('Send Message');
            $form[0].reset();
            window.gbh.showToast('Thank you! Your message has been sent to our Jaipur nursery team.', 'success');
        }, 800);
    });

    // 16. Product Card Single View Navigation
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