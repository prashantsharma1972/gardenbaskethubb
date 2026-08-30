/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../src-utilities/global.js":
/*!**********************************!*\
  !*** ../src-utilities/global.js ***!
  \**********************************/
/***/ (() => {

(function ($) {
  'use strict';

  // 12. Mobile Menu Drawer Toggle
  $(document).on('click', '#gbh-mobile-toggle', function (e) {
    e.preventDefault();
    $('#gbh-mobile-drawer').addClass('active');
    $('#gbh-mobile-overlay').addClass('active');
    $('body').css('overflow', 'hidden');
  });
  $(document).on('click', '#gbh-mobile-close, #gbh-mobile-overlay', function (e) {
    e.preventDefault();
    $('#gbh-mobile-drawer').removeClass('active');
    $('#gbh-mobile-overlay').removeClass('active');
    $('body').css('overflow', '');
  });

  // 15. Contact Form Handler
  $(document).on('submit', '.contact-form', function (e) {
    e.preventDefault();
    let $form = $(this);
    let $btn = $form.find('button[type="submit"]');
    $btn.prop('disabled', true).text('Sending message...');
    setTimeout(function () {
      $btn.prop('disabled', false).text('Send Message');
      $form[0].reset();
      window.gbh.showToast('Thank you! Your message has been sent to our Jaipur nursery team.', 'success');
    }, 800);
  });

  // 16. Product Card Single View Navigation
  $(document).on('click', '.product-card', function (e) {
    if ($(e.target).closest('.add-btn, .btn-buy-now, input, button, select').length > 0) {
      return; // allow button actions without navigating
    }
    let permalink = $(this).attr('data-permalink') || $(this).find('.product-name a').attr('href');
    if (permalink && permalink !== '#' && permalink !== '') {
      window.location.href = permalink;
    }
  });
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
                        <p class="empty-desc">You haven't added any seeds, seedlings, or gardening tools to your bag yet.</p>
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

/***/ "./shop/shop.scss":
/*!************************!*\
  !*** ./shop/shop.scss ***!
  \************************/
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
/*!**********************!*\
  !*** ./shop/shop.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../src-utilities/main.js */ "../src-utilities/main.js");
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../src-utilities/global.js */ "../src-utilities/global.js");
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _shop_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./shop.scss */ "./shop/shop.scss");



(function ($) {
  'use strict';

  // 1. AJAX Add to Cart / Buy Now Button
  $(document).on('click', '.add-btn, .btn-add-to-cart, .btn-buy-now', function (e) {
    e.preventDefault();
    let $btn = $(this);
    let isBuyNow = $btn.hasClass('btn-buy-now') || $btn.text().trim().toLowerCase() === 'buy now';
    let productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id');
    let quantity = parseInt($('.qty-stepper input').val()) || 1;
    let variant = $('.opt-pill.selected').text().trim() || '';
    if (!productId) {
      if (window.gbh && window.gbh.showToast) window.gbh.showToast('Please select a valid product', 'error');
      return;
    }
    $btn.prop('disabled', true).css('opacity', '0.7').text('Adding...');
    $.ajax({
      url: typeof gbh_ajax_obj !== 'undefined' ? gbh_ajax_obj.ajax_url : '/wp-admin/admin-ajax.php',
      type: 'POST',
      data: {
        action: 'gbh_add_to_cart',
        nonce: typeof gbh_ajax_obj !== 'undefined' ? gbh_ajax_obj.nonce : '',
        product_id: productId,
        quantity: quantity,
        variant: variant
      },
      success: function (response) {
        $btn.prop('disabled', false).css('opacity', '1').text('Add to bag');
        if (response.success) {
          if (window.gbh && window.gbh.updateCartDOM) window.gbh.updateCartDOM(response.data.cart);
          if (isBuyNow) {
            window.location.href = typeof gbh_ajax_obj !== 'undefined' ? gbh_ajax_obj.checkout_url : '/checkout';
          } else {
            if (window.gbh && window.gbh.showToast) window.gbh.showToast(response.data.message, 'success');else alert("Added to cart!");
          }
        } else {
          if (window.gbh && window.gbh.showToast) window.gbh.showToast(response.data.message || 'Error adding to cart', 'error');
        }
      },
      error: function () {
        $btn.prop('disabled', false).css('opacity', '1').text('Add to bag');
        if (window.gbh && window.gbh.showToast) window.gbh.showToast('Network error. Please try again.', 'error');
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
    $cards.each(function () {
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
  $(document).on('click', '.filter-container .filter', function () {
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
  $('#search-products').on('input', function () {
    runFilters();
  });

  // Clear All
  $('.filter-btns .clear').on('click', function () {
    $('.filter-container .filter').removeClass('active');
    $('#search-products').val('');
    runFilters();
  });

  // Sorting
  $('.sorting p').on('click', function () {
    let sortType = $(this).data('find'); // newest, low-high, high-low
    let label = $(this).data('attr');
    $('#sort-by').text(label);
    let $grid = $('#gbh-product-grid');
    let $cards = $grid.find('.product-card').get();
    $cards.sort(function (a, b) {
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
    $.each($cards, function (idx, itm) {
      $grid.append(itm);
    });
    runFilters(); // Ensure visibility matches filters after sorting

    // Hide dropdown
    $('.sorting').hide();
  });

  // Toggle sort dropdown
  $('.sort-by-heading').on('click', function () {
    $('.sorting').toggle();
  });
})(jQuery);
})();

/******/ })()
;
//# sourceMappingURL=shop.bundle.js.map