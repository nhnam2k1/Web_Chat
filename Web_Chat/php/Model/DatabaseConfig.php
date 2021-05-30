<?php
    class DatabaseConfig{
        private string $servername;
        private string $username;
        private string $password;
        private string $dbname;
        private $conn;

        public function __construct(){
            $this->servername = "studmysql01.fhict.local";
            $this->username = "dbi435906";
            $this->password = "Rene1995";
            $this->dbname = "dbi435906";
            $this->conn = new PDO("mysql:host=studmysql01.fhict.local;dbname=dbi435906", "dbi435906", "Rene1995");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function GetConnection(){
            return $this->conn;
        }
    }
?>