<?php
function getConnection() {
	$servername = "fdb16.awardspace.net";
	$serverusername = "3230701_db";
	$serverpassword = "password2";
	$dbname = "3230701_db";

	$c = new mysqli($servername, $serverusername, $serverpassword, $dbname);
	if ($c->connect_error) {
		die("Connection Failed: " . $c->connect_error);
	} else {
		return $c;
	}
}
?>