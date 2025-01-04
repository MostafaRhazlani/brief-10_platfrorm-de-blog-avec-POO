<?php
    session_start();
    require __DIR__ . '/../../../controllers/UserController.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = 0;
        $imageProfile = $_FILES['imageProfile']['name'];
        $tempImageProfile = $_FILES['imageProfile']['tmp_name'];
        $folder = '../../img/images/'. $imageProfile;
        $countErrors = array();
        
    
        if(!empty($tempImageProfile)) {
            move_uploaded_file($tempImageProfile, $folder);
        } else {
            $imageProfile = 'default.png';
        }
    
        // check if input username is empty
        if(empty($username)) {
            $countErrors[] = 1;
            $_SESSION['emptyUsername'] = 'username field is required!';
    
        }
    
        // check if input email is empty
        if(empty($email)) {
            $countErrors[] = 1;
            $_SESSION['emptyEmail'] = 'email field is required!';
        }
    
        // check if form email is valid
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $countErrors[] = 1;
            $_SESSION['invalidEmail'] = 'form of email is invalid!';
        }
    
        // check if input password is empty
        if(empty($password)) {
            $countErrors[] = 1;
            $_SESSION['emptyPassword'] = 'password field is required!';
        }
    
        // check if user confirm password is empty
        if(empty($confirm_password)) {
            $countErrors[] = 1;
            $_SESSION['emptyConfirmPassword'] = 'confirm password field is required!';
        }
        
        // check if password and confirm password is same
        if($password != $confirm_password) {
            $countErrors[] = 1;
            $_SESSION['notSamePassword'] = 'password is not correct!';
        }
    
        if(count($countErrors) == 0) {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $user = new UserController("", $username, $email, $password_hashed, $role, $imageProfile);
    
            if($user->createUser()) {
                header('location: login.php');
            } else {
                echo "not registred";
            }
        } else {
            header('location:register.php');
        }
    }

?>