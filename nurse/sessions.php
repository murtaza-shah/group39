<?php
include "../scripts/connection.php";
include "../scripts/logout.php";

logout("n_id");

$connection = getConnection();

if (isset($_POST["SessionID"])) {
	$sid = $_POST["SessionID"];

	$sql = "SELECT AHC
			FROM Patient
			WHERE SessionID = " . $sid . ";";
	$result = $connection->query($sql);

	$ahc = "";
	while ($row = $result->fetch_assoc()) {
		$ahc = $row["AHC"];
	}

	header("Location: http://groupthirtynine.scienceontheweb.net/nurse/patient/session.php?ahc=" . $ahc);
}

$output = "";

$output = "<table>";
$output .= "<tr><th>Session ID</th><th>Room</th><th>Treatment Provided</th><th>Dr ID</th><th>Visit</th></tr>";

$sql = "SELECT S.*
		FROM Session S INNER JOIN NurseHas N ON S.SessionID = N.SessionID
		WHERE N.NurseID = " . $_SESSION["n_id"] . ";";

$result = $connection->query($sql);

while ($row = $result->fetch_assoc()) {
	$output .= "<tr>";
	$output .= "<td>" . $row["SessionID"] . "</td>";
	$output .= "<td>" . $row["Room"] . "</td>";
	$output .= "<td>" . $row["TProvided"] . "</td>";
	$output .= "<td>" . $row["DrID"] . "</td>";
	$output .= "<td><form method=post><input hidden name=SessionID value=" . $row["SessionID"] . "><button type=submit>Visit</button></form></td>";
	$output .= "</tr>";
}

$output .= "</table>";

$output .= "<br><a href='./home.php'><button>Back</button></a>";

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
		<p>Viewing My Sessions</p>
		<?php echo $output; ?>
		
	</div>

</body>

</html>