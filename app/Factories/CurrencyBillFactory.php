<?php

namespace ATM\Factories;

use ATM\DefaultCurrencyBill;

class CurrencyBillFactory
{
    public function create200Bill(float $factor = 1)
    {
        return new DefaultCurrencyBill(200, $factor);
    }

    public function create100Bill(float $factor = 1)
    {
        return new DefaultCurrencyBill(100, $factor);
    }

    public function create50Bill(float $factor = 1)
    {
        return new DefaultCurrencyBill(50, $factor);
    }
}