/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../../node_modules/aos/dist/aos.js":
/*!******************************************!*\
  !*** ../../node_modules/aos/dist/aos.js ***!
  \******************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,function(){return function(e){function t(o){if(n[o])return n[o].exports;var i=n[o]={exports:{},id:o,loaded:!1};return e[o].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var n={};return t.m=e,t.c=n,t.p="dist/",t(0)}([function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},r=n(1),a=(o(r),n(6)),u=o(a),c=n(7),s=o(c),f=n(8),d=o(f),l=n(9),p=o(l),m=n(10),b=o(m),v=n(11),y=o(v),g=n(14),h=o(g),w=[],k=!1,x={offset:120,delay:0,easing:"ease",duration:400,disable:!1,once:!1,startEvent:"DOMContentLoaded",throttleDelay:99,debounceDelay:50,disableMutationObserver:!1},j=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(e&&(k=!0),k)return w=(0,y.default)(w,x),(0,b.default)(w,x.once),w},O=function(){w=(0,h.default)(),j()},M=function(){w.forEach(function(e,t){e.node.removeAttribute("data-aos"),e.node.removeAttribute("data-aos-easing"),e.node.removeAttribute("data-aos-duration"),e.node.removeAttribute("data-aos-delay")})},S=function(e){return e===!0||"mobile"===e&&p.default.mobile()||"phone"===e&&p.default.phone()||"tablet"===e&&p.default.tablet()||"function"==typeof e&&e()===!0},_=function(e){x=i(x,e),w=(0,h.default)();var t=document.all&&!window.atob;return S(x.disable)||t?M():(x.disableMutationObserver||d.default.isSupported()||(console.info('\n      aos: MutationObserver is not supported on this browser,\n      code mutations observing has been disabled.\n      You may have to call "refreshHard()" by yourself.\n    '),x.disableMutationObserver=!0),document.querySelector("body").setAttribute("data-aos-easing",x.easing),document.querySelector("body").setAttribute("data-aos-duration",x.duration),document.querySelector("body").setAttribute("data-aos-delay",x.delay),"DOMContentLoaded"===x.startEvent&&["complete","interactive"].indexOf(document.readyState)>-1?j(!0):"load"===x.startEvent?window.addEventListener(x.startEvent,function(){j(!0)}):document.addEventListener(x.startEvent,function(){j(!0)}),window.addEventListener("resize",(0,s.default)(j,x.debounceDelay,!0)),window.addEventListener("orientationchange",(0,s.default)(j,x.debounceDelay,!0)),window.addEventListener("scroll",(0,u.default)(function(){(0,b.default)(w,x.once)},x.throttleDelay)),x.disableMutationObserver||d.default.ready("[data-aos]",O),w)};e.exports={init:_,refresh:j,refreshHard:O}},function(e,t){},,,,,function(e,t){(function(t){"use strict";function n(e,t,n){function o(t){var n=b,o=v;return b=v=void 0,k=t,g=e.apply(o,n)}function r(e){return k=e,h=setTimeout(f,t),M?o(e):g}function a(e){var n=e-w,o=e-k,i=t-n;return S?j(i,y-o):i}function c(e){var n=e-w,o=e-k;return void 0===w||n>=t||n<0||S&&o>=y}function f(){var e=O();return c(e)?d(e):void(h=setTimeout(f,a(e)))}function d(e){return h=void 0,_&&b?o(e):(b=v=void 0,g)}function l(){void 0!==h&&clearTimeout(h),k=0,b=w=v=h=void 0}function p(){return void 0===h?g:d(O())}function m(){var e=O(),n=c(e);if(b=arguments,v=this,w=e,n){if(void 0===h)return r(w);if(S)return h=setTimeout(f,t),o(w)}return void 0===h&&(h=setTimeout(f,t)),g}var b,v,y,g,h,w,k=0,M=!1,S=!1,_=!0;if("function"!=typeof e)throw new TypeError(s);return t=u(t)||0,i(n)&&(M=!!n.leading,S="maxWait"in n,y=S?x(u(n.maxWait)||0,t):y,_="trailing"in n?!!n.trailing:_),m.cancel=l,m.flush=p,m}function o(e,t,o){var r=!0,a=!0;if("function"!=typeof e)throw new TypeError(s);return i(o)&&(r="leading"in o?!!o.leading:r,a="trailing"in o?!!o.trailing:a),n(e,t,{leading:r,maxWait:t,trailing:a})}function i(e){var t="undefined"==typeof e?"undefined":c(e);return!!e&&("object"==t||"function"==t)}function r(e){return!!e&&"object"==("undefined"==typeof e?"undefined":c(e))}function a(e){return"symbol"==("undefined"==typeof e?"undefined":c(e))||r(e)&&k.call(e)==d}function u(e){if("number"==typeof e)return e;if(a(e))return f;if(i(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(l,"");var n=m.test(e);return n||b.test(e)?v(e.slice(2),n?2:8):p.test(e)?f:+e}var c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},s="Expected a function",f=NaN,d="[object Symbol]",l=/^\s+|\s+$/g,p=/^[-+]0x[0-9a-f]+$/i,m=/^0b[01]+$/i,b=/^0o[0-7]+$/i,v=parseInt,y="object"==("undefined"==typeof t?"undefined":c(t))&&t&&t.Object===Object&&t,g="object"==("undefined"==typeof self?"undefined":c(self))&&self&&self.Object===Object&&self,h=y||g||Function("return this")(),w=Object.prototype,k=w.toString,x=Math.max,j=Math.min,O=function(){return h.Date.now()};e.exports=o}).call(t,function(){return this}())},function(e,t){(function(t){"use strict";function n(e,t,n){function i(t){var n=b,o=v;return b=v=void 0,O=t,g=e.apply(o,n)}function r(e){return O=e,h=setTimeout(f,t),M?i(e):g}function u(e){var n=e-w,o=e-O,i=t-n;return S?x(i,y-o):i}function s(e){var n=e-w,o=e-O;return void 0===w||n>=t||n<0||S&&o>=y}function f(){var e=j();return s(e)?d(e):void(h=setTimeout(f,u(e)))}function d(e){return h=void 0,_&&b?i(e):(b=v=void 0,g)}function l(){void 0!==h&&clearTimeout(h),O=0,b=w=v=h=void 0}function p(){return void 0===h?g:d(j())}function m(){var e=j(),n=s(e);if(b=arguments,v=this,w=e,n){if(void 0===h)return r(w);if(S)return h=setTimeout(f,t),i(w)}return void 0===h&&(h=setTimeout(f,t)),g}var b,v,y,g,h,w,O=0,M=!1,S=!1,_=!0;if("function"!=typeof e)throw new TypeError(c);return t=a(t)||0,o(n)&&(M=!!n.leading,S="maxWait"in n,y=S?k(a(n.maxWait)||0,t):y,_="trailing"in n?!!n.trailing:_),m.cancel=l,m.flush=p,m}function o(e){var t="undefined"==typeof e?"undefined":u(e);return!!e&&("object"==t||"function"==t)}function i(e){return!!e&&"object"==("undefined"==typeof e?"undefined":u(e))}function r(e){return"symbol"==("undefined"==typeof e?"undefined":u(e))||i(e)&&w.call(e)==f}function a(e){if("number"==typeof e)return e;if(r(e))return s;if(o(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=o(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(d,"");var n=p.test(e);return n||m.test(e)?b(e.slice(2),n?2:8):l.test(e)?s:+e}var u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},c="Expected a function",s=NaN,f="[object Symbol]",d=/^\s+|\s+$/g,l=/^[-+]0x[0-9a-f]+$/i,p=/^0b[01]+$/i,m=/^0o[0-7]+$/i,b=parseInt,v="object"==("undefined"==typeof t?"undefined":u(t))&&t&&t.Object===Object&&t,y="object"==("undefined"==typeof self?"undefined":u(self))&&self&&self.Object===Object&&self,g=v||y||Function("return this")(),h=Object.prototype,w=h.toString,k=Math.max,x=Math.min,j=function(){return g.Date.now()};e.exports=n}).call(t,function(){return this}())},function(e,t){"use strict";function n(e){var t=void 0,o=void 0,i=void 0;for(t=0;t<e.length;t+=1){if(o=e[t],o.dataset&&o.dataset.aos)return!0;if(i=o.children&&n(o.children))return!0}return!1}function o(){return window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver}function i(){return!!o()}function r(e,t){var n=window.document,i=o(),r=new i(a);u=t,r.observe(n.documentElement,{childList:!0,subtree:!0,removedNodes:!0})}function a(e){e&&e.forEach(function(e){var t=Array.prototype.slice.call(e.addedNodes),o=Array.prototype.slice.call(e.removedNodes),i=t.concat(o);if(n(i))return u()})}Object.defineProperty(t,"__esModule",{value:!0});var u=function(){};t.default={isSupported:i,ready:r}},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(){return navigator.userAgent||navigator.vendor||window.opera||""}Object.defineProperty(t,"__esModule",{value:!0});var i=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),r=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i,a=/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,u=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i,c=/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,s=function(){function e(){n(this,e)}return i(e,[{key:"phone",value:function(){var e=o();return!(!r.test(e)&&!a.test(e.substr(0,4)))}},{key:"mobile",value:function(){var e=o();return!(!u.test(e)&&!c.test(e.substr(0,4)))}},{key:"tablet",value:function(){return this.mobile()&&!this.phone()}}]),e}();t.default=new s},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e,t,n){var o=e.node.getAttribute("data-aos-once");t>e.position?e.node.classList.add("aos-animate"):"undefined"!=typeof o&&("false"===o||!n&&"true"!==o)&&e.node.classList.remove("aos-animate")},o=function(e,t){var o=window.pageYOffset,i=window.innerHeight;e.forEach(function(e,r){n(e,i+o,t)})};t.default=o},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var i=n(12),r=o(i),a=function(e,t){return e.forEach(function(e,n){e.node.classList.add("aos-init"),e.position=(0,r.default)(e.node,t.offset)}),e};t.default=a},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var i=n(13),r=o(i),a=function(e,t){var n=0,o=0,i=window.innerHeight,a={offset:e.getAttribute("data-aos-offset"),anchor:e.getAttribute("data-aos-anchor"),anchorPlacement:e.getAttribute("data-aos-anchor-placement")};switch(a.offset&&!isNaN(a.offset)&&(o=parseInt(a.offset)),a.anchor&&document.querySelectorAll(a.anchor)&&(e=document.querySelectorAll(a.anchor)[0]),n=(0,r.default)(e).top,a.anchorPlacement){case"top-bottom":break;case"center-bottom":n+=e.offsetHeight/2;break;case"bottom-bottom":n+=e.offsetHeight;break;case"top-center":n+=i/2;break;case"bottom-center":n+=i/2+e.offsetHeight;break;case"center-center":n+=i/2+e.offsetHeight/2;break;case"top-top":n+=i;break;case"bottom-top":n+=e.offsetHeight+i;break;case"center-top":n+=e.offsetHeight/2+i}return a.anchorPlacement||a.offset||isNaN(t)||(o=t),n+o};t.default=a},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e){for(var t=0,n=0;e&&!isNaN(e.offsetLeft)&&!isNaN(e.offsetTop);)t+=e.offsetLeft-("BODY"!=e.tagName?e.scrollLeft:0),n+=e.offsetTop-("BODY"!=e.tagName?e.scrollTop:0),e=e.offsetParent;return{top:n,left:t}};t.default=n},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=function(e){return e=e||document.querySelectorAll("[data-aos]"),Array.prototype.map.call(e,function(e){return{node:e}})};t.default=n}])});

/***/ }),

/***/ "../src-utilities/country.js":
/*!***********************************!*\
  !*** ../src-utilities/country.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   countryJSON: () => (/* binding */ countryJSON)
/* harmony export */ });
// 'Country/Region',
const countryJSON = [{
  name: 'Andorra',
  code: 'AD',
  emoji: '🇦🇩',
  unicode: 'U+1F1E6 U+1F1E9',
  image: 'AD.svg',
  dial_code: '+376'
}, {
  name: 'United Arab Emirates',
  code: 'AE',
  emoji: '🇦🇪',
  unicode: 'U+1F1E6 U+1F1EA',
  image: 'AE.svg',
  dial_code: '+971'
}, {
  name: 'Afghanistan',
  code: 'AF',
  emoji: '🇦🇫',
  unicode: 'U+1F1E6 U+1F1EB',
  image: 'AF.svg',
  dial_code: '+93'
}, {
  name: 'Antigua & Barbuda',
  code: 'AG',
  emoji: '🇦🇬',
  unicode: 'U+1F1E6 U+1F1EC',
  image: 'AG.svg',
  dial_code: '+1268'
}, {
  name: 'Anguilla',
  code: 'AI',
  emoji: '🇦🇮',
  unicode: 'U+1F1E6 U+1F1EE',
  image: 'AI.svg',
  dial_code: '+1264'
}, {
  name: 'Albania',
  code: 'AL',
  emoji: '🇦🇱',
  unicode: 'U+1F1E6 U+1F1F1',
  image: 'AL.svg',
  dial_code: '+355'
}, {
  name: 'Armenia',
  code: 'AM',
  emoji: '🇦🇲',
  unicode: 'U+1F1E6 U+1F1F2',
  image: 'AM.svg',
  dial_code: '+374'
}, {
  name: 'Angola',
  code: 'AO',
  emoji: '🇦🇴',
  unicode: 'U+1F1E6 U+1F1F4',
  image: 'AO.svg',
  dial_code: '+244'
}, {
  name: 'Antarctica',
  code: 'AQ',
  emoji: '🇦🇶',
  unicode: 'U+1F1E6 U+1F1F6',
  image: 'AQ.svg',
  dial_code: '+672'
}, {
  name: 'Argentina',
  code: 'AR',
  emoji: '🇦🇷',
  unicode: 'U+1F1E6 U+1F1F7',
  image: 'AR.svg',
  dial_code: '+54'
}, {
  name: 'American Samoa',
  code: 'AS',
  emoji: '🇦🇸',
  unicode: 'U+1F1E6 U+1F1F8',
  image: 'AS.svg',
  dial_code: '+1684'
}, {
  name: 'Austria',
  code: 'AT',
  emoji: '🇦🇹',
  unicode: 'U+1F1E6 U+1F1F9',
  image: 'AT.svg',
  dial_code: '+43'
}, {
  name: 'Australia',
  code: 'AU',
  emoji: '🇦🇺',
  unicode: 'U+1F1E6 U+1F1FA',
  image: 'AU.svg',
  dial_code: '+61'
}, {
  name: 'Aruba',
  code: 'AW',
  emoji: '🇦🇼',
  unicode: 'U+1F1E6 U+1F1FC',
  image: 'AW.svg',
  dial_code: '+297'
}, {
  name: 'Åland Islands',
  code: 'AX',
  emoji: '🇦🇽',
  unicode: 'U+1F1E6 U+1F1FD',
  image: 'AX.svg',
  dial_code: '+358'
}, {
  name: 'Azerbaijan',
  code: 'AZ',
  emoji: '🇦🇿',
  unicode: 'U+1F1E6 U+1F1FF',
  image: 'AZ.svg',
  dial_code: '+994'
}, {
  name: 'Bosnia & Herzegovina',
  code: 'BA',
  emoji: '🇧🇦',
  unicode: 'U+1F1E7 U+1F1E6',
  image: 'BA.svg',
  dial_code: '+387'
}, {
  name: 'Barbados',
  code: 'BB',
  emoji: '🇧🇧',
  unicode: 'U+1F1E7 U+1F1E7',
  image: 'BB.svg',
  dial_code: '+1246'
}, {
  name: 'Bangladesh',
  code: 'BD',
  emoji: '🇧🇩',
  unicode: 'U+1F1E7 U+1F1E9',
  image: 'BD.svg',
  dial_code: '+880'
}, {
  name: 'Belgium',
  code: 'BE',
  emoji: '🇧🇪',
  unicode: 'U+1F1E7 U+1F1EA',
  image: 'BE.svg',
  dial_code: '+32'
}, {
  name: 'Burkina Faso',
  code: 'BF',
  emoji: '🇧🇫',
  unicode: 'U+1F1E7 U+1F1EB',
  image: 'BF.svg',
  dial_code: '+226'
}, {
  name: 'Bulgaria',
  code: 'BG',
  emoji: '🇧🇬',
  unicode: 'U+1F1E7 U+1F1EC',
  image: 'BG.svg',
  dial_code: '+359'
}, {
  name: 'Bahrain',
  code: 'BH',
  emoji: '🇧🇭',
  unicode: 'U+1F1E7 U+1F1ED',
  image: 'BH.svg',
  dial_code: '+973'
}, {
  name: 'Burundi',
  code: 'BI',
  emoji: '🇧🇮',
  unicode: 'U+1F1E7 U+1F1EE',
  image: 'BI.svg',
  dial_code: '+257'
}, {
  name: 'Benin',
  code: 'BJ',
  emoji: '🇧🇯',
  unicode: 'U+1F1E7 U+1F1EF',
  image: 'BJ.svg',
  dial_code: '+229'
}, {
  name: 'St. Barthélemy',
  code: 'BL',
  emoji: '🇧🇱',
  unicode: 'U+1F1E7 U+1F1F1',
  image: 'BL.svg',
  dial_code: '+590'
}, {
  name: 'Bermuda',
  code: 'BM',
  emoji: '🇧🇲',
  unicode: 'U+1F1E7 U+1F1F2',
  image: 'BM.svg',
  dial_code: '+1441'
}, {
  name: 'Brunei',
  code: 'BN',
  emoji: '🇧🇳',
  unicode: 'U+1F1E7 U+1F1F3',
  image: 'BN.svg',
  dial_code: '+673'
}, {
  name: 'Bolivia',
  code: 'BO',
  emoji: '🇧🇴',
  unicode: 'U+1F1E7 U+1F1F4',
  image: 'BO.svg',
  dial_code: '+591'
}, {
  name: 'Brazil',
  code: 'BR',
  emoji: '🇧🇷',
  unicode: 'U+1F1E7 U+1F1F7',
  image: 'BR.svg',
  dial_code: '+55'
}, {
  name: 'Bahamas',
  code: 'BS',
  emoji: '🇧🇸',
  unicode: 'U+1F1E7 U+1F1F8',
  image: 'BS.svg',
  dial_code: '+1242'
}, {
  name: 'Bhutan',
  code: 'BT',
  emoji: '🇧🇹',
  unicode: 'U+1F1E7 U+1F1F9',
  image: 'BT.svg',
  dial_code: '+975'
}, {
  name: 'Botswana',
  code: 'BW',
  emoji: '🇧🇼',
  unicode: 'U+1F1E7 U+1F1FC',
  image: 'BW.svg',
  dial_code: '+267'
}, {
  name: 'Belarus',
  code: 'BY',
  emoji: '🇧🇾',
  unicode: 'U+1F1E7 U+1F1FE',
  image: 'BY.svg',
  dial_code: '+375'
}, {
  name: 'Belize',
  code: 'BZ',
  emoji: '🇧🇿',
  unicode: 'U+1F1E7 U+1F1FF',
  image: 'BZ.svg',
  dial_code: '+501'
}, {
  name: 'Canada',
  code: 'CA',
  emoji: '🇨🇦',
  unicode: 'U+1F1E8 U+1F1E6',
  image: 'CA.svg',
  dial_code: '+1'
}, {
  name: 'Cocos (Keeling) Islands',
  code: 'CC',
  emoji: '🇨🇨',
  unicode: 'U+1F1E8 U+1F1E8',
  image: 'CC.svg',
  dial_code: '+61'
}, {
  name: 'Congo - Kinshasa',
  code: 'CD',
  emoji: '🇨🇩',
  unicode: 'U+1F1E8 U+1F1E9',
  image: 'CD.svg',
  dial_code: '+243'
}, {
  name: 'Central African Republic',
  code: 'CF',
  emoji: '🇨🇫',
  unicode: 'U+1F1E8 U+1F1EB',
  image: 'CF.svg',
  dial_code: '+236'
}, {
  name: 'Congo - Brazzaville',
  code: 'CG',
  emoji: '🇨🇬',
  unicode: 'U+1F1E8 U+1F1EC',
  image: 'CG.svg',
  dial_code: '+242'
}, {
  name: 'Switzerland',
  code: 'CH',
  emoji: '🇨🇭',
  unicode: 'U+1F1E8 U+1F1ED',
  image: 'CH.svg',
  dial_code: '+41'
}, {
  name: 'Côte d’Ivoire',
  code: 'CI',
  emoji: '🇨🇮',
  unicode: 'U+1F1E8 U+1F1EE',
  image: 'CI.svg',
  dial_code: '+225'
}, {
  name: 'Cook Islands',
  code: 'CK',
  emoji: '🇨🇰',
  unicode: 'U+1F1E8 U+1F1F0',
  image: 'CK.svg',
  dial_code: '+682'
}, {
  name: 'Chile',
  code: 'CL',
  emoji: '🇨🇱',
  unicode: 'U+1F1E8 U+1F1F1',
  image: 'CL.svg',
  dial_code: '+56'
}, {
  name: 'Cameroon',
  code: 'CM',
  emoji: '🇨🇲',
  unicode: 'U+1F1E8 U+1F1F2',
  image: 'CM.svg',
  dial_code: '+237'
}, {
  name: 'China',
  code: 'CN',
  emoji: '🇨🇳',
  unicode: 'U+1F1E8 U+1F1F3',
  image: 'CN.svg',
  dial_code: '+86'
}, {
  name: 'Colombia',
  code: 'CO',
  emoji: '🇨🇴',
  unicode: 'U+1F1E8 U+1F1F4',
  image: 'CO.svg',
  dial_code: '+57'
}, {
  name: 'Costa Rica',
  code: 'CR',
  emoji: '🇨🇷',
  unicode: 'U+1F1E8 U+1F1F7',
  image: 'CR.svg',
  dial_code: '+506'
}, {
  name: 'Cuba',
  code: 'CU',
  emoji: '🇨🇺',
  unicode: 'U+1F1E8 U+1F1FA',
  image: 'CU.svg',
  dial_code: '+53'
}, {
  name: 'Cape Verde',
  code: 'CV',
  emoji: '🇨🇻',
  unicode: 'U+1F1E8 U+1F1FB',
  image: 'CV.svg',
  dial_code: '+238'
}, {
  name: 'Christmas Island',
  code: 'CX',
  emoji: '🇨🇽',
  unicode: 'U+1F1E8 U+1F1FD',
  image: 'CX.svg',
  dial_code: '+61'
}, {
  name: 'Cyprus',
  code: 'CY',
  emoji: '🇨🇾',
  unicode: 'U+1F1E8 U+1F1FE',
  image: 'CY.svg',
  dial_code: '+357'
}, {
  name: 'Czechia',
  code: 'CZ',
  emoji: '🇨🇿',
  unicode: 'U+1F1E8 U+1F1FF',
  image: 'CZ.svg',
  dial_code: '+420'
}, {
  name: 'Germany',
  code: 'DE',
  emoji: '🇩🇪',
  unicode: 'U+1F1E9 U+1F1EA',
  image: 'DE.svg',
  dial_code: '+49'
}, {
  name: 'Djibouti',
  code: 'DJ',
  emoji: '🇩🇯',
  unicode: 'U+1F1E9 U+1F1EF',
  image: 'DJ.svg',
  dial_code: '+253'
}, {
  name: 'Denmark',
  code: 'DK',
  emoji: '🇩🇰',
  unicode: 'U+1F1E9 U+1F1F0',
  image: 'DK.svg',
  dial_code: '+45'
}, {
  name: 'Dominica',
  code: 'DM',
  emoji: '🇩🇲',
  unicode: 'U+1F1E9 U+1F1F2',
  image: 'DM.svg',
  dial_code: '+1767'
}, {
  name: 'Dominican Republic',
  code: 'DO',
  emoji: '🇩🇴',
  unicode: 'U+1F1E9 U+1F1F4',
  image: 'DO.svg',
  dial_code: '+1849'
}, {
  name: 'Algeria',
  code: 'DZ',
  emoji: '🇩🇿',
  unicode: 'U+1F1E9 U+1F1FF',
  image: 'DZ.svg',
  dial_code: '+213'
}, {
  name: 'Ecuador',
  code: 'EC',
  emoji: '🇪🇨',
  unicode: 'U+1F1EA U+1F1E8',
  image: 'EC.svg',
  dial_code: '+593'
}, {
  name: 'Estonia',
  code: 'EE',
  emoji: '🇪🇪',
  unicode: 'U+1F1EA U+1F1EA',
  image: 'EE.svg',
  dial_code: '+372'
}, {
  name: 'Egypt',
  code: 'EG',
  emoji: '🇪🇬',
  unicode: 'U+1F1EA U+1F1EC',
  image: 'EG.svg',
  dial_code: '+20'
}, {
  name: 'Eritrea',
  code: 'ER',
  emoji: '🇪🇷',
  unicode: 'U+1F1EA U+1F1F7',
  image: 'ER.svg',
  dial_code: '+291'
}, {
  name: 'Spain',
  code: 'ES',
  emoji: '🇪🇸',
  unicode: 'U+1F1EA U+1F1F8',
  image: 'ES.svg',
  dial_code: '+34'
}, {
  name: 'Ethiopia',
  code: 'ET',
  emoji: '🇪🇹',
  unicode: 'U+1F1EA U+1F1F9',
  image: 'ET.svg',
  dial_code: '+251'
}, {
  name: 'Finland',
  code: 'FI',
  emoji: '🇫🇮',
  unicode: 'U+1F1EB U+1F1EE',
  image: 'FI.svg',
  dial_code: '+358'
}, {
  name: 'Fiji',
  code: 'FJ',
  emoji: '🇫🇯',
  unicode: 'U+1F1EB U+1F1EF',
  image: 'FJ.svg',
  dial_code: '+679'
}, {
  name: 'Falkland Islands',
  code: 'FK',
  emoji: '🇫🇰',
  unicode: 'U+1F1EB U+1F1F0',
  image: 'FK.svg',
  dial_code: '+500'
}, {
  name: 'Micronesia',
  code: 'FM',
  emoji: '🇫🇲',
  unicode: 'U+1F1EB U+1F1F2',
  image: 'FM.svg',
  dial_code: '+691'
}, {
  name: 'Faroe Islands',
  code: 'FO',
  emoji: '🇫🇴',
  unicode: 'U+1F1EB U+1F1F4',
  image: 'FO.svg',
  dial_code: '+298'
}, {
  name: 'France',
  code: 'FR',
  emoji: '🇫🇷',
  unicode: 'U+1F1EB U+1F1F7',
  image: 'FR.svg',
  dial_code: '+33'
}, {
  name: 'Gabon',
  code: 'GA',
  emoji: '🇬🇦',
  unicode: 'U+1F1EC U+1F1E6',
  image: 'GA.svg',
  dial_code: '+241'
}, {
  name: 'United Kingdom',
  code: 'GB',
  emoji: '🇬🇧',
  unicode: 'U+1F1EC U+1F1E7',
  image: 'GB.svg',
  dial_code: '+44'
}, {
  name: 'Grenada',
  code: 'GD',
  emoji: '🇬🇩',
  unicode: 'U+1F1EC U+1F1E9',
  image: 'GD.svg',
  dial_code: '+1473'
}, {
  name: 'Georgia',
  code: 'GE',
  emoji: '🇬🇪',
  unicode: 'U+1F1EC U+1F1EA',
  image: 'GE.svg',
  dial_code: '+995'
}, {
  name: 'French Guiana',
  code: 'GF',
  emoji: '🇬🇫',
  unicode: 'U+1F1EC U+1F1EB',
  image: 'GF.svg',
  dial_code: '+594'
}, {
  name: 'Guernsey',
  code: 'GG',
  emoji: '🇬🇬',
  unicode: 'U+1F1EC U+1F1EC',
  image: 'GG.svg',
  dial_code: '+44'
}, {
  name: 'Ghana',
  code: 'GH',
  emoji: '🇬🇭',
  unicode: 'U+1F1EC U+1F1ED',
  image: 'GH.svg',
  dial_code: '+233'
}, {
  name: 'Gibraltar',
  code: 'GI',
  emoji: '🇬🇮',
  unicode: 'U+1F1EC U+1F1EE',
  image: 'GI.svg',
  dial_code: '+350'
}, {
  name: 'Greenland',
  code: 'GL',
  emoji: '🇬🇱',
  unicode: 'U+1F1EC U+1F1F1',
  image: 'GL.svg',
  dial_code: '+299'
}, {
  name: 'Gambia',
  code: 'GM',
  emoji: '🇬🇲',
  unicode: 'U+1F1EC U+1F1F2',
  image: 'GM.svg',
  dial_code: '+220'
}, {
  name: 'Guinea',
  code: 'GN',
  emoji: '🇬🇳',
  unicode: 'U+1F1EC U+1F1F3',
  image: 'GN.svg',
  dial_code: '+224'
}, {
  name: 'Guadeloupe',
  code: 'GP',
  emoji: '🇬🇵',
  unicode: 'U+1F1EC U+1F1F5',
  image: 'GP.svg',
  dial_code: '+590'
}, {
  name: 'Equatorial Guinea',
  code: 'GQ',
  emoji: '🇬🇶',
  unicode: 'U+1F1EC U+1F1F6',
  image: 'GQ.svg',
  dial_code: '+240'
}, {
  name: 'Greece',
  code: 'GR',
  emoji: '🇬🇷',
  unicode: 'U+1F1EC U+1F1F7',
  image: 'GR.svg',
  dial_code: '+30'
}, {
  name: 'South Georgia & South Sandwich Islands',
  code: 'GS',
  emoji: '🇬🇸',
  unicode: 'U+1F1EC U+1F1F8',
  image: 'GS.svg',
  dial_code: '+500'
}, {
  name: 'Guatemala',
  code: 'GT',
  emoji: '🇬🇹',
  unicode: 'U+1F1EC U+1F1F9',
  image: 'GT.svg',
  dial_code: '+502'
}, {
  name: 'Guam',
  code: 'GU',
  emoji: '🇬🇺',
  unicode: 'U+1F1EC U+1F1FA',
  image: 'GU.svg',
  dial_code: '+1671'
}, {
  name: 'Guinea-Bissau',
  code: 'GW',
  emoji: '🇬🇼',
  unicode: 'U+1F1EC U+1F1FC',
  image: 'GW.svg',
  dial_code: '+245'
}, {
  name: 'Guyana',
  code: 'GY',
  emoji: '🇬🇾',
  unicode: 'U+1F1EC U+1F1FE',
  image: 'GY.svg',
  dial_code: '+595'
}, {
  name: 'Hong Kong SAR China',
  code: 'HK',
  emoji: '🇭🇰',
  unicode: 'U+1F1ED U+1F1F0',
  image: 'HK.svg',
  dial_code: '+852'
}, {
  name: 'Honduras',
  code: 'HN',
  emoji: '🇭🇳',
  unicode: 'U+1F1ED U+1F1F3',
  image: 'HN.svg',
  dial_code: '+504'
}, {
  name: 'Croatia',
  code: 'HR',
  emoji: '🇭🇷',
  unicode: 'U+1F1ED U+1F1F7',
  image: 'HR.svg',
  dial_code: '+385'
}, {
  name: 'Haiti',
  code: 'HT',
  emoji: '🇭🇹',
  unicode: 'U+1F1ED U+1F1F9',
  image: 'HT.svg',
  dial_code: '+509'
}, {
  name: 'Hungary',
  code: 'HU',
  emoji: '🇭🇺',
  unicode: 'U+1F1ED U+1F1FA',
  image: 'HU.svg',
  dial_code: '+36'
}, {
  name: 'Indonesia',
  code: 'ID',
  emoji: '🇮🇩',
  unicode: 'U+1F1EE U+1F1E9',
  image: 'ID.svg',
  dial_code: '+62'
}, {
  name: 'Ireland',
  code: 'IE',
  emoji: '🇮🇪',
  unicode: 'U+1F1EE U+1F1EA',
  image: 'IE.svg',
  dial_code: '+353'
}, {
  name: 'Israel',
  code: 'IL',
  emoji: '🇮🇱',
  unicode: 'U+1F1EE U+1F1F1',
  image: 'IL.svg',
  dial_code: '+972'
}, {
  name: 'Isle of Man',
  code: 'IM',
  emoji: '🇮🇲',
  unicode: 'U+1F1EE U+1F1F2',
  image: 'IM.svg',
  dial_code: '+44'
}, {
  name: 'India',
  code: 'IN',
  emoji: '🇮🇳',
  unicode: 'U+1F1EE U+1F1F3',
  image: 'IN.svg',
  dial_code: '+91'
}, {
  name: 'British Indian Ocean Territory',
  code: 'IO',
  emoji: '🇮🇴',
  unicode: 'U+1F1EE U+1F1F4',
  image: 'IO.svg',
  dial_code: '+246'
}, {
  name: 'Iraq',
  code: 'IQ',
  emoji: '🇮🇶',
  unicode: 'U+1F1EE U+1F1F6',
  image: 'IQ.svg',
  dial_code: '+964'
}, {
  name: 'Iran',
  code: 'IR',
  emoji: '🇮🇷',
  unicode: 'U+1F1EE U+1F1F7',
  image: 'IR.svg',
  dial_code: '+98'
}, {
  name: 'Iceland',
  code: 'IS',
  emoji: '🇮🇸',
  unicode: 'U+1F1EE U+1F1F8',
  image: 'IS.svg',
  dial_code: '+354'
}, {
  name: 'Italy',
  code: 'IT',
  emoji: '🇮🇹',
  unicode: 'U+1F1EE U+1F1F9',
  image: 'IT.svg',
  dial_code: '+39'
}, {
  name: 'Jersey',
  code: 'JE',
  emoji: '🇯🇪',
  unicode: 'U+1F1EF U+1F1EA',
  image: 'JE.svg',
  dial_code: '+44'
}, {
  name: 'Jamaica',
  code: 'JM',
  emoji: '🇯🇲',
  unicode: 'U+1F1EF U+1F1F2',
  image: 'JM.svg',
  dial_code: '+1876'
}, {
  name: 'Jordan',
  code: 'JO',
  emoji: '🇯🇴',
  unicode: 'U+1F1EF U+1F1F4',
  image: 'JO.svg',
  dial_code: '+962'
}, {
  name: 'Japan',
  code: 'JP',
  emoji: '🇯🇵',
  unicode: 'U+1F1EF U+1F1F5',
  image: 'JP.svg',
  dial_code: '+81'
}, {
  name: 'Kenya',
  code: 'KE',
  emoji: '🇰🇪',
  unicode: 'U+1F1F0 U+1F1EA',
  image: 'KE.svg',
  dial_code: '+254'
}, {
  name: 'Kyrgyzstan',
  code: 'KG',
  emoji: '🇰🇬',
  unicode: 'U+1F1F0 U+1F1EC',
  image: 'KG.svg',
  dial_code: '+996'
}, {
  name: 'Cambodia',
  code: 'KH',
  emoji: '🇰🇭',
  unicode: 'U+1F1F0 U+1F1ED',
  image: 'KH.svg',
  dial_code: '+855'
}, {
  name: 'Kiribati',
  code: 'KI',
  emoji: '🇰🇮',
  unicode: 'U+1F1F0 U+1F1EE',
  image: 'KI.svg',
  dial_code: '+686'
}, {
  name: 'Comoros',
  code: 'KM',
  emoji: '🇰🇲',
  unicode: 'U+1F1F0 U+1F1F2',
  image: 'KM.svg',
  dial_code: '+269'
}, {
  name: 'St. Kitts & Nevis',
  code: 'KN',
  emoji: '🇰🇳',
  unicode: 'U+1F1F0 U+1F1F3',
  image: 'KN.svg',
  dial_code: '+1869'
}, {
  name: 'North Korea',
  code: 'KP',
  emoji: '🇰🇵',
  unicode: 'U+1F1F0 U+1F1F5',
  image: 'KP.svg',
  dial_code: '+850'
}, {
  name: 'South Korea',
  code: 'KR',
  emoji: '🇰🇷',
  unicode: 'U+1F1F0 U+1F1F7',
  image: 'KR.svg',
  dial_code: '+82'
}, {
  name: 'Kuwait',
  code: 'KW',
  emoji: '🇰🇼',
  unicode: 'U+1F1F0 U+1F1FC',
  image: 'KW.svg',
  dial_code: '+965'
}, {
  name: 'Cayman Islands',
  code: 'KY',
  emoji: '🇰🇾',
  unicode: 'U+1F1F0 U+1F1FE',
  image: 'KY.svg',
  dial_code: '+ 345'
}, {
  name: 'Kazakhstan',
  code: 'KZ',
  emoji: '🇰🇿',
  unicode: 'U+1F1F0 U+1F1FF',
  image: 'KZ.svg',
  dial_code: '+77'
}, {
  name: 'Laos',
  code: 'LA',
  emoji: '🇱🇦',
  unicode: 'U+1F1F1 U+1F1E6',
  image: 'LA.svg',
  dial_code: '+856'
}, {
  name: 'Lebanon',
  code: 'LB',
  emoji: '🇱🇧',
  unicode: 'U+1F1F1 U+1F1E7',
  image: 'LB.svg',
  dial_code: '+961'
}, {
  name: 'St. Lucia',
  code: 'LC',
  emoji: '🇱🇨',
  unicode: 'U+1F1F1 U+1F1E8',
  image: 'LC.svg',
  dial_code: '+1758'
}, {
  name: 'Liechtenstein',
  code: 'LI',
  emoji: '🇱🇮',
  unicode: 'U+1F1F1 U+1F1EE',
  image: 'LI.svg',
  dial_code: '+423'
}, {
  name: 'Sri Lanka',
  code: 'LK',
  emoji: '🇱🇰',
  unicode: 'U+1F1F1 U+1F1F0',
  image: 'LK.svg',
  dial_code: '+94'
}, {
  name: 'Liberia',
  code: 'LR',
  emoji: '🇱🇷',
  unicode: 'U+1F1F1 U+1F1F7',
  image: 'LR.svg',
  dial_code: '+231'
}, {
  name: 'Lesotho',
  code: 'LS',
  emoji: '🇱🇸',
  unicode: 'U+1F1F1 U+1F1F8',
  image: 'LS.svg',
  dial_code: '+266'
}, {
  name: 'Lithuania',
  code: 'LT',
  emoji: '🇱🇹',
  unicode: 'U+1F1F1 U+1F1F9',
  image: 'LT.svg',
  dial_code: '+370'
}, {
  name: 'Luxembourg',
  code: 'LU',
  emoji: '🇱🇺',
  unicode: 'U+1F1F1 U+1F1FA',
  image: 'LU.svg',
  dial_code: '+352'
}, {
  name: 'Latvia',
  code: 'LV',
  emoji: '🇱🇻',
  unicode: 'U+1F1F1 U+1F1FB',
  image: 'LV.svg',
  dial_code: '+371'
}, {
  name: 'Libya',
  code: 'LY',
  emoji: '🇱🇾',
  unicode: 'U+1F1F1 U+1F1FE',
  image: 'LY.svg',
  dial_code: '+218'
}, {
  name: 'Morocco',
  code: 'MA',
  emoji: '🇲🇦',
  unicode: 'U+1F1F2 U+1F1E6',
  image: 'MA.svg',
  dial_code: '+212'
}, {
  name: 'Monaco',
  code: 'MC',
  emoji: '🇲🇨',
  unicode: 'U+1F1F2 U+1F1E8',
  image: 'MC.svg',
  dial_code: '+377'
}, {
  name: 'Moldova',
  code: 'MD',
  emoji: '🇲🇩',
  unicode: 'U+1F1F2 U+1F1E9',
  image: 'MD.svg',
  dial_code: '+373'
}, {
  name: 'Montenegro',
  code: 'ME',
  emoji: '🇲🇪',
  unicode: 'U+1F1F2 U+1F1EA',
  image: 'ME.svg',
  dial_code: '+382'
}, {
  name: 'St. Martin',
  code: 'MF',
  emoji: '🇲🇫',
  unicode: 'U+1F1F2 U+1F1EB',
  image: 'MF.svg',
  dial_code: '+590'
}, {
  name: 'Madagascar',
  code: 'MG',
  emoji: '🇲🇬',
  unicode: 'U+1F1F2 U+1F1EC',
  image: 'MG.svg',
  dial_code: '+261'
}, {
  name: 'Marshall Islands',
  code: 'MH',
  emoji: '🇲🇭',
  unicode: 'U+1F1F2 U+1F1ED',
  image: 'MH.svg',
  dial_code: '+692'
}, {
  name: 'North Macedonia',
  code: 'MK',
  emoji: '🇲🇰',
  unicode: 'U+1F1F2 U+1F1F0',
  image: 'MK.svg',
  dial_code: '+389'
}, {
  name: 'Mali',
  code: 'ML',
  emoji: '🇲🇱',
  unicode: 'U+1F1F2 U+1F1F1',
  image: 'ML.svg',
  dial_code: '+223'
}, {
  name: 'Myanmar (Burma)',
  code: 'MM',
  emoji: '🇲🇲',
  unicode: 'U+1F1F2 U+1F1F2',
  image: 'MM.svg',
  dial_code: '+95'
}, {
  name: 'Mongolia',
  code: 'MN',
  emoji: '🇲🇳',
  unicode: 'U+1F1F2 U+1F1F3',
  image: 'MN.svg',
  dial_code: '+976'
}, {
  name: 'Macao SAR China',
  code: 'MO',
  emoji: '🇲🇴',
  unicode: 'U+1F1F2 U+1F1F4',
  image: 'MO.svg',
  dial_code: '+853'
}, {
  name: 'Northern Mariana Islands',
  code: 'MP',
  emoji: '🇲🇵',
  unicode: 'U+1F1F2 U+1F1F5',
  image: 'MP.svg',
  dial_code: '+1670'
}, {
  name: 'Martinique',
  code: 'MQ',
  emoji: '🇲🇶',
  unicode: 'U+1F1F2 U+1F1F6',
  image: 'MQ.svg',
  dial_code: '+596'
}, {
  name: 'Mauritania',
  code: 'MR',
  emoji: '🇲🇷',
  unicode: 'U+1F1F2 U+1F1F7',
  image: 'MR.svg',
  dial_code: '+222'
}, {
  name: 'Montserrat',
  code: 'MS',
  emoji: '🇲🇸',
  unicode: 'U+1F1F2 U+1F1F8',
  image: 'MS.svg',
  dial_code: '+1664'
}, {
  name: 'Malta',
  code: 'MT',
  emoji: '🇲🇹',
  unicode: 'U+1F1F2 U+1F1F9',
  image: 'MT.svg',
  dial_code: '+356'
}, {
  name: 'Mauritius',
  code: 'MU',
  emoji: '🇲🇺',
  unicode: 'U+1F1F2 U+1F1FA',
  image: 'MU.svg',
  dial_code: '+230'
}, {
  name: 'Maldives',
  code: 'MV',
  emoji: '🇲🇻',
  unicode: 'U+1F1F2 U+1F1FB',
  image: 'MV.svg',
  dial_code: '+960'
}, {
  name: 'Malawi',
  code: 'MW',
  emoji: '🇲🇼',
  unicode: 'U+1F1F2 U+1F1FC',
  image: 'MW.svg',
  dial_code: '+265'
}, {
  name: 'Mexico',
  code: 'MX',
  emoji: '🇲🇽',
  unicode: 'U+1F1F2 U+1F1FD',
  image: 'MX.svg',
  dial_code: '+52'
}, {
  name: 'Malaysia',
  code: 'MY',
  emoji: '🇲🇾',
  unicode: 'U+1F1F2 U+1F1FE',
  image: 'MY.svg',
  dial_code: '+60'
}, {
  name: 'Mozambique',
  code: 'MZ',
  emoji: '🇲🇿',
  unicode: 'U+1F1F2 U+1F1FF',
  image: 'MZ.svg',
  dial_code: '+258'
}, {
  name: 'Namibia',
  code: 'NA',
  emoji: '🇳🇦',
  unicode: 'U+1F1F3 U+1F1E6',
  image: 'NA.svg',
  dial_code: '+264'
}, {
  name: 'New Caledonia',
  code: 'NC',
  emoji: '🇳🇨',
  unicode: 'U+1F1F3 U+1F1E8',
  image: 'NC.svg',
  dial_code: '+687'
}, {
  name: 'Niger',
  code: 'NE',
  emoji: '🇳🇪',
  unicode: 'U+1F1F3 U+1F1EA',
  image: 'NE.svg',
  dial_code: '+227'
}, {
  name: 'Norfolk Island',
  code: 'NF',
  emoji: '🇳🇫',
  unicode: 'U+1F1F3 U+1F1EB',
  image: 'NF.svg',
  dial_code: '+672'
}, {
  name: 'Nigeria',
  code: 'NG',
  emoji: '🇳🇬',
  unicode: 'U+1F1F3 U+1F1EC',
  image: 'NG.svg',
  dial_code: '+234'
}, {
  name: 'Nicaragua',
  code: 'NI',
  emoji: '🇳🇮',
  unicode: 'U+1F1F3 U+1F1EE',
  image: 'NI.svg',
  dial_code: '+505'
}, {
  name: 'Netherlands',
  code: 'NL',
  emoji: '🇳🇱',
  unicode: 'U+1F1F3 U+1F1F1',
  image: 'NL.svg',
  dial_code: '+31'
}, {
  name: 'Norway',
  code: 'NO',
  emoji: '🇳🇴',
  unicode: 'U+1F1F3 U+1F1F4',
  image: 'NO.svg',
  dial_code: '+47'
}, {
  name: 'Nepal',
  code: 'NP',
  emoji: '🇳🇵',
  unicode: 'U+1F1F3 U+1F1F5',
  image: 'NP.svg',
  dial_code: '+977'
}, {
  name: 'Nauru',
  code: 'NR',
  emoji: '🇳🇷',
  unicode: 'U+1F1F3 U+1F1F7',
  image: 'NR.svg',
  dial_code: '+674'
}, {
  name: 'Niue',
  code: 'NU',
  emoji: '🇳🇺',
  unicode: 'U+1F1F3 U+1F1FA',
  image: 'NU.svg',
  dial_code: '+683'
}, {
  name: 'New Zealand',
  code: 'NZ',
  emoji: '🇳🇿',
  unicode: 'U+1F1F3 U+1F1FF',
  image: 'NZ.svg',
  dial_code: '+64'
}, {
  name: 'Oman',
  code: 'OM',
  emoji: '🇴🇲',
  unicode: 'U+1F1F4 U+1F1F2',
  image: 'OM.svg',
  dial_code: '+968'
}, {
  name: 'Panama',
  code: 'PA',
  emoji: '🇵🇦',
  unicode: 'U+1F1F5 U+1F1E6',
  image: 'PA.svg',
  dial_code: '+507'
}, {
  name: 'Peru',
  code: 'PE',
  emoji: '🇵🇪',
  unicode: 'U+1F1F5 U+1F1EA',
  image: 'PE.svg',
  dial_code: '+51'
}, {
  name: 'French Polynesia',
  code: 'PF',
  emoji: '🇵🇫',
  unicode: 'U+1F1F5 U+1F1EB',
  image: 'PF.svg',
  dial_code: '+689'
}, {
  name: 'Papua New Guinea',
  code: 'PG',
  emoji: '🇵🇬',
  unicode: 'U+1F1F5 U+1F1EC',
  image: 'PG.svg',
  dial_code: '+675'
}, {
  name: 'Philippines',
  code: 'PH',
  emoji: '🇵🇭',
  unicode: 'U+1F1F5 U+1F1ED',
  image: 'PH.svg',
  dial_code: '+63'
}, {
  name: 'Pakistan',
  code: 'PK',
  emoji: '🇵🇰',
  unicode: 'U+1F1F5 U+1F1F0',
  image: 'PK.svg',
  dial_code: '+92'
}, {
  name: 'Poland',
  code: 'PL',
  emoji: '🇵🇱',
  unicode: 'U+1F1F5 U+1F1F1',
  image: 'PL.svg',
  dial_code: '+48'
}, {
  name: 'St. Pierre & Miquelon',
  code: 'PM',
  emoji: '🇵🇲',
  unicode: 'U+1F1F5 U+1F1F2',
  image: 'PM.svg',
  dial_code: '+508'
}, {
  name: 'Pitcairn Islands',
  code: 'PN',
  emoji: '🇵🇳',
  unicode: 'U+1F1F5 U+1F1F3',
  image: 'PN.svg',
  dial_code: '+872'
}, {
  name: 'Puerto Rico',
  code: 'PR',
  emoji: '🇵🇷',
  unicode: 'U+1F1F5 U+1F1F7',
  image: 'PR.svg',
  dial_code: '+1939'
}, {
  name: 'Palestinian Territories',
  code: 'PS',
  emoji: '🇵🇸',
  unicode: 'U+1F1F5 U+1F1F8',
  image: 'PS.svg',
  dial_code: '+970'
}, {
  name: 'Portugal',
  code: 'PT',
  emoji: '🇵🇹',
  unicode: 'U+1F1F5 U+1F1F9',
  image: 'PT.svg',
  dial_code: '+351'
}, {
  name: 'Palau',
  code: 'PW',
  emoji: '🇵🇼',
  unicode: 'U+1F1F5 U+1F1FC',
  image: 'PW.svg',
  dial_code: '+680'
}, {
  name: 'Paraguay',
  code: 'PY',
  emoji: '🇵🇾',
  unicode: 'U+1F1F5 U+1F1FE',
  image: 'PY.svg',
  dial_code: '+595'
}, {
  name: 'Qatar',
  code: 'QA',
  emoji: '🇶🇦',
  unicode: 'U+1F1F6 U+1F1E6',
  image: 'QA.svg',
  dial_code: '+974'
}, {
  name: 'Réunion',
  code: 'RE',
  emoji: '🇷🇪',
  unicode: 'U+1F1F7 U+1F1EA',
  image: 'RE.svg',
  dial_code: '+262'
}, {
  name: 'Romania',
  code: 'RO',
  emoji: '🇷🇴',
  unicode: 'U+1F1F7 U+1F1F4',
  image: 'RO.svg',
  dial_code: '+40'
}, {
  name: 'Serbia',
  code: 'RS',
  emoji: '🇷🇸',
  unicode: 'U+1F1F7 U+1F1F8',
  image: 'RS.svg',
  dial_code: '+381'
}, {
  name: 'Russia',
  code: 'RU',
  emoji: '🇷🇺',
  unicode: 'U+1F1F7 U+1F1FA',
  image: 'RU.svg',
  dial_code: '+7'
}, {
  name: 'Rwanda',
  code: 'RW',
  emoji: '🇷🇼',
  unicode: 'U+1F1F7 U+1F1FC',
  image: 'RW.svg',
  dial_code: '+250'
}, {
  name: 'Saudi Arabia',
  code: 'SA',
  emoji: '🇸🇦',
  unicode: 'U+1F1F8 U+1F1E6',
  image: 'SA.svg',
  dial_code: '+966'
}, {
  name: 'Solomon Islands',
  code: 'SB',
  emoji: '🇸🇧',
  unicode: 'U+1F1F8 U+1F1E7',
  image: 'SB.svg',
  dial_code: '+677'
}, {
  name: 'Seychelles',
  code: 'SC',
  emoji: '🇸🇨',
  unicode: 'U+1F1F8 U+1F1E8',
  image: 'SC.svg',
  dial_code: '+248'
}, {
  name: 'Sudan',
  code: 'SD',
  emoji: '🇸🇩',
  unicode: 'U+1F1F8 U+1F1E9',
  image: 'SD.svg',
  dial_code: '+249'
}, {
  name: 'Sweden',
  code: 'SE',
  emoji: '🇸🇪',
  unicode: 'U+1F1F8 U+1F1EA',
  image: 'SE.svg',
  dial_code: '+46'
}, {
  name: 'Singapore',
  code: 'SG',
  emoji: '🇸🇬',
  unicode: 'U+1F1F8 U+1F1EC',
  image: 'SG.svg',
  dial_code: '+65'
}, {
  name: 'St. Helena',
  code: 'SH',
  emoji: '🇸🇭',
  unicode: 'U+1F1F8 U+1F1ED',
  image: 'SH.svg',
  dial_code: '+290'
}, {
  name: 'Slovenia',
  code: 'SI',
  emoji: '🇸🇮',
  unicode: 'U+1F1F8 U+1F1EE',
  image: 'SI.svg',
  dial_code: '+386'
}, {
  name: 'Svalbard & Jan Mayen',
  code: 'SJ',
  emoji: '🇸🇯',
  unicode: 'U+1F1F8 U+1F1EF',
  image: 'SJ.svg',
  dial_code: '+47'
}, {
  name: 'Slovakia',
  code: 'SK',
  emoji: '🇸🇰',
  unicode: 'U+1F1F8 U+1F1F0',
  image: 'SK.svg',
  dial_code: '+421'
}, {
  name: 'Sierra Leone',
  code: 'SL',
  emoji: '🇸🇱',
  unicode: 'U+1F1F8 U+1F1F1',
  image: 'SL.svg',
  dial_code: '+232'
}, {
  name: 'San Marino',
  code: 'SM',
  emoji: '🇸🇲',
  unicode: 'U+1F1F8 U+1F1F2',
  image: 'SM.svg',
  dial_code: '+378'
}, {
  name: 'Senegal',
  code: 'SN',
  emoji: '🇸🇳',
  unicode: 'U+1F1F8 U+1F1F3',
  image: 'SN.svg',
  dial_code: '+221'
}, {
  name: 'Somalia',
  code: 'SO',
  emoji: '🇸🇴',
  unicode: 'U+1F1F8 U+1F1F4',
  image: 'SO.svg',
  dial_code: '+252'
}, {
  name: 'Suriname',
  code: 'SR',
  emoji: '🇸🇷',
  unicode: 'U+1F1F8 U+1F1F7',
  image: 'SR.svg',
  dial_code: '+597'
}, {
  name: 'South Sudan',
  code: 'SS',
  emoji: '🇸🇸',
  unicode: 'U+1F1F8 U+1F1F8',
  image: 'SS.svg',
  dial_code: '+211'
}, {
  name: 'São Tomé & Príncipe',
  code: 'ST',
  emoji: '🇸🇹',
  unicode: 'U+1F1F8 U+1F1F9',
  image: 'ST.svg',
  dial_code: '+239'
}, {
  name: 'El Salvador',
  code: 'SV',
  emoji: '🇸🇻',
  unicode: 'U+1F1F8 U+1F1FB',
  image: 'SV.svg',
  dial_code: '+503'
}, {
  name: 'Syria',
  code: 'SY',
  emoji: '🇸🇾',
  unicode: 'U+1F1F8 U+1F1FE',
  image: 'SY.svg',
  dial_code: '+963'
}, {
  name: 'Eswatini',
  code: 'SZ',
  emoji: '🇸🇿',
  unicode: 'U+1F1F8 U+1F1FF',
  image: 'SZ.svg',
  dial_code: '+268'
}, {
  name: 'Turks & Caicos Islands',
  code: 'TC',
  emoji: '🇹🇨',
  unicode: 'U+1F1F9 U+1F1E8',
  image: 'TC.svg',
  dial_code: '+1649'
}, {
  name: 'Chad',
  code: 'TD',
  emoji: '🇹🇩',
  unicode: 'U+1F1F9 U+1F1E9',
  image: 'TD.svg',
  dial_code: '+235'
}, {
  name: 'Togo',
  code: 'TG',
  emoji: '🇹🇬',
  unicode: 'U+1F1F9 U+1F1EC',
  image: 'TG.svg',
  dial_code: '+228'
}, {
  name: 'Thailand',
  code: 'TH',
  emoji: '🇹🇭',
  unicode: 'U+1F1F9 U+1F1ED',
  image: 'TH.svg',
  dial_code: '+66'
}, {
  name: 'Tajikistan',
  code: 'TJ',
  emoji: '🇹🇯',
  unicode: 'U+1F1F9 U+1F1EF',
  image: 'TJ.svg',
  dial_code: '+992'
}, {
  name: 'Tokelau',
  code: 'TK',
  emoji: '🇹🇰',
  unicode: 'U+1F1F9 U+1F1F0',
  image: 'TK.svg',
  dial_code: '+690'
}, {
  name: 'Timor-Leste',
  code: 'TL',
  emoji: '🇹🇱',
  unicode: 'U+1F1F9 U+1F1F1',
  image: 'TL.svg',
  dial_code: '+670'
}, {
  name: 'Turkmenistan',
  code: 'TM',
  emoji: '🇹🇲',
  unicode: 'U+1F1F9 U+1F1F2',
  image: 'TM.svg',
  dial_code: '+993'
}, {
  name: 'Tunisia',
  code: 'TN',
  emoji: '🇹🇳',
  unicode: 'U+1F1F9 U+1F1F3',
  image: 'TN.svg',
  dial_code: '+216'
}, {
  name: 'Tonga',
  code: 'TO',
  emoji: '🇹🇴',
  unicode: 'U+1F1F9 U+1F1F4',
  image: 'TO.svg',
  dial_code: '+676'
}, {
  name: 'Turkey',
  code: 'TR',
  emoji: '🇹🇷',
  unicode: 'U+1F1F9 U+1F1F7',
  image: 'TR.svg',
  dial_code: '+90'
}, {
  name: 'Trinidad & Tobago',
  code: 'TT',
  emoji: '🇹🇹',
  unicode: 'U+1F1F9 U+1F1F9',
  image: 'TT.svg',
  dial_code: '+1868'
}, {
  name: 'Tuvalu',
  code: 'TV',
  emoji: '🇹🇻',
  unicode: 'U+1F1F9 U+1F1FB',
  image: 'TV.svg',
  dial_code: '+688'
}, {
  name: 'Taiwan',
  code: 'TW',
  emoji: '🇹🇼',
  unicode: 'U+1F1F9 U+1F1FC',
  image: 'TW.svg',
  dial_code: '+886'
}, {
  name: 'Tanzania',
  code: 'TZ',
  emoji: '🇹🇿',
  unicode: 'U+1F1F9 U+1F1FF',
  image: 'TZ.svg',
  dial_code: '+255'
}, {
  name: 'Ukraine',
  code: 'UA',
  emoji: '🇺🇦',
  unicode: 'U+1F1FA U+1F1E6',
  image: 'UA.svg',
  dial_code: '+380'
}, {
  name: 'Uganda',
  code: 'UG',
  emoji: '🇺🇬',
  unicode: 'U+1F1FA U+1F1EC',
  image: 'UG.svg',
  dial_code: '+256'
}, {
  name: 'United States',
  code: 'US',
  emoji: '🇺🇸',
  unicode: 'U+1F1FA U+1F1F8',
  image: 'US.svg',
  dial_code: '+1'
}, {
  name: 'Uruguay',
  code: 'UY',
  emoji: '🇺🇾',
  unicode: 'U+1F1FA U+1F1FE',
  image: 'UY.svg',
  dial_code: '+598'
}, {
  name: 'Uzbekistan',
  code: 'UZ',
  emoji: '🇺🇿',
  unicode: 'U+1F1FA U+1F1FF',
  image: 'UZ.svg',
  dial_code: '+998'
}, {
  name: 'Vatican City',
  code: 'VA',
  emoji: '🇻🇦',
  unicode: 'U+1F1FB U+1F1E6',
  image: 'VA.svg',
  dial_code: '+379'
}, {
  name: 'St. Vincent & Grenadines',
  code: 'VC',
  emoji: '🇻🇨',
  unicode: 'U+1F1FB U+1F1E8',
  image: 'VC.svg',
  dial_code: '+1784'
}, {
  name: 'Venezuela',
  code: 'VE',
  emoji: '🇻🇪',
  unicode: 'U+1F1FB U+1F1EA',
  image: 'VE.svg',
  dial_code: '+58'
}, {
  name: 'British Virgin Islands',
  code: 'VG',
  emoji: '🇻🇬',
  unicode: 'U+1F1FB U+1F1EC',
  image: 'VG.svg',
  dial_code: '+1284'
}, {
  name: 'U.S. Virgin Islands',
  code: 'VI',
  emoji: '🇻🇮',
  unicode: 'U+1F1FB U+1F1EE',
  image: 'VI.svg',
  dial_code: '+1340'
}, {
  name: 'Vietnam',
  code: 'VN',
  emoji: '🇻🇳',
  unicode: 'U+1F1FB U+1F1F3',
  image: 'VN.svg',
  dial_code: '+84'
}, {
  name: 'Vanuatu',
  code: 'VU',
  emoji: '🇻🇺',
  unicode: 'U+1F1FB U+1F1FA',
  image: 'VU.svg',
  dial_code: '+678'
}, {
  name: 'Wallis & Futuna',
  code: 'WF',
  emoji: '🇼🇫',
  unicode: 'U+1F1FC U+1F1EB',
  image: 'WF.svg',
  dial_code: '+681'
}, {
  name: 'Samoa',
  code: 'WS',
  emoji: '🇼🇸',
  unicode: 'U+1F1FC U+1F1F8',
  image: 'WS.svg',
  dial_code: '+685'
}, {
  name: 'Yemen',
  code: 'YE',
  emoji: '🇾🇪',
  unicode: 'U+1F1FE U+1F1EA',
  image: 'YE.svg',
  dial_code: '+967'
}, {
  name: 'Mayotte',
  code: 'YT',
  emoji: '🇾🇹',
  unicode: 'U+1F1FE U+1F1F9',
  image: 'YT.svg',
  dial_code: '+262'
}, {
  name: 'South Africa',
  code: 'ZA',
  emoji: '🇿🇦',
  unicode: 'U+1F1FF U+1F1E6',
  image: 'ZA.svg',
  dial_code: '+27'
}, {
  name: 'Zambia',
  code: 'ZM',
  emoji: '🇿🇲',
  unicode: 'U+1F1FF U+1F1F2',
  image: 'ZM.svg',
  dial_code: '+260'
}, {
  name: 'Zimbabwe',
  code: 'ZW',
  emoji: '🇿🇼',
  unicode: 'U+1F1FF U+1F1FC',
  image: 'ZW.svg',
  dial_code: '+263'
}];
let countries = Array.from(document.querySelectorAll('.countries-name'));
let countriesCodes = Array.from(document.querySelectorAll('.country-phone-code'));
let countryCodeHTML = `<option disabled selected value="">Code <span>*</span></option>` + countryJSON.map((country, index) => `<option value="${country.dial_code}">${country.dial_code} ${country.emoji} </option>`);
let countryNames = `<option value="" selected>Select Country <span>*</span></option>` + countryJSON.map(country => country.name).sort((a, b) => a.localeCompare(b)).map(countryName => `<option value="${countryName}">${countryName}</option>`).join('');
setTimeout(() => {
  countries.forEach(country => {
    country.insertAdjacentHTML('beforeend', countryNames);
  });
  countriesCodes.forEach(countryElement => {
    countryElement.insertAdjacentHTML('beforeend', countryCodeHTML);
  });
}, 5000);

/***/ }),

/***/ "../src-utilities/footer.js":
/*!**********************************!*\
  !*** ../src-utilities/footer.js ***!
  \**********************************/
/***/ (() => {

// Deployed.....

/***/ }),

/***/ "../src-utilities/header.js":
/*!**********************************!*\
  !*** ../src-utilities/header.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aos */ "../../node_modules/aos/dist/aos.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_0__);
// Jai Bajarang Bali

aos__WEBPACK_IMPORTED_MODULE_0___default().init();

// Header animation Functionality 
let lastScrollY = window.scrollY;
const header = document.querySelector('.header-wrapper');
const toggleBtnMain = document.getElementById('toggle-btn');
const toggleBtn = document.getElementById('toggle-btn');
const sideNavbar = document.getElementById('side-navbar');
const toggleIcon = document.getElementById('toggle-icon');
const sideNavbarLinks = sideNavbar ? sideNavbar.querySelectorAll('a') : [];
let isOpen = false;

// Function to open the sidebar
const openNavbar = () => {
  if (sideNavbar && toggleIcon) {
    sideNavbar.style.right = '0';
    toggleIcon.innerHTML = `<span class="close-svg-inner-header"><svg xmlns="http://www.w3.org/2000/svg" height="329pt" viewBox="0 0 329.26933 329" width="329pt"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0 " fill="#2B2B2B"/></svg></span>`;
    isOpen = true;
  }
};

// Function to close the sidebar
const closeNavbar = () => {
  if (sideNavbar && toggleIcon) {
    sideNavbar.style.right = '-300px';
    toggleIcon.innerHTML = `<svg width="83" height="94" viewBox="0 0 83 94" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 82.2666H5.72V81.1146L15.944 76.5866V77.0506L5.72 72.5226V71.3706H17V72.5866H7.432V72.1066L17 76.3786V77.2586L7.432 81.5466V81.0666H17V82.2666ZM17 65.3482H5.72L5.72 58.1482H6.808V64.0522H10.728V58.5002H11.832V64.0522H15.896V58.1482H17V65.3482ZM17 52.742H5.72V51.702L15.32 44.47V44.838H5.72V43.606H17V44.63L7.4 51.862V51.51H17V52.742ZM17.144 33.1409C17.144 34.6662 16.7547 35.8022 15.976 36.5489C15.1973 37.2849 14.0507 37.6529 12.536 37.6529H5.72V36.3409H12.472C13.6347 36.3409 14.5093 36.0849 15.096 35.5729C15.6827 35.0609 15.976 34.2502 15.976 33.1409C15.976 32.0955 15.6827 31.3009 15.096 30.7569C14.5093 30.2129 13.6347 29.9409 12.472 29.9409H5.72V28.6289H12.536C14.0507 28.6289 15.1973 29.0129 15.976 29.7809C16.7547 30.5382 17.144 31.6582 17.144 33.1409Z" fill="#2B2B2B"/>
        <path d="M76.3203 32.8999H32.6797V34.8098H76.3203V32.8999Z" fill="#2B2B2B"/>
        <path d="M76.3203 54.8159H32.6797V56.7258H76.3203V54.8159Z" fill="#2B2B2B"/>
        <path d="M76.3203 77.8159H32.6797V79.7258H76.3203V77.8159Z" fill="#2B2B2B"/>
    </svg>`;
  }
  isOpen = false;
};

// Toggle button click to open/close the sidebar
if (toggleBtn) {
  toggleBtn.addEventListener('click', event => {
    event.stopPropagation();
    isOpen ? closeNavbar() : openNavbar();
  });
}

// Close the sidebar when a link inside the sidebar is clicked
if (sideNavbarLinks && sideNavbarLinks.length > 0) {
  sideNavbarLinks.forEach(link => {
    link.addEventListener('click', closeNavbar);
  });
}

// Scroll event to show/hide the navbar and toggle button
window.addEventListener('scroll', () => {
  const currentScrollY = window.scrollY;
  if (currentScrollY <= 10) {
    if (header) header.classList.remove('hidden');
    if (toggleBtnMain) toggleBtnMain.classList.remove('show');
    closeNavbar();
  } else if (currentScrollY > lastScrollY) {
    if (header) header.classList.add('hidden');
    if (toggleBtnMain) toggleBtnMain.classList.add('show');
  }
  lastScrollY = currentScrollY;
});

// Close the sidebar when the user clicks anywhere outside of it
document.addEventListener('click', event => {
  if (isOpen && sideNavbar && !sideNavbar.contains(event.target) && event.target !== toggleBtn) {
    closeNavbar();
  }
});

/***/ }),

/***/ "./reels/reels.scss":
/*!**************************!*\
  !*** ./reels/reels.scss ***!
  \**************************/
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
/*!************************!*\
  !*** ./reels/reels.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _reels_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./reels.scss */ "./reels/reels.scss");
/* harmony import */ var _src_utilities_header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./../../src-utilities/header */ "../src-utilities/header.js");
/* harmony import */ var _src_utilities_country__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./../../src-utilities/country */ "../src-utilities/country.js");
/* harmony import */ var _src_utilities_footer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./../../src-utilities/footer */ "../src-utilities/footer.js");
/* harmony import */ var _src_utilities_footer__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_src_utilities_footer__WEBPACK_IMPORTED_MODULE_3__);




(function ($) {
  'use strict';

  // 1. Pure JS Filtering and Searching for Reels
  function runFilters() {
    let searchQuery = $('#search-reels').val();
    if (searchQuery) searchQuery = searchQuery.toLowerCase().trim();else searchQuery = '';
    let selectedCategory = $('.filter-container .filter.active').data('title');
    if (selectedCategory) selectedCategory = selectedCategory.toLowerCase();
    let $cards = $('#gbh-reels-grid .reel-card');
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

    // Toggle "No reels found" message
    if (visibleCount === 0) {
      if ($('#no-reels-msg').length === 0) {
        $('#gbh-reels-grid').append('<p id="no-reels-msg" style="grid-column: 1/-1; text-align: center; padding: 2rem;">No reels match your criteria.</p>');
      }
    } else {
      $('#no-reels-msg').remove();
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
  $('#search-reels').on('input', function () {
    runFilters();
  });

  // Clear All
  $('.filter-btns .clear').on('click', function () {
    $('.filter-container .filter').removeClass('active');
    $('#search-reels').val('');
    runFilters();
  });

  // 2. Reels Modal Playback
  let $modal = $('.reel-modal');
  let $modalBody = $('.reel-modal-body');
  let $modalClose = $('.reel-modal-close');
  let $modalOverlay = $('.reel-modal-overlay');
  function closeModal() {
    $modalBody.empty(); // destroy iframe/video
    $modal.hide();
  }
  $(document).on('click', '.play-reel-btn, .reel-card .btn-ghost', function (e) {
    e.preventDefault();
    let $card = $(this).closest('.reel-card');
    let videoUrl = $card.data('video-url');
    if (!videoUrl) {
      if (window.gbh && window.gbh.showToast) window.gbh.showToast('No video available for this reel.', 'error');
      return;
    }
    let embedHtml = '';
    if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
      // Extract Youtube ID
      let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
      let match = videoUrl.match(regExp);
      if (match && match[2].length === 11) {
        let yId = match[2];
        embedHtml = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + yId + '?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
      }
    } else if (videoUrl.includes('vimeo.com')) {
      // Extract Vimeo ID
      let vId = videoUrl.split('/').pop();
      embedHtml = '<iframe src="https://player.vimeo.com/video/' + vId + '?autoplay=1" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
    } else if (videoUrl.endsWith('.mp4') || videoUrl.endsWith('.webm')) {
      // Direct video file
      embedHtml = '<video src="' + videoUrl + '" width="100%" height="100%" controls autoplay></video>';
    } else {
      // Fallback iframe
      embedHtml = '<iframe src="' + videoUrl + '" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>';
    }
    $modalBody.html(embedHtml);
    $modal.show();
  });
  $modalClose.on('click', closeModal);
  $modalOverlay.on('click', closeModal);
})(jQuery);
})();

/******/ })()
;
//# sourceMappingURL=reels.bundle.js.map