<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $page_name = "Hello | A messaging app";
    include_once("../private/includes/header.php");
    session_start();
    if(isset($_SESSION['check']) && $_SESSION['check'] == true){
        header("location: inbox.php");
        exit;
    }
?>
</head>
<body>
    
</body>
</html>