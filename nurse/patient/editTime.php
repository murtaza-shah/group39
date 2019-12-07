<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("n_id");

$output = "";

if (isset($_GET["ahc"])) {
	if (isset($_POST["waittime"])) {
		$time .= $_POST["waittime"];
		if (strlen($time) == 5) {
			$time .= ":00";
		}

		$sql = "UPDATE WaitTime 
				SET waitTime = '" . $time . "'
				WHERE PAHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);
		if ($result) {
			$output .= "<p>Patient (AHC = " . $_GET["ahc"] . ") Wait Time Updated</p>";
		}
		
	} else {
		$sql = "SELECT waitTime
				FROM WaitTime
				WHERE PAHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);

		$time = "00:00:00";

		//echo $result->num_rows;
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO WaitTime (PAHC, waitTime) VALUES ('" . $_GET["ahc"] . "', '" . $time . "');";
			$result = $connection->query($sql);
		} else {
			while ($row = $result->fetch_assoc()) {
				$time = $row["waitTime"];
			}
		}


		$output .= "<p>Edit Patient (AHC = " . $_GET["ahc"] . ") Wait Time:</p><br>
				<form method='post'>
				<label for='waittime'>Waiting Time:</label><input type='time' name='waittime' step='1' value=" . $time . ">
				<br>
				<button type='submit'>Update</button>
				</form>";
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