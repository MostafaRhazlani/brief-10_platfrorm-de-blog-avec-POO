<?php
    session_start();
    require_once __DIR__ . "/../controllers/CRUDController.php";

    $crud = new CRUDContoller("users", "id", "role", 0);

    $getUser = $crud->conditionSelect();
    if(!isset($_SESSION['user']) || $_SESSION['user']['id'] != $getUser['id']) {
        header('location:/resources/views/blog/blog.php');
    }
?>