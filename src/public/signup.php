<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $page_name = "Signup | Hello";
    include_once("../private/includes/header.php");
    session_start();
    if(isset($_SESSION['check']) && $_SESSION['check'] == true){
        header("location: inbox.php");
        exit;
    }
?>
</head>
<body class="registration">
    <div class="registration-container">
        <h1 class="black-text">Sign up</h1>
        <hr class="signup-black-divider">
        <form action="../private/registration.php" method="post" class="registration-form">
            <div class="name-input-container">
                <input type="text" name="fname" placeholder="First Name" class="name input">
                <input type="text" name="lname" placeholder="Last Name" class="name input">
            </div>
            <input type="email" name="email" placeholder="E-mail Address" class="input">
            <input type="password" name="password" placeholder="Password" class="input">
            <p class="black-text xs label">Birthday</p>
            <div class="birthdate">
                <select name="month" class="dropdown">
                    <option value="" disabled selected>Month</option>
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
                <select name="day" class="dropdown">
                    <option value="" disabled selected>Day</option>
                    <?php 
                        for ($i = 1; $i <= 31; $i++){
                            echo '<option value="' . $i . '">' . $i . '</option>';      
                        }
                    ?>
                </select>
                <select name="year" class="dropdown">
                    <option value="" disabled selected>Year</option>
                    <?php
                        for ($i = intval(date("Y")); $i >= 1900; $i--){
                            echo '<option value="' . $i . '">' . $i . '</option>'; 
                        }
                    ?>
                </select>
            </div>
            <p class="black-text xs label">Gender</p>
            <select name="gender" class="dropdown">
                <option value="" disabled selected>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
            </select>
            <p class="black-text xs label">By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.</p>
            <button type="submit" class="signup-btn register">Sign up</button>
        </form>
    </div>    
</body>
</html>