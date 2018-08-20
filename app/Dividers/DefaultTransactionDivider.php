<?php

namespace ATM\Dividers;

use ATM\Contracts\CurrencyBill;
use ATM\Contracts\CurrencyBillCounter;
use ATM\Contracts\Transaction;
use ATM\Contracts\TransactionDivider;
use ATM\DefaultTransaction;

class DefaultTransactionDivider implements TransactionDivider
{
    private $transaction;
    private $currencyBillCounter;

    public function __construct(CurrencyBillCounter $currencyBillCounter)
    {
        $this->setCurrencyBillCounter($currencyBillCounter);
    }

    public function setTransaction(Transaction $transaction): TransactionDivider
    {
        $this->transaction = $transaction;

        return $this;
    }

    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    public function divide(array $currencyBills): array
    {
        if ( ! $this->getTransaction() instanceof Transaction) {
            throw new \RuntimeException('You have to set a transaction first before using the divide mehod.');
        }

        if ( ! count($currencyBills)) {
            throw new \RuntimeException('You have to pass supported currency bills to divide the transaction against them!');
        }

        // Sort the given currency bills to avoid
        // pulling from smaller currency bills first.
        usort($currencyBills, function($billA, $billB) {
            if ($billA->getValue() == $billB->getValue()) {
                return false;
            }
            return $billA->getValue() > $billB->getValue() ? false : true;
        });

        $subTransactions = [];
        $transactionAmount = $this->getTransaction()->getAmount();

        /** @var CurrencyBill $currencyBill */
        foreach ($currencyBills as $currencyBill)
        {
            $modulus = $currencyBill->calculateModulus($transactionAmount);
            $billAmount = $transactionAmount - $modulus;
            $transactionAmount -= $billAmount;

            // Avoid creating empty transaction.
            if ($billAmount == 0) {
                continue;
            }

            $subTransactions[] = new DefaultTransaction(
                $billAmount,
                $this->getCurrencyBillCounter()->count($currencyBill, $billAmount),
                $currencyBill
            );

        }

        return $subTransactions;
    }

    public function getCurrencyBillCounter(): CurrencyBillCounter
    {
        return $this->currencyBillCounter;
    }

    public function setCurrencyBillCounter(CurrencyBillCounter $currencyBillCounter) : TransactionDivider
    {
        $this->currencyBillCounter = $currencyBillCounter;

        return $this;
    }
}