<?php

namespace ATM\Contracts;

interface Transaction
{
    public function setAmount(int $amount);

    public function getAmount() : int;

    public function setBillsCount(int $count);

    public function getBillsCount() : int;

    public function setCurrencyBill(CurrencyBill $currencyBill) : self;

    public function getCurrencyBill() : CurrencyBill;
}
