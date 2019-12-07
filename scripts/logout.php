<?php
session_start();

function resetUser() {
	header("Location: http://groupthirtynine.scienceontheweb.net/");
	session_unset();
	session_destroy();
	die();
}

// "Logs out" the user by clearing their session and returning them to the home page.
function logout($session) {
	if (!isset($_SESSION[$session])) {
		resetUser();	
	}
}
?>