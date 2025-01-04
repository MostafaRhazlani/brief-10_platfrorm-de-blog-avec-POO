<?php
    class DB {
        private $servername;
        private $username;
        private $password;
        private $dbName;
    
        public function __construct() {
            $config = require __DIR__ . '/info.php';
    
            $this->servername = $config['servername'];
            $this->username = $config['username'];
            $this->password = $config['password'];
            $this->dbName = $config['dbName'];
        }
    
        public function connect() {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
                return $conn;
                } catch (PDOException $error) {
                echo "Connection failed: " . $error->getMessage();
            }
        }
    }
    

?>