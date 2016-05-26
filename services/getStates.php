<?php

require '../classes/CountryRepository.php';

header('Content-Type: application/json');

//prefix json to prevent (hypothetical) Javascript/json Hijacking
echo ")]}'\n";

if (isset($_GET['countryCode']) && is_string($_GET['countryCode'])) {
	$states = CountryRepository::getStates($_GET['countryCode']);
	echo json_encode($states);	
}