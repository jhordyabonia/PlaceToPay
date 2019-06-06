<?php


namespace AgSoftware\PlaceToPay\Model\Data;

use AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface;

class PlaceToPay extends \Magento\Framework\Api\AbstractExtensibleObject implements PlaceToPayInterface
{
 
    /**
     * Get placeToPay_id
     * @return string|null
     */
    public function getPlaceToPayId()
    {
        return $this->_get(self::PAYTOPLACE_ID);
    }

     /**
     * Set placeToPay_id
     * @param string $placeToPay_id
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setPlaceToPayId($placeToPay_id)
    {
        return $this->setData(self::PAYTOPLACE_ID, $placeToPay_id);
    }

    /**
     * Get increment_id
     * @return string|null
     */
    public function getIncrementId()
    {
        return $this->_get(self::INCREMENT_ID);
    }

    /**
     * Set increment_id
     * @param string $incrementId
     * @return \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setIncrementId($incrementId)
    {
        return $this->setData(self::INCREMENT_ID, $incrementId);
    }


    /**
     * Get response
     * @return string|null
     */
    public function getResponse()
    {
        return $this->_get(self::RESPONSE);
    }

    /**
     * Set response
     * @param string $response
     * @return \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setResponse($response)
    {
        return $this->setData(self::RESPONSE, $response);
    }
     /**
     * Get form_data
     * @return string|null
     */
    public function getFormData()
    {
        return $this->_get(self::FORM_DATA);
    }


    /**
     * Set form_data
     * @param string $form_data
     * @return  \AgSoftware\PlaceToPay\Api\Data\PlaceToPayInterface
     */
    public function setFormData($form_data)
    {
        return $this->setData(self::FORM_DATA, $form_data);
    }

}
