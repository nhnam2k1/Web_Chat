<?php
    include_once("Class/User.php");
    include_once("Class/Admin.php");
    include_once("DatabaseConfig.php");

    class ProfileModel
    {
        private DatabaseConfig $dbConfig;
        private string $tbName;
        private $conn;

        public function __construct()
        {
            $this->dbConfig = new DatabaseConfig();
            $this->tbName = "profile";
            $this->conn = $this->dbConfig->GetConnection();
        }

        public function GetProfileFromDatabase(int $id)
        {
            $sql = "SELECT First_Name, Last_Name, Gender, BirthDate, Email FROM $this->tbName WHERE ID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = null;
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return $result;
        }

        public function GetNamesFromDatabase()
        {
            $sql = "SELECT ID, concat(First_Name,' ',Last_Name) AS fullname FROM $this->tbName";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = null;
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll();
            }

            return $result;
        }

        public function CreateProfileToDatabase(User $profile)
        {
            $sql = "INSERT INTO $this->tbName (ID, First_Name, Last_Name, Gender, BirthDate, Email) 
                    VALUES (:id, :fname, :lname, :gender, :birthdate, :email);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fname', $profile->GetFirstName());
            $stmt->bindParam(':lname', $profile->GetLastName());
            $stmt->bindParam(':gender', $profile->GetGender());
            $stmt->bindParam(':birthdate', $profile->GetBirthDate());
            $stmt->bindParam(':email', $profile->GetEmail());
            $stmt->bindParam(':id', $profile->GetID());
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }

        public function UpdateProfileToDatabase(User $profile)
        {
            $sql = "UPDATE $this->tbName SET First_Name = :fname, Last_Name = :lname, 
                    Gender = :gender, BirthDate = :birthdate, Email = :email WHERE ID = :id;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fname', $profile->GetFirstName());
            $stmt->bindParam(':lname', $profile->GetLastName());
            $stmt->bindParam(':gender', $profile->GetGender());
            $stmt->bindParam(':birthdate', $profile->GetBirthDate());
            $stmt->bindParam(':email', $profile->GetEmail());
            $stmt->bindParam(':id', $profile->GetID());
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }
    }
?>