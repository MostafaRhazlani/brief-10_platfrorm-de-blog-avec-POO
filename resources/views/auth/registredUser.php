<?php
    session_start();
    require __DIR__ . "/../../../controllers/UserController.php";    
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';


    $checkPassword = new CRUDContoller("users", "password", "email", $email);
    $resultUser = $checkPassword->conditionSelect();
    $countErrors = array();

    // check if input email is empty
    if(empty($email)) {
        $countErrors[] = 1;
        $_SESSION['emptyEmail'] = 'email field is required!';
    }

    if(!isset($resultUser)) {
        $countErrors[] = 1;
        $_SESSION['emailNotCorrect'] = 'email is not correct!';
    }

    // check if input password is empty
    if(empty($password)) {
        $countErrors[] = 1;
        $_SESSION['emptyPassword'] = 'password field is required!';
    }

    if(!password_verify($password, $resultUser['password'])) {
        $countErrors[] = 1;
        $_SESSION['passNotCorrect'] = 'password is not correct!';                      

    }

    if(count($countErrors) == 0) {

        $requiredColumns = new CRUDContoller("users", ["id", "role"], "email", $email);
        $columns = $requiredColumns->conditionSelect();
        
        if($columns['role'] == 1) {
            $_SESSION['user'] = $columns;
            header('location:/resources/views/page_admin/dashboard.php');
        } else {
            $_SESSION['user'] = $columns;
            header('location:/resources/views/blog/blog.php');
        }
    } else {
        header('location:login.php');
    }
?>