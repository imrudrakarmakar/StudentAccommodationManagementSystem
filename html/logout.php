<?php 

    session_start();
    // Destroy php session
    session_destroy();
    // Redirect to login page
    header("location:login.php");
?>