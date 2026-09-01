import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './singleProduct.scss';

(function($) {
    'use strict';

    // 1. AJAX Add to Cart / Buy Now Button
    $(document).on('click', '.add-btn, .btn-add-to-cart, .btn-buy-now', function(e) {
        e.preventDefault();
        let $btn = $(this);
        let isBuyNow = $btn.hasClass('btn-buy-now') || $btn.text().trim().toLowerCase() === 'buy now';
        let productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
        let quantity = 1; 
        let variant = $('.opt-pill.selected').text().trim() || '';

        if (!productId) {
            if(window.gbh && window.gbh.showToast) window.gbh.showToast('Please select a valid product', 'error');
            return;
        }

        $btn.prop('disabled', true).css('opacity', '0.7').text('Adding...');

        $.ajax({
            url: (typeof gbh_ajax_obj !== 'undefined') ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'gbh_add_to_cart',
                nonce: (typeof gbh_ajax_obj !== 'undefined') ? gbh_ajax_obj.nonce : '',
                product_id: productId,
                quantity: quantity,
                variant: variant
            },
            success: function(response) {
                $btn.prop('disabled', false).css('opacity', '1').text('Add to bag');
                if (response.success) {
                    if(window.gbh && window.gbh.updateCartDOM) window.gbh.updateCartDOM(response.data.cart);
                    if (isBuyNow) {
                        window.location.href = (typeof gbh_ajax_obj !== 'undefined') ? gbh_ajax_obj.checkout_url : '/checkout';
                    } else {
                        if(window.gbh && window.gbh.showToast) window.gbh.showToast(response.data.message, 'success');
                        else alert("Added to cart!");
                    }
                } else {
                    if(window.gbh && window.gbh.showToast) window.gbh.showToast(response.data.message || 'Error adding to cart', 'error');
                }
            },
            error: function() {
                $btn.prop('disabled', false).css('opacity', '1').text('Add to bag');
                if(window.gbh && window.gbh.showToast) window.gbh.showToast('Network error. Please try again.', 'error');
            }
        });
    });

    // 6. Check Pincode Delivery
    $(document).on('click', '.pincode-check button', function(e) {
        e.preventDefault();
        let pincode = $(this).siblings('input').val();

        if (!pincode) {
            window.gbh.showToast('Please enter a pincode', 'error');
            return;
        }

        $.ajax({
            url: gbh_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'gbh_check_pincode',
                pincode: pincode
            },
            success: function(response) {
                if (response.success) {
                    window.gbh.showToast(response.data.message, 'success');
                } else {
                    window.gbh.showToast(response.data.message, 'error');
                }
            }
        });
    });

    // 7. Option Pills Selector (PDP)
    $(document).on('click', '.opt-pill', function() {
        $(this).siblings('.opt-pill').removeClass('selected');
        $(this).addClass('selected');
    });

    // 10. Plant Care Tabs (PDP Accordion)
    $(document).on('click', '.tab-btn', function() {
        let target = $(this).data('tab');
        $('.tab-btn').removeClass('active');
        $('.tab-content').removeClass('active');
        $(this).addClass('active');
        $('#' + target).addClass('active');
        
        // Sync mobile dropdown if it exists
        $('.mobile-tab-select').val(target);
    });

    $(document).on('change', '.mobile-tab-select', function() {
        let target = $(this).val();
        $('.tab-content').removeClass('active');
        $('#' + target).addClass('active');
        
        // Sync desktop buttons
        $('.tab-btn').removeClass('active');
        $('.tab-btn[data-tab="' + target + '"]').addClass('active');
    });

    // 11. PDP Image Thumbnail Swap
    $(document).on('click', '.pdp-thumb', function() {
        $('.pdp-thumb').removeClass('active');
        $(this).addClass('active');
        let newSrc = $(this).find('img').attr('src');
        if (newSrc) {
            $('.pdp-main-img img').attr('src', newSrc);
        }
    });

})(jQuery);