<?php
include "./connection.php";

$connection = getConnection();

if (isset($_POST["FName"]) && isset($_POST["LName"])) {
	$fname = $_POST["FName"];
	$lname = $_POST["LName"];

	// SQL Sanitation Here

	$sql = "INSERT INTO Doctor (FName, LName) VALUES ('" . $fname . "', '" . $lname . "');";

	$result = $connection->query($sql);
}

$connection->close();
?>

<html>
<head>
	<title>Group 39 - Project</title>
	<link rel="stylesheet" href="../style.css" type="text/css">
</head>
<body>

	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<p>Create Doctor</p>

		<form method="post">
			<label for="FName">First Name:</label><input id="FName" name="FName" type="text"><br>
			<label for="LName">Last Name:</label><input id="LName" name="LName" type="text">
			<br>
			<button type="submit">Create Doctor</button>
		</form>
		<a href="../index.php"><button>Back</button></a>
	</div>

</body>
</html>