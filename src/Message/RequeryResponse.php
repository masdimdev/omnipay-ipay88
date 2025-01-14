<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;

class RequeryResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return $this->data === '00';
    }

    public function getMessage(): string
    {
        return match ($this->data) {
            '00' => 'Successful payment',
            'Invalid parameters' => 'Parameters passed are incorrect',
            'Record not found' => 'Record not found',
            'Incorrect amount' => 'Incorrect amount',
            'Payment fail' => 'Payment failed',
            'M88Admin' => 'Payment status updated by iPay88 Admin (Failed)',
            default => 'Unknown response: ' . $this->data,
        };
    }

    public function getCode()
    {
        return $this->data;
    }
}