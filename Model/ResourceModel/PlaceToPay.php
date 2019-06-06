<?php


namespace VexSoluciones\PlaceToPay\Model\ResourceModel;

class PlaceToPay extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('vexsoluciones_placeToPay', 'payTolLace_id');
    }
}
