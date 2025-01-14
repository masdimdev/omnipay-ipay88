<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful(): bool
    {
        return false;
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl(): string
    {
        return 'https://payment.ipay88.com.my/epayment/entry.asp';
    }

    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
