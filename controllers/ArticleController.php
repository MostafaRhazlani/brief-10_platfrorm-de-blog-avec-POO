<?php
    require_once __DIR__ . '/CRUDController.php';
    class ArticleController {

        public function index() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT articles.*, users.username FROM articles JOIN users ON users.id = articles.idUser");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }



?>