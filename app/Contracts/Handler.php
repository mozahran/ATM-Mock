<?php

namespace ATM\Contracts;

interface Handler
{
    public function setNext(self $handler);

    public function getNext(): ?self;

    public function handle(Transaction $transaction);

    public function setCurrencyBill(CurrencyBill $currencyBill);

    public function getCurrencyBill(): CurrencyBill;
}
