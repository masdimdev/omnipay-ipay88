<?php

namespace Omnipay\Ipay88\Enum;

enum ErrorDescription: string
{
    case PAYMENT_FAIL = "Payment is failed or not successful";
    case PAYMENT_PENDING = "Payment is pending and customer needs to pay and complete the payment on their mobile banking or ATM Machine";
    case PAYMENT_IN_PROGRESS = "Payment is not paid yet or customer idle on iPay88 payment page or Bank page";
    case RECORD_NOT_FOUND = "Transaction not recorded in iPay88 system";
    case TRANSACTION_NOT_FOUND = "Transaction not found in iPay88 system";
    case MERCHANT_NOT_FOUND = "Incorrect merchant code";
    case TRANSACTION_SIGNATURE_NOT_MATCH = "Incorrect request signature";
    case INCORRECT_AMOUNT = "Incorrect request amount";
    case M88ADMIN = "Payment status updated by iPay88 Admin (Failed)";
    case DUPLICATE_REFERENCE_NUMBER = "Reference number must be unique for each transaction.";
    case INVALID_MERCHANT = "The merchant code does not exist.";
    case INVALID_PARAMETERS = "Some parameter posted to iPay88 is invalid or empty.";
    case OVERLIMIT_PER_TRANSACTION = "You exceed the amount value per transaction.";
    case PAYMENT_NOT_ALLOWED = "The payment method you requested is not allowed for this merchant code, please contact iPay88 to enable your payment option.";
    case PERMISSION_NOT_ALLOW = "Referrer URL registered in iPay88 does not match. Please register your request and response URL with iPay88.";
    case SIGNATURE_NOT_MATCH = "The Signature generated is incorrect.";
    case STATUS_NOT_APPROVED = "Account was suspended or not active.";
    case BIND_CREDIT_CARD_NOT_FOUND = "Credit card information doesn't exist.";
    case INVALID_AMOUNT_FOR_BIND_CARD = "Only RM1.00 is allowed for merchant tokenization (Bind Card).";
    case BIND_CARD_CHARGE_NOT_ALLOWED = "Credit card is bounded. One credit card can be bound with one user only.";
    case DUPLICATE_TOKEN_ID_FOR_BIND_CARD = "Token ID input by merchant already exists, please use another TokenId.";
    case CREDIT_CARD_EXPIRED = "The credit card bound with the Token ID input by merchant has expired.";
    case DUPLICATE_TOKEN_ID_FOUND_FOR_TOKEN_SHARING_MERCHANT = "Token ID input by merchant already exists in master/child merchant, please use another Token ID.";
    case INVALID_PAYMENT_OPTION = "Selected payment option is not allowed.";
    case INVALID_ACTIONTYPE_FOR_PRE_AUTHORISATION = "ActionType = SC is not allowed to perform pre-authorisation transaction.";

    public static function tryFromKey(string $key): ?self
    {
        if (defined("self::{$key}")) {
            return constant("self::{$key}");
        }

        return null;
    }

    /**
     * Convert a string into uppercase snake_case format.
     */
    private static function prepareKey(string $key): string
    {
        // Convert to uppercase and replace non-alphanumeric characters with underscores
        return strtoupper(preg_replace('/[^\p{L}\p{N}]+/u', '_', trim($key)));
    }
}