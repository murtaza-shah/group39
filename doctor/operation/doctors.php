<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("d_id");

$output = "";


if (isset($_POST["remove"])) {
	$drid = $_POST["remove"];
	$opnum = $_GET["opnum"];

	$sql = "DELETE FROM Docs
			WHERE DrId = " . $drid . " && OpNum = " . $opnum . ";";
	$result = $connection->query($sql);

	if ($result) {
		$output .= "<p>Removed Doctor (DrID = " . $drid . ") from Operation (OpNum = " . $opnum . ")";
	}
} else if (isset($_POST["create"])) {
	if (isset($_POST["drid"])) {
		$drid = $_POST["drid"];
		$opnum = $_GET["opnum"];

		$sql = "INSERT INTO Docs (DrID, OpNum) VALUES ( " . $drid . ", " . $opnum . ");";
		$result = $connection->query($sql);

		if ($result) {
			$output .= "<p>Added Doctor (DrID = " . $drid . ") to Operation (OpNum = " . $opnum . ").</p>";
		}
	} else {
		$sql = "SELECT * 
				FROM Doctor 
				WHERE DrID NOT IN (SELECT d.DrID
							FROM Doctor d INNER JOIN Docs o ON d.DrID = o.DrID
							WHERE o.OpNum = " . $_GET["opnum"] . ");";

		$result = $connection->query($sql);

		$options = "";
		while ($row = $result->fetch_assoc()) {
			$inner = "(" . $row["DrID"] . ") " . $row["FName"] . " " . $row["LName"];
			$options .= "<option value=" . $row["DrID"] . ">" . $inner . "</option>";
		}

		$output .= "<form method=post>
					<input type=hidden name=create value=1>
					<select name=drid>" . $options . "</select><br>
					<button type=submit>Add Doctor</button></form>";
	}
	
} else {
	$output .= "<p>Viewing Operation (OpNum = " . $_GET["opnum"] . ") Doctors:</p><br>";

	$sql = "SELECT d.*
			FROM Doctor d INNER JOIN Docs o ON d.DrID = o.DrID
			WHERE o.OpNum = " . $_GET["opnum"] . ";";

	$result = $connection->query($sql);

	$output .= "<table>
				<tr><th>Doctor ID</th><th>Doctor FName</th><th>Doctor LName</th><th>Remove</th></tr>";

	
	while ($row = $result->fetch_assoc()) {

		$fourth = "";

		if ($row["DrID"] <> $_SESSION["d_id"]) {
			$fourth = "<form method=post><input hidden name=remove value=" . $row["DrID"] . "><button type=submit>Remove</button></form>";
		}

		$output .= "<tr>
					<td>" . $row["DrID"] . "</td>
					<td>" . $row["FName"] . "</td>
					<td>" . $row["LName"] . "</td>
					<td>" . $fourth . "</td>
					</tr>";
	}

	$output .= "</table>";
	
	$output .= "<form method='post'><input type=hidden name=create value=1><button type=submit>Add New Doctor</button></form>";
	
}

$output .= "<br><a href='./viewOperation.php?opnum=" . $_GET["opnum"] . "'><button>Back</button></a>";



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