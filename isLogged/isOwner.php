<?php
    session_start();
    require_once __DIR__ . "/../controllers/CRUDController.php";

    // $user = new CRUDContoller("users", "*", "role", 1);

    // $getUser = $user->conditionSelect();

    // var_dump($getUser);
    // foreach($getUser as $user) {
    //     var_dump($user['id']);
    // }
    // var_dump(va);
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
        header('location:/resources/views/blog/blog.php');

    }
?>