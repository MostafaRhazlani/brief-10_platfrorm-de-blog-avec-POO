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

        // method select with condition
        public function conditionSelect() {
            $db = new DB();
            $conn = $db->connect();

            if(is_array($this->columns)) {
                $columns = implode(", ", $this->columns);
            } else {
                $columns = $this->columns;
            }
            
            $result = $conn->query("SELECT $columns FROM $this->nameTable WHERE $this->leftCompare = '$this->rightCompare'");

            return $result->fetch();
        }

        // method select
        public function select() {
            $db = new DB();
            $conn = $db->connect();

            if(is_array($this->columns)) {
                $columns = implode(", ", $this->columns);
            } else {
                $columns = $this->columns;
            }
            
            $result = $conn->query("SELECT $columns FROM $this->nameTable");

            return $result->fetchAll(PDO::FETCH_ASSOC);
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

        // methode update
        public function update() {
            $db = new DB();
            $conn = $db->connect();

            
            if(is_array($this->columns)) {
                $arrayColumns = [];
                for ($i = 0; $i < count($this->columns); $i++) { 
                    $arrayColumns[] = $this->columns[$i] . " = ?";
                }
                $columns = implode(", ", $arrayColumns);
            } else {
                $columns = $this->columns . " = ?";
            }


            $params = $this->values;
            $result = $conn->prepare("UPDATE $this->nameTable SET $columns WHERE $this->leftCompare = '$this->rightCompare'");

            return $result->execute($params);
        }

        // method delete
        public function destroy() {
            $db = new DB();
            $conn = $db->connect();

            $params = [$this->rightCompare];
            $result = $conn->prepare("DELETE FROM $this->nameTable WHERE $this->leftCompare = ?");

            return $result->execute($params);
        }

        // methode to count rows
        public function count() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(*) FROM $this->nameTable");

            return $result->fetchColumn();
        }

    }

?>