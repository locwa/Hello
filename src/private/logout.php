<?php
    include_once("../private/includes/hello_api.php");
    session_start();
    if(!isset($_SESSION["check"]) || $_SESSION["check"] == true){
        $accounts = new Accounts();
        $res = $accounts->logout($_SESSION["id"]);
        if ($res){
            session_unset();
            session_destroy();
            header("Location: ../public/index.php");
            die();
        }
        else{
            echo "error";
        }
    }