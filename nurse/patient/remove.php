<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";


$connection = getConnection();

logout("n_id");

$output = "";

if (isset($_POST["remove"]) && isset($_GET["ahc"])) {
	$sql = "DELETE FROM Patient 
			WHERE AHC = " . $_GET["ahc"] . ";";

	$result = $connection->query($sql);
	
	header("Location: http://groupthirtynine.scienceontheweb.net/nurse/patient/home.php");
}

$output .= "<form method='post'><input type='hidden' name='remove' value='1'><button type='submit'>Remove Patient</button></form>";
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