<?php
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user']['idRole'] != 1) {
        header('location:/resources/views/blog/blog.php');
    }
?>