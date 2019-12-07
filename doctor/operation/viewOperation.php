<?php
include "../../scripts/connection.php";
include "../../scripts/logout.php";

logout("d_id");

$connection = getConnection();

$output = "";

$opnum = $_GET["opnum"];

if (isset($opnum)) {
	$output .= "<p>Viewing Operation (OpNum = " . $opnum . ")</p>";
	$output .= "<a href='./remove.php?opnum=" . $opnum . "'><button>Remove Operation</button></a>";
	$output .= "<a href='./edit.php?opnum=" . $opnum . "'><button>Edit Operation</button></a>";
	$output .= "<a href='./doctors.php?opnum=" . $opnum . "'><button>Operation Doctors</button></a>";
}
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