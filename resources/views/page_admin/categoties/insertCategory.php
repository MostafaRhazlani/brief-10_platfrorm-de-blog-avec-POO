<?php
    require __DIR__ . '/../../../../controllers/CategoryController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nameCategory = $_POST['nameCategory'];

        $storeCategory = new CategoryController("", $nameCategory);

        if($storeCategory->store()) {
            header('location: categories.php');
        }
    }

?>