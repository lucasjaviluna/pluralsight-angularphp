<?php

class DBClass {
	private static $DB_CONNECTIONSTRING = 'sqlite:/home/lucas.luna/MyProjects/pluralsight-angularphp/db/countries.sqlite';
	private static $DB_USERNAME = '';
	private static $DB_PASSWORD = '';

	private static $db = null;

	protected static function connect() {
		self::$db = new PDO(self::$DB_CONNECTIONSTRING, self::$DB_USERNAME, self::$DB_PASSWORD);
	}

	public static function execute($sql, $values = []) {
		if (self::$db === null) {
			self::connect();
		}

		$statement = self::$db->prepare($sql);
		$statement->execute($values);
		//var_dump($sql, $values);
		return $statement;
	}

	public static function query($sql, $values = []) {
		$statement = self::execute($sql, $values);
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}		
}