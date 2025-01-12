<?php
    session_start();

    require_once __DIR__ . '/../../../controllers/LikeArticle.php';
    require_once __DIR__ . '/../../../controllers/likeComment.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if(isset($_POST['likeComment'])) {
            $idUser = $_SESSION['user']['id'];
            $idArticle = $_POST['idArticle'];
            $idComment = $_POST['idComment'];
        
            $likes = new LikeComment($idComment, $idUser);
            $totalUserLike = $likes->totalUserLike();
        
            if($totalUserLike == 0) {
                $insertLike = new LikeComment($idComment, $idUser);
    
                if($insertLike->store()) {
                    header("location: detailsArticle.php?idArticle=$idArticle");
                }
            } else {
                $deleteLike = new LikeComment($idComment, $idUser);
    
                if($deleteLike->destroy()) {
                    header("location: detailsArticle.php?idArticle=$idArticle");
                }
            } 
        } else if(isset($_POST['likeArticle'])) {
            $idUser = $_SESSION['user']['id'];
            $idArticle = $_POST['idArticle'];
            $currentPage = $_POST['currentPath'];
            $redirectPage = '/resources/views/blog/blog.php';
        
            $likes = new LikeArticle($idArticle, $idUser);
            $totalUserLike = $likes->totalUserLike();
        
            if($totalUserLike == 0) {
                $insertLike = new LikeArticle($idArticle, $idUser);
    
                if($insertLike->store()) {
                    if($currentPage === $redirectPage) {
                        header('location: blog.php');
                    } else {
                        header("location: detailsArticle.php?idArticle=$idArticle");
                    }
                }
            } else {
                $deleteLike = new LikeArticle($idArticle, $idUser);
    
                if($deleteLike->destroy()) {
                    if($currentPage === $redirectPage) {
                        header('location: blog.php');
                    } else {
                        header("location: detailsArticle.php?idArticle=$idArticle");
                    }
                }
            } 
        }

    }

?>