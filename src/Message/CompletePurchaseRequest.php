<?php

namespace Omnipay\Ipay88\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    public function sendData($data): CompletePurchaseResponse
    {
        $generatedSignature = $this->generateSignature([
            $this->getMerchantKey(),
            $data['MerchantCode'] ?? '',
            $data['PaymentId'] ?? '',
            $data['RefNo'] ?? '',
            preg_replace('/[.,]/', '', (string)($data['Amount'] ?? '')),
            $data['Currency'] ?? '',
            $data['Status'] ?? '',
        ]);

        return $this->response = new CompletePurchaseResponse($this, $data, $generatedSignature);
    }
}
