<?php

namespace ATM\Contracts;

interface TransactionDivider
{
    public function setTransaction(Transaction $transaction) : TransactionDivider;
    public function getTransaction() : Transaction;
    public function divide(array $currencyBills) : array;
}