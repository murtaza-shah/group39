<?php
include "../scripts/logout.php";

logout("n_id");

if (isset($_POST["logout"])) {
	resetUser();
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

	<div class="content">
		<p>Nurse Homepage</p>
		<a href="./edit.php"><button>Edit Information</button></a>
		<a href="./remove.php"><button>Remove Self</button></a>
		<a href="./sessions.php"><button>View Sessions</button></a>
		<a href="./patient/home.php"><button>View My Patients</button></a>
		<br>
		<form method=post><input hidden name=logout value=1><button type=submit>Logout</button></form></a>
	</div>

</body>

</html>