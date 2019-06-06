<?php


namespace VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay;

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
            \VexSoluciones\PlaceToPay\Model\PlaceToPay::class,
            \VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay::class
        );
    }
}
