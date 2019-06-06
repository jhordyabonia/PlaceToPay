define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'AgSoftware_PlaceToPay/payment/place_to_pay'
            },
            getMailingAddress: function () {
                return window.checkoutConfig.payment.checkmo.mailingAddress;
            },
            getInstructions: function () {
                //return window.checkoutConfig.payment.instructions[this.item.method];
            },
        });
    }
);
