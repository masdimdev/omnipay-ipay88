<?php

namespace Omnipay\Ipay88\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Http\Exception\RequestException;

class RequeryPaymentRequest extends AbstractRequest
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
            'ReferenceNo' => $this->getTransactionId(),
            'Amount' => $this->getAmount(),
            'Version' => 4,
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return RequeryPaymentResponse
     * @throws Exception
     */
    public function sendData($data)
    {
        $endpoint = 'https://payment.ipay88.com.my/epayment/webservice/TxInquiryCardDetails/TxDetailsInquiry.asmx/TxDetailsInquiryCardInfo';
        $queryString = http_build_query($data);
        $url = $endpoint . '?' . $queryString;

        try {
            $httpResponse = $this->httpClient->request('GET', $url);

            $responseBody = (string)$httpResponse->getBody();

            $data = $this->parseXml($responseBody);

            return $this->response = new RequeryPaymentResponse($this, $data);
        } catch (RequestException $e) {
            throw new Exception('Error communicating with iPay88: ' . $e->getMessage());
        }
    }

    /**
     * Parse the XML response into an array
     *
     * @param $xmlString
     * @return array
     */
    protected function parseXml($xmlString): array
    {
        // Load the XML string into a SimpleXMLElement object
        $xml = simplexml_load_string($xmlString);

        // Convert the SimpleXMLElement object to a JSON string and then decode it to an array
        return json_decode(json_encode($xml), true);
    }
}