<?php
    require_once("./includes/dbconnect.php");

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        if ($email && $pwd){
            $stmt = $pdo->prepare("SELECT email, pwd FROM accounts WHERE email = ? AND pwd = ?");
            $stmt->execute([$email, $pwd]);
            $user_cred = $stmt->fetch();
            if ($user_cred){
                echo "Success";
            }
            else {
                header("Location: ../public/homepage.php");
            }
        }
        else {
            header("Location: ../public/homepage.php");
        }
    }
    else if (isset($_POST['signup'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        echo $email . " " . $pwd;
    }