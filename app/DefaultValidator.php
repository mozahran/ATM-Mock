<?php

namespace ATM;

use ATM\Contracts\Validator;
use ATM\Contracts\CurrencyBill;

class DefaultValidator implements Validator
{
    public function validateInut(int $input, CurrencyBill $lowestBill): bool
    {
        return ! is_float($input / $lowestBill->getValue());
    }
}