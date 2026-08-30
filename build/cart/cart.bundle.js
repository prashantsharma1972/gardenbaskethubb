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

/***/ "./cart/cart.scss":
/*!************************!*\
  !*** ./cart/cart.scss ***!
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
  !*** ./cart/cart.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../src-utilities/main.js */ "../src-utilities/main.js");
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../src-utilities/global.js */ "../src-utilities/global.js");
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _cart_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./cart.scss */ "./cart/cart.scss");



(function ($) {
  'use strict';

  // 2. Cart Quantity Stepper (+ / -) Buttons
  $(document).on('click', '.qty-stepper button', function (e) {
    e.preventDefault();
    let $btn = $(this);
    let $input = $btn.siblings('input');
    let currentVal = parseInt($input.val()) || 1;
    let isPlus = $btn.hasClass('btn-qty-plus') || $btn.text().trim() === '+';
    let newVal = isPlus ? currentVal + 1 : Math.max(1, currentVal - 1);
    $input.val(newVal).trigger('change');
  });

  // 3. Cart Page Quantity / Item Update (Dynamic DOM Update)
  $(document).on('change', '.cart-row .qty-stepper input', function () {
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
      success: function (response) {
        if (response.success) {
          // Find matching item line total
          let items = response.data.items;
          let item = items.find(i => i.key === key);
          if (item) {
            $row.find('.price').text(item.line_total_formatted);
          } else {
            $row.fadeOut(300, function () {
              $(this).remove();
            });
          }
          window.gbh.updateCartDOM(response.data);
        }
      }
    });
  });

  // 4. Remove Item from Cart
  $(document).on('click', '.cart-actions .remove', function (e) {
    e.preventDefault();
    let $row = $(this).closest('.cart-row');
    let key = $row.data('cart-key');
    if (!key) {
      $row.fadeOut(300, function () {
        $(this).remove();
      });
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
      success: function (response) {
        if (response.success) {
          $row.fadeOut(300, function () {
            $(this).remove();
          });
          window.gbh.updateCartDOM(response.data);
        }
      }
    });
  });

  // 5. Apply Coupon Code
  $(document).on('click', '.cart-summary .coupon button, .btn-apply-coupon', function (e) {
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
      success: function (response) {
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
})();

/******/ })()
;
//# sourceMappingURL=cart.bundle.js.map