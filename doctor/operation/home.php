<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("d_id");

$output = "";

if (isset($_POST["create"])) {
	if (isset($_POST["StartTime"]) && isset($_POST["EndTime"]) && isset($_POST["OpnType"]) && isset($_POST["PFName"]) && isset($_POST["PLName"])) {
		$start = $_POST["StartTime"];
		if (strlen($start) == 5) {
			$start .= ":00";
		}

		$end = $_POST["EndTime"];
		if (strlen($end) == 5) {
			$end .= ":00";
		}

		$type = $_POST["OpnType"];
		$fname = $_POST["PFName"];
		$lname = $_POST["PLName"];

		$sql = "INSERT INTO Operation (StartTime, EndTime, OpnType, PFName, PLName) VALUES ('" . $start . "', '" . $end . "', '" . $type . "', '" . $fname . "', '" . $lname . "');";
		$result = $connection->query($sql);

		if ($result) {
			$opnum = $connection->insert_id;

			$sql = "INSERT INTO Docs (DrID, OpNum) VALUES (" . $_SESSION["d_id"] . ", " . $opnum . ");";
			$result = $connection->query($sql);


			$output .= "<p>Operation (OpNum = " . $opnum . ") created.</p>";
		}
	} else {
		$output .= "<table><form method=post>
					<input type=hidden name=create value=1>
					<tr><th>Start Time</th><th>End Time</th><th>OpnType</th><th>PFName</th><th>PLName</th></tr>
					<tr>
					<td><input type=time name=StartTime></td>
					<td><input type=time name=EndTime></td>
					<td><input maxlength=15 type=text name=OpnType></td>
					<td><input maxlength=15 type=text name=PFName></td>
					<td><input maxlength=15 type=text name=PLName></td>
					</tr>
					<tr><td colspan=5><button type=submit>Create</button></form></td></tr>
					</table>";
	}
	
} else {
	$output .= "<p>Viewing My Operations:</p><br>";

	$sql = "SELECT o.*
			FROM Operation o INNER JOIN Docs d ON o.OpNum = d.OpNum
			WHERE d.DrId = " . $_SESSION["d_id"] . ";";

	$result = $connection->query($sql);

	

	$output .= "<table><form method='post'>
				<tr><th>OpNum</th><th>Start Time</th><th>End Time</th><th>OpnType</th><th>PFName</th><th>PLName</th></tr>";
	
	while ($row = $result->fetch_assoc()) {
		$output .= "<tr class=tr onclick=\"window.location.href='http://groupthirtynine.scienceontheweb.net/doctor/operation/viewOperation.php?opnum=" . $row["OpNum"] . "'\">
					<td>" . $row["OpNum"] . "</td>
					<td><input type=time name=StartTime disabled value=" . $row["StartTime"] . "></td>
					<td><input type=time name=EndTime disabled value=" . $row["EndTime"] . "></td>
					<td>" . $row["OpnType"] . "</td>
					<td>" . $row["PFName"] . "</td>
					<td>" . $row["PLName"] . "</td>
					</tr>";
	}

	

	$output .= "</table>";
	
	$output .= "<form method='post'><input type=hidden name=create value=1><button type=submit>Create New Operation</button></form>";
	
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