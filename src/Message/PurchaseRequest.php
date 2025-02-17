<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'merchantKey',
            'merchantCode',
            'transactionId',
            'amount',
            'currency',
            'description',
            'userName',
            'userEmail',
            'userContact',
            'returnUrl',
            'notifyUrl',
        );

        return [
            'MerchantCode' => $this->getMerchantCode(),
            'PaymentId' => $this->getPaymentId(),
            'RefNo' => $this->getTransactionId(),
            'Amount' => $this->getAmount(),
            'Currency' => $this->getCurrency(),
            'ProdDesc' => $this->getDescription(),
            'UserName' => $this->getUserName(),
            'UserEmail' => $this->getUserEmail(),
            'UserContact' => $this->getUserContact(),
            'Remark' => $this->getRemark(),
            'Lang' => 'UTF-8',
            'SignatureType' => 'HMACSHA512',
            'Signature' => $this->generateSignature([
                $this->getMerchantKey(),
                $this->getMerchantCode(),
                $this->getTransactionId(),
                preg_replace('/[.,]/', '', $this->getAmount()),
                $this->getCurrency(),
            ]),
            'ResponseURL' => $this->getReturnUrl(),
            'BackendURL' => $this->getNotifyUrl(),
            'Optional' => json_encode([]),
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
