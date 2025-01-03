<?php
require_once('../../../../connectdb/connectiondb.php');
    if(isset($_POST['idUser'])) {
        $idUser = $_POST['idUser'];
        $idRole = $_POST['idRole'];

        var_dump($idUser, $idRole);
        $updateRole = mysqli_prepare($conn, "UPDATE users SET idRole = ? WHERE id = ?");

        mysqli_stmt_bind_param($updateRole, 'ii', $idRole, $idUser);

        if(mysqli_stmt_execute($updateRole)) {
            if($idRole == 1) {
                header('location: users.php');
            } else {
                require_once('../../auth/logout.php');
            }
        }
    }
?>