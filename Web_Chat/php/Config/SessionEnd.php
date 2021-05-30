<?php
	// Rememeber me
	// If user wants to be remembered, keep his session as long as he's logged in

	// If not remove his session after 1 hour
	if(isset($_SESSION['ID']) && isset($_SESSION['loggedIn']) == false)
	{
		$current_time = time();
		if($current_time - $_SESSION['loginTime'] >= 3600)
		{
			session_start();

			// Unset all of the session variables.
			unset($_SESSION['IsAdmin']);
			unset($_SESSION['ID']);
			unset($_SESSION['IsAdmin']);
			unset($_SESSION['loggedin']);
			// Finally, destroy the session.
			session_destroy();

			// Include URL for Login page to login again.
			header("Location: $mainPath/login.php");
		}
	}
?>