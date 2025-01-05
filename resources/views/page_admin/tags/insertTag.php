<?php
    require_once('../../../../isLogged/isOwner.php');
    require __DIR__ . '/../../../../controllers/TagController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nameTag = $_POST['nameTag'];
        $idCategory = $_POST['idCategory'];

        $insertTag = new TagController("", $nameTag, $idCategory);

        if($insertTag->store()) {
            header('location: tags.php');
        }
    }

?>