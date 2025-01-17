<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;

class RequeryPaymentResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return (string)($this->data['Status'] ?? '') === '1';
    }

    public function getTransactionId()
    {
        return $this->data['RefNo'] ?? null;
    }

    public function getTransactionReference()
    {
        return $this->data['TransId'] ?? null;
    }
}