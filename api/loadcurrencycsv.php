<?php

require_once __DIR__ . '/../vendor/autoload.php';


use App\Model\Currency;

$curency = new Currency();

$CurrencycsvFile = __DIR__ . '/../assets/currencies.csv';

if ($curency->loadCurrencyIntoDb($CurrencycsvFile)) {
    echo "CSV data successfully loaded...";
};
//echo Currency::index($CurrencycsvFile);