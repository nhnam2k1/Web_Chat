<?php
    include_once('Controller/LoginController.php');

    session_start();
    
	if (isset($_SESSION['loggedin']) == false && basename($_SERVER['PHP_SELF']) != 'login.php') 
    {
		//echo 'No session was found, redirect to login';
		// Not logged in
		// Redirect to login
		header("location: login.php");
	}

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        try
        {
            $loginController = new LoginController();
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $result = $loginController->CheckLogin($username, $password);
            $_SESSION['ID'] = $result['ID'];
            $_SESSION['IsAdmin'] = $result['IsAdmin'];
            $_SESSION['loggedin']  = true;

            $_SESSION['loginTime'] = time();
            http_response_code(200);
            $result['error'] = "";
            echo json_encode($result);
        }
        catch(Exception $e)
        {
            http_response_code(403);
            $error['error'] = $e->GetMessage();
            echo json_encode($error);
        }
    }
?>