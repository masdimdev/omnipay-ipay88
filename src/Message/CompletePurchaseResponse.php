<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    protected string $generatedSignature;

    public function __construct(RequestInterface $request, $data, $generatedSignature)
    {
        parent::__construct($request, $data);

        $this->generatedSignature = $generatedSignature;
    }

    public function isSuccessful(): bool
    {
        return (string)($this->data['Status'] ?? '') === '1';
    }

    public function isSignatureValid(): bool
    {
        return (string)($this->data['Signature'] ?? '') === $this->generatedSignature;
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
