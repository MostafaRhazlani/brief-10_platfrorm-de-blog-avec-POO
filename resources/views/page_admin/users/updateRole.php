<?php

    require_once __DIR__ . '/../../../../connectdb/connectiondb.php';
    require_once __DIR__ . '/../../../../controllers/UserController.php';
    
    $db = new DB();
    $conn = $db->connect();

    if(isset($_GET['idUser'])) {
        $idUser = $_GET['idUser'];
        
        $user = new UserController($idUser);
        $getUser = $user->getUser();
        
        if($getUser['role'] == 1) {
            $updateUser = new UserController($idUser, "", "", "", 0);
            // $updateRole = $updateUser->update();
        } else {
            $updateUser = new UserController($idUser, "", "", "", 1);
        }
        
        $updateRole = $updateUser->updateRole();
        if($updateRole) {
            header('location: users.php');
        }
    }
?>