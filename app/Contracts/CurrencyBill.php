<?php

namespace ATM\Contracts;

interface CurrencyBill
{
    public function setValue(int $value) : self;

    public function getValue() : int;

    public function setFactor(float $factor) : self;

    public function getFactor() : float;

    public function calculateModulus(int $amount) : int;
}
