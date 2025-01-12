<?php
    require_once __DIR__ . '/LikeController.php';

    class LikeComment extends LikeController {
        private $idComment;

        public function __construct($idComment = "", $idUser = "") {
            parent::__construct($idUser);
            $this->idComment = $idComment;
        }

        public function totalUserLike() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT count(id) FROM likeComment WHERE idComment = $this->idComment AND idUser = $this->idUser");
            return $result->fetchColumn();
        }

        public function store() {
            $create = new CRUDContoller("likeComment", ["idComment", "idUser"], "", "", [$this->idComment, $this->idUser]);

            $result = $create->create();

            return $result;
        }

        public function destroy() {
            $db = new DB();
            $conn = $db->connect();

            $params = [$this->idComment, $this->idUser];
            $result = $conn->prepare("DELETE FROM likeComment WHERE idComment = ? AND idUser = ?");

            return $result->execute($params);
        }

        public function totalLikesComment() {
            $db = new DB();
            $conn = $db->connect();
            $totalLikes = $conn->query("SELECT count(id) FROM likeComment WHERE idComment = $this->idComment");

            return $totalLikes->fetchColumn();
        }
    }

?>