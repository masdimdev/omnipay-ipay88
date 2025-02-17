<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return 'https://payment.ipay88.com.my/epayment/entry.asp';
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     *
     * @return array
     */
    public function getRedirectData()
    {
        return $this->data;
    }
}
