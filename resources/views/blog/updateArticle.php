<?php
    
    session_start();
    require_once('../../../connectdb/connectiondb.php');
    
    // get all names in input
    
    if(isset($_POST['idArticle'])) {
        $idArticle = $_POST['idArticle'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $idCategory = isset($_POST['idCategory']) ? $_POST['idCategory'] : [];
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
        $imageTamp = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
        $folder = '../../img/images/'. $image;
        
        $deleteCategories = mysqli_prepare($conn, "DELETE FROM tags WHERE idArticle = ?");
        mysqli_stmt_bind_param($deleteCategories, "i", $idArticle);
        mysqli_stmt_execute($deleteCategories);
    
        
        $insertCategory = mysqli_prepare($conn, "INSERT INTO tags (idArticle, idCategory) VALUES (?,?)");
        foreach ($idCategory as $category) {
            mysqli_stmt_bind_param($insertCategory, "ii", $idArticle, $category);
            mysqli_stmt_execute($insertCategory);
        }

        if(move_uploaded_file($imageTamp, $folder)) {
            $updateArticle = mysqli_prepare($conn, "UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?");
            mysqli_stmt_bind_param($updateArticle, "sssi", $title, $content, $image, $idArticle);
            if(mysqli_stmt_execute($updateArticle)) {
    
                header('location: blog.php');
            }
        }
    }
?>