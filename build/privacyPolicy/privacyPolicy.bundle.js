/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../../node_modules/aos/dist/aos.js":
/*!******************************************!*\
  !*** ../../node_modules/aos/dist/aos.js ***!
  \******************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,function(){return function(e){function t(o){if(n[o])return n[o].exports;var i=n[o]={exports:{},id:o,loaded:!1};return e[o].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var n={};return t.m=e,t.c=n,t.p="dist/",t(0)}([function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},r=n(1),a=(o(r),n(6)),u=o(a),c=n(7),s=o(c),f=n(8),d=o(f),l=n(9),p=o(l),m=n(10),b=o(m),v=n(11),y=o(v),g=n(14),h=o(g),w=[],k=!1,x={offset:120,delay:0,easing:"ease",duration:400,disable:!1,once:!1,startEvent:"DOMContentLoaded",throttleDelay:99,debounceDelay:50,disableMutationObserver:!1},j=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(e&&(k=!0),k)return w=(0,y.default)(w,x),(0,b.default)(w,x.once),w},O=function(){w=(0,h.default)(),j()},M=function(){w.forEach(function(e,t){e.node.removeAttribute("data-aos"),e.node.removeAttribute("data-aos-easing"),e.node.removeAttribute("data-aos-duration"),e.node.removeAttribute("data-aos-delay")})},S=function(e){return e===!0||"mobile"===e&&p.default.mobile()||"phone"===e&&p.default.phone()||"tablet"===e&&p.default.tablet()||"function"==typeof e&&e()===!0},_=function(e){x=i(x,e),w=(0,h.default)();var t=document.all&&!window.atob;return S(x.disable)||t?M():(x.disableMutationObserver||d.default.isSupported()||(console.info('\n      aos: MutationObserver is not supported on this browser,\n      code mutations observing has been disabled.\n      You may have to call "refreshHard()" by yourself.\n    '),x.disableMutationObserver=!0),document.querySelector("body").setAttribute("data-aos-easing",x.easing),document.querySelector("body").setAttribute("data-aos-duration",x.duration),document.querySelector("body").setAttribute("data-aos-delay",x.delay),"DOMContentLoaded"===x.startEvent&&["complete","interactive"].indexOf(document.readyState)>-1?j(!0):"load"===x.startEvent?window.addEventListener(x.startEvent,function(){j(!0)}):document.addEventListener(x.startEvent,function(){j(!0)}),window.addEventListener("resize",(0,s.default)(j,x.debounceDelay,!0)),window.addEventListener("orientationchange",(0,s.default)(j,x.debounceDelay,!0)),window.addEventListener("scroll",(0,u.default)(function(){(0,b.default)(w,x.once)},x.throttleDelay)),x.disableMutationObserver||d.default.ready("[data-aos]",O),w)};e.exports={init:_,refresh:j,refreshHard:O}},function(e,t){},,,,,function(e,t){(function(t){"use strict";function n(e,t,n){function o(t){var n=b,o=v;return b=v=void 0,k=t,g=e.apply(o,n)}function r(e){return k=e,h=setTimeout(f,t),M?o(e):g}function a(e){var n=e-w,o=e-k,i=t-n;return S?j(i,y-o):i}function c(e){var n=e-w,o=e-k;return void 0===w||n>=t||n<0||S&&o>=y}function f(){var e=O();return c(e)?d(e):void(h=setTimeout(f,a(e)))}function d(e){return h=void 0,_&&b?o(e):(b=v=void 0,g)}function l(){void 0!==h&&clearTimeout(h),k=0,b=w=v=h=void 0}function p(){return void 0===h?g:d(O())}function m(){var e=O(),n=c(e);if(b=arguments,v=this,w=e,n){if(void 0===h)return r(w);if(S)return h=setTimeout(f,t),o(w)}return void 0===h&&(h=setTimeout(f,t)),g}var b,v,y,g,h,w,k=0,M=!1,S=!1,_=!0;if("function"!=typeof e)throw new TypeError(s);return t=u(t)||0,i(n)&&(M=!!n.leading,S="maxWait"in n,y=S?x(u(n.maxWait)||0,t):y,_="trailing"in n?!!n.trailing:_),m.cancel=l,m.flush=p,m}function o(e,t,o){var r=!0,a=!0;if("function"!=typeof e)throw new TypeError(s);return i(o)&&(r="leading"in o?!!o.leading:r,a="trailing"in o?!!o.trailing:a),n(e,t,{leading:r,maxWait:t,trailing:a})}function i(e){var t="undefined"==typeof e?"undefined":c(e);return!!e&&("object"==t||"function"==t)}function r(e){return!!e&&"object"==("undefined"==typeof e?"undefined":c(e))}function a(e){return"symbol"==("undefined"==typeof e?"undefined":c(e))||r(e)&&k.call(e)==d}function u(e){if("number"==typeof e)return e;if(a(e))return f;if(i(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(l,"");var n=m.test(e);return n||b.test(e)?v(e.slice(2),n?2:8):p.test(e)?f:+e}var c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},s="Expected a function",f=NaN,d="[object Symbol]",l=/^\s+|\s+$/g,p=/^[-+]0x[0-9a-f]+$/i,m=/^0b[01]+$/i,b=/^0o[0-7]+$/i,v=parseInt,y="object"==("undefined"==typeof t?"undefined":c(t))&&t&&t.Object===Object&&t,g="object"==("undefined"==typeof self?"undefined":c(self))&&self&&self.Object===Object&&self,h=y||g||Function("return this")(),w=Object.prototype,k=w.toString,x=Math.max,j=Math.min,O=function(){return h.Date.now()};e.exports=o}).call(t,function(){return this}())},function(e,t){(function(t){"use strict";function n(e,t,n){function i(t){var n=b,o=v;return b=v=void 0,O=t,g=e.apply(o,n)}function r(e){return O=e,h=setTimeout(f,t),M?i(e):g}function u(e){var n=e-w,o=e-O,i=t-n;return S?x(i,y-o):i}function s(e){var n=e-w,o=e-O;return void 0===w||n>=t||n<0||S&&o>=y}function f(){var e=j();return s(e)?d(e):void(h=setTimeout(f,u(e)))}function d(e){return h=void 0,_&&b?i(e):(b=v=void 0,g)}function l(){void 0!==h&&clearTimeout(h),O=0,b=w=v=h=void 0}function p(){return void 0===h?g:d(j())}function m(){var e=j(),n=s(e);if(b=arguments,v=this,w=e,n){if(void 0===h)return r(w);if(S)return h=setTimeout(f,t),i(w)}return void 0===h&&(h=setTimeout(f,t)),g}var b,v,y,g,h,w,O=0,M=!1,S=!1,_=!0;if("function"!=typeof e)throw new TypeError(c);return t=a(t)||0,o(n)&&(M=!!n.leading,S="maxWait"in n,y=S?k(a(n.maxWait)||0,t):y,_="trailing"in n?!!n.trailing:_),m.cancel=l,m.flush=p,m}function o(e){var t="undefined"==typeof e?"undefined":u(e);return!!e&&("object"==t||"function"==t)}function i(e){return!!e&&"object"==("undefined"==typeof e?"undefined":u(e))}function r(e){return"symbol"==("undefined"==typeof e?"undefined":u(e))||i(e)&&w.call(e)==f}function a(e){if("number"==typeof e)return e;if(r(e))return s;if(o(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=o(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(d,"");var n=p.test(e);return n||m.test(e)?b(e.slice(2),n?2:8):l.test(e)?s:+e}var u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},c="Expected a function",s=NaN,f="[object Symbol]",d=/^\s+|\s+$/g,l=/^[-+]0x[0-9a-f]+$/i,p=/^0b[01]+$/i,m=/^0o[0-7]+$/i,b=parseInt,v="object"==("undefined"==typeof t?"undefined":u(t))&&t&&t.Object===Object&&t,y="object"==("undefined"==typeof self?"undefined":u(self))&&self&&self.Object===Object&&self,g=v||y||Function("return this")(),h=Object.prototype,w=h.toString,k=Math.max,x=Math.min,j=function(){return g.Date.now()};e.exports=n}).call(t,function(){return this}())},function(e,t){"use strict";function n(e){var t=void 0,o=void 0,i=void 0;for(t=0;t<e.length;t+=1){if(o=e[t],o.dataset&&o.dataset.aos)return!0;if(i=o.children&&n(o.children))return!0}return!1}function o(){return window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver}function i(){return!!o()}function r(e,t){var n=window.document,i=o(),r=new i(a);u=t,r.observe(n.documentElement,{childList:!0,subtree:!0,removedNodes:!0})}function a(e){e&&e.forEach(function(e){var t=Array.prototype.slice.call(e.addedNodes),o=Array.prototype.slice.call(e.removedNodes),i=t.concat(o);if(n(i))return u()})}Object.defineProperty(t,"__esModule",{value:!0});var u=function(){};t.default={isSupported:i,ready:r}},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(){return navigator.userAgent||navigator.vendor||window.opera||""}Object.defineProperty(t,"__esModule",{value:!0});var i=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),r=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i,a=/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,u=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i,c=/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,s=function(){function e(){n(this,e)}return i(e,[{key:"phone",value:function(){var e=o();return!(!r.test(e)&&!a.test(e.substr(0,4)))}},{key:"mobile",value:function(){var e=o();return!(!u.test(e)&&!c.test(e.substr(0,4)))}},{key:"tablet",value:function(){return this.mobile()&&!this.phone()}}]),e}();t.default=new s},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e,t,n){var o=e.node.getAttribute("data-aos-once");t>e.position?e.node.classList.add("aos-animate"):"undefined"!=typeof o&&("false"===o||!n&&"true"!==o)&&e.node.classList.remove("aos-animate")},o=function(e,t){var o=window.pageYOffset,i=window.innerHeight;e.forEach(function(e,r){n(e,i+o,t)})};t.default=o},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var i=n(12),r=o(i),a=function(e,t){return e.forEach(function(e,n){e.node.classList.add("aos-init"),e.position=(0,r.default)(e.node,t.offset)}),e};t.default=a},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var i=n(13),r=o(i),a=function(e,t){var n=0,o=0,i=window.innerHeight,a={offset:e.getAttribute("data-aos-offset"),anchor:e.getAttribute("data-aos-anchor"),anchorPlacement:e.getAttribute("data-aos-anchor-placement")};switch(a.offset&&!isNaN(a.offset)&&(o=parseInt(a.offset)),a.anchor&&document.querySelectorAll(a.anchor)&&(e=document.querySelectorAll(a.anchor)[0]),n=(0,r.default)(e).top,a.anchorPlacement){case"top-bottom":break;case"center-bottom":n+=e.offsetHeight/2;break;case"bottom-bottom":n+=e.offsetHeight;break;case"top-center":n+=i/2;break;case"bottom-center":n+=i/2+e.offsetHeight;break;case"center-center":n+=i/2+e.offsetHeight/2;break;case"top-top":n+=i;break;case"bottom-top":n+=e.offsetHeight+i;break;case"center-top":n+=e.offsetHeight/2+i}return a.anchorPlacement||a.offset||isNaN(t)||(o=t),n+o};t.default=a},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e){for(var t=0,n=0;e&&!isNaN(e.offsetLeft)&&!isNaN(e.offsetTop);)t+=e.offsetLeft-("BODY"!=e.tagName?e.scrollLeft:0),n+=e.offsetTop-("BODY"!=e.tagName?e.scrollTop:0),e=e.offsetParent;return{top:n,left:t}};t.default=n},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e){return e=e||document.querySelectorAll("[data-aos]"),Array.prototype.map.call(e,function(e){return{node:e}})};t.default=n}])});

/***/ }),

/***/ "../src-utilities/footer.js":
/*!**********************************!*\
  !*** ../src-utilities/footer.js ***!
  \**********************************/
/***/ (() => {

/**
 * Garden Basket Hub — Global Footer JS
 * Reserved for future footer-specific interactions
 * (e.g. newsletter subscribe, footer CTA animations, etc.)
 */

// Placeholder — footer global logic goes here

/***/ }),

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

/***/ "../src-utilities/header.js":
/*!**********************************!*\
  !*** ../src-utilities/header.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main.js */ "../src-utilities/main.js");
/* harmony import */ var _main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./global.js */ "../src-utilities/global.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! aos */ "../../node_modules/aos/dist/aos.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_2__);
// Garden Basket Hub — Header Navigation Utility



if (typeof (aos__WEBPACK_IMPORTED_MODULE_2___default()) !== 'undefined') {
  aos__WEBPACK_IMPORTED_MODULE_2___default().init();
}
document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('gbh-mobile-toggle');
  const closeBtn = document.getElementById('gbh-mobile-close');
  const overlay = document.getElementById('gbh-mobile-overlay');
  const drawer = document.getElementById('gbh-mobile-drawer');
  if (!toggleBtn || !drawer) return;
  const openDrawer = e => {
    if (e) e.preventDefault();
    drawer.classList.add('open');
    if (overlay) overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  };
  const closeDrawer = e => {
    if (e) e.preventDefault();
    drawer.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    document.body.style.overflow = '';
  };
  toggleBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // Close drawer when any nav link inside it is clicked
  const drawerLinks = drawer.querySelectorAll('a');
  drawerLinks.forEach(link => {
    link.addEventListener('click', closeDrawer);
  });
});

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

/***/ "./privacy-policy/privacyPolicy.scss":
/*!*******************************************!*\
  !*** ./privacy-policy/privacyPolicy.scss ***!
  \*******************************************/
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
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
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
/*!*****************************************!*\
  !*** ./privacy-policy/privacyPolicy.js ***!
  \*****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _privacyPolicy_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./privacyPolicy.scss */ "./privacy-policy/privacyPolicy.scss");
/* harmony import */ var _src_utilities_header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./../../src-utilities/header */ "../src-utilities/header.js");
/* harmony import */ var _src_utilities_footer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./../../src-utilities/footer */ "../src-utilities/footer.js");
/* harmony import */ var _src_utilities_footer__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_footer__WEBPACK_IMPORTED_MODULE_2__);



})();

/******/ })()
;
//# sourceMappingURL=privacyPolicy.bundle.js.map