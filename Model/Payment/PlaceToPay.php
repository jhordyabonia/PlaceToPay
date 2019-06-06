<?php


namespace AgSoftware\PlaceToPay\Model\Payment;

class PlaceToPay extends \Magento\Payment\Model\Method\AbstractMethod
{

    protected $_code = "place_to_pay";
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
        return parent::isAvailable($quote);
    }
}
