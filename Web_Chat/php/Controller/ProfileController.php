<?php
    include_once("Class/User.php");
    include_once("Class/Admin.php");
    include_once("Model/ProfileModel.php");
    include_once("InputValidation.php");

    class ProfileController
    {
        private ProfileModel $profileModel;
        private InputValidation $inputValidation;

        public function __construct()
        {
            $this->profileModel = new ProfileModel();
            $this->inputValidation = new InputValidation();
        }

        public function GetProfile(int $id)
        {
            $id = $this->inputValidation->CleanData($id);
            $result = $this->profileModel->GetProfileFromDatabase($id);

            if ($result == null)
            {
                throw new Exception("Cannot find the user");
            }

            $user = new User($id, $result['First_Name'], $result['Last_Name'], $result['Gender'], $result['BirthDate'], $result['Email']);

            return $user;
        }

        private function GetCleanUserData(User $user)
        {
            $id = $user->GetID();
            $fname = $user->GetFirstName();
            $lname = $user->GetLastName();
            $gender = $user->GetGender();
            $birthDate = $user->GetBirthDate();
            $email = $user->GetEmail();

            $id = $this->inputValidation->CleanData($id);
            $fname = $this->inputValidation->CleanData($fname);
            $lname = $this->inputValidation->CleanData($lname);
            $gender = $this->inputValidation->CleanData($gender);
            $email = $this->inputValidation->CleanData($email);
            $birthDate = $this->inputValidation->CleanData($birthDate);
            $user = new User($id, $fname, $lname, $gender, $birthDate, $email);
            return $user;
        }

        public function CreateNewProfile(User $newProfile)
        {
            $user = $this->GetCleanUserData($newProfile);
            $result = $this->profileModel->CreateProfileToDatabase($user);

            if ($result == 0)
            {
                throw new Exception("Cannot create new user profile");
            }
        }

        public function UpdateProfile(User $oldProfile, User $newProfile)
        {
            $oldProfile = $this->GetCleanUserData($oldProfile);
            $newProfile = $this->GetCleanUserData($newProfile);
            
            if ($oldProfile->GetID() != $newProfile->GetID())
            {
                throw new Exception("The profile ID is not the same");
            }
            
            $result = $this->profileModel->UpdateProfileToDatabase($newProfile);
            if ($result == 0)
            {
                throw new Exception("Cannot update user profile");
            }
        }
    }
?>