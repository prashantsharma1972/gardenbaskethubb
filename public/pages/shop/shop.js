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

    // 2. Pure JS Filtering, Searching, and Sorting
    function runFilters() {
        let searchQuery = $('#search-products').val().toLowerCase().trim();
        let selectedCategory = $('.filter.active').data('title'); // e.g. "Seedlings"
        if (selectedCategory) {
            selectedCategory = selectedCategory.toLowerCase();
        }

        let $cards = $('#gbh-product-grid .product-card');
        let visibleCount = 0;

        $cards.each(function() {
            let $card = $(this);
            let cat = ($card.data('category') || '').toLowerCase();
            let title = ($card.data('title') || '').toLowerCase();
            
            let matchCat = !selectedCategory || cat.includes(selectedCategory);
            let matchSearch = !searchQuery || title.includes(searchQuery);

            if (matchCat && matchSearch) {
                $card.show();
                visibleCount++;
            } else {
                $card.hide();
            }
        });

        // Toggle "No products found" message if needed
        if (visibleCount === 0) {
            if ($('#no-products-msg').length === 0) {
                $('#gbh-product-grid').append('<p id="no-products-msg" style="grid-column: 1/-1; text-align: center; padding: 2rem;">No products match your criteria.</p>');
            }
        } else {
            $('#no-products-msg').remove();
        }
    }

    // Category click
    $(document).on('click', '.filter-container .filter', function() {
        let $this = $(this);
        if ($this.hasClass('active')) {
            $this.removeClass('active');
        } else {
            $('.filter-container .filter').removeClass('active');
            $this.addClass('active');
        }
        runFilters();
    });

    // Search input
    $('#search-products').on('input', function() {
        runFilters();
    });

    // Clear All
    $('.filter-btns .clear').on('click', function() {
        $('.filter-container .filter').removeClass('active');
        $('#search-products').val('');
        runFilters();
    });

    // Sorting
    $('.sorting p').on('click', function() {
        let sortType = $(this).data('find'); // newest, low-high, high-low
        let label = $(this).data('attr');
        $('#sort-by').text(label);
        
        let $grid = $('#gbh-product-grid');
        let $cards = $grid.find('.product-card').get();

        $cards.sort(function(a, b) {
            let priceA = parseFloat($(a).data('price')) || 0;
            let priceB = parseFloat($(b).data('price')) || 0;
            let dateA = parseInt($(a).data('date')) || 0;
            let dateB = parseInt($(b).data('date')) || 0;

            if (sortType === 'low-high') {
                return priceA - priceB;
            } else if (sortType === 'high-low') {
                return priceB - priceA;
            } else {
                // newest
                return dateB - dateA;
            }
        });

        $.each($cards, function(idx, itm) {
            $grid.append(itm);
        });

        runFilters(); // Ensure visibility matches filters after sorting
        
        // Hide dropdown
        $('.sorting').hide();
    });
    
    // Toggle sort dropdown
    $('.sort-by-heading').on('click', function() {
        $('.sorting').toggle();
    });

})(jQuery);