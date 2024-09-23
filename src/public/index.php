<?php
session_start();

if (isset($_SESSION['check']) && $_SESSION['check'] == true){
    header("Location: inbox.php");
    exit();
}
else{
    header("Location: homepage.php");
    exit();
}