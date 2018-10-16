<?php

ini_set('display_errors', '1');

require_once __DIR__.'/vendor/autoload.php';

use ATM\DefaultCurrencyBillCounter;
use ATM\DefaultTransaction;
use ATM\DefaultTransactionHandler;
use ATM\Dividers\DefaultTransactionDivider;
use ATM\Factories\CurrencyBillFactory;

$currencyBillCounter = new DefaultCurrencyBillCounter();
$currencyBillFactory = new CurrencyBillFactory();
$transactionDivider = new DefaultTransactionDivider($currencyBillCounter);

$transactionDivider->setTransaction(new DefaultTransaction(2950));

// We should add a validation layer here to tell the customer
// that whether we are able to process their transaction or not!

$fiftyBill = $currencyBillFactory->create50Bill();
$oneHundredBill = $currencyBillFactory->create100Bill();
$twoHundredsBill = $currencyBillFactory->create200Bill();

$supportedCurrencyBills = [
    $fiftyBill,
    $oneHundredBill,
    $twoHundredsBill,
];

$subTransactions = $transactionDivider->divide($supportedCurrencyBills);

$fiftyBillHandler = new DefaultTransactionHandler($fiftyBill);
$oneHundredBillHandler = new DefaultTransactionHandler($oneHundredBill);
$twoHundredsBillHandler = new DefaultTransactionHandler($twoHundredsBill);

$fiftyBillHandler->setNext($oneHundredBillHandler);
$oneHundredBillHandler->setNext($twoHundredsBillHandler);
$twoHundredsBillHandler->setNext($fiftyBillHandler);

/** @var \ATM\Contracts\Transaction $subTransaction */
foreach ($subTransactions as $subTransaction) {
    echo "<pre>Processing Sub-Transaction: {$subTransaction->getAmount()}</pre>";
    $fiftyBillHandler->handle($subTransaction);
}
