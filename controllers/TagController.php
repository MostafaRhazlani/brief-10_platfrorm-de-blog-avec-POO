<?php
    require_once __DIR__ . '/CRUDController.php';

    class TagController {
        private $id;
        private $nameTag;
        private $idCategory;

        public function __construct($id = "", $nameTag = "", $idCategory = "") {
            $this->id = $id;
            $this->nameTag = $nameTag;
            $this->idCategory = $idCategory;
        }

        public function index() {
            $db = new DB();
            $conn = $db->connect();
            $result = $conn->query("SELECT * from tags JOIN categories on categories.id = tags.idCategory");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>