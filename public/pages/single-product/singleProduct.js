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

        if ($btn.hasClass('sapling-restricted')) {
            if (window.gbh && window.gbh.openSaplingModal) {
                window.gbh.openSaplingModal();
            }
            return;
        }

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

        if ($btn.hasClass('sapling-restricted')) {
            if (window.gbh && window.gbh.openSaplingModal) {
                window.gbh.openSaplingModal();
            }
            return;
        }

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
    // 7. Check Pincode Delivery Availability (CR §5.2)
    // ============================================================
    $(document).on('click', '#gbh-pincode-check-btn, .pincode-check button', function(e) {
        e.preventDefault();
        const $input = $('#gbh-pincode-input').length ? $('#gbh-pincode-input') : $(this).siblings('input');
        const pincode = ($input.val() || '').trim();
        const $result = $('#gbh-pincode-result');
        const isSapling = $('[data-is-sapling="1"]').length > 0 || $('.product-card[data-is-sapling="1"]').length > 0;

        if (!pincode || pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
            if (window.gbh && window.gbh.showToast) window.gbh.showToast('Please enter a valid 6-digit Indian pincode.', 'warning');
            if ($result.length) {
                $result.css({ 'color': '#8B4A2B', 'display': 'block' }).html('⚠️ Please enter a valid 6-digit pincode.');
            }
            return;
        }

        const isJaipurPin = /^(302|303)/.test(pincode);

        if (isJaipurPin) {
            let msg = '✅ <strong>Delivery Available:</strong> Same-day / Next-day hand delivery in Jaipur (' + pincode + ').';
            if ($result.length) {
                $result.css({ 'color': '#2D6A28', 'display': 'block' }).html(msg);
            }
            if (window.gbh && window.gbh.showToast) window.gbh.showToast('Great! Jaipur same-day delivery available for ' + pincode, 'success');
        } else {
            if (isSapling) {
                let msg = '⚠️ <strong>Jaipur Only:</strong> Live saplings cannot be shipped to ' + pincode + ' to prevent plant transit damage. Seeds &amp; supplies ship pan-India!';
                if ($result.length) {
                    $result.css({ 'color': '#8B4A2B', 'display': 'block' }).html(msg);
                }
                if (window.gbh && window.gbh.showToast) window.gbh.showToast('Live saplings are delivered in Jaipur only.', 'warning');
            } else {
                let msg = '✅ <strong>Delivery Available:</strong> Express Pan-India Shipping to ' + pincode + ' (3–5 business days).';
                if ($result.length) {
                    $result.css({ 'color': '#2D6A28', 'display': 'block' }).html(msg);
                }
                if (window.gbh && window.gbh.showToast) window.gbh.showToast('Standard Pan-India delivery available for ' + pincode, 'success');
            }
        }
    });

})(jQuery);