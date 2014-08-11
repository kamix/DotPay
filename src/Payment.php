<?php

namespace DotPay;

class Payment {
    
    private $dotPayUrl;
    
    private $partnerId;
    
    private $amount;
    
    private $description;
    
    private $currency;
    
    private $payerName;
    
    private $payerSurname;
    
    private $payerEmail;
    
    private $successUrl;
    
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
    
    public function setPayerSurname($payerSurname) {
        $this->payerSurname = $payerSurname;
        
        return $this;
    }
    
    public function setPayerEmail($payerEmail) {
        $this->payerEmail = $payerEmail;
        
        return $this;
    }
    
    /**
     * 
     * @param string $url
     * @return \DotPay\Payment
     */
    public function setSuccessUrl($url) {
        $this->successUrl = $url;
        
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
        
        if ($this->description !== null) {
            $baseUrl .= '&opis="' . $this->description . '"';
        }
        
        if ($this->payerName !== null) {
            $baseUrl .= '&imie="' . $this->payerName . '"';
        }
        
        if ($this->payerSurname !== null) {
            $baseUrl .= '&nazwisko="' . $this->payerSurname . '"';
        }
        
        if ($this->payerEmail !== null) {
            $baseUrl .= '&email="' . $this->payerEmail . '"';
        }
        
        if ($this->successUrl !== null) {
            $baseUrl .= '&urlc="' . $this->successUrl . '"';
        }
        
        return $baseUrl;
    }
}
