<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/login.php');
?>