<?php
    require_once('../../../connectdb/connectiondb.php');

    // get all names in input
    $content = isset($_POST['content']) ? $_POST['content'] : 0;
    $idArticle = isset($_POST['idArticle']) ? $_POST['idArticle'] : 0;
    $idUser = isset($_POST['idUser']) ? $_POST['idUser'] : 0;

    var_dump($idArticle, $idUser);

    // insert new comment
    $insertComment = mysqli_prepare($conn, "INSERT INTO comments(content, idArticle, idUser) VALUES(?,?,?)");
    mysqli_stmt_bind_param($insertComment, "sii", $content, $idArticle, $idUser);
    if(mysqli_stmt_execute($insertComment)) {
        header("location: detailsArticle.php?idArticle=$idArticle");
    }
?>