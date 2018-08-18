<?php

namespace ATM\Contracts;

interface CurrencyBill
{
    public function setValue(int $value) : CurrencyBill;
    public function getValue() : int;
    public function setFactor(float $factor) : CurrencyBill;
    public function getFactor() : float;
    public function calculateModulus(int $amount) : int;
}