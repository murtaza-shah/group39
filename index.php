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

$sql = "SHOW TABLES LIKE 'Nurse'";
$result = $connection->query($sql);
if (!($result->num_rows > 0)) {
	$sql = "CREATE TABLE ​Nurse 
	(NurseID INT ​NOT NULL​,
	FName   VARCHAR(15) ​NOT NULL​,
	LName VARCHAR(15) ​NOT NULL​, 
	DrWaitList INT,
	PWaitTime Timestamp,
	PRIMARY KEY ​(NurseID));"
	$connection->query($sql);
}

$sql = "SHOW TABLES LIKE 'Patient'";
$result = $connection->query($sql);
if (!($result->num_rows > 0)) {
	$sql = "CREATE TABLE Patient
	(AHC CHAR(9) ​NOT NULL​,
	FName VARCHAR(15) ​NOT NULL​,
	LName VARCHAR(15) ​NOT NULL​,
	SessionID INT, 
	DrWaitList, 
	PRIMARY KEY ​(AHC) ); "
	$connection->query($sql);
}

$sql = "SHOW TABLES LIKE 'Session'";
$result = $connection->query($sql);
if (!($result->num_rows > 0)) {
	$sql = "CREATE TABLE Session 
	(SessionID INT
	​NOT NULL​, 
	Room VARCHAR(15) ​NOT NULL​,
	TProvided VARCHAR(15),
	DrID INT ​NOT NULL​,
	PRIMARY KEY ​(SessionID), 
	FOREIGN KEY ​(DrID) ​REFERENCES ​Doctor(DrID) ​ON DELETE ​SET NULL ​ON UPDATE CASCADE); "
	$connection->query($sql);
}

$sql = "SHOW TABLES LIKE 'Waitlist'";
$result = $connection->query($sql);
if (!($result->num_rows > 0)) {
	$sql = "CREATE TABLE Waitlist 
	(DrID INT ​NOT NULL​,
	PFName VARCHAR(15) ​NOT NULL​,
	PLName VARCHAR(15) ​NOT NULL​,
	PRIMARY KEY ​(DrID),
	FOREIGN KEY ​(DrID) ​REFERENCES ​Doctor(DrID) ​ON DELETE ​CASCADE ​ON UPDATE CASCADE);"
	$connection->query($sql);
}

$connection->close();
?>
<html>
<body>

<h1>Yo this is a hospital don't die bro</h1>

</body>
</html>