import '../../src-utilities/main.js';
import '../../src-utilities/global.js';
import './singleProduct.scss';

(function($) {
    'use strict';

    // 6. Check Pincode Delivery
    $(document).on('click', '.pincode-check button', function(e) {
        e.preventDefault();
        let pincode = $(this).siblings('input').val();

        if (!pincode) {
            window.gbh.showToast('Please enter a pincode', 'error');
            return;
        }

        $.ajax({
            url: gbh_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'gbh_check_pincode',
                pincode: pincode
            },
            success: function(response) {
                if (response.success) {
                    window.gbh.showToast(response.data.message, 'success');
                } else {
                    window.gbh.showToast(response.data.message, 'error');
                }
            }
        });
    });

    // 7. Option Pills Selector (PDP)
    $(document).on('click', '.opt-pill', function() {
        $(this).siblings('.opt-pill').removeClass('selected');
        $(this).addClass('selected');
    });

    // 10. Plant Care Tabs (PDP Accordion)
    $(document).on('click', '.tab-btn', function() {
        let target = $(this).data('tab');
        $('.tab-btn').removeClass('active');
        $('.tab-content').removeClass('active');
        $(this).addClass('active');
        $('#' + target).addClass('active');
    });

    // 11. PDP Image Thumbnail Swap
    $(document).on('click', '.pdp-thumb', function() {
        $('.pdp-thumb').removeClass('active');
        $(this).addClass('active');
        let newSrc = $(this).find('img').attr('src');
        if (newSrc) {
            $('.pdp-main-img img').attr('src', newSrc);
        }
    });

})(jQuery);