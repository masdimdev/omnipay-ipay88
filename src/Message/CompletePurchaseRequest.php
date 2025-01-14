<?php

namespace Omnipay\Ipay88\Message;

use Exception;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @throws Exception
     */
    public function getData()
    {
        $data = $this->httpRequest->request->all();

        $status = (string)($data['Status'] ?? '');
        if ($status !== '1') {
            throw new Exception($data['ErrDesc'] ?? 'An error occurred.');
        }

        $signature = $data['Signature'] ?? '';
        $generatedSignature = $this->generateSignature([
            $this->getMerchantKey(),
            $data['MerchantCode'] ?? '',
            $data['RefNo'] ?? '',
            $data['Amount'] ?? '',
            $data['Currency'] ?? '',
            $data['Status'] ?? '',
        ]);

        if ($signature !== $generatedSignature) {
            throw new Exception('Invalid signature.');
        }

        return $data;
    }

    public function sendData($data): CompletePurchaseResponse
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
