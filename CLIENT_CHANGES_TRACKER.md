# Garden Basket Hub — Client Change Request (CR) Tracker

> **Source of Truth Document & Client Communication Alignment**  
> **Status:** Active Work Tracker  
> **Brand Name Alignment:** Retaining **"Garden Basket Hub"** (Per client's authoritative latest directive overriding CR §3.1).

---

## 📊 Quick Progress Dashboard

- **Total Tasks:** 24
- **Completed:** 24
- **In Progress:** 0
- **Blocked / Awaiting Client Assets:** 0
- **Needs Clarification:** 0

```
[████████████████████] 100% Completed
```

---

## 🚀 Phase 1: Immediate Fixes & Information Updates (No Client Dependencies)

Tasks ready to build immediately with zero blockers:

- [x] **1.1 Fix Menu / Hamburger Navigation Bug (CR §13)**
  - *Details:* Removed inline `style="display:none;"` from `mobile-nav-controls` in `header.php`, rewrote `public/src-utilities/header.js` to target actual drawer/toggle IDs, and added resilient inline vanilla JS fallback handler in `header.php`.
  - *Files:* `header.php`, `public/src-utilities/header.js`, `public/src-utilities/global.js`.
  - *Status:* Completed ✅

- [x] **1.2 Complete Removal of Cash on Delivery (COD) (CR §7)**
  - *Details:* Removed COD option from checkout payment radio/options in `page-checkout.php`, removed COD flow in `checkout.js`, and added explicit server-side error rejection for any COD requests in `inc/checkout-orders.php`.
  - *Files:* `page-checkout.php`, `public/pages/checkout/checkout.js`, `inc/checkout-orders.php`.
  - *Status:* Completed ✅

- [x] **1.3 Clean Up COD References from Site Content (CR §7.1)**
  - *Details:* Removed all COD text and FAQ references in `page-about-us.php` and checkout templates. Replaced with clear prepaid Razorpay explanation.
  - *Files:* `page-about-us.php`, `page-checkout.php`, `inc/checkout-orders.php`.
  - *Status:* Completed ✅

- [x] **1.4 Contact Heading Update (CR §11.1)**
  - *Details:* Changed heading "Visit the garden" / "Contact our Nursery" to "Contact our Shop" in `page-contact-us.php` and mobile drawer in `header.php`.
  - *Files:* `header.php`, `page-contact-us.php`.
  - *Status:* Completed ✅

- [x] **1.5 Contact Details & WhatsApp Number Update (CR §11.3)**
  - *Details:* Updated business WhatsApp/Phone to `9414216343` (`https://wa.me/919414216343`), email to `prashant753@gmail.com`, and Instagram to `@garden_basket_hubb` across all template headers, footers, contact pages, and JSON-LD schema.
  - *Files:* `header.php`, `footer.php`, `page-contact-us.php`, `page-about-us.php`, `page-thank-you.php`, `inc/seo-engine.php`, `inc/shiprocket-integration.php`.
  - *Status:* Completed ✅

- [x] **1.6 Shop Location & Google Maps Link (CR §11.2)**
  - *Details:* Added "Locate Store on Google Maps" CTA button linking directly to `https://maps.app.goo.gl/PNbyJo98EydJKEWw7?g_st=ic` in `page-contact-us.php` and `footer.php`.
  - *Files:* `page-contact-us.php`, `footer.php`.
  - *Status:* Completed ✅

- [x] **1.7 Replace Emoji Social Icons with SVGs (CR §12)**
  - *Details:* Replaced emoji characters (`📷`, `💬`) in `footer.php` with sharp, crisp inline SVG vectors for Instagram and WhatsApp.
  - *Files:* `footer.php`.
  - *Status:* Completed ✅

- [x] **1.8 Remove YouTube from Footer & Social Links (CR §12)**
  - *Details:* Completely removed YouTube icon (`▶️`) and references from footer and social icon lists.
  - *Files:* `footer.php`.
  - *Status:* Completed ✅

- [x] **1.9 Update "Our Story" History to 2019 (CR §10)**
  - *Details:* Explicitly stated that Garden Basket Hub was founded / started in **2019** in `page-about-us.php`, `front-page.php`, and `footer.php`.
  - *Files:* `page-about-us.php`, `front-page.php`, `footer.php`.
  - *Status:* Completed ✅

---

## 🗺️ Phase 2: Category Structure & Navigation Tree (CR §2)

Reorganize the product category taxonomy and the "Shop All Essentials" navigation:

- [x] **2.1 Rename "Seedlings" to "Saplings" (CR §2)**
  - *Details:* Updated legacy taxonomy terms (`wp_update_term`) from "Seedlings" to "Saplings" (slug `saplings`), updated product fallback cards on `front-page.php`, cart summaries in `page-cart.php`, and dynamic JS state in `main.js`.
  - *Files:* `inc/cpt-taxonomies.php`, `archive-product.php`, `front-page.php`, `page-cart.php`, `public/src-utilities/main.js`.
  - *Status:* Completed ✅

- [x] **2.2 Register Full 9-Category Tree (CR §2)**
  - *Hierarchy registered:*
    1. **Seeds** (Subcategories: *Flowers*, *Vegetables*, *Exotic*, *Forestry*)
    2. **Saplings** (*Jaipur Only*)
    3. **Bulbs** (Subcategory: *Lily Bulbs*)
    4. **Manures & Fertilizers**
    5. **Combos** (Subcategories: *Vegetable Seed Combos*, *Forestry Seed Combos*)
    6. **Sprayers**
    7. **Tools**
    8. **Grow Bags**
    9. **Pots**
  - *Details:* Implemented `gbh_get_client_category_tree()`, auto-registration hook `gbh_setup_client_category_tree()`, and auto-seeder `gbh_seed_category_showcase_products()` providing authentic products across all 9 categories directly from the codebase without manual WP Admin work.
  - *Files:* `inc/cpt-taxonomies.php`.
  - *Status:* Completed ✅

- [x] **2.3 Update "Shop All Essentials" Menu / Dropdown & Sidebar Filters (CR §2)**
  - *Details:* Built the responsive 2-column desktop dropdown menu and mobile category grid in `header.php`, rendered the full hierarchical 9-category tree with subcategory indentation in `archive-product.php`, updated `data-category` attributes on cards to match all terms/parents/slugs, added URL parameter deep-linking (`?category=slug`) with browser history sync in `shop.js`, and added responsive collapsible accordion styling in `shop.scss`.
  - *Files:* `header.php`, `archive-product.php`, `public/pages/shop/shop.js`, `public/pages/shop/shop.scss`.
  - *Status:* Completed ✅

---

## 📍 Phase 3: Jaipur Location Prompt & Sapling Purchasing Rules (CR §5)

Core business rules for location-restricted sapling sales:

- [x] **3.1 Entry Location Modal / Prompt (CR §5.1)**
  - *Details:* On first visit, shows a modal asking user to choose between *Jaipur City (Full Nursery Catalog & Live Saplings)* vs *Outside Jaipur / Rest of India (Seeds, Boosters, Grow Bags & Tools)*. Saves choice in `localStorage` + `gbh_location` cookie. Added interactive location pill switcher in Desktop Nav, Mobile Controls, and Mobile Drawer.
  - *Files:* `header.php`, `public/src-utilities/location-manager.js`, `public/scss-utilities/_location.scss`.
  - *Status:* Completed ✅

- [x] **3.2 Restrict Sapling Add-to-Cart for Outside-Jaipur Users (CR §5.2)**
  - *Details:* When location is "Outside Jaipur":
    - Sapling product cards automatically switch button text to `📍 Jaipur Only` with amber styling.
    - Single Product Page (PDP) displays a delivery notice box explaining transit limitations and locks the purchase button to Jaipur delivery.
    - If clicked, opens an informative popup with direct option to switch delivery location to Jaipur or explore seeds/supplies.
    - Updated Pincode checker to validate Jaipur (302xxx/303xxx) vs pan-India pincodes.
  - *Files:* `front-page.php`, `archive-product.php`, `single-product.php`, `public/src-utilities/location-manager.js`, `public/pages/single-product/singleProduct.js`.
  - *Status:* Completed ✅

- [x] **3.3 Backend Cart & Checkout Validation Guard for Saplings (CR §5.2)**
  - *Details:* Added server-side validation in `gbh_ajax_add_to_cart()` (`inc/cart-engine.php`) to reject sapling addition if user location is marked outside Jaipur. Added validation guard in `gbh_ajax_place_order()` (`inc/checkout-orders.php`) rejecting order completion if cart contains live saplings and destination address is not in Jaipur.
  - *Files:* `inc/cart-engine.php`, `inc/checkout-orders.php`.
  - *Status:* Completed ✅

- [x] **3.4 Jaipur-First Prioritization on Homepage & Shop (CR §5.3)**
  - *Details:* Dynamic client-side and server-side state synchronization updates all catalog cards, badges, and PDP notices in real-time when switching between Jaipur and Outside Jaipur.
  - *Files:* `header.php`, `front-page.php`, `archive-product.php`, `public/src-utilities/location-manager.js`.
  - *Status:* Completed ✅

---

## ⭐ Phase 4: Featured Product & Order Tracking (CR §6 & §8)

- [x] **4.1 Featured / Star Product: "Garden Basket Plant Booster" (CR §6)**
  - *Details:* Added a dedicated high-converting showcase block for "Garden Basket Organic Plant Booster (500ml)" on the homepage with:
    - Live interactive quantity stepper (`-` `[qty]` `+`).
    - Direct 1-click "Add to Bag" button with micro-feedback & real-time header cart counter sync.
    - Instant "Buy Now" CTA redirecting directly to `/checkout/`.
    - Auto-seeding database hook ensuring valid WP product post, metadata, and cart line-item calculation.
  - *Files:* `front-page.php`, `inc/cpt-taxonomies.php`, `public/scss-utilities/_star-product.scss`, `public/src-utilities/global.js`.
  - *Status:* Completed ✅

- [x] **4.2 "Track Your Order" Section & Shiprocket Integration (CR §8)**
  - *Details:* Added full end-to-end order tracking across the entire website:
    - Added "Track Order 🚚" links in Desktop Navbar, Mobile Navigation Drawer, and Footer Information column.
    - Added universal `#gbh-track-order-modal` popup supporting Order ID (e.g. `GBH-1042`) and Shiprocket AWB number lookups.
    - Connected frontend AJAX handler to backend `gbh_ajax_track_order` in `inc/shiprocket-integration.php`.
    - Integrated direct 1-click Shiprocket live tracking gateway button and WhatsApp support link.
    - Added 1-click "Track Live Status" button on the Thank You order confirmation page (`page-thank-you.php`).
  - *Files:* `header.php`, `footer.php`, `page-thank-you.php`, `inc/shiprocket-integration.php`, `public/src-utilities/global.js`, `public/scss-utilities/_star-product.scss`.
  - *Status:* Completed ✅

---

## 🎨 Phase 5: Visuals & Asset-Dependent Updates (CR §3, §4, §9 & §10)

- [x] **5.1 Update Garden Basket Hub Logo (CR §3.2 & Client Msg #2)**
  - *Details:* Integrated official `garden-basket-hub-logo.png` (transparent background, cropped to artwork bounding box) across Desktop Navigation bar, Mobile Navigation Drawer, and Footer brand badge via `get_template_directory_uri()`.
  - *Files:* `header.php`, `footer.php`, `public/scss-utilities/_header.scss`, `public/scss-utilities/_footer.scss`.
  - *Status:* Completed ✅

- [x] **5.2 Homepage Hero Section Background (CR §4.1 & Client Msg #3)**
  - *Details:* Implemented aesthetic sunflower, terracotta pot, and watering can background (`hero-gardening-sunflowers-bg.webp`) on the homepage hero section with radial lighting overlay for readability and CTA contrast.
  - *Files:* `front-page.php`, `public/scss-utilities/_section-backgrounds.scss`.
  - *Status:* Completed ✅

- [x] **5.3 Varied Website Backgrounds Across Sections (CR §4.2 & Client Msg #3)**
  - *Details:* Applied distinct section-specific botanical background treatments matching the client's reference series:
    - *Featured Categories:* `section-climbing-ivy-vine-bg.webp` (climbing green vine canopy).
    - *Best Sellers / Saplings:* `section-potted-plants-balcony-bg.webp` (balcony potted herbs).
    - *Plant Booster Showcase:* `section-bougainvillea-floral-bg.webp` (pink bougainvillea floral drape).
    - *Why Gardeners Trust Us:* `section-white-jasmine-planters-bg.webp` (white jasmine & terracotta planters).
  - *Files:* `front-page.php`, `public/scss-utilities/_section-backgrounds.scss`.
  - *Status:* Completed ✅

- [x] **5.4 Shop Photo Collage in "Our Story" (CR §10 & Client Msg #4)**
  - *Details:* Built a photo collage featuring real shop snapshots (`our-story-jaipur-shop-front.webp`, `our-story-jaipur-shop-entrance.webp`, `our-story-fresh-saplings-rack.webp`), floating "Est. 2019 in Jaipur" badge, nursery story narrative, and Google Maps store locator CTA on both the homepage and About Us page.
  - *Files:* `front-page.php`, `page-about-us.php`, `public/scss-utilities/_section-backgrounds.scss`.
  - *Status:* Completed ✅

- [x] **5.5 Gardening Reels: Instagram Reels via ACF & Dynamic Queries (CR §9)**
  - *Details:* Theme queries 5 reels on homepage and full grid on archive. Implemented universal ACF fallbacks (`reel_video_url`, `video_url`, `instagram_url`) and automatic `/embed` formatting so client can upload their Instagram reels directly in WP Admin. Removed outdated YouTube fallback in favor of official Instagram link.
  - *Files:* `archive-reels.php`, `single-reels.php`, `front-page.php`, `public/pages/reels/reels.js`.
  - *Status:* Completed & Ready for Client Uploads ✅

---

## 🔍 Phase 6: Clarifications & Visual Fixes

- [x] **6.1 "Yhe Theda Ho Rha Hai" Alignment Issue (CR §14)**
  - *Details:* Resolved visual tilt in `.btn-location-pill` by standardizing flex alignment (`display: inline-flex; align-items: center; gap: 6px; vertical-align: middle;`). User confirmed issue is resolved.
  - *Files:* `public/scss-utilities/_location.scss`, `header.php`.
  - *Status:* Completed & Verified ✅

---

## 📝 Change Log & Session Notes

| Date | Task ID | Description of Change | Developer |
| :--- | :--- | :--- | :--- |
| 2026-10-10 | Phase 1 (1.1 - 1.9) | Fixed menu navigation bug, removed COD completely from frontend/backend, updated contact heading to "Contact our Shop", updated WhatsApp to 9414216343, email to prashant753@gmail.com, added Google Maps locate store link, replaced emoji icons with SVGs, removed YouTube, and updated founding year to 2019 | Assistant & Dev |
| 2026-10-10 | Phase 2 (2.1 - 2.3) | Renamed Seedlings to Saplings (slug: saplings), registered client agreed 9-category hierarchy tree with subcategories & auto-seeder, created desktop 2-column dropdown menu & mobile category grid, implemented shop sidebar accordion & URL deep-linking | Assistant & Dev |
| 2026-10-10 | Phase 3 (3.1 - 3.4) | Implemented first-visit Jaipur delivery modal, header & mobile drawer location pill switchers, live sapling delivery restrictions with smart popups, backend cart & checkout guards, and polished mobile header layout | Assistant & Dev |
| 2026-10-10 | Phase 4 (4.1 - 4.2) | Built Star Featured Product "Garden Basket Organic Plant Booster (500ml)" showcase with quantity stepper, 1-click add-to-bag & buy-now CTAs, and end-to-end Shiprocket order tracking modal across header, drawer, footer, and thank you page | Assistant & Dev |
| 2026-10-12 | Phase 5 (5.1 - 5.4) | Integrated official WebP brand logo in header, drawer, and footer; applied 5 varied botanical section backgrounds across homepage (hero sunflowers, climbing ivy categories, potted herbs bestsellers, bougainvillea booster, white jasmine trust); built authentic 3-photo shop collage in Our Story & homepage | Assistant & Dev |
