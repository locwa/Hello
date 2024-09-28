<?php
    require_once("./includes/dbconnect.php");
    session_start();

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        if ($email && $pwd){
            $stmt = $pdo->prepare("SELECT email, pwd, id, first_name, last_name FROM accounts WHERE email = ? AND pwd = ?");
            $stmt->execute([$email, $pwd]);
            $user_cred = $stmt->fetch();
            if ($user_cred){
                $_SESSION["check"] = true;
                $_SESSION["id"] = $user_cred["id"];
                $_SESSION["first_name"] = $user_cred["first_name"];
                $_SESSION["last_name"] = $user_cred["last_name"];
                header("Location: ../public/inbox.php");
                exit();
            }
            else {
                header("Location: ../public/homepage.php");
                exit();
            }
        }
        else {
            header("Location: ../public/homepage.php");
        }
    }
    else if (isset($_POST['signup'])){
        header("Location: ../public/signup.php");
    }