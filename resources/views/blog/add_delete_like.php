<?php
    session_start();

    require_once __DIR__ . '/../../../controllers/LikeController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $idUser = $_SESSION['user']['id'];
        $idArticle = $_POST['idArticle'];
        $currentPage = $_POST['currentPath'];
        $redirectPage = '/resources/views/blog/blog.php';
    
        $likes = new LikeController($idArticle, $idUser);
        $totalUserLike = $likes->totalUserLike();
    
        if($totalUserLike == 0) {
            $insertLike = new LikeController($idArticle, $idUser);

            if($insertLike->store()) {
                if($currentPage === $redirectPage) {
                    header('location: blog.php');
                } else {
                    header("location: detailsArticle.php?idArticle=$idArticle");
                }
            }
        } else {
            $deleteLike = new LikeController($idArticle, $idUser);

            if($deleteLike->destroy()) {
                if($currentPage === $redirectPage) {
                    header('location: blog.php');
                } else {
                    header("location: detailsArticle.php?idArticle=$idArticle");
                }
            }
        } 
    }

?>