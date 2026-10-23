import './location-manager.js';

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

    // ============================================================
    // Universal Product Card Add-to-Bag Handler
    // Works across Homepage Best Sellers, Shop Grid, Sliders, Category grids
    // ============================================================
    $(document).on('click', '.product-card .add-btn, .add-btn:not(.pdp-cta .add-btn)', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $btn = $(this);

        // Check if sapling restricted for visitors outside Jaipur
        if ($btn.hasClass('sapling-restricted')) {
            if (window.gbh && window.gbh.openSaplingModal) {
                window.gbh.openSaplingModal();
            }
            return;
        }

        var productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
        if (!productId) {
            var permalink = $btn.closest('.product-card').attr('data-permalink') || $btn.closest('.product-card').find('.product-name a').attr('href');
            if (permalink && permalink !== '#' && permalink !== '') {
                window.location.href = permalink;
                return;
            }
            if (window.gbh && window.gbh.showToast) window.gbh.showToast('Please select a valid product', 'error');
            return;
        }

        var origText = $btn.html();
        $btn.prop('disabled', true).css('opacity', '0.7').text('Adding... 🌱');

        var ajaxUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url) ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
        var nonce = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce) ? gbh_ajax_obj.nonce : '';

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'gbh_add_to_cart',
                nonce: nonce,
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                $btn.prop('disabled', false).css('opacity', '1');
                if (response.success) {
                    $btn.text('✓ Added! 🌱');
                    setTimeout(function() {
                        if ($btn.hasClass('sapling-restricted')) {
                            $btn.text('📍 Jaipur Only');
                        } else {
                            $btn.html(origText);
                        }
                    }, 2000);

                    if (response.data && response.data.cart) {
                        $('.cart-count-badge').text(response.data.cart.total_count);
                        if (window.gbh && window.gbh.updateCartDOM) {
                            window.gbh.updateCartDOM(response.data.cart);
                        }
                    }
                    if (window.gbh && window.gbh.showToast) {
                        window.gbh.showToast(response.data.message || 'Added to bag! 🌱', 'success');
                    }
                } else {
                    if ($btn.hasClass('sapling-restricted')) {
                        $btn.text('📍 Jaipur Only');
                    } else {
                        $btn.html(origText);
                    }
                    if (window.gbh && window.gbh.showToast) {
                        window.gbh.showToast(response.data.message || 'Could not add to bag', 'error');
                    }
                }
            },
            error: function() {
                $btn.prop('disabled', false).css('opacity', '1');
                if ($btn.hasClass('sapling-restricted')) {
                    $btn.text('📍 Jaipur Only');
                } else {
                    $btn.html(origText);
                }
                if (window.gbh && window.gbh.showToast) {
                    window.gbh.showToast('Network error. Please try again.', 'error');
                }
            }
        });
    });

    // ============================================================
    // Swiper Initialization
    // ============================================================
    $(document).ready(function() {
        if (typeof Swiper !== 'undefined') {
            
            // Standard Carousels (Related Products, etc.)
            if ($('.swiper:not(.pdp-gallery-swiper)').length) {
                new Swiper('.swiper:not(.pdp-gallery-swiper)', {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                    grabCursor: true,
                    breakpoints: {
                        600: { slidesPerView: 2.2, spaceBetween: 20 },
                        900: { slidesPerView: 3, spaceBetween: 24 },
                        1200: { slidesPerView: 4, spaceBetween: 24 }
                    }
                });
            }

            // PDP Main Image Gallery
            if ($('.pdp-gallery-swiper').length) {
                new Swiper('.pdp-gallery-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    grabCursor: true,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        }
    });

    // ============================================================
    // CR §8: ORDER TRACKING MODAL & AJAX SEARCH (SHIPROCKET)
    // ============================================================
    function openTrackModal(orderNum) {
        var $modal = $('#gbh-track-order-modal');
        if (!$modal.length) return;

        $modal.fadeIn(200);
        $('body').css('overflow', 'hidden');

        if (orderNum) {
            $('#gbh-track-query').val(orderNum);
            $('#gbh-track-order-form').trigger('submit');
        } else {
            setTimeout(function() {
                $('#gbh-track-query').focus();
            }, 250);
        }
    }

    function closeTrackModal() {
        $('#gbh-track-order-modal').fadeOut(200);
        $('body').css('overflow', '');
    }

    $(document).on('click', '#gbh-track-order-btn, #gbh-drawer-track-order-btn, .open-track-modal-btn, a[href="#track-order"]', function(e) {
        e.preventDefault();
        // If inside mobile drawer, close drawer first
        if ($('#gbh-mobile-drawer').hasClass('open')) {
            $('#gbh-mobile-drawer').removeClass('open');
            $('#gbh-mobile-overlay').removeClass('active');
        }
        var orderNum = $(this).attr('data-order-num') || '';
        openTrackModal(orderNum);
    });

    $(document).on('click', '#gbh-track-modal-close', function(e) {
        e.preventDefault();
        closeTrackModal();
    });

    $(document).on('click', '#gbh-track-order-modal', function(e) {
        if ($(e.target).is('#gbh-track-order-modal')) {
            closeTrackModal();
        }
    });

    $(document).on('submit', '#gbh-track-order-form', function(e) {
        e.preventDefault();
        var query = $('#gbh-track-query').val().trim();
        if (!query) return;

        var $btn = $('#gbh-track-submit-btn');
        var $resultBox = $('#gbh-track-result-box');

        $btn.prop('disabled', true).text('Searching... 🔍');
        $resultBox.slideUp(150);

        var ajaxUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url) ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
        var nonce = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce) ? gbh_ajax_obj.nonce : '';

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'gbh_track_order',
                nonce: nonce,
                order_query: query
            },
            success: function(res) {
                $btn.prop('disabled', false).text('Track Status ➔');
                if (res.success && res.data) {
                    var data = res.data;
                    var statusBadgeClass = 'track-badge';
                    var statusText = data.order_status || 'In Transit';
                    var displayOrderNum = data.order_num || query;
                    var trackingLink = data.tracking_url || ('https://shiprocket.co/tracking/' + encodeURIComponent(query));

                    var html = `
                        <div class="track-status-header">
                            <span class="track-order-title">📦 Order #${displayOrderNum}</span>
                            <span class="${statusBadgeClass}">${statusText}</span>
                        </div>
                        <div class="track-details-row">
                            <div><strong>Current Status:</strong> <span>${data.message || 'Dispatched via Shiprocket Courier'}</span></div>
                            <div><strong>AWB / Tracking Code:</strong> <span>${data.awb || 'Assigned on pickup'}</span></div>
                            <div><strong>Logistics Reference:</strong> <span>${data.shipment_id || 'Shiprocket Priority Air'}</span></div>
                        </div>
                        <a href="${trackingLink}" target="_blank" rel="noopener noreferrer" class="track-live-btn">
                            🚀 View Live Courier Journey on Shiprocket ➔
                        </a>
                    `;
                    $resultBox.html(html).slideDown(250);
                } else {
                    $resultBox.html(`
                        <div style="color: #A03828; font-size: 0.9rem; text-align: center; padding: 10px 0;">
                            ⚠️ ${res.data && res.data.message ? res.data.message : 'No active shipment found for this ID. Please verify your order number or contact WhatsApp support.'}
                        </div>
                    `).slideDown(250);
                }
            },
            error: function() {
                $btn.prop('disabled', false).text('Track Status ➔');
                $resultBox.html(`
                    <div style="color: #A03828; font-size: 0.9rem; text-align: center; padding: 10px 0;">
                        ⚠️ Unable to reach tracking gateway. Please check your internet connection or try again.
                    </div>
                `).slideDown(250);
            }
        });
    });

    // ============================================================
    // CR §6: STAR FEATURED PRODUCT — PLANT BOOSTER INTERACTIVITY
    // Live Stepper, 1-Click Add-to-Bag & Instant Buy Now
    // ============================================================
    $(document).on('click', '#star-qty-minus', function(e) {
        e.preventDefault();
        var $input = $('#star-booster-qty');
        var val = parseInt($input.val()) || 1;
        if (val > 1) {
            $input.val(val - 1);
        }
    });

    $(document).on('click', '#star-qty-plus', function(e) {
        e.preventDefault();
        var $input = $('#star-booster-qty');
        var val = parseInt($input.val()) || 1;
        if (val < 50) {
            $input.val(val + 1);
        }
    });

    $(document).on('click', '.star-thumb', function(e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
    });

    $(document).on('click', '#star-add-to-bag-btn', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var productId = $btn.data('product-id');
        var productName = $btn.data('product-name') || 'Garden Basket Organic Plant Booster (500ml)';
        var qty = parseInt($('#star-booster-qty').val()) || 1;

        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('Adding... 🌱');

        var ajaxUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url) ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
        var nonce = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce) ? gbh_ajax_obj.nonce : '';

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'gbh_add_to_cart',
                nonce: nonce,
                product_id: productId,
                quantity: qty,
                variant: '500ml Bottle'
            },
            success: function(res) {
                $btn.prop('disabled', false);
                if (res.success) {
                    $btn.html('✓ Added! 🌱');
                    setTimeout(function() {
                        $btn.html(originalHtml);
                    }, 2200);

                    if (window.gbh && window.gbh.showToast) {
                        window.gbh.showToast(`Added ${qty} × ${productName} to your bag! 🌱`, 'success');
                    }
                    if (res.data && res.data.cart && window.gbh && window.gbh.updateCartDOM) {
                        window.gbh.updateCartDOM(res.data.cart);
                    }
                } else {
                    $btn.html(originalHtml);
                    if (window.gbh && window.gbh.showToast) {
                        window.gbh.showToast(res.data && res.data.message ? res.data.message : 'Could not add to bag', 'error');
                    }
                }
            },
            error: function() {
                $btn.prop('disabled', false).html(originalHtml);
                if (window.gbh && window.gbh.showToast) {
                    window.gbh.showToast('Connection error. Please try again.', 'error');
                }
            }
        });
    });

    $(document).on('click', '#star-buy-now-btn', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var productId = $btn.data('product-id');
        var qty = parseInt($('#star-booster-qty').val()) || 1;

        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('Redirecting... ⚡');

        var ajaxUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url) ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
        var nonce = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce) ? gbh_ajax_obj.nonce : '';
        var checkoutUrl = (typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.checkout_url) ? gbh_ajax_obj.checkout_url : '/checkout/';

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'gbh_add_to_cart',
                nonce: nonce,
                product_id: productId,
                quantity: qty,
                variant: '500ml Bottle'
            },
            success: function(res) {
                if (res.success) {
                    window.location.href = checkoutUrl;
                } else {
                    $btn.prop('disabled', false).html(originalHtml);
                    if (window.gbh && window.gbh.showToast) {
                        window.gbh.showToast(res.data && res.data.message ? res.data.message : 'Error redirecting to checkout', 'error');
                    }
                }
            },
            error: function() {
                $btn.prop('disabled', false).html(originalHtml);
                if (window.gbh && window.gbh.showToast) {
                    window.gbh.showToast('Connection error. Please try again.', 'error');
                }
            }
        });
    });

})(jQuery);