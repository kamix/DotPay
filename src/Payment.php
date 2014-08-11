<?php

namespace DotPay;

class Payment {
    
    private $dotPayUrl;
    
    private $partnerId;
    
    private $amount;
    
    private $description;
    
    private $currency;
    
    public function __construct($dotPayUrl = "https://ssl.dotpay.pl/pay.php") {
        $this->dotPayUrl = $dotPayUrl;
    }
    
    /**
     * 
     * @param int $id
     * @return \DotPay\Payment
     */
    public function setPartnerId($id) {
        $this->partnerId = $id;
        
        return $this;
    }
    
    /**
     * 
     * @param float $amount
     * @return \DotPay\Payment
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        
        return $this;
    }
    
    /**
     * 
     * @param type $currency
     * @return \DotPay\Payment
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        
        return $this;
    }
    
    /**
     * 
     * @param string $description
     * @return \DotPay\Payment
     */
    public function setPaymentDescription($description) {
        
        if (255 < strlen($description)) {
            throw new \LengthException("Description has to be shorter than 255 characters");
        }
        
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * 
     * @param type $payerName
     * @return \DotPay\Payment
     */
    public function setPayerName($payerName) {
        $this->payerName = $payerName;
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function generateUrl() {
        
        $baseUrl = sprintf("%s?id=%s&kwota=%s&waluta=%s",
                $this->dotPayUrl,
                $this->partnerId,
                $this->amount,
                $this->currency);
        
        return $baseUrl;
    }
}
