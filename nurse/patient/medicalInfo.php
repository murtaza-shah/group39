<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

$connection = getConnection();

logout("n_id");

$output = "";

if (isset($_GET["ahc"])) {
	if (isset($_POST["allergies"]) && isset($_POST["crntmeds"]) && isset($_POST["hconds"])) {
		$allergies = $_POST["allergies"];
		$crntmeds = $_POST["crntmeds"];
		$hconds = $_POST["hconds"];

		$sql = "UPDATE MedicalInfo 
				SET Allergies = '" . $allergies . "', CrntMeds = '" . $crntmeds . "', HConds = '" . $hconds . "'  
				WHERE PAHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);
		if ($result) {
			$output .= "<p>Patient (AHC = " . $_GET["ahc"] . ") Medical Info Updated</p>";
		}
		
	} else {
		$sql = "SELECT *
				FROM MedicalInfo
				WHERE PAHC = " . $_GET["ahc"] . ";";

		$result = $connection->query($sql);

		$allergies = "";
		$crntmeds = "";
		$hconds = "";

		//echo $result->num_rows;
		if ($result->num_rows == 0) {
			$sql = "INSERT INTO MedicalInfo (PAHC) VALUES ('" . $_GET["ahc"] . "');";
			$result = $connection->query($sql);
		} else {
			while ($row = $result->fetch_assoc()) {
				$allergies = $row["Allergies"];
				$crntmeds = $row["CrntMeds"];
				$hconds = $row["HConds"];
			}
		}


		$output .= "<p>Patient (AHC = " . $_GET["ahc"] . ") Medical Info:</p><br>
				<form method='post'>
				<label for=allergies>Allergies:</label><textarea maxlength=15 style=resize:none; id=allergies name=allergies>" . $allergies . "</textarea><br>
				<label for=crntmeds>Current Medicine:</label><textarea maxlength=15 style=resize:none; id=crntmeds name=crntmeds>" . $crntmeds . "</textarea><br>
				<label for=hconds>Health Conditions:</label><textarea maxlength=15 style=resize:none; id=hconds name=hconds>" . $hconds . "</textarea><br>
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