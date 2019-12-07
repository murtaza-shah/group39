<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

logout("n_id");

$connection = getConnection();

$output = "";

$ahc = $_GET["ahc"];

$output .= "<p>Viewing Patient (AHC = " . $ahc . ")</p>";
$output .= "<a href='./remove.php?ahc=" . $ahc . "'><button>Remove Patient</button></a>";
$output .= "<a href='./edit.php?ahc=" . $ahc . "'><button>Edit Patient</button></a>";
$output .= "<a href='./editTime.php?ahc=" . $ahc . "'><button>Waiting Time</button></a>";
$output .= "<a href='./medicalInfo.php?ahc=" . $ahc . "'><button>Medical Info</button></a>";
$output .= "<a href='./session.php?ahc=" . $ahc . "'><button>Fetch Session</button></a>";
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
		<?php echo $output; ?>
	</div>

</body>

</html>