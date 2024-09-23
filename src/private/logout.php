<?php
    session_start();
    if(!isset($_SESSION["check"]) || $_SESSION["check"] == true){
        session_unset();
        session_destroy();
        header("Location: ../public/index.php");
        die();
    }