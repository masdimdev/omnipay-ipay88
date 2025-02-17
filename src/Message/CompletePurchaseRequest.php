<?php

namespace Omnipay\Ipay88\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->httpRequest->request->all();
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
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
