<?php
session_start();

if (isset($_SESSION['check']) && $_SESSION['check'] == true){
    header("inbox.php");
    exit();
}
else{
    header("../private/includes/homepage.php");
    exit();
}