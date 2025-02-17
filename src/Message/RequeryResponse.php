<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Ipay88\Enum\ErrorDescription;

class RequeryResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful(): bool
    {
        return $this->data === '00';
    }

    /**
     * Response Message
     *
     * @return string A response message from the payment gateway
     */
    public function getMessage(): string
    {
        if ($this->data === '00') {
            return 'Successful payment';
        }

        $errorDescription = ErrorDescription::tryFromKey($this->data);

        return $errorDescription?->value ?? 'Unknown response: ' . $this->data;
    }

    /**
     * Response code
     *
     * @return mixed A response code from the payment gateway
     */
    public function getCode()
    {
        return $this->data;
    }
}