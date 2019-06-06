<?php


namespace VexSoluciones\PlaceToPay\Block;
use \Datetime;
use \Datetimezone;

class Popup extends \Magento\Framework\View\Element\Template
{
    protected $_checkoutSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }
    function getIdCart(){
        return $this->_checkoutSession->getQuoteId(); 
        //return 75;
    }

}
