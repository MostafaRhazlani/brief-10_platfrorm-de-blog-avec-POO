<?php
    require_once __DIR__ . '/CRUDController.php';

    class CommentController {
        private $content;
        private $idArticle;
        private $idUser;

        public function __construct($content = "", $idArticle = "", $idUser = ""){
            $this->content = $content;
            $this->idArticle = $idArticle;
            $this->idUser = $idUser;
        }

        public function index() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT comments.*, email, username, imageProfile, role FROM comments JOIN users ON users.id = comments.idUser WHERE idArticle = $this->idArticle ORDER BY id DESC");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function store() {
            $insertComment = new CRUDContoller("comments", ['content', 'idArticle', 'idUser'], "", "", [$this->content, $this->idArticle, $this->idUser]);

            return $insertComment->create();
        }

        public function totalComments() {
            $totalComments = new CRUDContoller("comments");

            return $totalComments->count();
        }
    }


?>