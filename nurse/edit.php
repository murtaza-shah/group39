<?php
include "../scripts/connection.php";
include "../scripts/logout.php";

logout("n_id");

$connection = getConnection();

$output = "";

if (isset($_POST["FName"]) && isset($_POST["LName"])) {
	$fname = $_POST["FName"];
	$lname = $_POST["LName"];

	$sql = "UPDATE Nurse 
			SET FName = '" . $fname . "', LName = '" . $lname . "'
			WHERE NurseID = " . $_SESSION["n_id"] . ";";

	$result = $connection->query($sql);
	$output .= "<p>Nurse " . $_SESSION["n_id"] . " Updated</p>";
} else {
	$sql = "SELECT FName, LName
			FROM Nurse 
			WHERE NurseID = " . $_SESSION["n_id"] . ";";

	$result = $connection->query($sql);


	$fname;
	$lname;
	while ($row = $result->fetch_assoc()) {
		$fname = $row["FName"];
		$lname = $row["LName"];
	}

	$output .= "<p>Edit Nurse " . $_SESSION["n_id"] . ":</p><br>
			<form method='post'>
			<label for='FName'>First Name:</label><input id='FName' name='FName' type='text' value=" . $fname . "><br>
			<label for='LName'>Last Name:</label><input id='LName' name='LName' type='text' value=" . $lname . ">
			<br>
			<button type='submit'>Update</button>
			</form>";
}

$connection->close();

?>

<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<?php echo $output; ?>
		<br><a href="./home.php"><button>Back</button></a>
	</div>

</body>

</html>