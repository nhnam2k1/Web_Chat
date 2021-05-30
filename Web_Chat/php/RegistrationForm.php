<?php
    session_start();

    include_once('Controller/LoginController.php');
    include_once('Controller/ProfileController.php');
    include_once('Class/User.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        try
        {
            $loginController = new LoginController();
            $profileController = new ProfileController();

            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $rePassworrd = $_POST['ConfirmPassword'];
            $fname = $_POST['FirstName'];
            $lname = $_POST['LastName'];
            $gender = $_POST['Gender'];
            $birthdate = $_POST['Birthdate'];
            $email = $_POST['Email'];

            $loginController->RegisterLogin($username, $password, $rePassworrd);
            $result = $loginController->CheckLogin($username, $password);
            $profileController->CreateNewProfile(new User($result['ID'], $fname, $lname, $gender, $birthdate, $email));
            
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