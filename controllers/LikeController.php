<?php
    require_once __DIR__ . '/CRUDController.php';

    class LikeController {
        private $idArticle;
        private $idUser;


        public function __construct($idArticle = "", $idUser = ""){
            $this->idArticle = $idArticle;
            $this->idUser = $idUser;
        }

        public function totalUserLike() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(id) FROM likearticle WHERE idUser = $this->idUser AND idArticle = $this->idArticle");
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

        public function totalLikes() {
            $totalLikes = new CRUDContoller("likearticle");

            return $totalLikes->count();
        }
    }

?>