<?php
    require_once __DIR__ . '/CRUDController.php';

    class CommentController {
        private $idArticle;

        public function __construct($idArticle = ""){
            $this->idArticle = $idArticle;
        }

        public function index() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT comments.*, email, username, imageProfile, role FROM comments JOIN users ON users.id = comments.idUser WHERE idArticle = $this->idArticle ORDER BY id DESC");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function totalComments() {
            $totalComments = new CRUDContoller("comments");

            return $totalComments->count();
        }
    }


?>