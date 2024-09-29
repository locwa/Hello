<?php
    if (isset($_POST['signup'])){
        include_once("../private/includes/hello_api.php");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthdate = $_POST['year'] . $_POST['month'] . $_POST['day'];
        $gender = $_POST['gender'];
        
        $accounts = new Accounts();
        $accounts->register($fname, $lname, $email, $password, $birthdate, $gender);
    }
?>
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
        <form action="signup.php" method="post" class="registration-form">
            <h1 class="black-text">Sign up</h1>
            <hr class="signup-black-divider">
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
                    <option value="01">January</option>
                    <option value="02">Feburary</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="day" class="dropdown">
                    <option value="" disabled selected>Day</option>
                    <?php 
                        for ($i = 1; $i <= 31; $i++){
                            if ($i < 10){
                                $i = "0" . $i;
                            }
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
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                    <option value="2">Other</option>
            </select>
            <p class="black-text xs label">By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.</p>
            <button type="submit" name="signup" class="signup-btn register">Sign up</button>
        </form>
    </div>    
</body>
</html>