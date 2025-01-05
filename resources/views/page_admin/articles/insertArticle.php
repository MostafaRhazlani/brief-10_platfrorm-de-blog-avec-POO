<?php
    require_once('../../../../isLogged/isOwner.php');
    require_once __DIR__ . '/../../../../controllers/ArticleController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $idUser = $_POST['idUser'];
        $idTag = $_POST['idTag'];
        $image = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];
        $folder = "../../../img/images" . $image;

        if(move_uploaded_file($tempName, $folder)) {
            $insertArticle = new ArticleController("", $title, $content, $image, $idUser);

            if($insertArticle->store()) {
                $article = new ArticleController();
                $lastArticle = $article->lastArticleAdded();

                $insertTags = new ArticleController($lastArticle['id'], "", "", "", "" , $idTag);

                $insertTags->storeTags();
                header('location: articles.php');
            }
        }
    }

?>