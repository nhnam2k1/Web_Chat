<?php
    include_once('Controller/LoginController.php');
    include_once('Controller/ProfileController.php');
    include_once('Class/User.php');
    include_once('Class/Admin.php');

    session_start();
    try
    {
        $loginController = new LoginController();
        $profileController = new ProfileController();

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Edit function
            $newEmail = $_POST['newEmail'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword != "")
            {
                $id = $_SESSION['ID'];
                $loginController->UpdatePassword($id, $newPassword, $confirmPassword);
            }
            
            if ($newEmail != "")
            {
                $id = $_SESSION['ID'];
                $newUser = GetNewProfile($newEmail);
                $user = $profileController->GetProfile($id);
                $profileController->UpdateProfile($user, $newUser);
            }
            http_response_code(200);
            $result['error'] = "";
            echo json_encode($result);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            // Get Profile function
            $id = $_SESSION['ID'];
            $user = $profileController->GetProfile($id);
            $result['FirstName']    = $user->GetFirstName();
            $result['LastName']     = $user->GetLastName();
            $result['Gender']       = $user->GetGender();
            $result['Birthdate']    = $user->GetBirthDate();
            $result['Email']        = $user->GetEmail();
            $result['error'] = "";
            http_response_code(200);
            echo json_encode($result);
        }
    }
    catch(Exception $e)
    {
        http_response_code(403);
        $error['error'] = $e->GetMessage();
        echo json_encode($error);
    }

    function GetNewProfile($newEmail)
    {
        $profileController = new ProfileController();
        $id = $_SESSION['ID'];
        $user = $profileController->GetProfile($id);
        $newUser = new User($id, 
                            $user->GetFirstName(),
                            $user->GetLastName(),
                            $user->GetGender(),
                            $user->GetBirthDate(),
                            $newEmail
        );
        return $newUser;
    }
?>