<?php
include "./connection.php";

$connection = getConnection();

// If Doctor table does not exist, Create it
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