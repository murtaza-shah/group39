<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("n_id");

$output = "";

if (isset($_GET["ahc"])) {
	if (isset($_POST["FName"]) && isset($_POST["LName"])) {
		$fname = $_POST["FName"];
		$lname = $_POST["LName"];

		$sql = "UPDATE Patient 
				SET FName = '" . $fname . "', LName = '" . $lname . "'
				WHERE AHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);
		$output .= "<p>Patient (AHC = " . $_GET["ahc"] . ") Updated</p>";
	} else {
		$sql = "SELECT FName, LName
				FROM Patient 
				WHERE AHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);


		$fname;
		$lname;
		while ($row = $result->fetch_assoc()) {
			$fname = $row["FName"];
			$lname = $row["LName"];
		}

		$output .= "<p>Edit Patient (AHC = " . $_GET["ahc"] . "):</p><br>
				<form method='post'>
				<label for='FName'>First Name:</label><input id='FName' name='FName' type='text' value=" . $fname . "><br>
				<label for='LName'>Last Name:</label><input id='LName' name='LName' type='text' value=" . $lname . ">
				<br>
				<button type='submit'>Update</button>
				</form>";

		$output .= "<br><a href='./viewPatient.php?ahc=" . $_GET["ahc"] . "'><button>Back</button></a>";
	}
}

$connection->close();

?>

<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<?php echo $output; ?>
	</div>

</body>

</html>