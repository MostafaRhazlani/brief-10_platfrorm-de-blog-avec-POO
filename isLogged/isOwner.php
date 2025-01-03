<?php
    session_start();
    require_once __DIR__ . "/../controllers/CRUDController.php";

    $user = new CRUDContoller("users", "*", "role", 1);

    $getUser = $user->conditionSelect();

    if(!isset($_SESSION['user']) || $_SESSION['user']['id'] != $getUser['id']) {
        header('location:/resources/views/blog/blog.php');
    }
?>