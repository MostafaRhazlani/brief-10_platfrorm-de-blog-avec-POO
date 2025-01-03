<?php
    session_start();

    session_destroy();
    header('location: /resources/views/blog/blog.php')
?>