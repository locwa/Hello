<?php
    $error_text = "";
    function signupError($error){
        switch($error){
            case 1:
                $error_text = "Please fill in all the required fields.";
                break;
            case 2:
                $error_text = "Email is already taken.";
                break;
            case 3:
                $error_text = "There must be an error on our part.";
                break;
        }
        echo errorText($error_text, 0);
    }
    function loginError($error){
        switch($error){
            case 1:
                $error_text = "Please fill in all the required fields.";
                break;
            case 2:
                $error_text = "Invalid Username or Password.";
                break;

        }
        echo errorText($error_text, 1);
    }

    function errorText ($error, $token){
        if ($token = 0){
            $error_banner = '<div class="signup-banner error-banner">';
        }
        else if ($token = 1){
            $error_banner = '<div class="login-banner error-banner">';
        }
        return $error_banner . '<p><span class="bold">Error: </span>'. $error .'</p></div>';
    }
