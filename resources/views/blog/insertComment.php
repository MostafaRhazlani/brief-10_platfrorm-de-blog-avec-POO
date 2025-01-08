<?php
    require_once __DIR__ . '/../../../controllers/CommentController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = $_POST['content'];
        $idArticle = $_POST['idArticle'];
        $idUser = $_POST['idUser'];

        $insertComment = new CommentController("", $content, $idArticle, $idUser);

        // insert new comment
        if($insertComment->store()) {
            header("location: detailsArticle.php?idArticle=$idArticle");
        }
    }

?>