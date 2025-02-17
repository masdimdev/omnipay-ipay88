<?php

namespace Omnipay\Ipay88\Enum;

enum PaymentMethod: int
{
    case CREDIT_CARD_MYR = 2;
    case MAYBANK2U = 6;
    case ALLIANCE_ONLINE = 8;
    case AMONLINE = 10;
    case RHB_ONLINE = 14;
    case HONG_LEONG_ONLINE = 15;
    case CHINA_UNIONPAY_ONLINE = 18;
    case CIMB_CLICK = 20;
    case KIPLE_ONLINE = 22;
    case CREDIT_CARD_USD = 25;
    case PUBLIC_BANK_ONLINE = 31;
    case CREDIT_CARD_GBP = 35;
    case CREDIT_CARD_THB = 36;
    case CREDIT_CARD_CAD = 37;
    case CREDIT_CARD_SGD = 38;
    case CREDIT_CARD_AUD = 39;
    case CREDIT_CARD_MYR_ALT = 40;
    case CREDIT_CARD_EUR = 41;
    case CREDIT_CARD_HKD = 42;
    case PAYPAL_MYR = 48;
    case CREDIT_CARD_MYR_PRE_AUTH = 55;
    case BANK_RAKYAT = 102;
    case AFFIN_ONLINE = 103;
    case PUBLIC_BANK_EPP = 111;
    case MAYBANK_EZYPAY_VISA_MASTERCARD = 112;
    case MAYBANK_EZYPAY_AMEX = 115;
    case PAY4ME_DELAY = 122;
    case BSN_ONLINE = 124;
    case BANK_ISLAM = 134;
    case UOB = 152;
    case HONG_LEONG_PEX_QR = 163;
    case BANK_MUAMALAT = 166;
    case OCBC = 167;
    case STANDARD_CHARTERED = 168;
    case CIMB_VIRTUAL_ACCOUNT = 173;
    case CIMB_EASY_PAY = 174;
    case MAYBANK2E_ONLINE = 178;
    case HONG_LEONG_EPP_MIGS = 179;
    case HSBC_ONLINE_BANKING = 198;
    case KUWAIT_FINANCE_HOUSE = 199;
    case BOOST_WALLET = 210;
    case VCASH = 243;
    case MCASH = 244;
    case NETS_QR_ONLINE = 382;
    case AGRO_BANK_ONLINE = 405;
    case OCBC_INSTALMENT = 430;
    case HONG_LEONG_EPP_MPGS = 433;
    case GRABPAY_ONLINE = 523;
    case RHB_INSTALMENT = 534;
    case TOUCH_N_GO_EWALLET = 538;
    case MAYBANK_PAYQR_ONLINE = 542;
    case AMBANK_EPP = 606;
    case STANDARD_CHARTERED_INSTALMENT = 727;
    case SHOPEEPAY_ONLINE = 801;
    case MOBYPAY = 890;
    case ATOME = 891;

    public function getName(): string
    {
        return match ($this) {
            self::CREDIT_CARD_MYR => "Credit Card (MYR)",
            self::MAYBANK2U => "Maybank2U",
            self::ALLIANCE_ONLINE => "Alliance Online",
            self::AMONLINE => "AmOnline",
            self::RHB_ONLINE => "RHB Online",
            self::HONG_LEONG_ONLINE => "Hong Leong Online",
            self::CHINA_UNIONPAY_ONLINE => "China UnionPay Online Banking (MYR)",
            self::CIMB_CLICK => "CIMB Click",
            self::KIPLE_ONLINE => "Web Cash/Kiple Online",
            self::CREDIT_CARD_USD => "Credit Card (USD)",
            self::PUBLIC_BANK_ONLINE => "Public Bank Online",
            self::CREDIT_CARD_GBP => "Credit Card (GBP)",
            self::CREDIT_CARD_THB => "Credit Card (THB)",
            self::CREDIT_CARD_CAD => "Credit Card (CAD)",
            self::CREDIT_CARD_SGD => "Credit Card (SGD)",
            self::CREDIT_CARD_AUD => "Credit Card (AUD)",
            self::CREDIT_CARD_MYR_ALT => "Credit Card (MYR)",
            self::CREDIT_CARD_EUR => "Credit Card (EUR)",
            self::CREDIT_CARD_HKD => "Credit Card (HKD)",
            self::PAYPAL_MYR => "PayPal (MYR)",
            self::CREDIT_CARD_MYR_PRE_AUTH => "Credit Card (MYR) Pre-Auth",
            self::BANK_RAKYAT => "Bank Rakyat Internet Banking",
            self::AFFIN_ONLINE => "Affin Online",
            self::PUBLIC_BANK_EPP => "Public Bank EPP (Instalment Payment)",
            self::MAYBANK_EZYPAY_VISA_MASTERCARD => "Maybank EzyPay (Visa/Mastercard Instalment Payment)",
            self::MAYBANK_EZYPAY_AMEX => "Maybank EzyPay (AMEX Instalment Payment)",
            self::PAY4ME_DELAY => "Pay4Me (Delay payment)",
            self::BSN_ONLINE => "BSN Online",
            self::BANK_ISLAM => "Bank Islam",
            self::UOB => "UOB",
            self::HONG_LEONG_PEX_QR => "Hong Leong PEx+ (QR Payment)",
            self::BANK_MUAMALAT => "Bank Muamalat",
            self::OCBC => "OCBC",
            self::STANDARD_CHARTERED => "Standard Chartered Bank",
            self::CIMB_VIRTUAL_ACCOUNT => "CIMB Virtual Account (Delay payment)",
            self::CIMB_EASY_PAY => "CIMB Easy Pay (Instalment Payment)",
            self::MAYBANK2E_ONLINE => "Maybank2E Online",
            self::HONG_LEONG_EPP_MIGS => "Hong Leong Bank EPP-MIGS (Instalment Payment)",
            self::HSBC_ONLINE_BANKING => "HSBC Online Banking",
            self::KUWAIT_FINANCE_HOUSE => "Kuwait Finance House",
            self::BOOST_WALLET => "Boost Wallet",
            self::VCASH => "VCash",
            self::MCASH => "MCash",
            self::NETS_QR_ONLINE => "NETS QR Online",
            self::AGRO_BANK_ONLINE => "Agro Bank Online",
            self::OCBC_INSTALMENT => "OCBC Instalment",
            self::HONG_LEONG_EPP_MPGS => "Hong Leong Bank EPP-MPGS (Instalment Payment)",
            self::GRABPAY_ONLINE => "GrabPay Online",
            self::RHB_INSTALMENT => "RHB (Instalment Payment)",
            self::TOUCH_N_GO_EWALLET => "Touch 'n Go eWallet",
            self::MAYBANK_PAYQR_ONLINE => "Maybank PayQR Online",
            self::AMBANK_EPP => "AmBank EPP",
            self::STANDARD_CHARTERED_INSTALMENT => "Standard Chartered Bank Instalment",
            self::SHOPEEPAY_ONLINE => "ShopeePay Online",
            self::MOBYPAY => "MobyPay",
            self::ATOME => "Atome",
        };
    }

    public static function map(): array
    {
        $result = [];
        foreach (self::cases() as $method) {
            $result[$method->value] = $method->getName();
        }

        return $result;
    }
}