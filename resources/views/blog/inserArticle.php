<?php
    session_start();
    require_once('../../../connectdb/connectiondb.php');

    // get all names in input
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $idCategory = isset($_POST['idCategory']) ? $_POST['idCategory'] : [];
    $idUser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $tempName = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    $folder = '../../img/images/'.$image;

    // insert data of article
    if(move_uploaded_file($tempName, $folder)) {
        $insertArticle = mysqli_prepare($conn, "INSERT INTO articles(title, content, image, idUser) VALUES(?,?,?,?)");
        mysqli_stmt_bind_param($insertArticle, "sssi", $title, $content, $image, $idUser);
        if(mysqli_stmt_execute($insertArticle)) {
            
            // get id last article added
            $getidArticle = mysqli_query($conn, "SELECT id FROM articles ORDER BY id DESC LIMIT 1");
            $idArticle = mysqli_fetch_assoc($getidArticle);
        
            // insert id article and category in table tags
            $insertTag = mysqli_prepare($conn, "INSERT INTO tags(idArticle, idCategory) VALUES(?,?)");
    
            foreach($idCategory as $id) {
                mysqli_stmt_bind_param($insertTag, "ii", $idArticle['id'], $id);
                mysqli_stmt_execute($insertTag);
            }
    
            header('location: blog.php');
        }
    } else {
        echo "image not uploaded";
    }
?>