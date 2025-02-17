<?php

namespace Omnipay\Ipay88\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Http\Exception\RequestException;

class RequeryRequest extends AbstractRequest
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
            'merchantCode',
            'transactionId',
            'amount',
        );

        return [
            'MerchantCode' => $this->getMerchantCode(),
            'RefNo' => $this->getTransactionId(),
            'Amount' => $this->getAmount(),
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return RequeryResponse
     * @throws Exception
     */
    public function sendData($data)
    {
        $endpoint = 'https://payment.ipay88.com.my/epayment/enquiry.asp';
        $queryString = http_build_query($data);
        $url = $endpoint . '?' . $queryString;

        try {
            $httpResponse = $this->httpClient->request('GET', $url);

            $responseBody = (string)$httpResponse->getBody();

            return $this->response = new RequeryResponse($this, $responseBody);
        } catch (RequestException $e) {
            throw new Exception('Error communicating with iPay88: ' . $e->getMessage());
        }
    }
}