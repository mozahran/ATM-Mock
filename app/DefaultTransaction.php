<?php

namespace ATM;

use ATM\Contracts\Transaction;

class DefaultTransaction implements Transaction
{
    private $amount;
    private $billsCount;

    public function __construct(int $amount, int $billsCount = 0)
    {
        $this->setAmount($amount);
        $this->setBillsCount($billsCount);
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
}