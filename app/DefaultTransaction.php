<?php

namespace ATM;

use ATM\Contracts\CurrencyBill;
use ATM\Contracts\Transaction;

class DefaultTransaction implements Transaction
{
    private $amount;
    private $billsCount;
    private $currencyBill;

    public function __construct(
        int $amount,
        int $billsCount = 0,
        CurrencyBill $currencyBill = null
    ) {
        $this->setAmount($amount);
        $this->setBillsCount($billsCount);

        if ($currencyBill != null) {
            $this->setCurrencyBill($currencyBill);
        }
    }

    public function setAmount(int $amount): Transaction
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setBillsCount(int $count): Transaction
    {
        $this->billsCount = $count;

        return $this;
    }

    public function getBillsCount(): int
    {
        return $this->billsCount;
    }

    public function setCurrencyBill(CurrencyBill $currencyBill): Transaction
    {
        $this->currencyBill = $currencyBill;

        return $this;
    }

    public function getCurrencyBill(): CurrencyBill
    {
        return $this->currencyBill;
    }
}
