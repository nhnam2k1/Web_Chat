<?php
    include_once("Class/User.php");
    include_once("Class/Admin.php");
    include_once("Model/LoginModel.php");
    include_once("InputValidation.php");

    class LoginController{
        private LoginModel $loginModel;
        private InputValidation $inputValidation;

        public function __construct(){
            $this->loginModel = new LoginModel();
            $this->inputValidation = new InputValidation();
        }

        public function CheckLogin(string $username, string $password){
            $username = $this->inputValidation->CleanData($username);
            $password = $this->inputValidation->CleanData($password);
            $result = $this->loginModel->GetLoginFromDatabase($username, $password);
            
            if ($result == null)
            {
                throw new Exception("The username or password is not correct");
            }
            return $result;
        }

        public function RegisterLogin(string $username, string $password, string $confirmPassword){
            $username = $this->inputValidation->CleanData($username);
            $password = $this->inputValidation->CleanData($password);
            $confirmPassword = $this->inputValidation->CleanData($confirmPassword);

            if ($password != $confirmPassword)
            {
                throw new Exception("Confirm password should be the same as password");
            }

            $result = $this->loginModel->CreateNewLoginToDatabase($username, $password);
            if ($result == false)
            {
                throw new Exception("Cannot create new user login");
            }
        }
        
        public function UpdatePassword(int $id, string $newPassword, string $confirmPassword){
            $id = $this->inputValidation->CleanData($id);
            $newPassword = $this->inputValidation->CleanData($newPassword);
            $confirmPassword = $this->inputValidation->CleanData($confirmPassword);
            if ($newPassword != $confirmPassword)
            {
                throw new Exception("Confirm password should be the same as password");
            }

            $result = $this->loginModel->UpdateNewPasswordToDatabase($id, $newPassword);
            if ($result == false)
            {
                throw new Exception("Cannot update user password");
            }
        }
    }
?>