<?php

ini_set('display_errors', '1');

require_once __DIR__ . '/vendor/autoload.php';

use ATM\DefaultTransaction;
use ATM\DefaultCurrencyBillCounter;
use ATM\DefaultTransactionHandler;
use ATM\DefaultValidator;
use ATM\Factories\CurrencyBillFactory;
use ATM\Dividers\DefaultTransactionDivider;

$currencyBillCounter = new DefaultCurrencyBillCounter();
$currencyBillFactory = new CurrencyBillFactory();
$transactionDivider = new DefaultTransactionDivider($currencyBillCounter);
$validator = new DefaultValidator();

$supportedCurrencyBills = [
    $fiftyBill = $currencyBillFactory->create50Bill(),
    $oneHundredBill = $currencyBillFactory->create100Bill(),
    $twoHundredsBill = $currencyBillFactory->create200Bill(),
];

$userInput = 2950;

if ( ! $validator->validateInut($userInput, $fiftyBill)) {
    exit("Cannot process your transaction!\n");
}

$transactionDivider->setTransaction(new DefaultTransaction($userInput));
$subTransactions = $transactionDivider->divide($supportedCurrencyBills);

$fiftyBillHandler = new DefaultTransactionHandler($fiftyBill);
$oneHundredBillHandler = new DefaultTransactionHandler($oneHundredBill);
$twoHundredsBillHandler = new DefaultTransactionHandler($twoHundredsBill);

$fiftyBillHandler->setNext($oneHundredBillHandler);
$oneHundredBillHandler->setNext($twoHundredsBillHandler);
$twoHundredsBillHandler->setNext($fiftyBillHandler);

/** @var \ATM\Contracts\Transaction $subTransaction */
foreach ($subTransactions as $subTransaction) {
    echo "Processing Sub-Transaction: {$subTransaction->getAmount()}\n";
    $fiftyBillHandler->handle($subTransaction);
}