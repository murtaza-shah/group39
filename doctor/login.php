<?php
include "../scripts/connection.php";

$connection = getConnection();

$output = "<table><tr><th>Login</th><th>Doctor ID</th><th>FName</th><th>LName</th></tr>";

$sql = "SELECT * FROM Doctor";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$id = $row["DrID"];
		$output .= "<tr>";
		$output .= "<td><form action='../session.php' method='post'><input type='text' name='d_id' value='" . $id . "' hidden><input type='submit' value='Login'></form></td>";
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

	<div id="content">
		<?php echo $output; ?>
		<br>
		<a href="../index.php"><button>Back</button></a>
	</div>


</body>
</html>