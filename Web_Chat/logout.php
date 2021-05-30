<?php
session_start();

// Unset all of the session variables.
unset($_SESSION['IsAdmin']);
unset($_SESSION['ID']);
unset($_SESSION['IsAdmin']);
unset($_SESSION['loggedin']);
// Finally, destroy the session.
session_destroy();

// Include URL for Login page to login again.
header("Location: login.php");
?>