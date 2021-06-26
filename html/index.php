<?php
    // Start php session
    session_start();
    // Set cookies 
    if(!isset($_SESSION['Userdata'])) {
        header("localhost:login.php");
        exit;
    }
?>

Hey, You're logged in!