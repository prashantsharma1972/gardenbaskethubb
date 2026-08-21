import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './shop.scss';

(function($) {
    'use strict';

    // 1. AJAX Add to Cart / Buy Now Button
    $(document).on('click', '.add-btn, .btn-add-to-cart, .btn-buy-now', function(e) {
        e.preventDefault();
        let $btn = $(this);
        let isBuyNow = $btn.hasClass('btn-buy-now') || $btn.text().trim().toLowerCase() === 'buy now';
        let productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
        let quantity = parseInt($('.qty-stepper input').val()) || 1;
        let variant = $('.opt-pill.selected').text().trim() || '';

        if (!productId) {
            window.gbh.showToast('Please select a valid product', 'error');
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
                    window.gbh.updateCartDOM(response.data.cart);
                    if (isBuyNow) {
                        window.location.href = gbh_ajax_obj.checkout_url;
                    } else {
                        window.gbh.showToast(response.data.message, 'success');
                    }
                } else {
                    window.gbh.showToast(response.data.message || 'Error adding to cart', 'error');
                }
            },
            error: function() {
                $btn.prop('disabled', false).css('opacity', '1');
                window.gbh.showToast('Network error. Please try again.', 'error');
            }
        });
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

})(jQuery);