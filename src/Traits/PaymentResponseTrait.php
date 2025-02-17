<?php

namespace Omnipay\Ipay88\Traits;

use Omnipay\Ipay88\Enum\BankName;
use Omnipay\Ipay88\Enum\ErrorDescription;
use Omnipay\Ipay88\Enum\PaymentMethod;

trait PaymentResponseTrait
{
    public function getPaymentIdEnum($paymentId): ?PaymentMethod
    {
        return PaymentMethod::tryFrom($paymentId);
    }

    public function getErrorDescriptionEnum($errDesc): ?ErrorDescription
    {
        return ErrorDescription::tryFromKey($errDesc);
    }

    public function getBankNameEnum($bankName): ?BankName
    {
        return BankName::tryFrom($bankName);
    }

    public function getFullData()
    {
        $data = $this->getData(); // Fetch original response

        if (!is_array($data)) {
            return $data;
        }

        if (array_key_exists('PaymentId', $data)) {
            $paymentMethod = $this->getPaymentIdEnum($data['PaymentId']);
            $data = $this->arrayInsertAfter($data, 'PaymentId', 'FullPaymentId', $paymentMethod?->getName());
        }

        if (array_key_exists('ErrDesc', $data)) {
            $errorDescription = empty($data['ErrDesc']) ? null : $this->getErrorDescriptionEnum($data['ErrDesc']);
            $data = $this->arrayInsertAfter($data, 'ErrDesc', 'FullErrDesc', $errorDescription?->value);
        }

        if (array_key_exists('S_bankname', $data)) {
            $sBankName = empty($data['S_bankname']) ? null : $this->getBankNameEnum($data['S_bankname']);
            $data = $this->arrayInsertAfter($data, 'S_bankname', 'FullS_bankname', $sBankName?->getName());
        }

        if (array_key_exists('U_bankname', $data)) {
            $sBankName = empty($data['U_bankname']) ? null : $this->getBankNameEnum($data['U_bankname']);
            $data = $this->arrayInsertAfter($data, 'U_bankname', 'FullU_bankname', $sBankName?->getName());
        }

        return $data;
    }

    private function arrayInsertAfter(array $array, string $searchKey, string $newKey, $newValue): array
    {
        // If the key doesn't exist, simply append to the array
        if (!isset($array[$searchKey])) {
            $array[$newKey] = $newValue;

            return $array;
        }

        // Get array keys only once
        $keys = array_keys($array);
        $position = array_search($searchKey, $keys, true);

        // If inserting at the last position, directly append
        if ($position === count($keys) - 1) {
            $array[$newKey] = $newValue;

            return $array;
        }

        // Split the array efficiently
        $firstPart = array_slice($array, 0, $position + 1, true);
        $secondPart = array_slice($array, $position + 1, null, true);

        return $firstPart + [$newKey => $newValue] + $secondPart;
    }
}
