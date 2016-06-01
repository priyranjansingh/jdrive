$(function() {
    var $form = $('#payment-form');
    $form.submit(function(event) {
        // Disable the submit button to prevent repeated clicks:
        $form.find('.submit').prop('disabled', true);

        // Request a token from Stripe:
        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from being submitted:
        return false;
    });
});

function stripeResponseHandler(status, response) {
    // Grab the form:
    var $form = $('#payment-form');

    if (response.error) { // Problem!

        // Show the errors on the form:
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.submit').prop('disabled', false); // Re-enable submission

    } else { // Token was created!

        // Get the token ID:
        var token = response.id;

        // Insert the token ID into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken">').val(token));

        // Submit the form:
        $form.get(0).submit();
    }
}
;


$(document).ready(function() {
    $(".payment_class").click(function() {
        if ($(this).attr('id') == 'credit_card')
        {
            $("#paypal_form").hide();
            $("#credit_card_form").show();
        }
        else if ($(this).attr('id') == 'paypal')
        {
            $("#credit_card_form").hide();
            $("#paypal_form").show();
        }
    })

    $("#paypal_submit").click(function() {
        $.ajax({
            url: base_url + "/home/SaveTransaction",
            method: "POST",
            success: function(data) {
                $("#paypal_hid_frm").submit();
            }
        })
    })


    $("#mysubmit").click(function() {
        var code = $.trim($("#couponcode").val());
        $.ajax({
            url: base_url + "/home/ApplyCouponCode",
            method: "POST",
            dataType: "json",
            data:{'code':code},
            success: function(data) {
               if(data.status == 'failure')
               {
                   $("#coupon_err").html(data.message);
               }
               else if(data.status == 'success')
               {
                   $("input[name='a1']").val(data.amount);
                   $("#coupon_err").html(data.message);
               }    
            }
        })
    })




})