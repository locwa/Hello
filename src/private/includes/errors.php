<?php
    $error_text = "";
    /**
     * Errors pertaining to the signup page
     *
     * @param int $error The error code generated
     */
    function signupError(int $error){
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

    /**
     * Errors pertaining to the login page
     *
     * @param int $error The error code generated
     */
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

    /**
     * Generates the HTML of the error banner
     *
     * @param string $error The error text
     * @param int $token An integer that detects the error type
     * @return string The HTML code generated
     */
    function errorText (string $error, int $token){
        if ($token = 0){
            $error_banner = '<div class="signup-banner error-banner">';
        }
        else if ($token = 1){
            $error_banner = '<div class="login-banner error-banner">';
        }
        return $error_banner . '<p><span class="bold">Error: </span>'. $error .'</p></div>';
    }
