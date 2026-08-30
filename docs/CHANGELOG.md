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

## [v1.2.0] - 2026-08-31

### Desktop UI & Aesthetic Overhaul
- **Global Typography Restyling:** Re-engineered all header sizes, section labels, and body text spacing.
- **Front Page Redesign:**
  - Designed a 5-column CSS grid for the Category section (`.cat-grid-wrapper`).
  - Transformed the "Why local growers choose us" section into a 4-column `.about-values-grid` with shadow cards.
  - Implemented the Jaipur Sowing Calendar using a 3-column `.about-story-cards` grid with distinct seasonal background colors.
  - Replaced broken HTML in the Featured Guides section with the global `.product-grid` markup, ensuring consistency with the blog archive.
- **Archive Pages Fixes:**
  - Ported `.filter-sidebar` CSS rules out of `shop.scss` into the global `_base.scss` to fix missing filter bars on the Blog and Reels archives.
- **Single Pages Fixes:**
  - Re-styled related posts on `single-blog.php` into the standardized 3-column `.product-grid`.

### Mobile & 360px Responsiveness Sweep (Strict CSS Only)
- **Typography & Padding Scaling:** Clamped `h1` headings to `2.2rem` and global paragraph tags to `16px` inside isolated `@media (max-width: 500px)` blocks to ensure extreme legibility without horizontal scrolling. Tightened `<section>` margins to `16px` on 360px phones.
- **Grid Safeties:** Forced all complex global grids (categories, shop layouts, value grids, blog cards) to collapse to `1fr` securely on narrow screens.
- **Mobile Filter Accordion (Pure CSS Checkbox Hack):** 
  - Restructured the HTML in `archive-product.php`, `archive-blog.php`, and `archive-reels.php` using a robust hidden checkbox hack.
  - On desktop (above 900px), the sidebar is permanently pinned.
  - On mobile, it transforms seamlessly into a native "Filter & Sort Options" dropdown accordion, saving massive vertical screen space.
- **Cart Row Stack:** Fixed the brutally squished single-line cart row. Mobile devices now render `.cart-row` as a beautiful 2x2 grid layout (image & title on top, quantity & remove buttons spanning the bottom).
- **About Us Stats Scaling:** Shrunk the massive `.stat-num` "5,000+" fonts inside `.stats-strip` and widened the gap so the numbers sit perfectly inside a breathable 2x2 grid on mobile screens.
