<?php
session_start();

if (isset($_SESSION['check']) && $_SESSION['check'] == true){

}
else{
    include_once("../private/includes/homepage.php");
}