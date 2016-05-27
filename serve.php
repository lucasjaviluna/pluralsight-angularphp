#!/usr/bin/php -q
<?php
	exec("php -S localhost:8000", $output, $return);
	var_dump($output, $return);
