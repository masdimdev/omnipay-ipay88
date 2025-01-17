<?php

namespace Omnipay\Ipay88\Message;

use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Http\Exception\RequestException;
use Omnipay\Common\Message\ResponseInterface;

class RequeryPaymentRequest extends AbstractRequest
{
    /**
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
     * @throws Exception
     */
    public function sendData($data): ResponseInterface
    {
        $endpoint = 'https://payment.ipay88.com.my/epayment/webservice/TxInquiryCardDetails/TxDetailsInquiry.asmx/TxDetailsInquiryCardInfo';
        $queryString = http_build_query($data);
        $url = $endpoint . '?' . $queryString;

        try {
            $httpResponse = $this->httpClient->request('GET', $url);

            $responseBody = (string)$httpResponse->getBody();

            $data = $this->parseXml($responseBody);

            return $this->response = new RequeryResponse($this, $data);
        } catch (RequestException $e) {
            throw new Exception('Error communicating with iPay88: ' . $e->getMessage());
        }
    }

    protected function parseXml($xmlString)
    {
        // Load the XML string into a SimpleXMLElement object
        $xml = simplexml_load_string($xmlString);

        // Convert the SimpleXMLElement object to a JSON string and then decode it to an array
        return json_decode(json_encode($xml), true);
    }
}