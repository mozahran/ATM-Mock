<?php

ini_set('display_errors', '1');

require_once __DIR__ . '/vendor/autoload.php';

use ATM\DefaultTransaction;
use ATM\DefaultCurrencyBillCounter;
use ATM\Factories\CurrencyBillFactory;
use ATM\Dividers\DefaultTransactionDivider;

$currencyBillCounter = new DefaultCurrencyBillCounter();
$currencyBillFactory = new CurrencyBillFactory();
$transactionDivider = new DefaultTransactionDivider($currencyBillCounter);

$transactionDivider->setTransaction(new DefaultTransaction(2950));

// We should add a validation layer here to tell the customer
// that whether we are able to process their transaction or not!

$supportedCurrencyBills = [
    $currencyBillFactory->create50Bill(),
    $currencyBillFactory->create200Bill(),
    $currencyBillFactory->create100Bill(),
];

$subTransactions = $transactionDivider->divide($supportedCurrencyBills);

echo '<pre>';
var_dump($subTransactions);