<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("d_id");

$output = "";

if (isset($_GET["opnum"])) {
	if (isset($_POST["StartTime"]) && isset($_POST["EndTime"]) && isset($_POST["OpnType"]) && isset($_POST["PFName"]) && isset($_POST["PLName"]) && isset($_POST["Docs"])) {
		$start = $_POST["StartTime"];
		$end = $_POST["EndTime"];
		$type = $_POST["OpnType"];
		$fname = $_POST["PFName"];
		$lname = $_POST["PLName"];
		$docs = $_POST["Docs"];

		$sql = "UPDATE Operation 
				SET StartTime = '" . $start . "', EndTime = '" . $end . "', OpnType = '" . $type . "', PFName = '" . $fname . "', PLName = '" . $lname . "', Docs = '" . $docs . "'  
				WHERE OpNum = " . $_GET["opnum"] . ";";

		$result = $connection->query($sql);
		if ($result) {
			$output .= "<p>Operation (OpNum = " . $_GET["opnum"] . ") Updated</p>";
		}
	} else {
		$sql = "SELECT *
				FROM Operation 
				WHERE OpNum = " . $_GET["opnum"] . ";";

		$result = $connection->query($sql);


		$start = "";
		$end = "";
		$type = "";
		$fname = "";
		$lname = "";
		$docs = "";
		while ($row = $result->fetch_assoc()) {
			$start = $row["StartTime"];
			$end = $row["EndTime"];
			$type = $row["OpnType"];
			$fname = $row["PFName"];
			$lname = $row["PLName"];
			$docs = $row["Docs"];
		}

		$output .= "<p>Edit Operation (OpNum = " . $_GET["opnum"] . "):</p><br>
					<table><form method=post>
					<input type=hidden name=create value=1>
					<tr><th>Start Time</th><th>End Time</th><th>OpnType</th><th>PFName</th><th>PLName</th><th>Docs</th></tr>
					<tr>
					<td><input type=time name=StartTime value=" . $start . "></td>
					<td><input type=time name=EndTime value=" . $end . "></td>
					<td><input maxlength=15 type=text name=OpnType value='" . $type . "'></td>
					<td><input maxlength=15 type=text name=PFName value='" . $fname . "'></td>
					<td><input maxlength=15 type=text name=PLName value='" . $lname . "'></td>
					<td><input maxlength=15 type=text name=Docs value='" . $docs . "'></td>
					</tr>
					<tr><td colspan=6><button type=submit>Update</button></form></td></tr>
					</table>";

		$output .= "";

		
	}
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