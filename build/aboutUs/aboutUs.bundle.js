/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../src-utilities/global.js":
/*!**********************************!*\
  !*** ../src-utilities/global.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _location_manager_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./location-manager.js */ "../src-utilities/location-manager.js");
/* harmony import */ var _location_manager_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_location_manager_js__WEBPACK_IMPORTED_MODULE_0__);

(function ($) {
  'use strict';

  // ============================================================
  // CART COUNT BADGE — Sync on every page load via AJAX
  // Fixes the issue where navigating between pages shows stale
  // PHP-rendered count instead of the live session cart count.
  // ============================================================
  $(document).ready(function () {
    if (typeof gbh_ajax_obj === 'undefined') return;
    $.ajax({
      url: gbh_ajax_obj.ajax_url,
      type: 'POST',
      data: {
        action: 'gbh_get_cart',
        nonce: gbh_ajax_obj.nonce
      },
      success: function (res) {
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
  $(document).on('click', '#gbh-mobile-toggle', function (e) {
    e.preventDefault();
    $('#gbh-mobile-drawer').addClass('open');
    $('#gbh-mobile-overlay').addClass('active');
    $('body').css('overflow', 'hidden');
  });
  $(document).on('click', '#gbh-mobile-close, #gbh-mobile-overlay', function (e) {
    e.preventDefault();
    $('#gbh-mobile-drawer').removeClass('open');
    $('#gbh-mobile-overlay').removeClass('active');
    $('body').css('overflow', '');
  });

  // ============================================================
  // Contact Form Handler (submit to Google Sheets / placeholder)
  // ============================================================
  $(document).on('submit', '.contact-form', function (e) {
    e.preventDefault();
    let $form = $(this);
    let $btn = $form.find('button[type="submit"]');
    $btn.prop('disabled', true).text('Sending message...');
    setTimeout(function () {
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
  $(document).on('click', '.product-card', function (e) {
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
  $(document).on('click', '.product-card .add-btn, .add-btn:not(.pdp-cta .add-btn)', function (e) {
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
    var ajaxUrl = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
    var nonce = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce ? gbh_ajax_obj.nonce : '';
    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: {
        action: 'gbh_add_to_cart',
        nonce: nonce,
        product_id: productId,
        quantity: 1
      },
      success: function (response) {
        $btn.prop('disabled', false).css('opacity', '1');
        if (response.success) {
          $btn.text('✓ Added! 🌱');
          setTimeout(function () {
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
      error: function () {
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
  $(document).ready(function () {
    if (typeof Swiper !== 'undefined') {
      // Standard Carousels (Related Products, etc.)
      if ($('.swiper:not(.pdp-gallery-swiper)').length) {
        new Swiper('.swiper:not(.pdp-gallery-swiper)', {
          slidesPerView: 1.2,
          spaceBetween: 16,
          grabCursor: true,
          breakpoints: {
            600: {
              slidesPerView: 2.2,
              spaceBetween: 20
            },
            900: {
              slidesPerView: 3,
              spaceBetween: 24
            },
            1200: {
              slidesPerView: 4,
              spaceBetween: 24
            }
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
            prevEl: '.swiper-button-prev'
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
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
      setTimeout(function () {
        $('#gbh-track-query').focus();
      }, 250);
    }
  }
  function closeTrackModal() {
    $('#gbh-track-order-modal').fadeOut(200);
    $('body').css('overflow', '');
  }
  $(document).on('click', '#gbh-track-order-btn, #gbh-drawer-track-order-btn, .open-track-modal-btn, a[href="#track-order"]', function (e) {
    e.preventDefault();
    // If inside mobile drawer, close drawer first
    if ($('#gbh-mobile-drawer').hasClass('open')) {
      $('#gbh-mobile-drawer').removeClass('open');
      $('#gbh-mobile-overlay').removeClass('active');
    }
    var orderNum = $(this).attr('data-order-num') || '';
    openTrackModal(orderNum);
  });
  $(document).on('click', '#gbh-track-modal-close', function (e) {
    e.preventDefault();
    closeTrackModal();
  });
  $(document).on('click', '#gbh-track-order-modal', function (e) {
    if ($(e.target).is('#gbh-track-order-modal')) {
      closeTrackModal();
    }
  });
  $(document).on('submit', '#gbh-track-order-form', function (e) {
    e.preventDefault();
    var query = $('#gbh-track-query').val().trim();
    if (!query) return;
    var $btn = $('#gbh-track-submit-btn');
    var $resultBox = $('#gbh-track-result-box');
    $btn.prop('disabled', true).text('Searching... 🔍');
    $resultBox.slideUp(150);
    var ajaxUrl = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
    var nonce = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce ? gbh_ajax_obj.nonce : '';
    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: {
        action: 'gbh_track_order',
        nonce: nonce,
        order_query: query
      },
      success: function (res) {
        $btn.prop('disabled', false).text('Track Status ➔');
        if (res.success && res.data) {
          var data = res.data;
          var statusBadgeClass = 'track-badge';
          var statusText = data.order_status || 'In Transit';
          var displayOrderNum = data.order_num || query;
          var trackingLink = data.tracking_url || 'https://shiprocket.co/tracking/' + encodeURIComponent(query);
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
      error: function () {
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
  $(document).on('click', '#star-qty-minus', function (e) {
    e.preventDefault();
    var $input = $('#star-booster-qty');
    var val = parseInt($input.val()) || 1;
    if (val > 1) {
      $input.val(val - 1);
    }
  });
  $(document).on('click', '#star-qty-plus', function (e) {
    e.preventDefault();
    var $input = $('#star-booster-qty');
    var val = parseInt($input.val()) || 1;
    if (val < 50) {
      $input.val(val + 1);
    }
  });
  $(document).on('click', '.star-thumb', function (e) {
    e.preventDefault();
    $(this).addClass('active').siblings().removeClass('active');
  });
  $(document).on('click', '#star-add-to-bag-btn', function (e) {
    e.preventDefault();
    var $btn = $(this);
    var productId = $btn.data('product-id');
    var productName = $btn.data('product-name') || 'Garden Basket Organic Plant Booster (500ml)';
    var qty = parseInt($('#star-booster-qty').val()) || 1;
    var originalHtml = $btn.html();
    $btn.prop('disabled', true).html('Adding... 🌱');
    var ajaxUrl = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
    var nonce = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce ? gbh_ajax_obj.nonce : '';
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
      success: function (res) {
        $btn.prop('disabled', false);
        if (res.success) {
          $btn.html('✓ Added! 🌱');
          setTimeout(function () {
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
      error: function () {
        $btn.prop('disabled', false).html(originalHtml);
        if (window.gbh && window.gbh.showToast) {
          window.gbh.showToast('Connection error. Please try again.', 'error');
        }
      }
    });
  });
  $(document).on('click', '#star-buy-now-btn', function (e) {
    e.preventDefault();
    var $btn = $(this);
    var productId = $btn.data('product-id');
    var qty = parseInt($('#star-booster-qty').val()) || 1;
    var originalHtml = $btn.html();
    $btn.prop('disabled', true).html('Redirecting... ⚡');
    var ajaxUrl = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.ajax_url ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php';
    var nonce = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.nonce ? gbh_ajax_obj.nonce : '';
    var checkoutUrl = typeof gbh_ajax_obj !== 'undefined' && gbh_ajax_obj.checkout_url ? gbh_ajax_obj.checkout_url : '/checkout/';
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
      success: function (res) {
        if (res.success) {
          window.location.href = checkoutUrl;
        } else {
          $btn.prop('disabled', false).html(originalHtml);
          if (window.gbh && window.gbh.showToast) {
            window.gbh.showToast(res.data && res.data.message ? res.data.message : 'Error redirecting to checkout', 'error');
          }
        }
      },
      error: function () {
        $btn.prop('disabled', false).html(originalHtml);
        if (window.gbh && window.gbh.showToast) {
          window.gbh.showToast('Connection error. Please try again.', 'error');
        }
      }
    });
  });
})(jQuery);

/***/ }),

/***/ "../src-utilities/location-manager.js":
/*!********************************************!*\
  !*** ../src-utilities/location-manager.js ***!
  \********************************************/
/***/ (() => {

/**
 * Delivery Location Manager & Sapling Purchase Rules (CR §5)
 * Garden Basket Hub
 */

(function ($) {
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
    if (!loc || loc !== 'jaipur' && loc !== 'outside_jaipur') {
      loc = DEFAULT_LOC;
    }
    localStorage.setItem(LOC_KEY, loc);
    document.cookie = 'gbh_location=' + loc + '; path=/; max-age=' + 60 * 60 * 24 * 30; // 30 days

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
    let label = loc === 'outside_jaipur' ? 'Outside Jaipur' : 'Jaipur';
    $('#gbh-current-loc-name').text(label);
    $('#gbh-mobile-loc-name').text(label);
    $('#gbh-drawer-loc-name').text(label);

    // Highlight selected in modal
    $('.loc-option-card').removeClass('selected');
    $(`.loc-option-card[data-location="${loc}"]`).addClass('selected');
  }

  // 4. Update Product Cards & PDP based on location
  function updateSaplingCardsUI(loc) {
    const isOutside = loc === 'outside_jaipur';

    // Target all product cards that are saplings
    $('.product-card').each(function () {
      let $card = $(this);
      let isSapling = $card.attr('data-is-sapling') === '1' || $card.data('is-sapling') === 1 || $card.attr('data-category') && $card.attr('data-category').indexOf('sapling') !== -1 || $card.find('.product-category').text().trim().toLowerCase().indexOf('sapling') !== -1;
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
      let isPdpSapling = $('[data-is-sapling="1"]').length > 0 || $('.breadcrumb').text().toLowerCase().indexOf('sapling') !== -1 || $('.product-category').text().toLowerCase().indexOf('sapling') !== -1 || document.title.toLowerCase().indexOf('sapling') !== -1;
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
  $(document).ready(function () {
    let savedLoc = getUserLocation();
    if (!savedLoc) {
      // First time visitor: show location prompt modal
      setTimeout(function () {
        openLocationModal();
      }, 700);
      setUserLocation(DEFAULT_LOC, false);
    } else {
      setUserLocation(savedLoc, false);
    }

    // Open location selector when clicking badge
    $(document).on('click', '#gbh-location-btn, #gbh-mobile-location-btn, #gbh-drawer-location-btn', function (e) {
      e.preventDefault();
      openLocationModal();
    });

    // Select option in modal
    $(document).on('click', '.loc-option-card', function () {
      $('.loc-option-card').removeClass('selected');
      $(this).addClass('selected');
    });

    // Confirm location button in modal
    $(document).on('click', '#gbh-confirm-location-btn', function (e) {
      e.preventDefault();
      let selected = $('.loc-option-card.selected').data('location') || DEFAULT_LOC;
      setUserLocation(selected, true);
      closeLocationModal();
    });

    // Close location modal
    $(document).on('click', '#gbh-loc-modal-close', function (e) {
      e.preventDefault();
      closeLocationModal();
    });
    $('#gbh-location-modal').on('click', function (e) {
      if ($(e.target).is('#gbh-location-modal')) {
        closeLocationModal();
      }
    });

    // Intercept clicks on restricted sapling buttons
    $(document).on('click', '.add-btn.sapling-restricted, .btn-buy-now.sapling-restricted', function (e) {
      e.preventDefault();
      e.stopPropagation();
      openSaplingModal();
    });

    // Close sapling modal
    $(document).on('click', '#gbh-sapling-modal-close', function (e) {
      e.preventDefault();
      closeSaplingModal();
    });
    $('#gbh-sapling-modal').on('click', function (e) {
      if ($(e.target).is('#gbh-sapling-modal')) {
        closeSaplingModal();
      }
    });

    // Switch to Jaipur from Sapling Modal
    $(document).on('click', '#gbh-switch-to-jaipur-btn', function (e) {
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

/***/ }),

/***/ "../src-utilities/main.js":
/*!********************************!*\
  !*** ../src-utilities/main.js ***!
  \********************************/
/***/ (() => {

(function ($) {
  'use strict';

  // Toast Notification Handler
  function showToast(message, type = 'success') {
    let $toast = $('#gbh-toast-notification');
    if (!$toast.length) {
      $toast = $('<div id="gbh-toast-notification" class="gbh-toast"></div>').appendTo('body');
    }
    let icon = type === 'success' ? '🌱' : '⚠️';
    $toast.html('<span>' + icon + '</span> <span>' + message + '</span>').addClass('show');
    setTimeout(function () {
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
      $('.cart-layout').fadeOut(300, function () {
        $(this).replaceWith(`
                    <div class="empty-cart-view-container">
                        <div class="empty-icon">🛒 🌿</div>
                        <h2 class="empty-title">Your garden bag is empty</h2>
                        <p class="empty-desc">You haven't added any seeds, saplings, or gardening supplies to your bag yet.</p>
                        <a href="${gbh_ajax_obj.cart_url.replace('/cart/', '/shop/')}" class="btn-primary empty-btn">
                            Explore Nursery Shop ➔
                        </a>
                    </div>
                `);
      });
    }
  }

  // Expose globally
  window.gbh = window.gbh || {};
  window.gbh.showToast = showToast;
  window.gbh.updateCartCountBadge = updateCartCountBadge;
  window.gbh.updateCartDOM = updateCartDOM;
})(jQuery);

/***/ }),

/***/ "./about-us/aboutUs.scss":
/*!*******************************!*\
  !*** ./about-us/aboutUs.scss ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*****************************!*\
  !*** ./about-us/aboutUs.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../src-utilities/main.js */ "../src-utilities/main.js");
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../src-utilities/global.js */ "../src-utilities/global.js");
/* harmony import */ var _aboutUs_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./aboutUs.scss */ "./about-us/aboutUs.scss");



})();

/******/ })()
;
//# sourceMappingURL=aboutUs.bundle.js.map