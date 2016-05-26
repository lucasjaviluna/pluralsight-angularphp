<?php
require 'Country.php';
require 'State.php';

//https://apigility.org

class CountryRepository {
	private static $countries = [];

	protected static function init(){
		$countries = [];
		array_push($countries,
			new Country('Austria', 'AT', [
				new State('Styria'), new State('Vienna')
			])
		);
		array_push($countries,
			new Country('Canada', 'CA', [
				new State('Ontario'), new State('Quebec')
			])
		);
		array_push($countries,
			new Country('Luxembourg', 'LU')
		);

		self::$countries = $countries;
	}

	public static function getCountries() {
		if (count(self::$countries) === 0) {
			self::init();
		}
		return self::$countries;
	}

	public static function getStates($countryCode) {
		if (count(self::$countries) === 0) {
			self::init();
		}
		$country = array_filter(self::$countries, function($c) use ($countryCode) {
			return $c->code === $countryCode;
		});

		if (empty($country) === 0) {
			return [];
		}

		$firstCountry = array_shift($country);
		return $firstCountry->states;
	}

}