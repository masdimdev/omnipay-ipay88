<?php

namespace Omnipay\Ipay88;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Ipay88\Message\CompletePurchaseRequest;
use Omnipay\Ipay88\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Ipay88\Message\RequeryPaymentRequest;
use Omnipay\Ipay88\Message\RequeryRequest;

/**
 * @method NotificationInterface acceptNotification(array $options = array())
 * @method RequestInterface authorize(array $options = array())
 * @method RequestInterface completeAuthorize(array $options = array())
 * @method RequestInterface capture(array $options = array())
 * @method RequestInterface refund(array $options = array())
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method RequestInterface void(array $options = array())
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'ipay88';
    }

    public function getDefaultParameters(): array
    {
        return [
            'merchantCode' => '',
            'merchantKey' => '',
            'requestUrl' => 'https://payment.ipay88.com.my/ePayment/entry.asp',
            'requeryUrl' => 'https://payment.ipay88.com.my/ePayment/enquiry.asp',
            'paymentId' => '',
            'currency' => 'MYR',
        ];
    }

    public function setMerchantCode($value): Gateway
    {
        return $this->setParameter('merchantCode', $value);
    }

    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantKey($value): Gateway
    {
        return $this->setParameter('merchantKey', $value);
    }

    public function getMerchantKey(): Gateway
    {
        return $this->getParameter('merchantKey');
    }

    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function completePurchase(array $options = []): RequestInterface
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    public function requery(array $options = []): AbstractRequest
    {
        return $this->createRequest(RequeryRequest::class, $options);
    }

    public function requeryPayment(array $options = []): AbstractRequest
    {
        return $this->createRequest(RequeryPaymentRequest::class, $options);
    }
}
