<?php
    require_once __DIR__ . '/CRUDController.php';

    class CategoryController {
        private $id;
        private $nameCategory;

        public function __construct($id = "", $nameCategory = "") {
            $this->id = $id;
            $this->nameCategory = $nameCategory;
        }

        public function index() {
            $getAll = new CRUDContoller("categories", "*");

            $result = $getAll->select();
            return $result;
        }

        public function store() {
            $create = new CRUDContoller("categories", ["nameCategory"], "", "", [$this->nameCategory]);

            $result = $create->create();

            return $result;
        }

        public function update() {
            $update = new CRUDContoller("categories", "nameCategory", "id", $this->id, [$this->nameCategory]);

            $result = $update->update();

            return $result;
        }
    }

?>