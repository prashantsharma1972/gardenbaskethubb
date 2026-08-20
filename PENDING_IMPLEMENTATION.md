# 📌 Garden Basket Hub (`gardenbaskethubb`) — Pending Implementation & Live Launch Roadmap

> **Production Deployment, Payment Gateway, Logistics & Live Service Specification Guide**  
> This document details all pending implementations, third-party integrations (Razorpay & Shiprocket), credentials management, API workflows, live deployment checklists, and client questionnaires required to take the Garden Basket Hub custom theme live on `https://gardenbaskethubb.com`.

---

## 🔐 1. Consolidated Project & Third-Party Credentials

| Service / Platform | Website / Panel URL | Service Type | Username / Identifier | Password / Secret | Notes / Status |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Hosting cPanel** | `https://gardenbaskethubb.com:2083` | cPanel / Server | `gardenbaskethubb` | `#y`3T3k1A4/5KM3<a,J` | Primary Live Web Server & File Manager |
| **WordPress Live Admin** | `https://www.gardenbaskethubb.com/wp-admin/` | CMS Admin | `gardenbaskethubb` | `India1234@` | Production WordPress Dashboard |
| **Razorpay Account** | `https://dashboard.razorpay.com` | Payment Gateway | `prashant753@gmail.com` | `Snow@1230103` | UPI, Cards, Netbanking Payment Engine |
| **Shiprocket Account** | `https://app.shiprocket.in` | Logistics / Delivery | `prashant753@gmail.com` | `Snow@123` | Jaipur Same-Day & Pan-India Couriers |
| **Namecheap** | `https://www.namecheap.com` | Domain Registrar | `gardenbaskethubb` | `Prashant@123` | Domain DNS & Nameserver Management |
| **GitHub** | `https://github.com` | Code Repository | `prashant753@gmail.com` | *[Pending]* | Repository Hosting |

---

## 🚚 2. Shiprocket Logistics & Delivery Integration Architecture

### Team Decision & Scope
- **Finalized Logistics Provider**: **Shiprocket** (Selected over Borzo/Brozo).
- **Coverage**: Handles **BOTH** Pan-India courier shipping AND **Jaipur Same-City / Same-Day Delivery**.
- **Subscription Plan Strategy**: Start on Shiprocket Lite / Standard plan (Monthly 5+ advisory orders tier) and scale to ₹200 plan as order volume grows.

### API Integration Technical Workflow (`functions.php` & `assets/js/main.js`)

1. **Authentication Token Generation**:
   - Endpoint: `POST https://apiv2.shiprocket.in/v1/external/auth/login`
   - Request Payload:
     ```json
     {
       "email": "prashant753@gmail.com",
       "password": "Snow@123"
     }
     ```
   - Response: JWT Bearer Token cached in WP Transient `_gbh_shiprocket_token` for 24 hours.

2. **Order Auto-Creation (`gbh_place_order` AJAX Hook)**:
   - Endpoint: `POST https://apiv2.shiprocket.in/v1/external/orders/create/adhoc`
   - Payload Mapping:
     - `order_id`: WP Order ID from `gbh_order` CPT.
     - `order_date`: ISO timestamp.
     - `pickup_location`: `"Jaipur_Nursery_Main"` (Configured in Shiprocket Dashboard).
     - `billing_customer_name`, `billing_address`, `billing_city`, `billing_pincode`, `billing_state`, `billing_phone`.
     - `shipping_is_billing`: `true`.
     - `order_items`: Array of items mapped from cart (`name`, `sku`, `units`, `selling_price`).
     - `payment_method`: `"Prepaid"` for Razorpay payments or `"COD"` for Cash on Delivery.
     - `sub_total`, `length`, `width`, `height`, `weight` (Calculated from items).
     - For Jaipur Local orders: Includes preferred delivery time slot meta (`Morning 9-12` or `Evening 4-7`).

3. **Post Meta Tracking Fields (`gbh_order`)**:
   - `_shiprocket_order_id`: Shiprocket generated Order ID.
   - `_shiprocket_shipment_id`: Shipment ID.
   - `_shiprocket_awb_code`: AWB Tracking Code.
   - `_shiprocket_courier_name`: Assigned Courier Name (e.g. `Bluedart`, `Delhivery`, `Shiprocket Local`).

---

## 💳 3. Razorpay Payment Gateway Integration Architecture

### Technical Implementation Workflow (`page-checkout.php` & `assets/js/main.js`)

1. **Frontend Razorpay Modal Trigger**:
   - Enqueue Razorpay JS SDK: `https://checkout.razorpay.com/v1/checkout.js`.
   - When customer fills checkout form and chooses **Online Payment (UPI / Card / Net Banking)**:
     - JavaScript initiates Razorpay modal options:
       ```javascript
       var options = {
           "key": RAZORPAY_KEY_ID,
           "amount": totalAmountInPaise, // e.g. 19900 for ₹199
           "currency": "INR",
           "name": "Garden Basket Hub",
           "description": "Order #" + orderTempId,
           "image": siteLogoUrl,
           "handler": function (response){
               // Send response.razorpay_payment_id to server via AJAX
               placeOrderAJAX(response.razorpay_payment_id);
           },
           "prefill": {
               "name": customerName,
               "email": customerEmail,
               "contact": customerPhone
           },
           "theme": {
               "color": "#3A6B35" // var(--leaf)
           }
       };
       var rzp = new Razorpay(options);
       rzp.open();
       ```

2. **Server-Side Payment Signature Verification (`functions.php`)**:
   - Securely verify signature on backend:
     ```php
     $generated_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, $key_secret);
     if ($generated_signature === $razorpay_signature) {
         // Mark gbh_order meta _payment_status = 'Paid'
         // Save _razorpay_payment_id
     }
     ```

3. **Payment Modes Supported**:
   - UPI (GPay, PhonePe, Paytm, BHIM)
   - Credit & Debit Cards (Visa, Mastercard, RuPay)
   - Net Banking (All major Indian banks)
   - Cash on Delivery (COD) / Partial COD (Configurable for Jaipur orders)

---

## ✉️ 4. Order Notifications & Communication Setup

1. **Transactional SMTP Emails**:
   - Configure WP Mail SMTP with cPanel email `hello@gardenbaskethubb.com`.
   - **Customer Email**: HTML Receipt containing itemized table, delivery address, Jaipur time slot, and tracking button.
   - **Admin Email**: Instant notification sent to `hello@gardenbaskethub.in` for every new order.

2. **WhatsApp Buyer Notifications**:
   - Enable Shiprocket's built-in WhatsApp tracking notifications so customers receive automated WhatsApp updates when their package is dispatched and out for delivery.

---

## 🌐 5. Live Server Deployment Roadmap (`gardenbaskethubb.com`)

### Deployment Action Items
- [ ] **Step 1: Code Upload via FTP / cPanel File Manager**:
  - Upload `gardenbaskethubb` theme directory into `/wp-content/themes/`.
- [ ] **Step 2: Theme Activation**:
  - Log into `https://www.gardenbaskethubb.com/wp-admin/` and activate `Garden Basket Hub` theme.
- [ ] **Step 3: Database & Page Initialization**:
  - `gbh_create_required_wp_pages()` will automatically generate WP Pages (`shop`, `reels`, `blog`, `about-us`, `contact-us`, `cart`, `checkout`, `thank-you`, `privacy-policy`, `terms-and-conditions`, `refund-policy`).
- [ ] **Step 4: Seed Initial Content**:
  - `gbh_seed_sample_content()` will auto-seed 6 starter products, 4 reels, and 3 blog guides.
- [ ] **Step 5: Verify Permalinks**:
  - Navigate to WP Admin ➔ Settings ➔ Permalinks and select **Post name** (`/%postname%/`).

---

## ❓ 6. Client Questionnaire & Verification Checklist

Ask/confirm these 4 specific items with the client before executing live activation:

1. **Razorpay Account KYC Verification**:
   - *Question for Client*: *"Is the Razorpay account fully KYC verified for live INR transactions, or should we initiate integration using Razorpay Test Mode first?"*
2. **Shiprocket Pickup Warehouse Address**:
   - *Question for Client*: *"What is the exact Jaipur Nursery Pickup Address & Pincode configured in the Shiprocket Panel for courier pickups?"*
3. **Razorpay Key ID & Key Secret**:
   - *Action for Client*: Client to log into Razorpay Dashboard ➔ Settings ➔ API Keys and provide **Live Key ID** & **Live Key Secret**.
4. **GST Number Requirement**:
   - *Question for Client*: *"Do you need GSTIN numbers printed on customer invoices? If yes, please provide the store GSTIN to configure in Shiprocket profile."*

---

## 📊 7. Implementation Checklist Status

- [x] **Local Theme Development**: 100% Completed (21 PHP files, 0 syntax errors).
- [x] **Documentation & Architecture Mapping**: 100% Completed (`README.md` & `PROGRESS_TRACKER.md`).
- [ ] **Razorpay Payment Gateway Code Integration**: *Pending (Awaiting user command)*.
- [ ] **Shiprocket API Auto-Shipping Code Integration**: *Pending (Awaiting user command)*.
- [ ] **Live Server Deployment (`gardenbaskethubb.com`)**: *Pending (Awaiting user command)*.
