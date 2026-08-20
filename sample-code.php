<!-- =========================================================
     GARDEN BASKET HUB - All website pages
     Same exact design system as your Haritima template.
     Just copy each PAGE block into its own .html file:
       - shop.html
       - product.html
       - cart.html
       - checkout.html
       - about.html
       - reels.html
       - contact.html
     
     The <head> CSS + <nav> + <footer> are IDENTICAL across all
     pages — just paste them once into each file.
     Only the middle <main> section changes per page.   
     ========================================================= -->


<!-- ============================================================
     SHARED HEAD (paste this in every page)
     ============================================================ -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garden Basket Hub — Rooted in Jaipur, Growing Happiness</title>
  https://fonts.googleapis.com
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400&display=swap"
    rel="stylesheet">
  <style>
    /* === EXACT SAME CSS AS HOMEPAGE === */
    :root {
      --soil: #2C1A0E;
      --clay: #8B4A2B;
      --sand: #F0E6D3;
      --leaf: #3A6B35;
      --sprout: #7BBF6A;
      --marigold: #E8942A;
      --white: #FDFAF5;
      --ink: #1A1008;
      --f-display: 'Playfair Display', serif;
      --f-body: 'DM Sans', sans-serif;
      --f-mono: 'DM Mono', monospace;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      background: var(--white);
      color: var(--ink);
      font-family: var(--f-body);
      font-size: 16px;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* NAV */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 48px;
      background: rgba(253, 250, 245, 0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(44, 26, 14, 0.08);
    }

    .nav-logo {
      font-family: var(--f-display);
      font-size: 1.5rem;
      color: var(--soil);
      letter-spacing: -0.02em;
      text-decoration: none;
    }

    .nav-logo span {
      color: var(--leaf);
      font-style: italic;
    }

    .nav-links {
      display: flex;
      gap: 36px;
      list-style: none;
      align-items: center;
    }

    .nav-links a {
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--soil);
      text-decoration: none;
      letter-spacing: 0.02em;
      transition: color 0.2s;
    }

    .nav-links a:hover {
      color: var(--leaf);
    }

    .nav-cta {
      background: var(--leaf);
      color: var(--white) !important;
      padding: 8px 20px;
      border-radius: 2px;
      transition: background 0.2s !important;
    }

    .nav-cta:hover {
      background: var(--soil) !important;
    }

    /* SECTION COMMON */
    section {
      padding: 100px 80px;
    }

    .section-label {
      font-family: var(--f-mono);
      font-size: 0.72rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--clay);
      margin-bottom: 16px;
    }

    .section-title {
      font-family: var(--f-display);
      font-size: clamp(2rem, 3.5vw, 3rem);
      line-height: 1.1;
      color: var(--soil);
      letter-spacing: -0.025em;
      margin-bottom: 16px;
    }

    .section-sub {
      font-size: 1rem;
      color: var(--clay);
      max-width: 540px;
      line-height: 1.7;
      margin-bottom: 56px;
    }

    /* BUTTONS */
    .btn-primary {
      background: var(--soil);
      color: var(--white);
      padding: 14px 32px;
      font-family: var(--f-body);
      font-size: 0.9rem;
      font-weight: 500;
      border: none;
      border-radius: 2px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s;
      letter-spacing: 0.02em;
      display: inline-block;
    }

    .btn-primary:hover {
      background: var(--leaf);
    }

    .btn-ghost {
      color: var(--soil);
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: gap 0.2s;
    }

    .btn-ghost:hover {
      gap: 10px;
    }

    /* PAGE HERO (smaller than homepage hero) */
    .page-hero {
      padding: 160px 80px 80px;
      background: var(--sand);
      text-align: center;
    }

    .page-hero .section-label {
      justify-content: center;
    }

    .page-hero h1 {
      font-family: var(--f-display);
      font-size: clamp(2.5rem, 4vw, 3.8rem);
      color: var(--soil);
      letter-spacing: -0.03em;
      margin-bottom: 18px;
      line-height: 1.1;
    }

    .page-hero h1 em {
      color: var(--leaf);
      font-style: italic;
    }

    .page-hero p {
      font-size: 1.05rem;
      color: var(--clay);
      max-width: 560px;
      margin: 0 auto;
      line-height: 1.7;
    }

    .breadcrumb {
      font-family: var(--f-mono);
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--clay);
      margin-bottom: 24px;
    }

    .breadcrumb a {
      color: var(--clay);
      text-decoration: none;
    }

    .breadcrumb a:hover {
      color: var(--leaf);
    }

    /* PRODUCT GRID (reused) */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
    }

    .product-card {
      border: 1px solid rgba(44, 26, 14, 0.1);
      border-radius: 4px;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.25s, box-shadow 0.25s;
      background: var(--white);
      position: relative;
    }

    .product-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 32px rgba(44, 26, 14, 0.1);
    }

    .product-card:hover .add-btn {
      opacity: 1;
      transform: translateY(0);
    }

    .product-img {
      height: 240px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 5.5rem;
      background: var(--sand);
      position: relative;
    }

    .badge-new,
    .badge-hot,
    .badge-intl,
    .badge-jaipur {
      position: absolute;
      top: 14px;
      left: 14px;
      font-family: var(--f-mono);
      font-size: 0.65rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 2px;
    }

    .badge-new {
      background: var(--leaf);
      color: var(--white);
    }

    .badge-hot {
      background: var(--marigold);
      color: var(--ink);
    }

    .badge-intl {
      background: var(--soil);
      color: var(--sand);
    }

    .badge-jaipur {
      background: var(--clay);
      color: var(--white);
    }

    .product-body {
      padding: 20px 22px 24px;
    }

    .product-category {
      font-family: var(--f-mono);
      font-size: 0.68rem;
      color: var(--clay);
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .product-name {
      font-family: var(--f-display);
      font-size: 1.1rem;
      color: var(--soil);
      margin-bottom: 4px;
    }

    .product-desc {
      font-size: 0.85rem;
      color: #7a6050;
      margin-bottom: 16px;
      line-height: 1.5;
    }

    .product-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .product-price {
      font-family: var(--f-display);
      font-size: 1.25rem;
      color: var(--soil);
      font-weight: 700;
    }

    .product-price small {
      font-family: var(--f-body);
      font-size: 0.75rem;
      color: var(--clay);
      font-weight: 400;
      margin-left: 4px;
    }

    .add-btn {
      background: var(--leaf);
      color: var(--white);
      border: none;
      border-radius: 2px;
      padding: 8px 16px;
      font-size: 0.8rem;
      font-weight: 500;
      cursor: pointer;
      opacity: 0;
      transform: translateY(4px);
      transition: opacity 0.2s, transform 0.2s, background 0.2s;
    }

    .add-btn:hover {
      background: var(--soil);
    }

    /* SHOP FILTERS */
    .shop-layout {
      display: grid;
      grid-template-columns: 240px 1fr;
      gap: 48px;
    }

    .filter-sidebar h4 {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--clay);
      margin-bottom: 18px;
      margin-top: 32px;
    }

    .filter-sidebar h4:first-child {
      margin-top: 0;
    }

    .filter-sidebar label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.9rem;
      color: var(--soil);
      margin-bottom: 10px;
      cursor: pointer;
    }

    .filter-sidebar input {
      accent-color: var(--leaf);
    }

    .filter-sidebar .price-input {
      display: flex;
      gap: 8px;
      margin-top: 8px;
    }

    .filter-sidebar .price-input input {
      width: 50%;
      padding: 8px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
      font-family: var(--f-body);
      font-size: 0.85rem;
      background: transparent;
    }

    .shop-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(44, 26, 14, 0.1);
    }

    .shop-toolbar .results {
      font-family: var(--f-mono);
      font-size: 0.78rem;
      color: var(--clay);
      letter-spacing: 0.06em;
    }

    .shop-toolbar select {
      font-family: var(--f-body);
      font-size: 0.85rem;
      padding: 8px 12px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
      background: var(--white);
      color: var(--soil);
    }

    /* PRODUCT DETAIL */
    .pdp {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
      align-items: flex-start;
    }

    .pdp-gallery {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .pdp-main-img {
      aspect-ratio: 1;
      background: var(--sand);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10rem;
      border-radius: 4px;
      position: relative;
    }

    .pdp-thumbs {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
    }

    .pdp-thumb {
      aspect-ratio: 1;
      background: var(--sand);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.4rem;
      border-radius: 3px;
      cursor: pointer;
      border: 2px solid transparent;
      transition: border 0.2s;
    }

    .pdp-thumb.active,
    .pdp-thumb:hover {
      border-color: var(--leaf);
    }

    .pdp-info .breadcrumb {
      margin-bottom: 14px;
    }

    .pdp-info h1 {
      font-family: var(--f-display);
      font-size: clamp(2rem, 3.2vw, 2.8rem);
      color: var(--soil);
      letter-spacing: -0.025em;
      margin-bottom: 10px;
      line-height: 1.15;
    }

    .pdp-info .price {
      font-family: var(--f-display);
      font-size: 2rem;
      color: var(--soil);
      font-weight: 700;
      margin: 14px 0 6px;
    }

    .pdp-info .price small {
      font-family: var(--f-body);
      font-size: 0.85rem;
      color: var(--clay);
      font-weight: 400;
      margin-left: 6px;
    }

    .pdp-info .rating {
      display: flex;
      gap: 8px;
      align-items: center;
      color: var(--marigold);
      font-size: 0.95rem;
      margin-bottom: 24px;
    }

    .pdp-info .rating span {
      color: var(--clay);
      font-family: var(--f-mono);
      font-size: 0.78rem;
    }

    .pdp-info .desc {
      font-size: 0.95rem;
      color: #7a6050;
      line-height: 1.7;
      margin-bottom: 28px;
    }

    .pdp-options {
      display: flex;
      flex-direction: column;
      gap: 18px;
      margin-bottom: 32px;
    }

    .opt-row label {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--clay);
      display: block;
      margin-bottom: 8px;
    }

    .opt-pills {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .opt-pill {
      padding: 8px 16px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
      font-size: 0.85rem;
      color: var(--soil);
      background: var(--white);
      cursor: pointer;
      transition: 0.2s;
    }

    .opt-pill.selected,
    .opt-pill:hover {
      background: var(--soil);
      color: var(--white);
      border-color: var(--soil);
    }

    .qty-row {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .qty-stepper {
      display: flex;
      align-items: center;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
    }

    .qty-stepper button {
      background: transparent;
      border: none;
      padding: 10px 14px;
      cursor: pointer;
      font-size: 1rem;
      color: var(--soil);
    }

    .qty-stepper input {
      width: 50px;
      text-align: center;
      border: none;
      background: transparent;
      font-family: var(--f-body);
      font-size: 0.95rem;
    }

    .pdp-cta {
      display: flex;
      gap: 12px;
      margin-top: 28px;
    }

    .pdp-cta .btn-primary {
      flex: 1;
      padding: 16px;
    }

    .pdp-cta .btn-secondary {
      flex: 1;
      background: var(--leaf);
      color: var(--white);
      padding: 16px;
      border: none;
      border-radius: 2px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
    }

    .pdp-cta .btn-secondary:hover {
      background: var(--soil);
    }

    .pincode-check {
      margin-top: 28px;
      padding: 16px;
      background: var(--sand);
      border-radius: 3px;
    }

    .pincode-check label {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--clay);
      display: block;
      margin-bottom: 10px;
    }

    .pincode-check .row {
      display: flex;
      gap: 8px;
    }

    .pincode-check input {
      flex: 1;
      padding: 10px 14px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
      font-family: var(--f-body);
      font-size: 0.9rem;
      background: var(--white);
    }

    .pincode-check button {
      background: var(--soil);
      color: var(--white);
      border: none;
      padding: 10px 18px;
      border-radius: 2px;
      cursor: pointer;
      font-size: 0.85rem;
    }

    .pdp-trust {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 14px;
      margin-top: 24px;
    }

    .pdp-trust-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.85rem;
      color: var(--soil);
    }

    .pdp-trust-item .ic {
      font-size: 1.3rem;
    }

    /* CART */
    .cart-layout {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 48px;
      align-items: flex-start;
    }

    .cart-table {
      width: 100%;
    }

    .cart-row {
      display: grid;
      grid-template-columns: 90px 1fr auto;
      gap: 20px;
      padding: 20px 0;
      border-bottom: 1px solid rgba(44, 26, 14, 0.1);
      align-items: center;
    }

    .cart-row:first-child {
      padding-top: 0;
    }

    .cart-thumb {
      width: 90px;
      height: 90px;
      background: var(--sand);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.6rem;
      border-radius: 3px;
    }

    .cart-info h4 {
      font-family: var(--f-display);
      font-size: 1.1rem;
      color: var(--soil);
      margin-bottom: 4px;
    }

    .cart-info .meta {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      color: var(--clay);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 10px;
    }

    .cart-info .price {
      font-family: var(--f-display);
      font-size: 1rem;
      color: var(--soil);
      font-weight: 700;
    }

    .cart-actions {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 10px;
    }

    .cart-actions .remove {
      color: var(--clay);
      font-size: 0.8rem;
      background: none;
      border: none;
      cursor: pointer;
      text-decoration: underline;
    }

    .cart-summary {
      background: var(--sand);
      padding: 32px;
      border-radius: 4px;
      position: sticky;
      top: 100px;
    }

    .cart-summary h3 {
      font-family: var(--f-display);
      font-size: 1.4rem;
      color: var(--soil);
      margin-bottom: 20px;
    }

    .cart-summary .row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      font-size: 0.92rem;
      color: var(--soil);
    }

    .cart-summary .row.total {
      border-top: 1px solid rgba(44, 26, 14, 0.15);
      margin-top: 12px;
      padding-top: 18px;
      font-family: var(--f-display);
      font-size: 1.3rem;
      font-weight: 700;
    }

    .cart-summary .coupon {
      display: flex;
      gap: 8px;
      margin: 18px 0;
    }

    .cart-summary .coupon input {
      flex: 1;
      padding: 10px 12px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      background: var(--white);
      font-family: var(--f-body);
      font-size: 0.85rem;
      border-radius: 2px;
    }

    .cart-summary .coupon button {
      background: var(--soil);
      color: var(--white);
      border: none;
      padding: 10px 16px;
      border-radius: 2px;
      cursor: pointer;
      font-size: 0.8rem;
    }

    .cart-summary .checkout-btn {
      width: 100%;
      margin-top: 16px;
      text-align: center;
    }

    /* CHECKOUT */
    .checkout-layout {
      display: grid;
      grid-template-columns: 1.5fr 1fr;
      gap: 48px;
      align-items: flex-start;
    }

    .checkout-form .step {
      margin-bottom: 36px;
    }

    .checkout-form h3 {
      font-family: var(--f-display);
      font-size: 1.4rem;
      color: var(--soil);
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .checkout-form h3 .num {
      width: 30px;
      height: 30px;
      background: var(--leaf);
      color: var(--white);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-family: var(--f-mono);
      font-size: 0.85rem;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .form-grid .full {
      grid-column: span 2;
    }

    .form-group label {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--clay);
      display: block;
      margin-bottom: 6px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 2px;
      font-family: var(--f-body);
      font-size: 0.92rem;
      background: var(--white);
      color: var(--ink);
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--leaf);
    }

    .pay-option {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 18px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 3px;
      margin-bottom: 10px;
      cursor: pointer;
    }

    .pay-option.selected {
      border-color: var(--leaf);
      background: rgba(123, 191, 106, 0.08);
    }

    .pay-option .ic {
      font-size: 1.4rem;
    }

    .pay-option .label {
      font-weight: 500;
      color: var(--soil);
    }

    .pay-option .sub {
      font-size: 0.78rem;
      color: var(--clay);
    }

    /* REELS */
    .reels-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .reel-card {
      aspect-ratio: 9/16;
      border-radius: 4px;
      overflow: hidden;
      position: relative;
      cursor: pointer;
      background: var(--leaf);
      display: flex;
      align-items: flex-end;
      padding: 18px;
      color: var(--white);
      transition: transform 0.25s;
    }

    .reel-card:hover {
      transform: scale(1.02);
    }

    .reel-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.7));
    }

    .reel-card .play {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 48px;
      height: 48px;
      background: rgba(255, 255, 255, 0.92);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--soil);
      font-size: 1rem;
    }

    .reel-card .meta {
      position: relative;
      z-index: 1;
    }

    .reel-card .meta h4 {
      font-family: var(--f-display);
      font-size: 1rem;
      margin-bottom: 4px;
    }

    .reel-card .meta span {
      font-family: var(--f-mono);
      font-size: 0.7rem;
      opacity: 0.85;
      letter-spacing: 0.06em;
    }

    .reel-card.r1 {
      background: linear-gradient(135deg, #7BBF6A, #3A6B35);
    }

    .reel-card.r2 {
      background: linear-gradient(135deg, #E8942A, #8B4A2B);
    }

    .reel-card.r3 {
      background: linear-gradient(135deg, #8B4A2B, #2C1A0E);
    }

    .reel-card.r4 {
      background: linear-gradient(135deg, #F0E6D3, #8B4A2B);
    }

    .reel-card.r5 {
      background: linear-gradient(135deg, #a8d5a2, #3A6B35);
    }

    .reel-card.r6 {
      background: linear-gradient(135deg, #fce4c8, #E8942A);
    }

    .reel-card.r7 {
      background: linear-gradient(135deg, #c8e6c4, #3A6B35);
    }

    .reel-card.r8 {
      background: linear-gradient(135deg, #d4edda, #7BBF6A);
    }

    .reel-filters {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 40px;
    }

    .reel-pill {
      padding: 8px 18px;
      border: 1px solid rgba(44, 26, 14, 0.2);
      border-radius: 100px;
      font-size: 0.85rem;
      color: var(--soil);
      cursor: pointer;
      background: var(--white);
    }

    .reel-pill.active,
    .reel-pill:hover {
      background: var(--soil);
      color: var(--white);
      border-color: var(--soil);
    }

    /* ABOUT */
    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
      align-items: center;
      margin-bottom: 80px;
    }

    .about-grid.reverse {
      direction: rtl;
    }

    .about-grid.reverse>* {
      direction: ltr;
    }

    .about-visual {
      aspect-ratio: 4/5;
      background: var(--sand);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 9rem;
      border-radius: 4px;
    }

    .about-visual.green {
      background: var(--leaf);
      color: var(--white);
    }

    .about-text h2 {
      font-family: var(--f-display);
      font-size: clamp(1.8rem, 3vw, 2.6rem);
      color: var(--soil);
      margin-bottom: 18px;
      line-height: 1.15;
    }

    .about-text h2 em {
      color: var(--leaf);
      font-style: italic;
    }

    .about-text p {
      font-size: 0.98rem;
      color: #7a6050;
      line-height: 1.8;
      margin-bottom: 14px;
    }

    .stats-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      background: var(--sand);
      padding: 48px;
      border-radius: 4px;
      margin-top: 48px;
    }

    .stat {
      text-align: center;
    }

    .stat-num {
      font-family: var(--f-display);
      font-size: 2.4rem;
      color: var(--soil);
      font-weight: 700;
    }

    .stat-label {
      font-family: var(--f-mono);
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--clay);
      margin-top: 4px;
    }

    /* CONTACT */
    .contact-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
    }

    .contact-info {
      background: var(--soil);
      color: var(--sand);
      padding: 48px;
      border-radius: 4px;
    }

    .contact-info h2 {
      font-family: var(--f-display);
      font-size: 2rem;
      color: var(--sand);
      margin-bottom: 14px;
    }

    .contact-info p {
      font-size: 0.95rem;
      color: rgba(240, 230, 211, 0.7);
      margin-bottom: 32px;
      line-height: 1.7;
    }

    .contact-row {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 22px;
    }

    .contact-row .ic {
      font-size: 1.4rem;
      color: var(--marigold);
    }

    .contact-row strong {
      display: block;
      color: var(--sand);
      font-family: var(--f-mono);
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 4px;
    }

    .contact-row span {
      font-size: 0.92rem;
      color: rgba(240, 230, 211, 0.85);
    }

    .contact-form .form-group {
      margin-bottom: 18px;
    }

    .contact-form textarea {
      min-height: 130px;
      resize: vertical;
    }

    /* FOOTER */
    footer {
      background: var(--ink);
      color: var(--sand);
      padding: 64px 80px 40px;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 60px;
      margin-bottom: 60px;
    }

    .footer-brand .nav-logo {
      color: var(--sand);
    }

    .footer-brand p {
      font-size: 0.875rem;
      color: rgba(240, 230, 211, 0.55);
      margin-top: 16px;
      line-height: 1.7;
      max-width: 280px;
    }

    .footer-col h4 {
      font-family: var(--f-mono);
      font-size: 0.68rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: rgba(240, 230, 211, 0.4);
      margin-bottom: 20px;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col li {
      margin-bottom: 12px;
    }

    .footer-col a {
      font-size: 0.875rem;
      color: rgba(240, 230, 211, 0.7);
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-col a:hover {
      color: var(--marigold);
    }

    .footer-bottom {
      border-top: 1px solid rgba(240, 230, 211, 0.1);
      padding-top: 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-bottom p {
      font-size: 0.8rem;
      color: rgba(240, 230, 211, 0.35);
    }

    .footer-socials {
      display: flex;
      gap: 16px;
    }

    .footer-socials a {
      width: 34px;
      height: 34px;
      border-radius: 2px;
      background: rgba(240, 230, 211, 0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      text-decoration: none;
      color: var(--sand);
      transition: background 0.2s;
    }

    .footer-socials a:hover {
      background: var(--leaf);
    }

    /* MOBILE */
    @media (max-width:900px) {
      nav {
        padding: 16px 24px;
      }

      .nav-links {
        display: none;
      }

      section {
        padding: 64px 24px;
      }

      .page-hero {
        padding: 120px 24px 56px;
      }

      .product-grid {
        grid-template-columns: 1fr;
      }

      .shop-layout {
        grid-template-columns: 1fr;
      }

      .pdp {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .cart-layout {
        grid-template-columns: 1fr;
      }

      .checkout-layout {
        grid-template-columns: 1fr;
      }

      .reels-grid {
        grid-template-columns: 1fr 1fr;
      }

      .about-grid {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .stats-strip {
        grid-template-columns: 1fr 1fr;
        padding: 32px;
      }

      .contact-layout {
        grid-template-columns: 1fr;
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 36px;
      }

      footer {
        padding: 48px 24px 32px;
      }
    }
  </style>
</head>


<!-- ============================================================
     SHARED NAV (paste in every page <body>)
     ============================================================ -->

<body>
  <nav>
    <a href="index.html" class="nav-logo">Garden <span>Basket</span> Hub</a>
    <ul class="nav-links">
      <li><a href="shop.html">Shop</a></li>
      <li><a href="reels.html">Reels</a></li>
      <li><a href="about.html">Our Story</a></li>
      <li><a href="cart.html">Cart (2)</a></li>
      <li><a href="contact.html" class="nav-cta">Get in Touch</a></li>
    </ul>
  </nav>


  <!-- ============================================================
     PAGE 1 — SHOP / ALL PRODUCTS (shop.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="index.html">Home</a> · Shop</p>
    <h1>The whole <em>garden</em>, in one place.</h1>
    <p>Filter by category, season, or what you're growing. Fresh seedlings ship same-day in Jaipur.</p>
  </section>

  <section>
    <div class="shop-layout">
      <aside class="filter-sidebar">
        <h4>Category</h4>
        <label><input type="checkbox" checked> Seeds</label>
        <label><input type="checkbox"> Seedlings (Jaipur)</label>
        <label><input type="checkbox"> Compost & Soil</label>
        <label><input type="checkbox"> Tools</label>
        <label><input type="checkbox"> Gardening Machines</label>
        <label><input type="checkbox"> Pots & Planters</label>

        <h4>Season</h4>
        <label><input type="checkbox"> Monsoon</label>
        <label><input type="checkbox"> Winter</label>
        <label><input type="checkbox"> Summer</label>
        <label><input type="checkbox"> All Year</label>

        <h4>Price Range</h4>
        <div class="price-input">
          <input type="number" placeholder="Min ₹">
          <input type="number" placeholder="Max ₹">
        </div>

        <h4>Delivery</h4>
        <label><input type="checkbox"> Same-Day Jaipur</label>
        <label><input type="checkbox"> Pan India</label>
        <label><input type="checkbox"> COD Available</label>
      </aside>

      <div>
        <div class="shop-toolbar">
          <span class="results">Showing 24 products</span>
          <select>
            <option>Sort: Featured</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <option>Newest First</option>
            <option>Best Sellers</option>
          </select>
        </div>

        <div class="product-grid">
          <!-- repeat 6-12 product cards here -->
          <div class="product-card">
            <div class="product-img">🌱 <span class="badge-jaipur">Jaipur Only</span></div>
            <div class="product-body">
              <div class="product-category">Seedlings</div>
              <div class="product-name">Tomato Seedling Tray</div>
              <div class="product-desc">6 healthy seedlings, 3 weeks old. Same-day delivery in Jaipur.</div>
              <div class="product-footer">
                <div class="product-price">₹199 <small>/ tray</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌿 <span class="badge-new">New</span></div>
            <div class="product-body">
              <div class="product-category">Seeds</div>
              <div class="product-name">Monsoon Veg Seed Kit</div>
              <div class="product-desc">8 heirloom varieties, perfect for monsoon planting.</div>
              <div class="product-footer">
                <div class="product-price">₹349 <small>/ kit</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🪴 <span class="badge-hot">Bestseller</span></div>
            <div class="product-body">
              <div class="product-category">Compost</div>
              <div class="product-name">Organic Vermicompost 5kg</div>
              <div class="product-desc">Premium quality, ideal for terrace & balcony gardens.</div>
              <div class="product-footer">
                <div class="product-price">₹299 <small>/ 5kg</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌸 <span class="badge-jaipur">Jaipur Only</span></div>
            <div class="product-body">
              <div class="product-category">Seedlings</div>
              <div class="product-name">Marigold Sapling Pack</div>
              <div class="product-desc">Fresh flowering saplings, ready to transplant.</div>
              <div class="product-footer">
                <div class="product-price">₹149 <small>/ pack of 4</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🛠️</div>
            <div class="product-body">
              <div class="product-category">Tools</div>
              <div class="product-name">Gardening Tool Set</div>
              <div class="product-desc">5-piece essential kit — trowel, fork, pruner, gloves & more.</div>
              <div class="product-footer">
                <div class="product-price">₹599 <small>/ set</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">🌼 <span class="badge-hot">Popular</span></div>
            <div class="product-body">
              <div class="product-category">Bundle</div>
              <div class="product-name">Monsoon Starter Kit</div>
              <div class="product-desc">Seeds + compost + tool — everything to start gardening.</div>
              <div class="product-footer">
                <div class="product-price">₹799 <small>/ kit</small></div>
                <button class="add-btn">Add to bag</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ============================================================
     PAGE 2 — PRODUCT DETAIL (product.html)
     ============================================================ -->
  <section style="padding-top:140px;">
    <div class="pdp">
      <div class="pdp-gallery">
        <div class="pdp-main-img">🌱 <span class="badge-jaipur" style="font-size:0.7rem;">Jaipur Only · Same-Day</span>
        </div>
        <div class="pdp-thumbs">
          <div class="pdp-thumb active">🌱</div>
          <div class="pdp-thumb">🌿</div>
          <div class="pdp-thumb">🪴</div>
          <div class="pdp-thumb">🌾</div>
        </div>
      </div>

      <div class="pdp-info">
        <p class="breadcrumb"><a href="index.html">Home</a> · <a href="shop.html">Shop</a> · Seedlings</p>
        <h1>Tomato Seedling <em>Tray</em></h1>
        <div class="rating">★ ★ ★ ★ ★ <span>(127 reviews)</span></div>
        <div class="price">₹199 <small>per tray of 6 seedlings</small></div>

        <p class="desc">
          Robust, 3-week-old tomato seedlings — pesticide-free, locally grown in our Jaipur nursery. Ready to transplant
          straight into your pots, raised beds or terrace garden. Each tray comes with a hand-written care card.
        </p>

        <div class="pdp-options">
          <div class="opt-row">
            <label>Quantity Tray</label>
            <div class="opt-pills">
              <div class="opt-pill selected">Tray of 6</div>
              <div class="opt-pill">Tray of 12</div>
              <div class="opt-pill">Tray of 24</div>
            </div>
          </div>

          <div class="opt-row">
            <label>Variety</label>
            <div class="opt-pills">
              <div class="opt-pill selected">Cherry Tomato</div>
              <div class="opt-pill">Beefsteak</div>
              <div class="opt-pill">Roma</div>
            </div>
          </div>

          <div class="qty-row">
            <label
              style="font-family:var(--f-mono);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--clay);">Qty</label>
            <div class="qty-stepper">
              <button>−</button>
              <input type="text" value="1">
              <button>+</button>
            </div>
          </div>
        </div>

        <div class="pdp-cta">
          <a href="cart.html" class="btn-primary">Add to Bag</a>
          <button class="btn-secondary">Buy Now</button>
        </div>

        <div class="pincode-check">
          <label>Check delivery in your area</label>
          <div class="row">
            <input type="text" placeholder="Enter your pincode">
            <button>Check</button>
          </div>
        </div>

        <div class="pdp-trust">
          <div class="pdp-trust-item"><span class="ic">🚚</span>Same-day delivery in Jaipur</div>
          <div class="pdp-trust-item"><span class="ic">🌿</span>100% pesticide-free</div>
          <div class="pdp-trust-item"><span class="ic">💬</span>WhatsApp plant support</div>
          <div class="pdp-trust-item"><span class="ic">♻️</span>Zero-plastic packaging</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Related products section -->
  <section style="background:var(--sand);">
    <p class="section-label">You may also like</p>
    <h2 class="section-title">More from this garden</h2>
    <div class="product-grid">
      <div class="product-card">
        <div class="product-img">🌶️</div>
        <div class="product-body">
          <div class="product-category">Seedlings</div>
          <div class="product-name">Chilli Seedling Tray</div>
          <div class="product-desc">Spicy green chilli, 3 weeks old.</div>
          <div class="product-footer">
            <div class="product-price">₹179</div><button class="add-btn">Add to bag</button>
          </div>
        </div>
      </div>
      <div class="product-card">
        <div class="product-img">🪴</div>
        <div class="product-body">
          <div class="product-category">Compost</div>
          <div class="product-name">Premium Potting Mix</div>
          <div class="product-desc">Ready-to-use blend for transplanting.</div>
          <div class="product-footer">
            <div class="product-price">₹249</div><button class="add-btn">Add to bag</button>
          </div>
        </div>
      </div>
      <div class="product-card">
        <div class="product-img">🛠️</div>
        <div class="product-body">
          <div class="product-category">Tools</div>
          <div class="product-name">Mini Trowel & Fork</div>
          <div class="product-desc">Perfect for transplanting seedlings.</div>
          <div class="product-footer">
            <div class="product-price">₹199</div><button class="add-btn">Add to bag</button>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ============================================================
     PAGE 3 — CART (cart.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="index.html">Home</a> · Your Bag</p>
    <h1>Your <em>garden bag</em></h1>
    <p>Review your seedlings and supplies before checkout.</p>
  </section>

  <section>
    <div class="cart-layout">
      <div class="cart-table">
        <div class="cart-row">
          <div class="cart-thumb">🌱</div>
          <div class="cart-info">
            <h4>Tomato Seedling Tray</h4>
            <div class="meta">Cherry · Tray of 6 · Jaipur Only</div>
            <div class="price">₹199</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="1"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>

        <div class="cart-row">
          <div class="cart-thumb">🌿</div>
          <div class="cart-info">
            <h4>Monsoon Veg Seed Kit</h4>
            <div class="meta">8 Varieties · Pan India</div>
            <div class="price">₹349</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="2"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>

        <div class="cart-row">
          <div class="cart-thumb">🪴</div>
          <div class="cart-info">
            <h4>Organic Vermicompost</h4>
            <div class="meta">5 kg pack · Jaipur Delivery</div>
            <div class="price">₹299</div>
          </div>
          <div class="cart-actions">
            <div class="qty-stepper">
              <button>−</button><input type="text" value="1"><button>+</button>
            </div>
            <button class="remove">Remove</button>
          </div>
        </div>
      </div>

      <aside class="cart-summary">
        <h3>Order Summary</h3>
        <div class="row"><span>Subtotal (4 items)</span><span>₹1,196</span></div>
        <div class="row"><span>Same-day Jaipur delivery</span><span>₹49</span></div>
        <div class="row"><span>Discount (MONSOON10)</span><span style="color:var(--leaf);">−₹120</span></div>

        <div class="coupon">
          <input type="text" placeholder="Coupon code">
          <button>Apply</button>
        </div>

        <div class="row total"><span>Total</span><span>₹1,125</span></div>

        <a href="checkout.html" class="btn-primary checkout-btn">Proceed to Checkout</a>
        <p
          style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);text-align:center;margin-top:16px;letter-spacing:0.06em;">
          ✦ Free shipping pan India above ₹799</p>
      </aside>
    </div>
  </section>


  <!-- ============================================================
     PAGE 4 — CHECKOUT (checkout.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="cart.html">Bag</a> · Checkout</p>
    <h1>Almost in the <em>soil</em>.</h1>
    <p>Just a few details and your garden will be on its way.</p>
  </section>

  <section>
    <div class="checkout-layout">
      <div class="checkout-form">
        <div class="step">
          <h3><span class="num">1</span> Contact</h3>
          <div class="form-grid">
            <div class="form-group full"><label>Email</label><input type="email" placeholder="you@email.com"></div>
            <div class="form-group full"><label>Phone (WhatsApp)</label><input type="tel" placeholder="+91 9876543210">
            </div>
          </div>
        </div>

        <div class="step">
          <h3><span class="num">2</span> Delivery Address</h3>
          <div class="form-grid">
            <div class="form-group"><label>First Name</label><input type="text"></div>
            <div class="form-group"><label>Last Name</label><input type="text"></div>
            <div class="form-group full"><label>Street Address</label><input type="text"
                placeholder="House no., street, area"></div>
            <div class="form-group full"><label>Landmark (optional)</label><input type="text"></div>
            <div class="form-group"><label>City</label><input type="text" value="Jaipur"></div>
            <div class="form-group"><label>Pincode</label><input type="text" value="302001"></div>
            <div class="form-group full">
              <label>Delivery Slot (Jaipur only)</label>
              <select>
                <option>Today · 4 PM – 7 PM</option>
                <option>Today · 7 PM – 9 PM</option>
                <option>Tomorrow Morning · 9 AM – 12 PM</option>
              </select>
            </div>
          </div>
        </div>

        <div class="step">
          <h3><span class="num">3</span> Payment</h3>
          <div class="pay-option selected">
            <span class="ic">📱</span>
            <div>
              <div class="label">UPI / Razorpay</div>
              <div class="sub">Pay via any UPI app, cards or net banking</div>
            </div>
          </div>
          <div class="pay-option">
            <span class="ic">💵</span>
            <div>
              <div class="label">Cash on Delivery</div>
              <div class="sub">Available within Jaipur only</div>
            </div>
          </div>
          <div class="pay-option">
            <span class="ic">💳</span>
            <div>
              <div class="label">Partial COD</div>
              <div class="sub">Pay ₹100 advance, rest on delivery</div>
            </div>
          </div>
        </div>

        <a href="#" class="btn-primary" style="width:100%;text-align:center;padding:18px;">Place Order · ₹1,125</a>
      </div>

      <aside class="cart-summary">
        <h3>Your Order</h3>
        <div class="row"><span>Tomato Seedling Tray × 1</span><span>₹199</span></div>
        <div class="row"><span>Monsoon Veg Seed Kit × 2</span><span>₹698</span></div>
        <div class="row"><span>Vermicompost × 1</span><span>₹299</span></div>
        <div class="row"><span>Jaipur Delivery</span><span>₹49</span></div>
        <div class="row"><span>Discount</span><span style="color:var(--leaf);">−₹120</span></div>
        <div class="row total"><span>Total</span><span>₹1,125</span></div>
        <p
          style="font-family:var(--f-mono);font-size:0.7rem;color:var(--clay);margin-top:16px;letter-spacing:0.06em;text-align:center;">
          🔒 Secure payment · 100% protected</p>
      </aside>
    </div>
  </section>


  <!-- ============================================================
     PAGE 5 — ABOUT / OUR STORY (about.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="index.html">Home</a> · Our Story</p>
    <h1>Rooted in <em>Jaipur</em>, growing happiness.</h1>
    <p>A small gardening shop with big dreams — and a love for fresh seedlings, organic seeds and the people who plant
      them.</p>
  </section>

  <section>
    <div class="about-grid">
      <div class="about-visual">🌱</div>
      <div class="about-text">
        <h2>How it all <em>started</em></h2>
        <p>What began as a small nursery in Jaipur — selling seeds and saplings to neighbours — grew slowly into the
          Garden Basket Hub you see today.</p>
        <p>We noticed something simple: people wanted to grow their own food but didn't know where to start. So we built
          a shop that helps gardeners at every level — from the curious beginner with a balcony, to the experienced
          grower with a full terrace garden.</p>
      </div>
    </div>

    <div class="about-grid reverse">
      <div class="about-visual green">🌿</div>
      <div class="about-text">
        <h2>What makes us <em>different</em></h2>
        <p>We don't sell what we don't grow or use ourselves. Every seed packet, every seedling, every tool is something
          we've tested in our own gardens.</p>
        <p>Our seedlings are delivered the same day in Jaipur because plants don't belong in a warehouse for days. Our
          seeds and tools ship across India for everyone else.</p>
      </div>
    </div>

    <div class="about-grid">
      <div class="about-visual">🤝</div>
      <div class="about-text">
        <h2>Built for the <em>community</em></h2>
        <p>We answer plant questions on WhatsApp every day — because growing should be fun, not frustrating.</p>
        <p>Our compost comes from local Jaipur sources. Our pottery is made by local artisans. Our delivery partners are
          local riders. When you buy from Garden Basket Hub, you're supporting an entire ecosystem of growers.</p>
      </div>
    </div>

    <div class="stats-strip">
      <div class="stat">
        <div class="stat-num">5,000+</div>
        <div class="stat-label">Happy Gardeners</div>
      </div>
      <div class="stat">
        <div class="stat-num">120+</div>
        <div class="stat-label">Seed Varieties</div>
      </div>
      <div class="stat">
        <div class="stat-num">60+</div>
        <div class="stat-label">Fresh Seedlings</div>
      </div>
      <div class="stat">
        <div class="stat-num">Same-Day</div>
        <div class="stat-label">Jaipur Delivery</div>
      </div>
    </div>
  </section>


  <!-- ============================================================
     PAGE 6 — REELS / GALLERY (reels.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="index.html">Home</a> · Reels</p>
    <h1>Watch the <em>garden</em> grow.</h1>
    <p>Trending reels from our nursery, customer gardens, and quick gardening tips you can use today.</p>
  </section>

  <section>
    <div class="reel-filters">
      <div class="reel-pill active">All Reels</div>
      <div class="reel-pill">🌱 Seedling Care</div>
      <div class="reel-pill">🥬 Monsoon Veg</div>
      <div class="reel-pill">🪴 Customer Gardens</div>
      <div class="reel-pill">🛠️ Tool Demos</div>
      <div class="reel-pill">🌿 Composting</div>
    </div>

    <div class="reels-grid">
      <div class="reel-card r1">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Monsoon gardening tips</h4><span>2.4K views</span>
        </div>
      </div>
      <div class="reel-card r2">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>How to repot your plant</h4><span>3.1K views</span>
        </div>
      </div>
      <div class="reel-card r3">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Terracotta pots from Jaipur</h4><span>1.8K views</span>
        </div>
      </div>
      <div class="reel-card r4">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Seed saving 101</h4><span>5.2K views</span>
        </div>
      </div>
      <div class="reel-card r5">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Customer garden tour</h4><span>2.9K views</span>
        </div>
      </div>
      <div class="reel-card r6">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Composting at home</h4><span>4.1K views</span>
        </div>
      </div>
      <div class="reel-card r7">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Why your seedlings die</h4><span>6.7K views</span>
        </div>
      </div>
      <div class="reel-card r8">
        <div class="play">▶️</div>
        <div class="meta">
          <h4>Best monsoon vegetables</h4><span>3.5K views</span>
        </div>
      </div>
    </div>

    <div style="text-align:center;margin-top:48px;">
      <a href="#" class="btn-primary">Load More Reels</a>
    </div>
  </section>


  <!-- ============================================================
     PAGE 7 — CONTACT (contact.html)
     ============================================================ -->
  <section class="page-hero">
    <p class="breadcrumb"><a href="index.html">Home</a> · Contact</p>
    <h1>Say <em>hello</em>.</h1>
    <p>Plant questions, wholesale orders, partnerships or just gardening chats — we're here for it.</p>
  </section>

  <section>
    <div class="contact-layout">
      <div class="contact-info">
        <h2>Visit the garden</h2>
        <p>Our nursery is open every day except Tuesdays. Come say hi, pet the shop cat, and pick your seedlings in
          person.</p>

        <div class="contact-row">
          <span class="ic">📍</span>
          <div><strong>Nursery</strong><span>Jaipur, Rajasthan · 302001</span></div>
        </div>
        <div class="contact-row">
          <span class="ic">💬</span>
          <div><strong>WhatsApp</strong><span>+91 98765 43210</span></div>
        </div>
        <div class="contact-row">
          <span class="ic">📧</span>
          <div><strong>Email</strong><span>hello@gardenbaskethub.in</span></div>
        </div>
        <div class="contact-row">
          <span class="ic">📷</span>
          <div><strong>Instagram</strong><span>@gardenbaskethub</span></div>
        </div>
        <div class="contact-row">
          <span class="ic">🕒</span>
          <div><strong>Hours</strong><span>Wed – Mon · 9 AM to 7 PM</span></div>
        </div>
      </div>

      <form class="contact-form">
        <div class="form-group">
          <label>Your Name</label>
          <input type="text" placeholder="What should we call you?">
        </div>
        <div class="form-group">
          <label>Email or WhatsApp</label>
          <input type="text" placeholder="So we can reply">
        </div>
        <div class="form-group">
          <label>Topic</label>
          <select>
            <option>Plant question</option>
            <option>Order issue</option>
            <option>Wholesale enquiry</option>
            <option>Partnership / collab</option>
            <option>Something else</option>
          </select>
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea placeholder="Tell us about your garden..."></textarea>
        </div>
        <button type="button" class="btn-primary" style="width:100%;padding:16px;">Send Message</button>
      </form>
    </div>
  </section>


  <!-- ============================================================
     SHARED FOOTER (paste in every page)
     ============================================================ -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <a href="index.html" class="nav-logo" style="color:var(--sand)">Garden <span>Basket</span> Hub</a>
        <p>Rooted in Jaipur. Growing things — and the community around them — one seed at a time.</p>
      </div>
      <div class="footer-col">
        <h4>Shop</h4>
        <ul>
          <li><a href="shop.html">Seeds</a></li>
          <li><a href="shop.html">Seedlings</a></li>
          <li><a href="shop.html">Compost & Soil</a></li>
          <li><a href="shop.html">Tools & Machines</a></li>
          <li><a href="shop.html">Bundles</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Info</h4>
        <ul>
          <li><a href="about.html">Our Story</a></li>
          <li><a href="#">Shipping Policy</a></li>
          <li><a href="#">Returns</a></li>
          <li><a href="#">Plant Care Guides</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li><a href="#">WhatsApp Us</a></li>
          <li><a href="#">Instagram DM</a></li>
          <li><a href="mailto:hello@gardenbaskethub.in">hello@gardenbaskethub.in</a></li>
          <li><a href="#">Jaipur, Rajasthan</a></li>
          <li><a href="#">Wholesale</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>©️ 2026 Garden Basket Hub. All rights reserved. · Made in Jaipur with 🌿</p>
      <div class="footer-socials">
        <a href="#" title="Instagram">📷</a>
        <a href="#" title="WhatsApp">💬</a>
        <a href="#" title="YouTube">▶️</a>
      </div>
    </div>
  </footer>

</body>

</html>