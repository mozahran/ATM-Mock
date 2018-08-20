<?php

namespace ATM;

use ATM\Contracts\CurrencyBill;
use ATM\Contracts\Handler;
use ATM\Contracts\Transaction;

class DefaultTransactionHandler implements Handler
{
    private $next;
    private $currencyBill;

    public function __construct(CurrencyBill $currencyBill, Handler $next = null)
    {
        $this->setCurrencyBill($currencyBill);

        if ($next instanceof Handler) {
            $this->setNext($next);
        }
    }

    public function setNext(Handler $handler)
    {
        $this->next = $handler;
    }

    public function getNext() : ?Handler
    {
        return $this->next;
    }

    public function handle(Transaction $transaction)
    {
        if ($transaction->getCurrencyBill()->getValue() == $this->getCurrencyBill()->getValue()) {
            $billValue = $transaction->getCurrencyBill()->getValue();
            for ($i = 0; $i < $transaction->getBillsCount(); $i++) {
                echo "<pre>Processing: {$billValue} L.E.</pre>";
            }
            return;
        }

        if ($this->getNext() instanceof Handler) {
            $this->getNext()->handle($transaction);
        }
    }

    public function setCurrencyBill(CurrencyBill $currencyBill)
    {
        $this->currencyBill = $currencyBill;
    }

    public function getCurrencyBill(): CurrencyBill
    {
        return $this->currencyBill;
    }
}