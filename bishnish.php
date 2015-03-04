<?php

require_once('autoload.php');

$countryCodes = new \BishNish\CountryCodes(__DIR__ . '/src/country_codes.php');
$sortedUppercasedCountryCodes = $countryCodes->sorted()->uppercased()->getCodes();
$rules = ['B' => 'Bish', 'N' => 'Nish'];
$bishNish = new \BishNish\BishNish($sortedUppercasedCountryCodes, $rules);

echo PHP_EOL;
echo 'Printing BishNish on country codes:' . PHP_EOL;

foreach ($bishNish->generate() as $item) {
    echo $item . PHP_EOL;
}




