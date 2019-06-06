<?php


namespace AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \AgSoftware\PlaceToPay\Model\PlaceToPay::class,
            \AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay::class
        );
    }
}
