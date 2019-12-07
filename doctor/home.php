<?php
include "../scripts/logout.php";

logout("d_id");

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
		<p>Doctor Homepage</p>
		<a href="./edit.php"><button>Edit Information</button></a>
		<a href="./remove.php"><button>Remove Self</button></a>
		<a href="./operation/home.php"><button>View My Operations</button></a>
		<a href="./operation/waitlist.php"><button>View Waitlist</button></a>
		<br>
		<form method=post><input hidden name=logout value=1><button type=submit>Logout</button></form></a>
	</div>

</body>

</html>