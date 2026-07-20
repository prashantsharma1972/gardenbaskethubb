/**
 * Garden Basket Hub — Main Frontend JavaScript Engine
 */

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

    // Document Ready Handlers
    $(document).ready(function() {

        // 1. AJAX Add to Cart Button
        $(document).on('click', '.add-btn, .btn-add-to-cart', function(e) {
            e.preventDefault();
            let $btn = $(this);
            let productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
            let quantity = parseInt($('.qty-stepper input').val()) || 1;
            let variant = $('.opt-pill.selected').text().trim() || '';

            if (!productId) {
                // If on static card or demo, show friendly notification
                showToast('Product added to bag!');
                return;
            }

            $btn.prop('disabled', true).css('opacity', '0.7');

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_add_to_cart',
                    nonce: gbh_ajax_obj.nonce,
                    product_id: productId,
                    quantity: quantity,
                    variant: variant
                },
                success: function(response) {
                    $btn.prop('disabled', false).css('opacity', '1');
                    if (response.success) {
                        showToast(response.data.message, 'success');
                        updateCartCountBadge(response.data.cart.total_count);
                    } else {
                        showToast(response.data.message || 'Error adding to cart', 'error');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).css('opacity', '1');
                    showToast('Network error. Please try again.', 'error');
                }
            });
        });

        // 2. Cart Quantity Stepper (+ / -) Buttons
        $(document).on('click', '.qty-stepper button', function(e) {
            e.preventDefault();
            let $btn = $(this);
            let $input = $btn.siblings('input');
            let currentVal = parseInt($input.val()) || 1;
            let isPlus = $btn.text().trim() === '+';

            let newVal = isPlus ? currentVal + 1 : Math.max(1, currentVal - 1);
            $input.val(newVal).trigger('change');
        });

        // 3. Cart Page Quantity / Item Update
        $(document).on('change', '.cart-row .qty-stepper input', function() {
            let $input = $(this);
            let $row = $input.closest('.cart-row');
            let key = $row.data('cart-key');
            let qty = parseInt($input.val()) || 0;

            if (!key) return;

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_update_cart',
                    nonce: gbh_ajax_obj.nonce,
                    key: key,
                    quantity: qty
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        });

        // 4. Remove Item from Cart
        $(document).on('click', '.cart-actions .remove', function(e) {
            e.preventDefault();
            let $row = $(this).closest('.cart-row');
            let key = $row.data('cart-key');

            if (!key) {
                $row.fadeOut(300, function() { $(this).remove(); });
                return;
            }

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_update_cart',
                    nonce: gbh_ajax_obj.nonce,
                    key: key,
                    quantity: 0
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        });

        // 5. Apply Coupon Code
        $(document).on('click', '.cart-summary .coupon button', function(e) {
            e.preventDefault();
            let couponCode = $(this).siblings('input').val();

            if (!couponCode) {
                showToast('Please enter a coupon code', 'error');
                return;
            }

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_apply_coupon',
                    nonce: gbh_ajax_obj.nonce,
                    coupon: couponCode
                },
                success: function(response) {
                    if (response.success) {
                        showToast(response.data.message, 'success');
                        setTimeout(function() { location.reload(); }, 1000);
                    } else {
                        showToast(response.data.message, 'error');
                    }
                }
            });
        });

        // 6. Check Pincode Delivery
        $(document).on('click', '.pincode-check button', function(e) {
            e.preventDefault();
            let pincode = $(this).siblings('input').val();

            if (!pincode) {
                showToast('Please enter a pincode', 'error');
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
                        showToast(response.data.message, 'success');
                    } else {
                        showToast(response.data.message, 'error');
                    }
                }
            });
        });

        // 7. Option Pills Selector (PDP)
        $(document).on('click', '.opt-pill', function() {
            $(this).siblings('.opt-pill').removeClass('selected');
            $(this).addClass('selected');
        });

        // 8. Payment Method Selection (Checkout)
        $(document).on('click', '.pay-option', function() {
            $('.pay-option').removeClass('selected');
            $(this).addClass('selected');
            let method = $(this).find('.label').text().trim();
            $('#payment_method_input').val(method);
        });

        // 9. Checkout Form Submission
        $(document).on('submit', '#gbh-checkout-form', function(e) {
            e.preventDefault();
            let $form = $(this);
            let $btn = $form.find('button[type="submit"], .btn-place-order');

            $btn.prop('disabled', true).text('Processing Order...');

            let formData = $form.serializeArray();
            formData.push({ name: 'action', value: 'gbh_place_order' });
            formData.push({ name: 'nonce', value: gbh_ajax_obj.nonce });

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: $.param(formData),
                success: function(response) {
                    if (response.success) {
                        showToast(response.data.message, 'success');
                        setTimeout(function() {
                            window.location.href = response.data.redirect_url;
                        }, 1000);
                    } else {
                        $btn.prop('disabled', false).text('Place Order');
                        showToast(response.data.message, 'error');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Place Order');
                    showToast('Order processing failed. Please try again.', 'error');
                }
            });
        });

        // 10. Plant Care Tabs (PDP Accordion)
        $(document).on('click', '.tab-btn', function() {
            let target = $(this).data('tab');
            $('.tab-btn').removeClass('active');
            $('.tab-content').removeClass('active');
            $(this).addClass('active');
            $('#' + target).addClass('active');
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

    });

})(jQuery);
