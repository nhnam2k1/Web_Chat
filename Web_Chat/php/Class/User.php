<?php
    class User
    {
        private int $id;
        private string $firstName;
        private string $lastName;
        private string $gender;
        private string $birthDate;
        private string $email;

        public function __construct($id, $firstName, $lastName, $gender, $birthDate, $email)
        {
            $this->id = $id;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->gender = $gender;
            $this->birthDate = $birthDate;
            $this->email = $email;
        }

        public function GetID(){
            return $this->id;
        }

        public function GetFirstName(){
            return $this->firstName;
        }

        public function GetLastName(){
            return $this->lastName;
        }

        public function GetGender(){
            return $this->gender;
        }

        public function GetBirthDate(){
            return $this->birthDate;
        }
        
        public function GetEmail(){
            return $this->email;
        }
    }
?>