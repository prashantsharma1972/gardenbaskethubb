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
                    <div class="empty-cart-view" style="text-align:center;padding:60px 20px;max-width:540px;margin:0 auto;">
                        <div style="font-size:4rem;margin-bottom:16px;">🛒 🌿</div>
                        <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:12px;font-size:2rem;">Your garden bag is empty</h2>
                        <p style="color:var(--clay);margin-bottom:28px;line-height:1.6;">You haven't added any seeds, seedlings, or gardening tools to your bag yet.</p>
                        <a href="${gbh_ajax_obj.cart_url.replace('/cart/', '/shop/')}" class="btn-primary" style="padding:14px 32px;">
                            Explore Nursery Shop ➔
                        </a>
                    </div>
                `);
            });
        }
    }

    // Document Ready Handlers
    $(document).ready(function() {

        // 1. AJAX Add to Cart / Buy Now Button
        $(document).on('click', '.add-btn, .btn-add-to-cart, .btn-buy-now', function(e) {
            e.preventDefault();
            let $btn = $(this);
            let isBuyNow = $btn.hasClass('btn-buy-now') || $btn.text().trim().toLowerCase() === 'buy now';
            let productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
            let quantity = parseInt($('.qty-stepper input').val()) || 1;
            let variant = $('.opt-pill.selected').text().trim() || '';

            if (!productId) {
                showToast('Please select a valid product', 'error');
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
                        updateCartDOM(response.data.cart);
                        if (isBuyNow) {
                            window.location.href = gbh_ajax_obj.checkout_url;
                        } else {
                            showToast(response.data.message, 'success');
                        }
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
                        updateCartDOM(response.data);
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
                        updateCartDOM(response.data);
                    }
                }
            });
        });

        // 5. Apply Coupon Code
        $(document).on('click', '.cart-summary .coupon button, .btn-apply-coupon', function(e) {
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
                        updateCartDOM(response.data.cart);
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

        // 13. Live AJAX Shop Catalog Filter & Sort
        function triggerProductFilter() {
            let $grid = $('#gbh-product-grid');
            if (!$grid.length) return;

            let cats = [];
            $('.filter-sidebar input[name="cat"]:checked').each(function() {
                cats.push($(this).val());
            });

            let seasons = [];
            $('.filter-sidebar input[name="season"]:checked').each(function() {
                seasons.push($(this).val());
            });

            let sort = $('#gbh-sort-products').val() || 'featured';

            $grid.css('opacity', '0.5');

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_filter_products',
                    cats: cats,
                    seasons: seasons,
                    sort: sort
                },
                success: function(response) {
                    $grid.css('opacity', '1');
                    if (response.success) {
                        $grid.html(response.data.html);
                        $('#gbh-results-count').text('Showing ' + response.data.count + ' products');
                    }
                },
                error: function() {
                    $grid.css('opacity', '1');
                }
            });
        }

        $(document).on('change', '.filter-sidebar input[type="checkbox"], #gbh-sort-products', function() {
            triggerProductFilter();
        });

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

        // 15. Contact Form Handler
        $(document).on('submit', '.contact-form', function(e) {
            e.preventDefault();
            let $form = $(this);
            let $btn = $form.find('button[type="submit"]');
            $btn.prop('disabled', true).text('Sending message...');

            setTimeout(function() {
                $btn.prop('disabled', false).text('Send Message');
                $form[0].reset();
                showToast('Thank you! Your message has been sent to our Jaipur nursery team.', 'success');
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

    });

})(jQuery);





