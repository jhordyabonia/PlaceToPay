<?php


namespace AgSoftware\PlaceToPay\Model;

use AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface;
use Magento\Framework\Api\DataObjectHelper;
use AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterfaceFactory;

class PlaceToPay extends \Magento\Framework\Model\AbstractModel
{

    protected $placeToPayDataFactory;

    protected $dataObjectHelper;

    protected $_code = "placeToPay";
    protected $_eventPrefix = 'agsoftware_placeToPay';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PlaceToPayInterfaceFactory $placeToPayDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay $resource
     * @param \AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PlaceToPayInterfaceFactory $placeToPayDataFactory,
        DataObjectHelper $dataObjectHelper,
        \AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay $resource,
        \AgSoftware\PlaceToPay\Model\ResourceModel\PlaceToPay\Collection $resourceCollection,
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



