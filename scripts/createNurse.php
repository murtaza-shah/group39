<?php
include "./connection.php";

$connection = getConnection();

if (isset($_POST["FName"]) && isset($_POST["LName"])) {
	$fname = $_POST["FName"];
	$lname = $_POST["LName"];
	//$timestamp = date("Y-m-d H:i:s");

	$sql = "INSERT INTO Nurse (FName, LName) VALUES ('" . $fname . "', '" . $lname . "');";

	$result = $connection->query($sql);
	if ($result) {
		echo "Successfully Inserted<br>";
	} else {
		echo "Insert Failed<br>";
	}
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

	<div id="content">
		<p>Create Nurse</p>

		<form method="post">
			<label for="FName">First Name:</label><input id="FName" name="FName" type="text"><br>
			<label for="LName">Last Name:</label><input id="LName" name="LName" type="text">
			<br>
			<input type="submit" value="Submit">
		</form>
	</div>

</body>
</html>