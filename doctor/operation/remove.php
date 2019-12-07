<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";


$connection = getConnection();

logout("d_id");

$output = "";

if (isset($_POST["remove"]) && isset($_GET["opnum"])) {
	$sql = "DELETE FROM Operation 
			WHERE OpNum = " . $_GET["opnum"] . ";";

	$result = $connection->query($sql);
	
	header("Location: http://groupthirtynine.scienceontheweb.net/doctor/operation/home.php");
}

$output .= "<form method='post'><input type='hidden' name='remove' value='1'><button type='submit'>Remove Operation</button></form>";
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