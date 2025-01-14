<?php

namespace Omnipay\Ipay88\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    /**
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
            'PaymentId' => $this->getParameter('paymentId'),
            'RefNo' => $this->getTransactionId(),
            'Amount' => number_format($this->getAmount() / 100, 2, '.', ','),
            'Currency' => $this->getCurrency(),
            'ProdDesc' => $this->getParameter('description'),
            'UserName' => $this->getParameter('userName'),
            'UserEmail' => $this->getParameter('userEmail'),
            'UserContact' => $this->getParameter('userContact'),
            'Remark' => $this->getParameter('remark') ?? '',
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

    public function sendData($data): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
