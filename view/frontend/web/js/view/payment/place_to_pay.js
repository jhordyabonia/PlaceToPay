define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'place_to_pay',
                component: 'VexSoluciones_PlaceToPay/js/view/payment/method-renderer/place_to_pay-method'
            }
        );
        return Component.extend({});
    }
);