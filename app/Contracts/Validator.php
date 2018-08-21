<?php

namespace ATM\Contracts;

interface Validator
{
    public function validateInut(int $input, CurrencyBill $lowestBill) : bool;
}