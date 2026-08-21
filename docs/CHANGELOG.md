# Garden Basket Hub - Changelog

## [v1.1.0] - 2026-08-21

### UI & Layout Fixes
- **Fluid Layout Refactor:** Removed rigid `max-width: 1300px` constraints from all primary containers (`section`, `.footer-top`, `.footer-bottom`). Replaced with a fluid `padding: 60px 5vw` to allow the layout to stretch naturally across large monitors, perfectly matching the design language of the Archive Blog page.
- **Global Typography Scaling:** Increased base font sizes globally to fix legibility ("chota chota" UI bug).
  - Base body font increased to `18px`.
  - Product Card headings increased from `1.05rem` to `1.2rem`.
  - Product Card prices increased to `1.1rem`.
  - Primary & Secondary Button font sizes increased from `0.9rem` to `1.05rem`.
  - Section titles clamp updated to scale up to `3.5rem`.
- **Contact Us Page:** Refactored the `.contact-layout` into a robust two-column CSS Grid. Removed old conflicting SCSS selectors that caused form inputs to overlap with the information box.

### JavaScript & Functionality Bug Fixes
- **Quantity Stepper (Single Product Page):**
  - Added explicit HTML class hooks (`.qty-plus`, `.qty-minus`, `.qty-input`) to stepper buttons in `single-product.php` to avoid encoding errors.
  - Rewrote the local stepper logic in `ecommerce.js` to rely securely on CSS classes, successfully updating the local quantity state before Add to Cart is clicked.
- **Add to Bag (Single Product Page):**
  - Updated `gbh_add_to_cart` AJAX logic to dynamically read the stepper quantity field value instead of defaulting to `1`.
- **Buy Now Button:**
  - Implemented the `btn-buy-now` event listener in `ecommerce.js`. It now adds the item to the cart and instantly redirects the user to `/checkout/` upon success.
- **Reels Modal Video Player:**
  - Added the missing click handler logic in `reels.js`. Clicking any `.reel-card` now correctly extracts the `data-video` URL, dynamically injects an `iframe` (or HTML5 `video`) into the `#gbh-reel-modal` body, and toggles the lightbox overlay.
- **Global Navigation Crash:**
  - Patched `header.js` with strict null checks (`if (sideNavbar && toggleIcon)`) to prevent a `TypeError` crash (`querySelectorAll` of null) on pages that don't load the mobile navigation DOM elements, restoring JS execution across the site.
