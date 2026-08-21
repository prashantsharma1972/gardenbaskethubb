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

        $btn.prop('disabled', true).text('Processing Order...');

        let processFinalOrderPlacement = function(extraFields) {
            let formData = $form.serializeArray();
            formData.push({ name: 'action', value: 'gbh_place_order' });
            formData.push({ name: 'nonce', value: gbh_ajax_obj.nonce });
            if (extraFields && Array.isArray(extraFields)) {

                extraFields.forEach(function(f) { formData.push(f); });
            }

            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: $.param(formData),
                success: function(response) {
                    if (response.success) {
                        window.gbh.showToast(response.data.message, 'success');
                        setTimeout(function() {
                            window.location.href = response.data.redirect_url;
                        }, 1000);
                    } else {
                        $btn.prop('disabled', false).text('Place Order');
                        window.gbh.showToast(response.data.message, 'error');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Place Order');
                    window.gbh.showToast('Order processing failed. Please try again.', 'error');
                }
            });
        };

        // If Online Payment (Razorpay / UPI), launch Razorpay Checkout Popup
        if (paymentMethod.indexOf('Razorpay') !== -1 || paymentMethod.indexOf('UPI') !== -1 || paymentMethod.indexOf('Partial') !== -1) {
            $.ajax({
                url: gbh_ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'gbh_create_razorpay_order',
                    nonce: gbh_ajax_obj.nonce
                },
                success: function(res) {
                    if (res.success && typeof Razorpay !== 'undefined') {
                        let options = {
                            "key": res.data.key_id,
                            "amount": res.data.amount,
                            "currency": "INR",
                            "name": "Garden Basket Hub",
                            "description": "Nursery Plants & Supplies Order",
                            "handler": function (response){
                                processFinalOrderPlacement([
                                    { name: 'razorpay_payment_id', value: response.razorpay_payment_id },
                                    { name: 'razorpay_order_id', value: response.razorpay_order_id }
                                ]);
                            },
                            "prefill": {
                                "name": $form.find('input[name="first_name"]').val() + ' ' + $form.find('input[name="last_name"]').val(),
                                "email": $form.find('input[name="email"]').val(),
                                "contact": $form.find('input[name="phone"]').val()
                            },
                            "theme": { "color": "#3A6B35" },
                            "modal": {
                                "ondismiss": function() {
                                    $btn.prop('disabled', false).text('Place Order');
                                    window.gbh.showToast('Payment window closed. Order not placed.', 'warning');
                                }
                            }
                        };
                        let rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        // Fallback if Razorpay SDK or Keys not present
                        processFinalOrderPlacement([]);
                    }
                },
                error: function() {
                    processFinalOrderPlacement([]);
                }
            });
        } else {
            // COD / Direct Order Placement
            processFinalOrderPlacement([]);
        }
    });

})(jQuery);