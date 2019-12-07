<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

logout("n_id");

$connection = getConnection();

if (isset($_POST["ahc"])) {
	$sql = "DELETE FROM Checks 
			WHERE PAHC = " . $_POST["ahc"] . ";";
	$result = $connection->query($sql);
}

$output = "";

$output = "<table>";
$output .= "<tr><th>AHC</th><th>FName</th><th>LName</th><th>SessionID</th><th>DrWaitlist</th><th>Relinquish</th></tr>";

$sql = "SELECT P.*
		FROM Patient P INNER JOIN Checks ON P.AHC = Checks.PAHC;";

$result = $connection->query($sql);

printf("Error: %s\n", $result->error);

while ($row = $result->fetch_assoc()) {
	$output .= "<tr class=tr onclick=\"window.location.href = 'http://groupthirtynine.scienceontheweb.net/nurse/patient/viewPatient.php?ahc=" . $row["AHC"] . "'\">";
	$output .= "<td>" . $row["AHC"] . "</td>";
	$output .= "<td>" . $row["FName"] . "</td>";
	$output .= "<td>" . $row["LName"] . "</td>";
	$output .= "<td>" . $row["SessionID"] . "</td>";
	$output .= "<td>" . $row["DrWaitList"] . "</td>";
	$output .= "<td><form method='post'><input type=hidden name=ahc value=" . $row["AHC"] . "><button type=submit>Relinquish</button></form></td>";
	$output .= "</tr>";
}

$output .= "</table>";

$output .= "<a href='./adoptPatient.php'><button>Adopt Patient</button></a><br><br><a href='../home.php'><button>Back</button></a>";

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
		<p>Viewing My Patients</p>
		<?php echo $output; ?>
		
	</div>

</body>

</html>