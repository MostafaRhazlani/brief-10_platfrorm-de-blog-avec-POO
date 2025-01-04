<?php
    require_once __DIR__ . "/CRUDController.php";

    $db = new DB();

    class UserController {
        private $id;
        private $username;
        private $email;
        private $password;
        private $role;
        private $imageProfile;

        public function __construct($id = "", $username = "", $email = "", $password = "", $role = "", $imageProfile = "") {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->imageProfile = $imageProfile;
        }

        public function createUser() {
        
            $crud = new CRUDContoller("users", ["username", "email", "password", "role", "imageProfile"], "", "", [$this->username, $this->email, $this->password, $this->role, $this->imageProfile]);
            return $crud->create();

        }

        public function index() {
            $crud = new CRUDContoller("users", "*");

            return $crud->select();
        }

        public function getUser() {
            $crud = new CRUDContoller("users", "id", "id", $this->id);

            return $crud->conditionSelect();
        }

        public function destroy() {
            $crud = new CRUDContoller("users", "", "id", $this->id);

            return $crud->destroy();
        }
    }

?>