<?php
session_start();

if (isset($_SESSION['check']) && $_SESSION['check'] == true){
    include_once("../public/inbox.php");
}
else{
    include_once("../private/includes/homepage.php");
}