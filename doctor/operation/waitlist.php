<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("d_id");

$output = "";



if (isset($_POST["create"])) {
	if (isset($_POST["ahc"])) {
		$sql = "SELECT FName, LName
				FROM Patient
				WHERE AHC = '" . $_POST["ahc"] . "';";
		$result = $connection->query($sql);


		$fname = "";
		$lname = "";
		while ($row = $result->fetch_assoc()) {
			$fname = $row["FName"];
			$lname = $row["LName"];
		}

		$sql = "INSERT INTO Waitlist (DrID, PFName, PLName) VALUES ( " . $_SESSION["d_id"] . ", '" . $fname . "', '" . $lname . "');";
		$result = $connection->query($sql);

		if ($result) {
			$sql = "UPDATE Patient
					SET DrWaitList = '" . $_SESSION["d_id"] . "'
					WHERE AHC = '" . $_POST["ahc"] . "';";

			$result = $connection->query($sql);

			printf("Error: %s\n", $connection->error);

			$output .= "<p>Added Patient to Doctor (DrID = " . $_SESSION["d_id"] . ") Waitlist.</p>";
		}
	} else {
		$sql = "SELECT * 
				FROM Patient 
				WHERE DrWaitList IS NULL;";

		$result = $connection->query($sql);

		echo $result->num_rows;

		$options = "";
		while ($row = $result->fetch_assoc()) {
			$inner = "(" . $row["AHC"] . ") " . $row["FName"] . " " . $row["LName"];
			$options .= "<option value=" . $row["AHC"] . ">" . $inner . "</option>";
		}

		$output .= "<form method=post>
					<input type=hidden name=create value=1>
					<select name=ahc>" . $options . "</select><br>
					<button type=submit>Add Patient</button></form>";
	}
} else if (isset($_POST["FName"]) && isset($_POST["LName"])) {
	$fname = $_POST["FName"];
	$lname = $_POST["LName"];

	$sql = "DELETE FROM Waitlist
			WHERE PFName = '" . $fname . "' && PLName = '" . $lname . "';";
	$result = $connection->query($sql);

	if ($result) {
		$sql = "UPDATE Patient
				SET DrWaitList = NULL
				WHERE DrWaitList = '" . $_SESSION["d_id"] . "' && FName = '" . $fname . "' && LName = '" . $lname . "';";
		$result = $connection->query($sql);

		$output .= "<p>Removed Patient from Doctor (DrID = " . $_SESSION["d_id"] . ") Waitlist.";
	}
	
} else {
	$output .= "<p>Viewing Doctor (DrID = " . $_SESSION["d_id"] . ") Waitlist:</p><br>";

	$sql = "SELECT *
			FROM Waitlist
			WHERE DrID = " . $_SESSION["d_id"] . ";";

	$result = $connection->query($sql);

	$output .= "<table>
				<tr><th>FName</th><th>LName</th><th>Remove</th></tr>";

	
	while ($row = $result->fetch_assoc()) {

		$output .= "<tr>
					<td>" . $row["PFName"] . "</td>
					<td>" . $row["PLName"] . "</td>
					<td><form method=post><input hidden name=FName value=" . $row["PFName"] . "><input hidden name=LName value=" . $row["PLName"] . "><button type=submit>Remove</button></form></td>
					</tr>";
	}

	$output .= "</table>";
	
	$output .= "<form method='post'><input type=hidden name=create value=1><button type=submit>Append to Waitlist</button></form>";
	
}

$output .= "<br><a href='../home.php'><button>Back</button></a>";



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