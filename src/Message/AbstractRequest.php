<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($value): AbstractRequest
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value): AbstractRequest
    {
        return $this->setParameter('merchantKey', $value);
    }

    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    public function setUserName($value): AbstractRequest
    {
        return $this->setParameter('userName', $value);
    }

    public function getUserEmail()
    {
        return $this->getParameter('userEmail');
    }

    public function setUserEmail($value): AbstractRequest
    {
        return $this->setParameter('userEmail', $value);
    }

    public function getUserContact()
    {
        return $this->getParameter('userContact');
    }

    public function setUserContact($value): AbstractRequest
    {
        return $this->setParameter('userContact', $value);
    }

    protected function generateSignature($signaturePayload): string
    {
        return hash_hmac('sha512', join('', $signaturePayload), $this->getMerchantKey());
    }
}
