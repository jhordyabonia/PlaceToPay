<?php


namespace AgSoftware\PlaceToPay\Model\ResourceModel;

class PlaceToPay extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('agsoftware_placeToPay', 'payTolLace_id');
    }
}
