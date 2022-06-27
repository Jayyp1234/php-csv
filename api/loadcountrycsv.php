<?php

require_once __DIR__ . '/../vendor/autoload.php';


use App\Model\Country;
$curency = new Country();

$CountrycsvFile = __DIR__ . '/../assets/countries.csv';

if ($curency->loadCSVDataIntoDb($CountrycsvFile)) {
    echo "CSV data successfully loaded...";
};