(function($) {
    'use strict';

    // Toast Notification Handler
    function showToast(message, type = 'success') {
        let $toast = $('#gbh-toast-notification');
        if (!$toast.length) {
            $toast = $('<div id="gbh-toast-notification" class="gbh-toast"></div>').appendTo('body');
        }
        let icon = type === 'success' ? '🌱' : '⚠️';
        $toast.html('<span>' + icon + '</span> <span>' + message + '</span>').addClass('show');
        
        setTimeout(function() {
            $toast.removeClass('show');
        }, 3500);
    }

    // Update Header Cart Count Badge
    function updateCartCountBadge(count) {
        let $badge = $('.cart-count-badge');
        if ($badge.length) {
            $badge.text(count);
        }
    }

    // Dynamic Cart DOM Updater helper function
    function updateCartDOM(cart) {
        updateCartCountBadge(cart.total_count);
        
        $('.summary-cart-count').text(cart.total_count);
        $('.summary-subtotal').text(cart.subtotal_formatted);
        $('.summary-delivery').text(cart.delivery_fee_formatted);
        $('.summary-total').text(cart.total_formatted);
        if (cart.discount > 0) {
            $('.summary-discount').text(cart.discount_formatted);
        }

        // If cart is empty now, show empty view dynamically
        if (cart.total_count === 0 && $('.cart-layout').length) {
            $('.cart-layout').fadeOut(300, function() {
                $(this).replaceWith(`
                    <div class="empty-cart-view-container">
                        <div class="empty-icon">🛒 🌿</div>
                        <h2 class="empty-title">Your garden bag is empty</h2>
                        <p class="empty-desc">You haven't added any seeds, seedlings, or gardening tools to your bag yet.</p>
                        <a href="${gbh_ajax_obj.cart_url.replace('/cart/', '/shop/')}" class="btn-primary empty-btn">
                            Explore Nursery Shop ➔
                        </a>
                    </div>
                `);
            });
        }
    }

    // Expose globally
    window.gbh = window.gbh || {};
    window.gbh.showToast = showToast;
    window.gbh.updateCartCountBadge = updateCartCountBadge;
    window.gbh.updateCartDOM = updateCartDOM;

})(jQuery);