import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './cart.scss';

(function($) {
    'use strict';

    // 2. Cart Quantity Stepper (+ / -) Buttons
    $(document).on('click', '.qty-stepper button', function(e) {
        e.preventDefault();
        let $btn = $(this);
        let $input = $btn.siblings('input');
        let currentVal = parseInt($input.val()) || 1;
        let isPlus = $btn.hasClass('btn-qty-plus') || $btn.text().trim() === '+';

        let newVal = isPlus ? currentVal + 1 : Math.max(1, currentVal - 1);
        $input.val(newVal).trigger('change');
    });

    // 3. Cart Page Quantity / Item Update (Dynamic DOM Update)
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
                    // Find matching item line total
                    let items = response.data.items;
                    let item = items.find(i => i.key === key);
                    if (item) {
                        $row.find('.price').text(item.line_total_formatted);
                    } else {
                        $row.fadeOut(300, function() { $(this).remove(); });
                    }
                    window.gbh.updateCartDOM(response.data);
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
                    $row.fadeOut(300, function() { $(this).remove(); });
                    window.gbh.updateCartDOM(response.data);
                }
            }
        });
    });

    // 5. Apply Coupon Code
    $(document).on('click', '.cart-summary .coupon button, .btn-apply-coupon', function(e) {
        e.preventDefault();
        let couponCode = $(this).siblings('input').val();

        if (!couponCode) {
            window.gbh.showToast('Please enter a coupon code', 'error');
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
                    window.gbh.showToast(response.data.message, 'success');
                    window.gbh.updateCartDOM(response.data.cart);
                } else {
                    window.gbh.showToast(response.data.message, 'error');
                }
            }
        });
    });

})(jQuery);