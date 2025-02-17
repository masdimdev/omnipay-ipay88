<?php

namespace Omnipay\Ipay88\Enum;

enum BankName: string
{
    case AFFIN_BANK = "ABB0232";
    case AFFIN_BANK_B2C = "ABB0233";
    case ALLIANCE_BANK_B2C = "ABMB0212";
    case ALLIANCE_BANK_B2B = "ABMB0213";
    case AMBANK_B2B = "AMBB0208";
    case AMBANK_B2C = "AMBB0209";
    case CIMB_BANK = "BCBB0235";
    case BANK_ISLAM = "BIMB0340";
    case BANK_MUAMALAT = "BMMB0341";
    case BANK_MUAMALAT_B2B = "BMMB0342";
    case BANK_RAKYAT_B2C = "BKRM0602";
    case BSN = "BSN0601";
    case DEUTSCHE_BANK = "DBB0199";
    case HONG_LEONG_BANK = "HLB0224";
    case HONG_LEONG_B2B2 = "HLB0225";
    case HSBC_FPX = "HSBC0223";
    case KUWAIT_FINANCE = "KFH0346";
    case MAYBANK_M2U = "MB2U0227";
    case MAYBANK_M2E = "MBB0227";
    case MAYBANK_B2B = "MBB0228";
    case OCBC_BANK = "OCBC0229";
    case PUBLIC_BANK = "PBB0233";
    case RHB_BANK = "RHB0218";
    case STANDARD_CHARTERED_B2B = "SCB0215";
    case STANDARD_CHARTERED_B2C = "SCB0216";
    case GHL_CARDPAY = "TPAGHL";
    case MOBILE88 = "TPAIPAY88";
    case MOLPAY = "TPAMOLPAY";
    case REVENUE_HARVEST = "TPAREVENUE";
    case UOB_B2C = "UOB0226";
    case UOB_B2B1 = "UOB0227";
    case UOB_B2B1_REGIONAL = "UOB0228";

    public function getName(): string
    {
        return match ($this) {
            self::AFFIN_BANK => "Affin Bank Berhad",
            self::AFFIN_BANK_B2C => "Affin Bank Berhad B2C",
            self::ALLIANCE_BANK_B2C => "Alliance Bank Malaysian Berhad B2C",
            self::ALLIANCE_BANK_B2B => "Alliance Bank Malaysian Berhad B2B",
            self::AMBANK_B2B => "AmBank Malaysia Berhad B2B",
            self::AMBANK_B2C => "AmBank Malaysia Berhad B2C",
            self::CIMB_BANK => "CIMB Bank Berhad",
            self::BANK_ISLAM => "Bank Islam Malaysia Berhad",
            self::BANK_MUAMALAT => "Bank Muamalat Malaysia Berhad",
            self::BANK_MUAMALAT_B2B => "Bank Muamalat Malaysia Berhad B2B",
            self::BANK_RAKYAT_B2C => "Bank Kerjasama Rakyat Malaysia B2C",
            self::BSN => "Bank Simpanan Nasional",
            self::DEUTSCHE_BANK => "Deutsche Bank (Malaysia) Berhad",
            self::HONG_LEONG_BANK => "Hong Leong Bank Berhad",
            self::HONG_LEONG_B2B2 => "Hong Leong Bank Berhad B2B2",
            self::HSBC_FPX => "HSBC Bank Berhad FPX",
            self::KUWAIT_FINANCE => "Kuwait Finance House",
            self::MAYBANK_M2U => "Malayan Banking Berhad (M2U)",
            self::MAYBANK_M2E => "Malayan Banking Berhad (M2E)",
            self::MAYBANK_B2B => "Malayan Banking Berhad B2B",
            self::OCBC_BANK => "OCBC Bank Malaysia Berhad",
            self::PUBLIC_BANK => "Public Bank Berhad",
            self::RHB_BANK => "RHB Bank Berhad",
            self::STANDARD_CHARTERED_B2B => "Standard Chartered Bank Malaysia Berhad B2B",
            self::STANDARD_CHARTERED_B2C => "Standard Chartered Bank Malaysia Berhad B2C",
            self::GHL_CARDPAY => "GHL CardPay Sdn Bhd",
            self::MOBILE88 => "Mobile88.com Sdn Bhd",
            self::MOLPAY => "MOL Pay Sdn Bhd",
            self::REVENUE_HARVEST => "Revenue Harvest Sdn Bhd",
            self::UOB_B2C => "United Overseas Bank B2C",
            self::UOB_B2B1 => "United Overseas Bank B2B1",
            self::UOB_B2B1_REGIONAL => "United Overseas Bank B2B1 Regional",
        };
    }
}