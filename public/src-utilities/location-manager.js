/**
 * Delivery Location Manager & Sapling Purchase Rules (CR §5)
 * Garden Basket Hub
 */

(function($) {
    'use strict';

    const LOC_KEY = 'gbh_user_location';
    const DEFAULT_LOC = 'jaipur';

    // 1. Get current location from localStorage or cookie
    function getUserLocation() {
        let loc = localStorage.getItem(LOC_KEY);
        if (!loc) {
            // Check cookie fallback
            const match = document.cookie.match(new RegExp('(^| )gbh_location=([^;]+)'));
            if (match) loc = match[2];
        }
        return loc || null;
    }

    // 2. Set location & sync state
    function setUserLocation(loc, isExplicit = true) {
        if (!loc || (loc !== 'jaipur' && loc !== 'outside_jaipur')) {
            loc = DEFAULT_LOC;
        }

        localStorage.setItem(LOC_KEY, loc);
        document.cookie = 'gbh_location=' + loc + '; path=/; max-age=' + (60 * 60 * 24 * 30); // 30 days

        updateHeaderLocationBadges(loc);
        updateSaplingCardsUI(loc);

        if (isExplicit && window.gbh && window.gbh.showToast) {
            if (loc === 'jaipur') {
                window.gbh.showToast('Location set: 🌸 Jaipur (Full Nursery & Live Saplings)', 'success');
            } else {
                window.gbh.showToast('Location set: 🇮🇳 Rest of India (Seeds, Boosters & Supplies)', 'success');
            }
        }
    }

    // 3. Update Header Badges
    function updateHeaderLocationBadges(loc) {
        let label = (loc === 'outside_jaipur') ? 'Outside Jaipur' : 'Jaipur';
        $('#gbh-current-loc-name').text(label);
        $('#gbh-mobile-loc-name').text(label);
        $('#gbh-drawer-loc-name').text(label);

        // Highlight selected in modal
        $('.loc-option-card').removeClass('selected');
        $(`.loc-option-card[data-location="${loc}"]`).addClass('selected');
    }

    // 4. Update Product Cards & PDP based on location
    function updateSaplingCardsUI(loc) {
        const isOutside = (loc === 'outside_jaipur');

        // Target all product cards that are saplings
        $('.product-card').each(function() {
            let $card = $(this);
            let isSapling = $card.attr('data-is-sapling') === '1' || 
                            $card.data('is-sapling') === 1 || 
                            ($card.attr('data-category') && $card.attr('data-category').indexOf('sapling') !== -1) ||
                            $card.find('.product-category').text().trim().toLowerCase().indexOf('sapling') !== -1;

            if (isSapling) {
                let $btn = $card.find('.add-btn');
                if (isOutside) {
                    $btn.addClass('sapling-restricted').text('📍 Jaipur Only');
                } else {
                    $btn.removeClass('sapling-restricted').text('Add to bag');
                }
            }
        });

        // Single Product Page (PDP) Handling
        if ($('.pdp').length) {
            let isPdpSapling = $('[data-is-sapling="1"]').length > 0 || 
                               $('.breadcrumb').text().toLowerCase().indexOf('sapling') !== -1 ||
                               $('.product-category').text().toLowerCase().indexOf('sapling') !== -1 ||
                               document.title.toLowerCase().indexOf('sapling') !== -1;

            if (isPdpSapling) {
                let $addBtn = $('.pdp-cta .add-btn');
                let $buyBtn = $('.pdp-cta .btn-buy-now');
                let $noticeBox = $('#gbh-pdp-sapling-notice');

                if (isOutside) {
                    $addBtn.addClass('sapling-restricted').text('📍 Available in Jaipur Only');
                    $buyBtn.addClass('sapling-restricted').text('📍 Jaipur Delivery Only').prop('disabled', true).css('opacity', '0.6');
                    
                    if (!$noticeBox.length) {
                        $noticeBox = $('<div id="gbh-pdp-sapling-notice" class="pdp-sapling-notice outside-active"></div>').insertBefore('.pdp-cta');
                    }
                    $noticeBox.html('⚠️ <div><strong>Jaipur Delivery Only:</strong> Live saplings are exclusively delivered within Jaipur to guarantee plant health. If you are ordering for Jaipur, please switch your location above.</div>').show();
                } else {
                    $addBtn.removeClass('sapling-restricted').text('Add to Bag');
                    $buyBtn.removeClass('sapling-restricted').text('Buy Now').prop('disabled', false).css('opacity', '1');
                    
                    if (!$noticeBox.length) {
                        $noticeBox = $('<div id="gbh-pdp-sapling-notice" class="pdp-sapling-notice jaipur-active"></div>').insertBefore('.pdp-cta');
                    }
                    $noticeBox.html('🌿 <div><strong>Jaipur Nursery Fresh:</strong> Hand-delivered directly to your home with guaranteed root viability.</div>').show();
                }
            }
        }
    }

    // 5. Modal Control Helpers
    function openLocationModal() {
        let current = getUserLocation() || DEFAULT_LOC;
        $('.loc-option-card').removeClass('selected');
        $(`.loc-option-card[data-location="${current}"]`).addClass('selected');
        $('#gbh-location-modal').fadeIn(200);
        $('body').css('overflow', 'hidden');
    }

    function closeLocationModal() {
        $('#gbh-location-modal').fadeOut(200);
        $('body').css('overflow', '');
    }

    function openSaplingModal() {
        $('#gbh-sapling-modal').fadeIn(200);
        $('body').css('overflow', 'hidden');
    }

    function closeSaplingModal() {
        $('#gbh-sapling-modal').fadeOut(200);
        $('body').css('overflow', '');
    }

    // ============================================================
    // Event Handlers
    // ============================================================
    $(document).ready(function() {
        let savedLoc = getUserLocation();

        if (!savedLoc) {
            // First time visitor: show location prompt modal
            setTimeout(function() {
                openLocationModal();
            }, 700);
            setUserLocation(DEFAULT_LOC, false);
        } else {
            setUserLocation(savedLoc, false);
        }

        // Open location selector when clicking badge
        $(document).on('click', '#gbh-location-btn, #gbh-mobile-location-btn, #gbh-drawer-location-btn', function(e) {
            e.preventDefault();
            openLocationModal();
        });

        // Select option in modal
        $(document).on('click', '.loc-option-card', function() {
            $('.loc-option-card').removeClass('selected');
            $(this).addClass('selected');
        });

        // Confirm location button in modal
        $(document).on('click', '#gbh-confirm-location-btn', function(e) {
            e.preventDefault();
            let selected = $('.loc-option-card.selected').data('location') || DEFAULT_LOC;
            setUserLocation(selected, true);
            closeLocationModal();
        });

        // Close location modal
        $(document).on('click', '#gbh-loc-modal-close', function(e) {
            e.preventDefault();
            closeLocationModal();
        });

        $('#gbh-location-modal').on('click', function(e) {
            if ($(e.target).is('#gbh-location-modal')) {
                closeLocationModal();
            }
        });

        // Intercept clicks on restricted sapling buttons
        $(document).on('click', '.add-btn.sapling-restricted, .btn-buy-now.sapling-restricted', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openSaplingModal();
        });

        // Close sapling modal
        $(document).on('click', '#gbh-sapling-modal-close', function(e) {
            e.preventDefault();
            closeSaplingModal();
        });

        $('#gbh-sapling-modal').on('click', function(e) {
            if ($(e.target).is('#gbh-sapling-modal')) {
                closeSaplingModal();
            }
        });

        // Switch to Jaipur from Sapling Modal
        $(document).on('click', '#gbh-switch-to-jaipur-btn', function(e) {
            e.preventDefault();
            setUserLocation('jaipur', true);
            closeSaplingModal();
        });
    });

    // Expose location manager to global window
    window.gbh = window.gbh || {};
    window.gbh.getUserLocation = getUserLocation;
    window.gbh.setUserLocation = setUserLocation;
    window.gbh.openLocationModal = openLocationModal;
    window.gbh.openSaplingModal = openSaplingModal;

})(jQuery);
