<?php
    require_once __DIR__ . '/../../../controllers/ArticleController.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idArticle = $_POST['idArticle'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $idTag = $_POST['idTag'];
        $image = $_FILES['image']['name'];
        $imageTamp = $_FILES['image']['tmp_name'];
        $folder = '../../img/images/'. $image;
        
        // delete all tags before update article
        $deleteTags = new ArticleController($idArticle);
        $deleteTags->destroyTagsOfArticle();
        
        // insert new tags before update article
        $insertTags = new ArticleController($idArticle, "", "", "", "" , $idTag);
        $insertTags->storeTags();
    
        // update article after delete old tags and insert new tags
        move_uploaded_file($imageTamp, $folder);
        $updateArticle = new ArticleController($idArticle, $title, $content, $image);
        if($updateArticle->update()) {
            header('location: blog.php');
        }
    }
?>