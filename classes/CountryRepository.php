<?php
require_once 'Country.php';
require_once 'State.php';
require_once 'DBHelper.php';
//https://apigility.org

class CountryRepository {
	//private static $countries = [];

	public static function init(){
		DBHelper::resetDB();

		DBHelper::addCountry(
			new Country('United States', 'US', [
				new State('California'), new State('North Dakota'), new State('Wyoming')
			])
		);
		DBHelper::addCountry(
			new Country('Canada', 'CA', [
				new State('Ontario'), new State('Quebec')
			])
		);
		DBHelper::addCountry(
			new Country('Germany', 'DE', [
				new State('Bavaria'), new State('Berlin')
			])
		);
		DBHelper::addCountry(
			new Country('Austria', 'AT', [
				new State('Styria'), new State('Tyrol')
			])
		);
		DBHelper::addCountry(
			new Country('Luxembourg', 'LU')
		);
		/*$countries = [];
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

		self::$countries = $countries;*/
	}

	public static function getCountries() {
		return DBHelper::getCountries();
		/*if (count(self::$countries) === 0) {
			self::init();
		}
		return self::$countries;*/
	}

	public static function getStates($countryCode) {
		return DBHelper::getStates(new Country('', $countryCode));
		/*if (count(self::$countries) === 0) {
			self::init();
		}
		$country = array_filter(self::$countries, function($c) use ($countryCode) {
			return $c->code === $countryCode;
		});

		if (empty($country) === 0) {
			return [];
		}

		$firstCountry = array_shift($country);
		return $firstCountry->states;*/
	}

	public static function addState($name, $countryCode) {
		return DBHelper::addState(new State($name), new Country('', $countryCode));
	}
}