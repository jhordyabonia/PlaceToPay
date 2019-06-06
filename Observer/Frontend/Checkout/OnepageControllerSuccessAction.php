<?php


namespace AgSoftware\PlaceToPay\Observer\Frontend\Checkout;

class OnepageControllerSuccessAction implements \Magento\Framework\Event\ObserverInterface
{


    private $url;
    private $logger;
    private $responseFactory;
    private $orderModel;
    protected $_checkoutSession;

    /**
     * OnepageControllerSuccessAction constructor.
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Psr\Log\LoggerInterface $logger
    )  {
        $this->remoteAddress = $remoteAddress;
        $this->_storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->_checkoutSession = $checkoutSession; 
        $this->responseFactory = $responseFactory;
        $this->url = $url;
        $this->logger = $logger;
        $this->orderModel = $order;
    }

    public function getConfigData($config_path)
    {
        return $this->scopeConfig->getValue(
            'payment/place_to_pay/'.$config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    private function send($obj){

        $url = $this->getConfigData('url_api');
        if($this->getConfigData('test'))
            $url = "https://test.placetopay.ec/redirection/api/session";

        $data_string = json_encode($obj,JSON_PRETTY_PRINT); 
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        if(!$result){
            echo 'Curl error: ' . curl_error($ch);
            die;
        }
        curl_close($ch);
        return  json_decode($result);
    }
    private function getFrom($order){
        $_obj = '{
            "auth": {
                "login": "6dd490faf9cb87a9862245da41170ff2",
                "seed": "2017-07-24T15:21:10-05:00",
                "nonce": "ZjgzYzNkNzI1MmEwNjRlNzlhZDViOGIyNmQxNjcxZTg=",
                "tranKey": "gUwHkL4tiU+0oCWEiWw0q2uUfwQ="
            },
            "payment": {
                "reference": "0001",
                "description": "Pago basico de prueba",
                "amount": {
                    "currency": "USD",
                    "total": "10000"
                }
            },
            "expiration": "2017-08-01T00:00:00-05:00",
            "returnUrl": "https://dev.placetopay.com/redirection/sandbox/session/0001",
            "ipAddress": "127.0.0.1",
            "userAgent": "PlacetoPay Sandbox"
        }';
        $obj = json_decode($_obj);
        $secretKey = $this->getConfigData('private_key');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        
        $obj->auth->nonce = base64_encode($nonce);
        $obj->auth->login = $this->getConfigData('number_account');
        $obj->auth->seed = date('c');
        $obj->auth->tranKey = base64_encode(sha1($nonce.$obj->auth->seed.$secretKey, true));
        $obj->expiration = date('c', strtotime("+1 hours"));
        
        $obj->payment->reference = $order->getQuoteId();
        $obj->payment->amount = (Object)array("currency"=>$order->getGlobalCurrencyCode(),"total"=>$order->getGrandTotal());
        $obj->returnUrl = $this->_storeManager->getStore()->getBaseUrl()."placetopay/success/?quote_id=".$obj->payment->reference;
        $obj->ipAddress = $this->remoteAddress->getRemoteAddress();
        $obj->userAgent = "PlacetoPay Sandbox";

        return $obj;        
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {        
        try {

            $orderIds = $observer->getEvent()->getOrderIds();
            foreach ($orderIds as $order_id) {
                $order = $this->orderModel->load($order_id);
                if($order->getPayment()->getMethod() == 'place_to_pay') {                   
                    if($order->getStatus()=='pending'){
                        $comment = new \Magento\Framework\Phrase('Awaiting confirmation of Pay To Place');
                        $order->addStatusHistoryComment($comment);
                        $order->setStatus('pending_placeToPay');
                        $order->save();

                        $placeToPayFrom = $this->getFrom($order);
                        $result = $this->send($placeToPayFrom);
                        
                        if($result->status->status == 'OK'){
                            $this->responseFactory->create()->setRedirect($result->processUrl)->sendResponse();        
                            exit();
                        }      
                    }//endif($order->getStatus()=='pending')
                }//endif ($order->getPayment()->getMethod() == 'placeToPay')                   
            }//endforecah
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
        }
    }
}
