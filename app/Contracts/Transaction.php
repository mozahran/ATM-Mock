<?php

namespace ATM\Contracts;

interface Transaction
{
    public function setAmount(int $amount);
    public function getAmount() : int;
    public function setBillsCount(int $count);
    public function getBillsCount() : int;
    public function setCurrencyBill(CurrencyBill $currencyBill) : Transaction;
    public function getCurrencyBill() : CurrencyBill;
}