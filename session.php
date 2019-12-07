<?php
session_start();

if (isset($_POST["n_id"])) {
	session_unset();
	$_SESSION["n_id"] = $_POST["n_id"];
	header("Location: http://groupthirtynine.scienceontheweb.net/nurse/home.php");
	die();
} else if (isset($_POST["d_id"])) {
	session_unset();
	$_SESSION["d_id"] = $_POST["d_id"];
	header("Location: http://groupthirtynine.scienceontheweb.net/doctor/home.php");
	die();
} else if (!isset($_SESSION["n_id"]) && !isset($_SESSION["d_id"])) {
	// "Logout"
	session_unset();
	session_destroy();
	header("Location: http://groupthirtynine.scienceontheweb.net/");
	die();
}


?>

<html>
<head>
	<title>Group 39 - Project</title>
	<link rel="stylesheet" href="../style.css" type="text/css">
</head>
</html>