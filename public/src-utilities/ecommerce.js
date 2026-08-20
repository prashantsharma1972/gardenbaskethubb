/**
 * Garden Basket Hub — Core E-Commerce Utility & Event Engine
 * Handles Cart AJAX, Product Add/Update/Remove, Razorpay Popup Modal, Coupons, Pincode & Catalog Filters
 */

const $ = window.jQuery || window.$;


// Toast Notification
export function showToast(message, type = 'success') {
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

// Update Cart Count Badge in Header
export function updateCartCountBadge(count) {
    let $badge = $('.cart-count-badge');
    if ($badge.length) {
        $badge.text(count);
    }
}

// Update Cart DOM in Cart & Checkout Pages
export function updateCartDOM(cart) {
    updateCartCountBadge(cart.total_count);
    
    $('.summary-cart-count').text(cart.total_count);
    $('.summary-subtotal').text(cart.subtotal_formatted);
    $('.summary-delivery').text(cart.delivery_fee_formatted);
    $('.summary-total').text(cart.total_formatted);
    if (cart.discount > 0) {
        $('.summary-discount').text(cart.discount_formatted);
        $('.summary-discount-row').show();
    } else {
        $('.summary-discount-row').hide();
    }

    if (cart.items.length === 0) {
        $('.cart-items-container').html(`
            <div class="empty-cart-state" style="text-align:center;padding:60px 20px;">
                <div style="font-size:4rem;margin-bottom:16px;">🌱🛒</div>
                <h3 style="font-family:var(--f-display);color:var(--soil);margin-bottom:8px;">Your Garden Bag is Empty</h3>
                <p style="color:var(--clay);margin-bottom:24px;">Discover fresh organic seeds and lively saplings grown right here in Jaipur.</p>
                <a href="${window.gbh_ajax_obj ? window.gbh_ajax_obj.shop_url : '/shop/'}" class="btn-primary" style="display:inline-block;padding:12px 28px;background:var(--forest);color:#fff;border-radius:999px;font-weight:600;">Explore Shop</a>
            </div>
        `);
        $('.cart-summary-card button.btn-checkout').prop('disabled', true).css('opacity', '0.5');
    }
}

export function initEcommerce() {
    $(document).ready(function() {
        const ajaxUrl = (window.gbh_ajax_obj && window.gbh_ajax_obj.ajax_url) ? window.gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
        const nonce = (window.gbh_ajax_obj && window.gbh_ajax_obj.nonce) ? window.gbh_ajax_obj.nonce : '';

        // 1. Add To Cart Button Handler
        $(document).on('click', '.add-btn, .btn-add-to-bag', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const $btn = $(this);
            const productId = $btn.data('product-id');
            const qty = parseInt($('#product-qty-val').text()) || 1;
            const variant = $('.variant-pill.active').text().trim() || '';

            if (!productId) return;

            const originalText = $btn.html();
            $btn.prop('disabled', true).html('Adding... 🌱');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_add_to_cart',
                    nonce: nonce,
                    product_id: productId,
                    quantity: qty,
                    variant: variant
                },
                success: function(res) {
                    $btn.prop('disabled', false).html(originalText);
                    if (res.success) {
                        showToast(res.data.message || 'Added to your bag! 🌱');
                        if (res.data.cart) {
                            updateCartDOM(res.data.cart);
                        }
                    } else {
                        showToast(res.data.message || 'Could not add item.', 'error');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalText);
                    showToast('Connection error. Please try again.', 'error');
                }
            });
        });

        // 2. Cart Quantity Stepper (+ / -) & Item Removal
        $(document).on('click', '.cart-qty-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $row = $btn.closest('.cart-item-row');
            const key = $row.data('item-key');
            let currentQty = parseInt($row.find('.cart-qty-num').text()) || 1;

            if ($btn.hasClass('qty-plus')) {
                currentQty++;
            } else if ($btn.hasClass('qty-minus')) {
                currentQty--;
            }

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_update_cart',
                    nonce: nonce,
                    key: key,
                    quantity: currentQty
                },
                success: function(res) {
                    if (res.success) {
                        if (currentQty <= 0) {
                            $row.fadeOut(300, function() { $(this).remove(); });
                            showToast('Item removed from bag.');
                        } else {
                            $row.find('.cart-qty-num').text(currentQty);
                        }
                        if (res.data) updateCartDOM(res.data);
                    }
                }
            });
        });

        $(document).on('click', '.cart-remove-item', function(e) {
            e.preventDefault();
            const $row = $(this).closest('.cart-item-row');
            const key = $row.data('item-key');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_update_cart',
                    nonce: nonce,
                    key: key,
                    quantity: 0
                },
                success: function(res) {
                    if (res.success) {
                        $row.fadeOut(300, function() { $(this).remove(); });
                        showToast('Item removed from bag.');
                        if (res.data) updateCartDOM(res.data);
                    }
                }
            });
        });

        // 3. Apply Coupon Code
        $(document).on('click', '#apply-coupon-btn', function(e) {
            e.preventDefault();
            const coupon = $('#coupon-input').val().trim();
            if (!coupon) {
                showToast('Please enter a coupon code.', 'error');
                return;
            }

            const $btn = $(this);
            $btn.prop('disabled', true).text('Applying...');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_apply_coupon',
                    nonce: nonce,
                    coupon: coupon
                },
                success: function(res) {
                    $btn.prop('disabled', false).text('Apply');
                    if (res.success) {
                        showToast(res.data.message);
                        if (res.data.cart) updateCartDOM(res.data.cart);
                    } else {
                        showToast(res.data.message || 'Invalid coupon code.', 'error');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Apply');
                    showToast('Coupon check failed.', 'error');
                }
            });
        });

        // 4. Pincode Availability Checker
        $(document).on('click', '#check-pincode-btn', function(e) {
            e.preventDefault();
            const pincode = $('#pincode-input').val().trim();
            if (!pincode || pincode.length < 6) {
                showToast('Please enter a 6-digit PIN code.', 'error');
                return;
            }

            const $btn = $(this);
            $btn.prop('disabled', true).text('Checking...');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_check_pincode',
                    pincode: pincode
                },
                success: function(res) {
                    $btn.prop('disabled', false).text('Check');
                    if (res.success) {
                        $('#pincode-result-msg').html(res.data.message).css('color', 'var(--forest)').fadeIn();
                    } else {
                        $('#pincode-result-msg').html(res.data.message).css('color', 'var(--rust)').fadeIn();
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Check');
                }
            });
        });

        // 5. Checkout Form Submit with Razorpay Modal
        $(document).on('submit', '#gbh-checkout-form', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $form.find('button[type="submit"]');

            const firstName = $form.find('input[name="first_name"]').val().trim();
            const phone = $form.find('input[name="phone"]').val().trim();
            const email = $form.find('input[name="email"]').val().trim();
            const address = $form.find('input[name="address"]').val().trim();
            const paymentMethod = $form.find('input[name="payment_method"]:checked').val() || 'UPI / Razorpay';

            if (!firstName || !phone || !email || !address) {
                showToast('Please complete all contact and address fields.', 'error');
                return;
            }

            $btn.prop('disabled', true).html('Preparing Payment... 🔒');

            // Online Payment / Razorpay Modal Flow
            if (paymentMethod !== 'COD' && typeof Razorpay !== 'undefined') {
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'gbh_create_razorpay_order',
                        nonce: nonce
                    },
                    success: function(res) {
                        if (res.success && res.data.razorpay_order_id) {
                            const options = {
                                key: res.data.key_id,
                                amount: res.data.amount,
                                currency: res.data.currency || 'INR',
                                name: 'Garden Basket Hub',
                                description: 'Heirloom Seeds & Plants Order',
                                order_id: res.data.razorpay_order_id,
                                prefill: {
                                    name: firstName,
                                    email: email,
                                    contact: phone
                                },
                                theme: {
                                    color: '#3A6B35'
                                },
                                handler: function(response) {
                                    $btn.html('Confirming Order... 🌱');
                                    const formData = $form.serialize() + '&action=gbh_place_order&nonce=' + nonce + '&razorpay_payment_id=' + response.razorpay_payment_id + '&razorpay_order_id=' + response.razorpay_order_id;
                                    
                                    $.ajax({
                                        url: ajaxUrl,
                                        type: 'POST',
                                        data: formData,
                                        success: function(orderRes) {
                                            if (orderRes.success && orderRes.data.redirect_url) {
                                                window.location.href = orderRes.data.redirect_url;
                                            } else {
                                                showToast(orderRes.data.message || 'Order placed successfully!');
                                            }
                                        }
                                    });
                                },
                                modal: {
                                    ondismiss: function() {
                                        $btn.prop('disabled', false).html('Complete Order 🔒');
                                        showToast('Payment window closed. You can retry when ready.', 'error');
                                    }
                                }
                            };

                            const rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            $btn.prop('disabled', false).html('Complete Order 🔒');
                            showToast(res.data.message || 'Failed to initiate Razorpay payment.', 'error');
                        }
                    },
                    error: function() {
                        $btn.prop('disabled', false).html('Complete Order 🔒');
                        showToast('Error connecting to payment gateway.', 'error');
                    }
                });
            } else {
                // Direct COD Flow
                $btn.html('Placing Order... 🌱');
                const formData = $form.serialize() + '&action=gbh_place_order&nonce=' + nonce;
                
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formData,
                    success: function(res) {
                        if (res.success && res.data.redirect_url) {
                            window.location.href = res.data.redirect_url;
                        } else {
                            $btn.prop('disabled', false).html('Complete Order 🔒');
                            showToast(res.data.message || 'Error processing order.', 'error');
                        }
                    },
                    error: function() {
                        $btn.prop('disabled', false).html('Complete Order 🔒');
                        showToast('Connection error. Please try again.', 'error');
                    }
                });
            }
        });

        // 6. Live Product Catalog Filtering
        function triggerProductFilter() {
            const selectedCats = [];
            $('.filter-cat-checkbox:checked').each(function() {
                selectedCats.push($(this).val());
            });

            const selectedSeasons = [];
            $('.filter-season-checkbox:checked').each(function() {
                selectedSeasons.push($(this).val());
            });

            const sortVal = $('#shop-sort-select').val() || 'featured';
            const minPrice = parseFloat($('#filter-min-price').val()) || 0;
            const maxPrice = parseFloat($('#filter-max-price').val()) || 0;

            const $grid = $('#shop-products-grid');
            $grid.css('opacity', '0.4');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'gbh_filter_products',
                    nonce: nonce,
                    cats: selectedCats,
                    seasons: selectedSeasons,
                    sort: sortVal,
                    min_price: minPrice,
                    max_price: maxPrice
                },
                success: function(res) {
                    $grid.css('opacity', '1');
                    if (res.success) {
                        $grid.html(res.data.html);
                        $('.shop-results-count').text(res.data.count + ' Products Found');
                    }
                },
                error: function() {
                    $grid.css('opacity', '1');
                }
            });
        }

        $(document).on('change', '.filter-cat-checkbox, .filter-season-checkbox, #shop-sort-select', function() {
            triggerProductFilter();
        });
    });
}
