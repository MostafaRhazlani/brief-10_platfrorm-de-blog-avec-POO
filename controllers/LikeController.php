<?php
    require_once __DIR__ . '/CRUDController.php';

    class LikeController {
        protected $idUser;


        public function __construct($idUser){
            $this->idUser = $idUser;
        }
    }

?>