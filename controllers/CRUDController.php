<?php
    require_once __DIR__ . '/../connectdb/connectiondb.php';

    class CRUDContoller {
        private $nameTable;
        private $columns;
        private $values;

        public function __construct($nameTable = "", $columns = [], $values = []) {
            $this->nameTable = $nameTable;
            $this->columns = $columns;
            $this->values = $values;
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

    }

?>