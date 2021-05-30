<?php
    include_once("DatabaseConfig.php");

    class RoomModel
    {
        private DatabaseConfig $dbConfig;
        private string $tbName;
        private $conn;

        public function __construct()
        {
            $this->dbConfig = new DatabaseConfig();
            $this->tbName = "rooms";
            $this->conn = $this->dbConfig->GetConnection();
        }

        public function GetAllRooms(){
            $sql = "SELECT * FROM $this->tbName";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = null;
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll();
            }
            return $result;
        }

        public function CreateNewRoom($newRoom){
            $sql = "INSERT INTO $this->tbName (Name) VALUES (:newRoom);";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':newRoom', $newRoom);
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }
    }
?>