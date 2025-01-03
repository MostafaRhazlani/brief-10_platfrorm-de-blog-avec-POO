<?php
    require_once('../../../../isLogged/isOwner.php');
    require_once('../../../../connectdb/connectiondb.php');

    if(isset($_POST['idCategory'])) {
        $idCategory = $_POST['idCategory'];
        $nameCategory = $_POST['nameCategory'];

        $updateCategory = mysqli_prepare($conn, "UPDATE categories SET nameCategory = ? WHERE id = ?");
        
        mysqli_stmt_bind_param($updateCategory, 'si', $nameCategory, $idCategory);
        if(mysqli_stmt_execute($updateCategory)) {

            header('location: categories.php');
        }
    }

?>