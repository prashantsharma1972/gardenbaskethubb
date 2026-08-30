# 🌿 Garden Basket Hub (`gardenbaskethubb`) — Custom WordPress E-Commerce Theme

> **Developer & AI Assistant Documentation Guide**  
> This file contains the complete end-to-end repository architecture, Custom Post Types (CPTs), ACF meta field mapping, AJAX cart storage engine, template routing rules, and guidelines for team members and AI assistants continuing development on this codebase.

---

## 📌 Project Overview
- **Store Name**: Garden Basket Hub (Rooted in Jaipur, Rajasthan)
- **Business Model**: E-Commerce Nursery for Heirloom Seeds, Live Seedlings (Same-Day Jaipur Delivery), Organic Vermicompost & Soil, Gardening Tools, and Clay Pots.
- **Tech Stack**:
  - **CMS**: WordPress (Custom Light Theme — WooCommerce Not Required)
  - **Styles**: Vanilla CSS Design System with CSS Variables (`style.css`)
  - **Scripts**: Modular JS bundled via Webpack (`public/` -> `build/`)
  - **Fonts**: `Playfair Display` (Serif Headings), `DM Sans` (Body Text), `DM Mono` (Accents & Badges)

---

## 📁 Repository Directory & File Structure

```text
gardenbaskethubb/
├── functions.php                   # Master Theme Loader, API Constants & Asset Enqueue
├── style.css                       # Root Stylesheet (Not used for styles, just WP Theme Info)
├── header.php                      # Site Header, Desktop Nav, Mobile Drawer Overlay & Toggle Button
├── footer.php                      # Shared Footer, Legal Policy Links & Crisp Vector SVGs
├── sitemap.xml                     # Physical XML Sitemap fallback
├── robots.txt                      # Physical Robots.txt crawler directives
├── index.php                       # Fallback Main WordPress Loop Template
├── front-page.php                  # Homepage (Hero, Categories, Best Sellers, Reels, Trust Grid, Calendar, Blogs)
├── 404.php                         # Custom 404 Page Not Found Template
│
├── public/                         # Frontend Source Code (Webpack Entrypoints)
│   ├── pages/                      # Page-specific JS/SCSS (shop, single-product, cart, etc.)
│   ├── scss-utilities/             # Global Sass Modules (_base.scss, _breakpoints.scss, _variables.scss)
│   └── src-utilities/              # Global JS Utilities (ecommerce.js, header.js, footer.js, reels.js)
│
├── build/                          # Compiled Webpack Output (DO NOT EDIT DIRECTLY)
│   ├── frontPage.js, shop.js, etc. # Minified Bundles
│   └── *.css                       # Compiled Styles
│
├── docs/                           # Documentation (CHANGELOG, PENDING_IMPLEMENTATION, PROGRESS_TRACKER, README)
├── package.json                    # NPM Dependencies & Scripts (`npm run build`, `npm run dev`)
├── webpack.config.js               # Webpack Bundler Configuration
│
├── archive-product.php             # Shop Catalog Page (Live AJAX Category, Season & Price Filter Grid)
├── single-product.php              # Single Product Detail Page (PDP) with Image Gallery, Specs, Care Tabs, Buy Now
├── archive-reels.php               # Gardening Video Reels Gallery Archive Page
├── single-reels.php                # Single Reel Post View Template
├── archive-blog.php                # Gardening Guides & Blog Catalog Archive Page
├── single-blog.php                 # Single Blog Post View Template with Author Bio & Related Articles
│
├── page-cart.php                   # Shopping Bag Page (Dynamic Items Table, Quantity Steppers, Coupons, Summary)
├── page-checkout.php               # 3-Step Checkout Page (Contact, Jaipur Slot Delivery, Payment Options)
├── page-thank-you.php              # Order Completion Page (Order ID Badge, Slot Summary, WA Tracking)
│
├── page-about-us.php               # About Us / Our Story Page (3-Column Story Cards, Values Grid, Stats Counter)
├── page-contact-us.php             # Contact Us Page (Jaipur Nursery Details, Hours, Form with Toast Handler)
│
├── privacy-policy.php              # Privacy Policy Legal Page
├── page-terms-and-conditions.php   # Terms & Conditions Legal Page
├── page-refund-policy.php          # Refund & Shipping Policy Legal Page (Live Plant Guarantee, Jaipur Shipping)
```

---

## ⚙️ Custom Post Types (CPTs) & Taxonomies

Defined in `functions.php`:

| Post Type | Singular Name | Slug / Rewrite | Description | Associated Taxonomies |
| :--- | :--- | :--- | :--- | :--- |
| `product` | Product | `/shop/` | Gardening Products, Seeds, Saplings | `product_cat`, `product_season` |
| `reels` | Reel | `/reels/` | Short Gardening Video Guides | `reel_cat` |
| `gbh_order` | Order | Internal | Checkout Order Records | None |

### Taxonomies
1. `product_cat`: Categories (`Seeds`, `Seedlings`, `Compost & Soil`, `Tools`, `Pots & Planters`).
2. `product_season`: Seasons (`Monsoon`, `Winter`, `Summer`, `All Year`).
3. `reel_cat`: Video Categories (`Seedling Care`, `Monsoon Veg`, `Composting`, etc.).

---

## 🔑 ACF & Post Meta Fields Reference

All post meta lookups in `single-product.php`, `archive-product.php`, and `functions.php` check both `get_post_meta()` and `get_field()` with fallback handling:

### Product Meta Fields (`product`)
- `product_price`: Regular Price (e.g. `249`).
- `product_offer_price`: Discounted Offer Price (e.g. `199`).
- `discount_label`: Badge label (e.g. `Jaipur Only`, `Bestseller`, `10% OFF`).
- `number_of_seeds`: Quantity/Count spec (e.g. `6 Saplings`, `120+ Seeds`).
- `seed_type`: Seed variety classification (e.g. `Hybrid Cherry`, `Heirloom Organic`).
- `sowing_season`: Recommended season (e.g. `Monsoon`, `Winter`, `Summer`).
- `germination_temperature`: Optimal temperature range (e.g. `20-28°C`).
- `germination_time`: Expected days to germinate (e.g. `7-10 Days`).
- `germination_rate`: Germination percentage (e.g. `85%+`).
- `first_harvest`: Time to harvest (e.g. `60-70 Days`).
- `container_pot_size` / `container__pot_size`: Recommended pot size (e.g. `12 Inch Pot / Grow Bag`).
- `growing_level`: Difficulty level (e.g. `Beginner Friendly`).
- `sku`: Product SKU identifier (e.g. `GBH-SEEDS-101`).
- `product_image`: Main product image URL.
- `product_gallery` / `product_image_1..3`: Gallery images array or URLs.
- `plant_care_tips`, `how_to_grow`, `pests_and_diseases`, `harvesting_guide`: Accordion guide tabs.

### Reel Meta Fields (`reels`)
- `reel_video_url`: Embeddable YouTube / MP4 video link.
- `reel_view_count`: View count string (e.g. `2.4K views`).

### Blog Post Meta Fields (`post`)
- `read_time`: Estimated reading time (e.g. `5 min read`).
- `banner_image`: Featured banner image URL.

---

## 🛒 Dual E-Commerce Cart Engine Architecture

### Storage & Persistence (`functions.php`)
- **Cart Key Format**: `$product_id . '_' . sanitize_key($variant)`.
- **Dual Persistence Strategy**: Saved in PHP `$_SESSION['gbh_cart']` AND HTTP cookie `gbh_cart_cookie` (30-day expiration).
- **Auto-Restoration**: `gbh_get_cart_data()` automatically populates the session from the cookie if the PHP session expires.

### Registered AJAX Endpoints (`admin-ajax.php`)
- `gbh_add_to_cart`: Adds item with quantity to cart.
- `gbh_get_cart`: Returns full cart JSON object (items, subtotal, delivery fee, discount, final total, count).
- `gbh_update_cart`: Updates item quantities or removes items (`qty = 0`).
- `gbh_apply_coupon`: Validates coupon codes (`ORGANIC10`, `JAIPUR100`, `MONSOON200`).
- `gbh_check_pincode`: Validates Jaipur delivery pincodes (`302001` to `302039`).
- `gbh_place_order`: Saves checkout details to `gbh_order` CPT and clears cart.
- `gbh_filter_products`: Executes live product filtering and returns filtered card grid HTML.

---

## 🛠️ Dynamic Page Routing & Helper Functions

### Page Auto-Creator (`gbh_create_required_wp_pages`)
Automatically creates required WordPress pages in the database on `init` if missing:
`shop`, `reels`, `blog`, `about-us`, `contact-us`, `cart`, `checkout`, `thank-you`, `privacy-policy`, `terms-and-conditions`, `refund-policy`.

### Dynamic URL Resolver (`gbh_get_page_url`)
Use `gbh_get_page_url('shop')` or `gbh_get_page_url('cart')` across templates. It dynamically handles **Plain Permalinks** (`?page_id=X`) and **Pretty Permalinks** (`/shop/`) without breaking URLs.

---

## 🤖 Guidelines for AI Assistants & Developers

1. **Maintain Dynamic DOM Updates**: Never use `location.reload()` in JavaScript for cart updates. Always call `updateCartDOM(data)` in `public/src-utilities/ecommerce.js` or related modules.
2. **Obey Design System Tokens**: Use CSS variables defined in `:root` (`var(--soil)`, `var(--clay)`, `var(--leaf)`, `var(--sand)`, `var(--sprout)`, `var(--marigold)`, `var(--white)`, `var(--ink)`).
3. **Responsive Mobile Engineering**: The theme employs a strict "Desktop-First, Override for Mobile" CSS strategy.
   - All desktop structural grids (`.shop-layout`, `.product-grid`, `.cat-grid-wrapper`) are defined in standard selectors.
   - All mobile layout changes (360px targeted clamps, `1fr` grid collapses, filter toggles) MUST be written safely inside isolated `@media (max-width: 900px)` or `@media (max-width: 500px)` blocks within `_breakpoints.scss` so desktop views are never compromised.
   - The Shop, Blog, and Reels filters use a Pure CSS Checkbox Hack for mobile accordion dropdowns. Do NOT wrap these in native `<details>` tags as they break the desktop shadow DOM display.
4. **Product Card Navigation**: Always give `.product-card` containers `data-permalink="<?php the_permalink(); ?>"` and wrap product title and thumbnail in `<a href="<?php the_permalink(); ?>">`.
5. **PHP Code Linting**: Always verify syntax with `php -l <filename>` before pushing changes.
