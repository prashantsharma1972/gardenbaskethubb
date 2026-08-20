<?php
/**
 * Template Name: Privacy Policy
 */

get_header();
?>

<!-- ============================================================
     PRIVACY POLICY HERO
     ============================================================ -->
<section class="page-hero" style="padding:160px 80px 80px;background:linear-gradient(180deg, var(--sand) 0%, var(--white) 100%);text-align:center;">
  <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> · Legal</p>
  <h1 style="font-size:clamp(2.5rem, 4.5vw, 4rem);margin-bottom:20px;">Privacy <em>Policy</em></h1>
  <p style="font-size:1.1rem;max-width:640px;margin:0 auto 32px;color:#5c4436;line-height:1.7;">
    How Garden Basket Hub collects, uses, and protects your personal information.
  </p>
</section>

<!-- ============================================================
     POLICY CONTENT
     ============================================================ -->
<section style="padding:40px 80px 100px;">
  <div style="max-width:800px;margin:0 auto;line-height:1.8;color:#5c4436;">
    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:16px;font-size:1.8rem;">1. Information We Collect</h2>
    <p style="margin-bottom:20px;">
      When you place an order for our seeds or saplings, we collect your name, billing address, shipping address, email, and phone number to fulfill your delivery.
    </p>

    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:16px;font-size:1.8rem;margin-top:40px;">2. Payment Security</h2>
    <p style="margin-bottom:20px;">
      We use Razorpay as our secure payment gateway. We do not store your credit card or UPI details on our servers. All transactions are securely processed and encrypted by Razorpay.
    </p>

    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:16px;font-size:1.8rem;margin-top:40px;">3. Third-Party Logistics</h2>
    <p style="margin-bottom:20px;">
      To deliver your garden supplies, we share your shipping name, address, and phone number with our logistics partner, Shiprocket, and local delivery agents in Jaipur.
    </p>

    <h2 style="font-family:var(--f-display);color:var(--soil);margin-bottom:16px;font-size:1.8rem;margin-top:40px;">4. Contact Us</h2>
    <p style="margin-bottom:20px;">
      For any privacy concerns, you can reach us at privacy@gardenbaskethubb.com.
    </p>
  </div>
</section>

<?php get_footer(); ?>