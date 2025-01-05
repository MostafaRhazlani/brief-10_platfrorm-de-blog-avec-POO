<?php
    require_once __DIR__ . '/CRUDController.php';
    class ArticleController {
        private $id;
        private $title;
        private $content;
        private $image;
        private $idUser;
        private $idTag;

        public function __construct($id = "", $title = "", $content = "", $image = "", $idUser = "", $idTag = []) {
            $this->id = $id;
            $this->title = $title;
            $this->content = $content;
            $this->image = $image;
            $this->idUser = $idUser;
            $this->idTag = $idTag;
        }

        public function index() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT articles.*, users.username FROM articles JOIN users ON users.id = articles.idUser");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function store() {
            $create = new CRUDContoller("articles", ['title', 'content', 'image', 'idUser'], "", "", [$this->title, $this->content, $this->image, $this->idUser]);

            $result = $create->create();

            return $result;
        }

        public function lastArticleAdded() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT id FROM articles ORDER BY id DESC LIMIT 1");

            return $result->fetch();
        }

        public function storeTags() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->prepare("INSERT INTO tags_articles(idArticle, idTag) VALUES(?,?)");
            foreach($this->idTag as $tag) {
                $params = [$this->id, $tag];
                $result->execute($params);
            }
        }
    }



?>