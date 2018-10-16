<?php

namespace ATM\Contracts;

interface TransactionDivider
{
    public function setTransaction(Transaction $transaction) : self;

    public function getTransaction() : Transaction;

    public function divide(array $currencyBills) : array;
}
