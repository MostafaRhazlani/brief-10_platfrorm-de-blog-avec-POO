<?php
    require_once('../../../../connectdb/connectiondb.php');

    $nameCategory = isset($_POST['category']) ? $_POST['category'] : '';

    $insertCategory = mysqli_prepare($conn, "INSERT INTO categories(nameCategory) VALUES(?)");

    mysqli_stmt_bind_param($insertCategory, 's', $nameCategory);

    if(mysqli_stmt_execute($insertCategory)) {
        header('location: categories.php');
    }

?>