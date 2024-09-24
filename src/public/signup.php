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
    <div class="registration-container">
        <form action="../private/registration.php" method="post">
            <input type="text" name="fname">
            <input type="text" name="lname">
            <input type="email" name="email">
            <input type="password" name="password">
            <div class="birthdate">
                <select name="month">
                    <option value="january">January</option>
                    <option value="feburary">Feburary</option>
                    <option value="march">March</option>
                    <option value="april">April</option>
                    <option value="may">May</option>
                    <option value="june">June</option>
                    <option value="july">July</option>
                    <option value="august">August</option>
                    <option value="september">September</option>
                    <option value="october">October</option>
                    <option value="november">November</option>
                    <option value="december">December</option>
                </select>
                <select name="day">
                    <?php 
                        for ($i = 1; $i <= 31; $i++){
                            echo '<option value="' . $i . '">' . $i . '</option>';      
                        }
                    ?>
                </select>
                <select name="year">
                    <?php
                        for ($i = intval(date("Y")); $i >= 1900; $i--){
                            echo '<option value="' . $i . '">' . $i . '</option>'; 
                        }
                    ?>
                </select>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </form>
    </div>    
</body>
</html>