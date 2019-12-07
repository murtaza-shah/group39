<?php
include "../scripts/connection.php";

$connection = getConnection();

$output = "<table><tr><th>Login</th><th>Nurse ID</th><th>FName</th><th>LName</th></tr>";

$sql = "SELECT * FROM Nurse ORDER BY NurseID";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$id = $row["NurseID"];
		$output .= "<tr>";
		$output .= "<td><form action='../session.php' method='post'><input hidden name=n_id value='" . $id . "'><button type=submit>Login</button></form></td>";
		$output .= "<td>" . $id . "</td>";
		$output .= "<td>" . $row["FName"] . "</td>";
		$output .= "<td>" . $row["LName"] . "</td>";
		$output .= "</tr>";
	}
}

$output .= "</table>";

$connection->close();

?>

<html>
<head>
	<title>Group 39 - Project</title>
	<link rel="stylesheet" href="../style.css" type="text/css">
</head>
<body>

	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div class="content">
		<?php echo $output; ?>
		<br>
		<a href="../index.php"><button>Back</button></a>
	</div>


</body>
</html>