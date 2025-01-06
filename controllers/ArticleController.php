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

            $result = $conn->query("SELECT articles.*, users.username, users.email, users.imageProfile FROM articles JOIN users ON users.id = articles.idUser");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function store() {
            $create = new CRUDContoller("articles", ['title', 'content', 'image', 'idUser'], "", "", [$this->title, $this->content, $this->image, $this->idUser]);

            $result = $create->create();

            return $result;
        }

        public function getArticle() {
            $getOne = new CRUDContoller("articles", "*", "id", $this->id);

            return $getOne->conditionSelect();
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

        public function getTagsOfArticle() {
            $db = new DB();
            $conn = $db->connect();

            $result = $conn->query("SELECT tags.nameTag FROM tags_articles 
                                    JOIN tags ON tags.id = tags_articles.idTag WHERE tags_articles.idArticle = $this->id");
            return $result;
        }

        public function destroy() {
            $destroy = new CRUDContoller("articles", "", "id", $this->id);

            return $destroy->destroy();
        }
    }



?>