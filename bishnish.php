<?php

require_once('vendor/autoload.php');

$countryCodes = new \BishNish\CountryCodes(__DIR__ . '/src/country_codes.php');
$sortedUppercasedCountryCodes = $countryCodes->sorted()->uppercased()->getCodes();
$rules = ['B' => 'Bish', 'N' => 'Nish'];
$bishNish = new \BishNish\BishNish($sortedUppercasedCountryCodes, $rules);

// Print the BishNish array
foreach ($bishNish->generate() as $item) {
    echo $item . "\n";
}




