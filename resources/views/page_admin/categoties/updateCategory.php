<?php
    require_once('../../../../isLogged/isOwner.php');
    require __DIR__ . '/../../../../controllers/CategoryController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idCategory = $_POST['idCategory'];
        $nameCategory = $_POST['nameCategory'];

        $updateCategory = new CategoryController($idCategory, $nameCategory);

        if($updateCategory->update()) {
            header('location: categories.php');
        }
    }

?>