<?php

    session_start();
    require_once('../../../connectdb/connectiondb.php');
    $idUser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
    $idArticle = isset($_POST['idArticle']) ? $_POST['idArticle'] : 0;
    $currentPage = isset($_POST['currentPath']) ? $_POST['currentPath'] : '';
    $redirectPage = '/resources/views/blog/blog.php';

    $getLikes = mysqli_query($conn, "SELECT * FROM likes WHERE idUser = $idUser AND idArticle = $idArticle");
    $userLike = mysqli_num_rows($getLikes);

    var_dump($currentPage, $redirectPage);
    if($userLike == 0) {
        $insertLike = mysqli_prepare($conn, "INSERT INTO likes(idUser, idArticle) VALUES(?,?)");
        mysqli_stmt_bind_param($insertLike, 'ii', $idUser, $idArticle);
    
        if(mysqli_stmt_execute($insertLike)) {
            if($currentPage === $redirectPage) {
                header('location: blog.php');
            } else {
                header("location: detailsArticle.php?idArticle=$idArticle");
            }
            exit;
        }
    } else {
        $deleteLike = mysqli_prepare($conn, "DELETE FROM likes WHERE idUser = ? AND idArticle = ?");
        mysqli_stmt_bind_param($deleteLike, 'ii', $idUser, $idArticle);
    
        if(mysqli_stmt_execute($deleteLike)) {
            if($currentPage === $redirectPage) {
                header('location: blog.php');
            } else {
                header("location: detailsArticle.php?idArticle=$idArticle");
            }
            exit;
        }
    } 
?>