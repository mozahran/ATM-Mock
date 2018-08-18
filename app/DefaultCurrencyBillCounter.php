<?php

namespace ATM;

use ATM\Contracts\CurrencyBill;
use ATM\Contracts\CurrencyBillCounter;

class DefaultCurrencyBillCounter implements CurrencyBillCounter
{
    public function count(CurrencyBill $currencyBill, int $amount): int
    {
        return $amount / $currencyBill->getValue();
    }
}