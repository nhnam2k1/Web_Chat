<?php
    include_once("DatabaseConfig.php");

    class LoginModel
    {
        private string $tbName;
        private $conn; 
        private DatabaseConfig $dbConfig;

        public function __construct()
        {
            $this->dbConfig = new DatabaseConfig();
            $this->conn = $this->dbConfig->GetConnection();
            $this->tbName = "user";
        }

        public function GetLoginFromDatabase(string $username, string $password)
        {
            $sql = "SELECT ID, IsAdmin, IsBlocked FROM $this->tbName WHERE Username = :username AND Password = :password;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $result = null;
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
        }

        public function CreateNewLoginToDatabase(string $newUsername, string $newPassword)
        {
            $sql = "INSERT INTO $this->tbName (Username, Password) VALUES (:username, :password);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':password', $newPassword);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }

        public function UpdateNewPasswordToDatabase(int $id, string $newPassword)
        {
            $sql = "UPDATE $this->tbName SET Password = :newPassword WHERE ID = :id;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }

        public function PromoteUserToAdmin($userID)
        {
            $sql = "UPDATE $this->tbName SET IsAdmin = '1' WHERE ID = :id;";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $userID);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }

        public function BlockUserFromLogin($userID)
        {
            $sql = "UPDATE $this->tbName SET IsBlocked = '1' WHERE ID = :id;";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $userID);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }
    }
?>