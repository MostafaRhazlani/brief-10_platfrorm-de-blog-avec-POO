<?php
    require_once __DIR__ . '/../connectdb/connectiondb.php';

    class CRUDContoller {
        private $nameTable;
        private $columns;
        private $leftCompare;
        private $rightCompare;
        private $values;

        public function __construct($nameTable = "", $columns = [], $leftCompare = "", $rightCompare = "", $values = []) {
            $this->nameTable = $nameTable;
            $this->columns = $columns;
            $this->leftCompare = $leftCompare;
            $this->rightCompare = $rightCompare;
            $this->values = $values;
        }

        public function conditionSelect() {
            $db = new DB();
            $conn = $db->connect();

            if(is_array($this->columns)) {
                $columns = implode(", ", $this->columns);
            } else {
                $columns = $this->columns;
            }
            
            $result = $conn->query("SELECT $columns FROM $this->nameTable WHERE $this->leftCompare = '$this->rightCompare'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function select() {
            $db = new DB();
            $conn = $db->connect();

            if(is_array($this->columns)) {
                $columns = implode(", ", $this->columns);
            } else {
                $columns = $this->columns;
            }
            
            $result = $conn->query("SELECT $columns FROM $this->nameTable");

            return $result->fetchObject();
        }

        // method create
        public function create() {
            $db = new DB();
            $conn = $db->connect();
            $columns = implode(", ", $this->columns);

            $placeholders = [];
            for ($i = 0; $i < count($this->columns); $i++) { 
                $placeholders[] = '?';
            }
            $placeholders = implode(", ", $placeholders);
            
            $params = $this->values;
            $result = $conn->prepare("INSERT INTO $this->nameTable($columns) VALUES($placeholders)");

            return $result->execute($params);
        }

        public function count() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(*) FROM $this->nameTable");

            return $result->fetchColumn();
        }

    }

?>