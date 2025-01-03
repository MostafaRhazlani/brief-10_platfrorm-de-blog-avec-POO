<?php
    session_start();
    require_once __DIR__ . "/../controllers/CRUDController.php";

    $crud = new CRUDContoller("users", "*", "role", 1);

    $getUser = $crud->conditionSelect();

    if(!isset($_SESSION['user']) || $_SESSION['user'] != $getUser[0]['id']) {
        header('location:/resources/views/blog/blog.php');
    }
?>