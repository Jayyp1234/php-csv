<?php

require_once __DIR__ . '/../vendor/autoload.php';

 use App\Model\Currency;

$currency = new Currency();

echo $currency->find();
