<?php

namespace ATM;

use ATM\Contracts\CurrencyBill;

class DefaultCurrencyBill implements CurrencyBill
{
    private $value;
    private $factor;

    public function __construct(int $value, float $factor)
    {
        $this->setValue($value);
        $this->setFactor($factor);
    }

    public function setValue(int $value): CurrencyBill
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setFactor(float $factor) : CurrencyBill
    {
        $this->factor = $factor;

        return $this;
    }

    public function getFactor(): float
    {
        return $this->factor;
    }

    public function calculateModulus(int $amount) : int
    {
        return $amount % $this->getValue();
    }
}
