<?php


namespace AgSoftware\PlaceToPay\Api\Data;

interface PlaceToPayInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const PAYTOPLACE_ID = 'payToPlace_id';
    const FORM_DAT = 'form_data';
    const RESPONSE = 'response';
    const INCREMENT_ID = 'increment_id';

    /**
     * Get payToPlace_id
     * @return string|null
     */
    public function getPlaceToPayId();

    /**
     * Set payToPlace_id
     * @param string $payToPlace_id
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setPlaceToPayId($payToPlace_id);

    /**
     * Get increment_id
     * @return string|null
     */
    public function getIncrementId();

    /**
     * Set increment_id
     * @param string $incrementId
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setIncrementId($incrementId);

    /**
     * Get response
     * @return string|null
     */
    public function getResponse();

    /**
     * Set response
     * @param string $response
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setResponse($form_data);

    /**
     * Get form_data
     * @return string|null
     */
    public function getFormData();

    /**
     * Set form_data
     * @param string $form_data
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setFormData($form_data);
    
}
