<?php
    require_once('../../../../isLogged/isOwner.php');
    require __DIR__ . '/../../../../controllers/TagController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idTag = $_POST['idTag'];
        $nameTag = $_POST['nameTag'];
        $idCategory = $_POST['idCategory'];

        $updateTag = new TagController($idTag, $nameTag, $idCategory);

        if($updateTag->update()) {
            header('location: tags.php');
        }
    }


?>