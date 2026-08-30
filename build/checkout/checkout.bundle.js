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

/***/ "./checkout/checkout.scss":
/*!********************************!*\
  !*** ./checkout/checkout.scss ***!
  \********************************/
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
/*!******************************!*\
  !*** ./checkout/checkout.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../src-utilities/main.js */ "../src-utilities/main.js");
/* harmony import */ var _src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../src-utilities/global.js */ "../src-utilities/global.js");
/* harmony import */ var _src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_global_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _checkout_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./checkout.scss */ "./checkout/checkout.scss");



(function ($) {
  'use strict';

  // 8. Payment Method Selection (Checkout)
  $(document).on('click', '.pay-option', function () {
    $('.pay-option').removeClass('selected');
    $(this).addClass('selected');
    let method = $(this).find('.label').text().trim();
    $('#payment_method_input').val(method);
  });

  // 9. Checkout Form Submission with Razorpay Modal Integration
  $(document).on('submit', '#gbh-checkout-form', function (e) {
    e.preventDefault();
    let $form = $(this);
    let $btn = $form.find('button[type="submit"], .btn-place-order');
    let paymentMethod = $('#payment_method_input').val() || 'UPI / Razorpay';
    $btn.prop('disabled', true).text('Processing Order...');
    let processFinalOrderPlacement = function (extraFields) {
      let formData = $form.serializeArray();
      formData.push({
        name: 'action',
        value: 'gbh_place_order'
      });
      formData.push({
        name: 'nonce',
        value: gbh_ajax_obj.nonce
      });
      if (extraFields && Array.isArray(extraFields)) {
        extraFields.forEach(function (f) {
          formData.push(f);
        });
      }
      $.ajax({
        url: gbh_ajax_obj.ajax_url,
        type: 'POST',
        data: $.param(formData),
        success: function (response) {
          if (response.success) {
            window.gbh.showToast(response.data.message, 'success');
            setTimeout(function () {
              window.location.href = response.data.redirect_url;
            }, 1000);
          } else {
            $btn.prop('disabled', false).text('Place Order');
            window.gbh.showToast(response.data.message, 'error');
          }
        },
        error: function () {
          $btn.prop('disabled', false).text('Place Order');
          window.gbh.showToast('Order processing failed. Please try again.', 'error');
        }
      });
    };

    // If Online Payment (Razorpay / UPI), launch Razorpay Checkout Popup
    if (paymentMethod.indexOf('Razorpay') !== -1 || paymentMethod.indexOf('UPI') !== -1 || paymentMethod.indexOf('Partial') !== -1) {
      $.ajax({
        url: gbh_ajax_obj.ajax_url,
        type: 'POST',
        data: {
          action: 'gbh_create_razorpay_order',
          nonce: gbh_ajax_obj.nonce
        },
        success: function (res) {
          if (res.success && typeof Razorpay !== 'undefined') {
            let options = {
              "key": res.data.key_id,
              "amount": res.data.amount,
              "currency": "INR",
              "name": "Garden Basket Hub",
              "description": "Nursery Plants & Supplies Order",
              "handler": function (response) {
                processFinalOrderPlacement([{
                  name: 'razorpay_payment_id',
                  value: response.razorpay_payment_id
                }, {
                  name: 'razorpay_order_id',
                  value: response.razorpay_order_id
                }]);
              },
              "prefill": {
                "name": $form.find('input[name="first_name"]').val() + ' ' + $form.find('input[name="last_name"]').val(),
                "email": $form.find('input[name="email"]').val(),
                "contact": $form.find('input[name="phone"]').val()
              },
              "theme": {
                "color": "#3A6B35"
              },
              "modal": {
                "ondismiss": function () {
                  $btn.prop('disabled', false).text('Place Order');
                  window.gbh.showToast('Payment window closed. Order not placed.', 'warning');
                }
              }
            };
            let rzp1 = new Razorpay(options);
            rzp1.open();
          } else {
            // Fallback if Razorpay SDK or Keys not present
            processFinalOrderPlacement([]);
          }
        },
        error: function () {
          processFinalOrderPlacement([]);
        }
      });
    } else {
      // COD / Direct Order Placement
      processFinalOrderPlacement([]);
    }
  });
})(jQuery);
})();

/******/ })()
;
//# sourceMappingURL=checkout.bundle.js.map