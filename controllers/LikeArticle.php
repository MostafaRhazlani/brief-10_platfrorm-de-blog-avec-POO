<?php
    require_once __DIR__ . '/LikeController.php';

    class LikeArticle extends LikeController {
        private $idArticle;

        public function __construct($idArticle = "", $idUser = "") {
            parent::__construct($idUser);
            $this->idArticle = $idArticle;
        }

        public function totalUserLike() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(id) FROM likearticle WHERE idArticle = $this->idArticle AND idUser = $this->idUser");
            return $result->fetchColumn();
        }

        public function store() {
            $create = new CRUDContoller("likearticle", ["idArticle", "idUser"], "", "", [$this->idArticle, $this->idUser]);

            $result = $create->create();

            return $result;
        }

        public function destroy() {
            $db = new DB();
            $conn = $db->connect();

            $params = [$this->idArticle, $this->idUser];
            $result = $conn->prepare("DELETE FROM likearticle WHERE idArticle = ? AND idUser = ?");

            return $result->execute($params);
        }

        public function totalLikesArticle() {
            $db = new DB();
            $conn = $db->connect();
            $totalLikes = $conn->query("SELECT count(id) FROM likearticle WHERE idArticle = $this->idArticle");

            return $totalLikes->fetchColumn();
        }
    }

?>