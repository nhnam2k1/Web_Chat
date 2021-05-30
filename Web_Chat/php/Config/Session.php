<?php 
	// Start user session
	session_start();
    
	// If no session was found and the current page isn't login
	if (isset($_SESSION['loggedin']) == false && basename($_SERVER['PHP_SELF']) != 'login.php')
	{
		//echo 'No session was found, redirect to login';
		// Not logged in
		// Redirect to login
		header("location: $mainPath/login.php");
	}
?>