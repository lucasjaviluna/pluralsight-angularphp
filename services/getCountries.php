<?php

require '../classes/CountryRepository.php';

header('Content-Type: application/json');

//prefix json to prevent (hypothetical) Javascript/json Hijacking
echo ")]}'\n";

$countries = CountryRepository::getCountries();

echo json_encode($countries);