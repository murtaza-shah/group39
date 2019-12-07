<?php
include "../../scripts/connection.php";

$connection = getConnection();

if (isset($_POST["AHC"]) && isset($_POST["FName"]) && isset($_POST["LName"])) {
	$AHC = $_POST["AHC"];
	$fname = $_POST["FName"];
	$lname = $_POST["LName"];

	// Perform SQL Sanitation here


	$sql = "INSERT INTO Patient (AHC, FName, LName) VALUES ('" . $AHC . "', '" . $fname . "', '" . $lname . "');";

	$result = $connection->query($sql);
}

$connection->close();
?>

<html>
<head>
	<title>Group 39 - Project</title>
	<link rel="stylesheet" href="../../style.css" type="text/css">
</head>
<body>

	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<p>Create Patient</p>

		<form method="post">
			<table>
			<tr><td><label for="AHC">AHC:</label></td><td><input id="AHC" name="AHC" type="text"></td></tr>
			<tr><td><label for="FName">First Name:</label></td><td><input id="FName" name="FName" type="text"></td></tr>
			<tr><td><label for="LName">Last Name:</label></td><td><input id="LName" name="LName" type="text"></td></tr>
			</table>
			<button type="submit">Create Patient</button>
		</form>
		<a href="./adoptPatient.php"><button>Back</button></a>
	</div>

</body>
</html>