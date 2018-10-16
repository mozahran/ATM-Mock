<?php

namespace ATM\Contracts;

interface CurrencyBillCounter
{
    public function count(CurrencyBill $currencyBill, int $amount) : int;
}
