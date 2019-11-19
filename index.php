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

$connection = getConnection();


$sql = "SHOW TABLES LIKE 'Doctor'";
$result = $connection->query($sql);
if (!($result->num_rows > 0)) {
	$sql = "CREATE TABLE Doctor
			(DrID INT NOT NULL,
			FName VARCHAR(15) NOT NULL,
			LName VARCHAR(15) NOT NULL,
			OpNum INT,
			PRIMARY KEY (DrID) );";
	$connection->query($sql);
}

$connection->close();
?>
<html>
<body>

<h1>Yo this is a hospital don't die bro</h1>

</body>
</html>