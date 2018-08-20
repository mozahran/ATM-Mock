<?php

namespace ATM\Contracts;

interface Handler
{
    public function setNext(Handler $handler);
    public function getNext(): ?Handler;
    public function handle(Transaction $transaction);
    public function setCurrencyBill(CurrencyBill $currencyBill);
    public function getCurrencyBill(): CurrencyBill;
}