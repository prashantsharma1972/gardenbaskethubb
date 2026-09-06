import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './checkout.scss';

(function($) {
    'use strict';

    // 8. Payment Method Selection (Checkout)
    $(document).on('click', '.pay-option', function() {
        $('.pay-option').removeClass('selected');
        $(this).addClass('selected');
        let method = $(this).find('.label').text().trim();
        $('#payment_method_input').val(method);
    });

    // 9. Checkout Form Submission with Razorpay Modal Integration
    $(document).on('submit', '#gbh-checkout-form', function(e) {
        e.preventDefault();
        let $form = $(this);
        let $btn = $form.find('button[type="submit"], .btn-place-order');
        let paymentMethod = $('#payment_method_input').val() || 'UPI / Razorpay';

        console.log('[GBH Checkout] Initiating checkout submission. Selected Payment Method:', paymentMethod);

        $btn.prop('disabled', true).text('Processing Order...');

        let processFinalOrderPlacement = function(extraFields) {
            let formData = $form.serializeArray();
            formData.push({ name: 'action', value: 'gbh_place_order' });
            formData.push({ name: 'nonce', value: gbh_ajax_obj.nonce });
            if (extraFields && Array.isArray(extraFields)) {
                extraFields.forEach(function(f) { formData.push(f); });
            }

            console.log('[GBH Checkout] Submitting order payload to backend...', formData);

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: $.param(formData),
                success: function(response) {
                    console.log('[GBH Checkout] Backend order response:', response);
                    if (response.success) {
                        window.gbh.showToast(response.data.message || 'Order placed successfully!', 'success');
                        setTimeout(function() {
                            window.location.href = response.data.redirect_url;
                        }, 1000);
                    } else {
                        $btn.prop('disabled', false).text('Place Order');
                        let errMsg = (response.data && response.data.message) ? response.data.message : 'Order processing failed. Please try again.';
                        console.error('[GBH Checkout] Order creation rejected:', errMsg);
                        window.gbh.showToast(errMsg, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('[GBH Checkout] Order AJAX network/server error:', error, xhr.responseText);
                    $btn.prop('disabled', false).text('Place Order');
                    window.gbh.showToast('Order processing failed due to server connection error. Please try again.', 'error');
                }
            });
        };

        // If Online Payment (Razorpay / UPI), launch Razorpay Checkout Popup
        if (paymentMethod.indexOf('Razorpay') !== -1 || paymentMethod.indexOf('UPI') !== -1 || paymentMethod.indexOf('Partial') !== -1) {
            let customerEmail = $form.find('input[name="email"]').val();
            console.log('[GBH Checkout] Requesting Razorpay Order ID for customer:', customerEmail);

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_create_razorpay_order',
                    nonce: gbh_ajax_obj.nonce,
                    email: customerEmail
                },
                success: function(res) {
                    console.log('[GBH Checkout] Razorpay order creation response:', res);
                    if (res.success && typeof Razorpay !== 'undefined') {
                        let options = {
                            "key": res.data.key_id,
                            "order_id": res.data.razorpay_order_id,
                            "amount": res.data.amount,
                            "currency": "INR",
                            "name": "Garden Basket Hub",
                            "description": res.data.is_tester ? "🌱 GBH Test Order · ₹1 Verification" : "Nursery Plants & Supplies Order",
                            "handler": function (response){
                                console.log('[GBH Checkout] Razorpay payment successful! Details:', response);
                                processFinalOrderPlacement([
                                    { name: 'razorpay_payment_id', value: response.razorpay_payment_id },
                                    { name: 'razorpay_order_id', value: response.razorpay_order_id || res.data.razorpay_order_id },
                                    { name: 'razorpay_signature', value: response.razorpay_signature || '' }
                                ]);
                            },
                            "prefill": {
                                "name": $form.find('input[name="first_name"]').val() + ' ' + $form.find('input[name="last_name"]').val(),
                                "email": customerEmail,
                                "contact": $form.find('input[name="phone"]').val()
                            },
                            "theme": { "color": "#3A6B35" },
                            "modal": {
                                "ondismiss": function() {
                                    console.warn('[GBH Checkout] Razorpay payment modal closed by user.');
                                    $btn.prop('disabled', false).text('Place Order');
                                    window.gbh.showToast('Payment window closed. Order was not placed.', 'warning');
                                }
                            }
                        };

                        let rzp1 = new Razorpay(options);

                        // Official Razorpay Payment Failure Event Listener
                        rzp1.on('payment.failed', function(failureResponse) {
                            console.error('[GBH Checkout] Razorpay payment failed:', failureResponse.error);
                            $btn.prop('disabled', false).text('Place Order');
                            let failureReason = (failureResponse.error && failureResponse.error.description) 
                                ? failureResponse.error.description 
                                : 'Payment failed. Please try again with another UPI app or card.';
                            window.gbh.showToast('Payment Failed: ' + failureReason, 'error');
                        });

                        rzp1.open();
                    } else {
                        $btn.prop('disabled', false).text('Place Order');
                        let errMsg = (res.data && res.data.message) ? res.data.message : 'Unable to initiate payment gateway. Please try again or choose COD.';
                        console.error('[GBH Checkout] Razorpay initialization failed:', errMsg);
                        window.gbh.showToast(errMsg, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('[GBH Checkout] Razorpay gateway AJAX connection failed:', error, xhr.responseText);
                    $btn.prop('disabled', false).text('Place Order');
                    window.gbh.showToast('Payment server connection failed. Please try again.', 'error');
                }
            });
        } else {
            // COD / Direct Order Placement
            console.log('[GBH Checkout] Processing Cash on Delivery order.');
            processFinalOrderPlacement([]);
        }
    });

})(jQuery);