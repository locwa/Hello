<?php
    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        echo $email . " " . $pwd;
    }
    if (isset($_POST['signup'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        echo $email . " " . $pwd;
    }