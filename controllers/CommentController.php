<?php
    require_once __DIR__ . '/CRUDController.php';

    class CommentController {
        private $id;
        private $content;
        private $idArticle;
        private $idUser;

        public function __construct($id = "", $content = "", $idArticle = "", $idUser = ""){
            $this->id = $id;
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

        public function totalCommentsArticle() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(id) FROM comments WHERE idArticle = $this->idArticle");
            return $result->fetchColumn();
        }

        public function getComment() {
            $getOne = new CRUDContoller("comments", ['id', 'content'], "id", $this->id);
            
            return $getOne->conditionSelect();
        }
        
        public function update() {
            $updateComment = new CRUDContoller("comments", ['content'], "id", $this->id, [$this->content]);

            return $updateComment->update();
        }

        public function destroy() {
            $deletComment = new CRUDContoller("comments", "", "id", $this->id);
            return $deletComment->destroy();
        }

        public function totalComments() {
            $totalComments = new CRUDContoller("comments");

            return $totalComments->count();
        }
    }


?>