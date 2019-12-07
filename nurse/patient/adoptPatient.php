<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

logout("n_id");

$connection = getConnection();

if (isset($_POST["ahc"])) {
	$sql = "INSERT INTO Checks (PAHC, NurseID) VALUES (" . $_POST["ahc"] . ", " . $_SESSION["n_id"] . ");";
	$result = $connection->query($sql);
}

$output = "";

$output = "<table>";
$output .= "<tr><th>AHC</th><th>FName</th><th>LName</th><th>Adopt</th></tr>";

$sql = "SELECT *
		FROM Patient p
		WHERE p.AHC NOT IN (SELECT PAHC
							FROM Checks
							WHERE NurseID = " . $_SESSION["n_id"] . ");";

$result = $connection->query($sql);

while ($row = $result->fetch_assoc()) {
	$output .= "<tr>";
	$output .= "<td>" . $row["AHC"] . "</td>";
	$output .= "<td>" . $row["FName"] . "</td>";
	$output .= "<td>" . $row["LName"] . "</td>";
	$output .= "<td><form method='post'><input type=hidden name=ahc value=" . $row["AHC"] . "><button type=submit>Adopt</button></form></td>";
	$output .= "</tr>";
}

$output .= "</table>";

$output .= "<a href='./createPatient.php'><button>Create Patient</button></a><br><br><a href='./home.php'><button>Back</button></a>";

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
		<p>Viewing All Patients</p>
		<?php echo $output; ?>
		
	</div>

</body>

</html>