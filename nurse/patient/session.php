<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("n_id");

$output = "";

if (isset($_GET["ahc"])) {
	if (isset($_POST["delete"])) {
		$sid = $_POST["delete"];

		$sql = "DELETE FROM Session
				WHERE SessionID = " . $sid . ";";

		$result = $connection->query($sql);
		if ($result) {
			$sql = "UPDATE Patient
					SET SessionID = NULL
					WHERE AHC = " . $_GET["ahc"] . ";";

			$result = $connection->query($sql);

			$output .= "<p>Session Succesfully removed.</p>";
		}
	} else if (isset($_POST["SessionID"]) && isset($_POST["Room"]) && isset($_POST["TProvided"]) && isset($_POST["DrID"])) {
		$sid = $_POST["SessionID"];
		$room = $_POST["Room"];
		$tprov = $_POST["TProvided"];
		$drid = $_POST["DrID"];

		echo $drid;

		$sql = "UPDATE Session 
				SET Room = '" . $room . "', TProvided = '" . $tprov . "', DrID = '" . $drid . "'  
				WHERE SessionID = " . $sid . ";";

		$result = $connection->query($sql);
		if ($result) {
			$output .= "<p>Session (Session ID = " . $sid . ") Updated</p>";
		}
	} else if (isset($_POST["create"])) {
		if (isset($_POST["Room"]) && isset($_POST["DrID"])) {
			$room = $_POST["Room"];
			$drid = $_POST["DrID"];

			$sql = "INSERT INTO Session (Room, DrID) VALUES ('" . $room . "', " . $drid . ");";
			$result = $connection->query($sql);

			if ($result) {
				$sessionid = $connection->insert_id;

				$sql = "INSERT INTO NurseHas (NurseID, SessionID) VALUES (" . $_SESSION["n_id"] . ", " . $sessionid . ");";
				$result = $connection->query($sql);

				$sql = "UPDATE Patient
						SET SessionID = " . $sessionid . "
						WHERE AHC = " . $_GET["ahc"] . ";";

				$result = $connection->query($sql);

				$output .= "<p>Session created for patient.</p>";
			}
		} else {
			$sql = "SELECT * 
					FROM Doctor;";

			$result = $connection->query($sql);

			$options = "";
			while ($row = $result->fetch_assoc()) {
				$inner = "(" . $row["DrID"] . ") " . $row["FName"] . " " . $row["LName"];
				$options .= "<option value=" . $row["DrID"] . ">" . $inner . "</option>";
			}

			$output .= "<table><form method=post>
						<input type=hidden name=create value=1>
						<tr><th>Room</th><th>Dr ID</th></tr>
						<tr>
						<td><textarea maxlength=15 style=resize:none; name=Room>" . $room . "</textarea></td>
						<td><select name=DrID>" . $options . "</select></td>
						</tr>
						<tr><td colspan=3><button type=submit>Create</button></form></td></tr>
						</table>";
		}
		
	} else {
		$output .= "<p>Patient (AHC = " . $_GET["ahc"] . ") Session Info:</p><br>";

		$sql = "SELECT s.*
				FROM Session s INNER JOIN Patient p ON s.SessionID = p.SessionID;";

		$result = $connection->query($sql);

		$sid = "";
		$room = "";
		$tprov = "";
		$drid = "";

		//echo $result->num_rows;
		if ($result->num_rows == 0) {
			$output .= "<p>No session exists for this patient.</p>";
			$output .= "<form method='post'><input type=hidden name=create value=1><button type=submit>Create New Session</button></form>";
			//$sql = "INSERT INTO Session (PAHC) VALUES ('" . $_GET["ahc"] . "');";
			//$result = $connection->query($sql);
		} else {
			while ($row = $result->fetch_assoc()) {
				$sid = $row["SessionID"];
				$room = $row["Room"];
				$tprov = $row["TProvided"];
				$drid = $row["DrID"];
			}

			$sql = "SELECT * 
					FROM Doctor;";

			$result = $connection->query($sql);

			$options = "";
			while ($row = $result->fetch_assoc()) {
				$inner = "(" . $row["DrID"] . ") " . $row["FName"] . " " . $row["LName"];
				$selected = "";
				if ($row["DrID"] == $drid) {
					$selected = " selected=selected";
				}
				$options .= "<option value=" . $row["DrID"] . $selected . ">" . $inner . "</option>";
			}

			$output .= "<table><form method='post'>
						<tr><th>Session ID</th><th>Room</th><th>Treatment Provided</th><th>Dr ID</th></tr>
						<tr>
						<td><input hidden name=SessionID value=" . $sid . ">" . $sid . "</td>
						<td><textarea maxlength=15 style=resize:none; name=Room>" . $room . "</textarea></td>
						<td><textarea maxlength=15 style=resize:none; name=TProvided>" . $tprov . "</textarea></td>
						<td><select name=DrID>" . $options . "</select></td>
						</tr>
						<tr><td colspan=4><button type=submit>Update</button></form><form method=post><input hidden name=delete value=" . $sid . "><button type=submit>Delete</button></form></td></tr>
						</table>";
		}


		
	}
}
$output .= "<br><a href='./viewPatient.php?ahc=" . $_GET["ahc"] . "'><button>Back</button></a>";



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