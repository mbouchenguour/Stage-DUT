<?php
    session_start();
    if(!isset($_SESSION["pseudo"])){
        header("Location: ../Login/login.php");
        exit(); 
    }
?>
