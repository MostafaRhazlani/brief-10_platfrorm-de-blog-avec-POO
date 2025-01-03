<?php
    require_once __DIR__ . "/CRUDController.php";

    $db = new DB();

    class UserController {
        private $username;
        private $email;
        private $password;
        private $role;
        private $imageProfile;

        public function __construct($username = "", $email = "", $password = "", $role = "", $imageProfile = "") {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->imageProfile = $imageProfile;
        }

        public function createUser() {
        
            $crud = new CRUDContoller("users", ["username", "email", "password", "role", "imageProfile"], [$this->username, $this->email, $this->password, $this->role, $this->imageProfile]);
            return $crud->create();

        }
    }

?>;