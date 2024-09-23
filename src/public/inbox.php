<?php
    if(!isset($_SESSION["check"]) || $_SESSION["check"] == false){
        header("Location: ./");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../private/includes/header.php");?>
<body>
    

</body>
</html>