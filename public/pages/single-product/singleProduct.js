import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './singleProduct.scss';

(function($) {
    'use strict';

    const ajaxUrl = (typeof gbh_ajax_obj !== 'undefined') ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
    const nonce   = (typeof gbh_ajax_obj !== 'undefined') ? gbh_ajax_obj.nonce : '';

    // ============================================================
    // 1. Quantity Stepper +/- Buttons (PDP)
    // Reads from .qty-stepper input and updates it correctly
    // ============================================================
    $(document).on('click', '.qty-stepper button', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const $btn   = $(this);
        const $input = $btn.siblings('input[type="number"], input');
        let qty = parseInt($input.val()) || 1;

        if ($btn.hasClass('qty-plus') || $btn.attr('data-action') === 'plus' || $btn.text().trim() === '+') {
            qty = Math.min(qty + 1, 99);
        } else if ($btn.hasClass('qty-minus') || $btn.attr('data-action') === 'minus' || $btn.text().trim() === '-') {
            qty = Math.max(qty - 1, 1);
        }
        $input.val(qty);
    });

    // ============================================================
    // 2. Add to Bag — reads current qty from stepper
    // ============================================================
    $(document).on('click', '.add-btn, .btn-add-to-cart', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const $btn      = $(this);
        const productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
        const $stepper  = $('.qty-stepper input');
        const quantity  = $stepper.length ? (parseInt($stepper.val()) || 1) : 1;
        const variant   = $('.opt-pill.selected').text().trim() || '';
        const origHtml  = $btn.html();

        if (!productId) {
            if (window.gbh && window.gbh.showToast) window.gbh.showToast('Please select a valid product.', 'error');
            return;
        }

        $btn.prop('disabled', true).html('Adding... 🌱');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action:     'gbh_add_to_cart',
                nonce:      nonce,
                product_id: productId,
                quantity:   quantity,
                variant:    variant
            },
            success: function(res) {
                $btn.prop('disabled', false).html(origHtml);
                if (res.success) {
                    if (window.gbh && window.gbh.updateCartDOM) window.gbh.updateCartDOM(res.data.cart);
                    if (window.gbh && window.gbh.showToast) window.gbh.showToast(res.data.message || '✅ Added to bag!', 'success');
                } else {
                    if (window.gbh && window.gbh.showToast) window.gbh.showToast(res.data.message || 'Error adding to cart.', 'error');
                }
            },
            error: function() {
                $btn.prop('disabled', false).html(origHtml);
                if (window.gbh && window.gbh.showToast) window.gbh.showToast('Network error. Please try again.', 'error');
            }
        });
    });

    // ============================================================
    // 3. Buy Now — adds to cart then redirects to checkout
    // ============================================================
    $(document).on('click', '.btn-buy-now', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const $btn      = $(this);
        const productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
        const $stepper  = $('.qty-stepper input');
        const quantity  = $stepper.length ? (parseInt($stepper.val()) || 1) : 1;
        const variant   = $('.opt-pill.selected').text().trim() || '';
        const origHtml  = $btn.html();

        if (!productId) return;

        $btn.prop('disabled', true).html('Processing... ⏳');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action:     'gbh_add_to_cart',
                nonce:      nonce,
                product_id: productId,
                quantity:   quantity,
                variant:    variant
            },
            success: function(res) {
                if (res.success) {
                    const checkoutUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.checkout_url)
                        ? gbh_ajax_obj.checkout_url
                        : '/checkout/';
                    window.location.href = checkoutUrl;
                } else {
                    $btn.prop('disabled', false).html(origHtml);
                    if (window.gbh && window.gbh.showToast) window.gbh.showToast(res.data.message || 'Error. Please try again.', 'error');
                }
            },
            error: function() {
                $btn.prop('disabled', false).html(origHtml);
                if (window.gbh && window.gbh.showToast) window.gbh.showToast('Network error. Please try again.', 'error');
            }
        });
    });

    // ============================================================
    // 4. Option / Variant Pills
    // ============================================================
    $(document).on('click', '.opt-pill', function() {
        $(this).siblings('.opt-pill').removeClass('selected');
        $(this).addClass('selected');
    });

    // ============================================================
    // 5. Plant Care Tabs (PDP)
    // ============================================================
    $(document).on('click', '.tab-btn', function() {
        const target = $(this).data('tab');
        $('.tab-btn').removeClass('active');
        $('.tab-content').removeClass('active');
        $(this).addClass('active');
        $('#' + target).addClass('active');
        $('.mobile-tab-select').val(target);
    });

    $(document).on('change', '.mobile-tab-select', function() {
        const target = $(this).val();
        $('.tab-content').removeClass('active');
        $('#' + target).addClass('active');
        $('.tab-btn').removeClass('active');
        $('.tab-btn[data-tab="' + target + '"]').addClass('active');
    });

    // ============================================================
    // 6. PDP Image Thumbnail Swap
    // ============================================================
    $(document).on('click', '.pdp-thumb', function() {
        $('.pdp-thumb').removeClass('active');
        $(this).addClass('active');
        const newSrc = $(this).find('img').attr('src');
        if (newSrc) {
            $('.pdp-main-img img').attr('src', newSrc);
        }
    });

    // ============================================================
    // 7. Check Pincode Delivery
    // ============================================================
    $(document).on('click', '.pincode-check button', function(e) {
        e.preventDefault();
        const pincode = $(this).siblings('input').val().trim();
        if (!pincode) {
            if (window.gbh && window.gbh.showToast) window.gbh.showToast('Please enter a pincode.', 'error');
            return;
        }
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: { action: 'gbh_check_pincode', pincode: pincode },
            success: function(res) {
                const type = res.success ? 'success' : 'error';
                if (window.gbh && window.gbh.showToast) window.gbh.showToast(res.data.message, type);
            }
        });
    });

})(jQuery);