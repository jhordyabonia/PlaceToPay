<?php


namespace VexSoluciones\PlaceToPay\Model;

use VexSoluciones\PlaceToPay\Api\Data\PlaceToPayInterface;
use Magento\Framework\Api\DataObjectHelper;
use VexSoluciones\PlaceToPay\Api\Data\PlaceToPayInterfaceFactory;

class PlaceToPay extends \Magento\Framework\Model\AbstractModel
{

    protected $placeToPayDataFactory;

    protected $dataObjectHelper;

    protected $_code = "placeToPay";
    protected $_eventPrefix = 'vexsoluciones_placeToPay';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PlaceToPayInterfaceFactory $placeToPayDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay $resource
     * @param \VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PlaceToPayInterfaceFactory $placeToPayDataFactory,
        DataObjectHelper $dataObjectHelper,
        \VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay $resource,
        \VexSoluciones\PlaceToPay\Model\ResourceModel\PlaceToPay\Collection $resourceCollection,
        array $data = []
    ) {
        $this->placeToPayDataFactory = $placeToPayDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getAccountPlaceToPay(){
        return $this->getConfigData('number_account');
    }
    /**
     * Retrieve PlaceToPay model with tucompra data
     * @return PlaceToPayInterface
     */
    public function getDataModel()
    {
        $placeToPayData = $this->getData();
        
        $placeToPayDataObject = $this->placeToPayDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $placeToPayDataObject,
            $placeToPayData,
            PlaceToPayInterface::class
        );
        
        return $placeToPayDataObject;
    }
 
}



