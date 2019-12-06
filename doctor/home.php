<?php
session_start();

if (!isset($_SESSION["d_id"])) {
	// "Logout"
	header("Location: http://groupthirtynine.scienceontheweb.net/");
	die();
}

?>

<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
	<div id="header">
		<h1>Hospital Management System</h1>
	</div>

	<div id="content">
		Doctor Homepage
	</div>

</body>

</html>