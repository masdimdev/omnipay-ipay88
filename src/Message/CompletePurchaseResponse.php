<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Ipay88\Traits\PaymentResponseTrait;

class CompletePurchaseResponse extends AbstractResponse
{
    use PaymentResponseTrait;

    protected string $generatedSignature;

    /**
     * Constructor
     *
     * @param RequestInterface $request the initiating request.
     * @param mixed $data
     */
    public function __construct(RequestInterface $request, $data, $generatedSignature)
    {
        parent::__construct($request, $data);

        $this->generatedSignature = $generatedSignature;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful(): bool
    {
        return (string)($this->data['Status'] ?? '') === '1';
    }

    /**
     * Is the response signature valid?
     *
     * @return boolean
     */
    public function isSignatureValid(): bool
    {
        return (string)($this->data['Signature'] ?? '') === $this->generatedSignature;
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['RefNo'] ?? null;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['TransId'] ?? null;
    }
}
