<?php
    if (isset($_POST['signup'])){
        include_once("../private/includes/dbconnect.php");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthdate = $_POST['year'] . $_POST['month'] . $_POST['day'];
        $gender = $_POST['gender'];
        $joindate = date('Y-m-d H:i:s e');
        
        $query = "INSERT INTO accounts (first_name, last_name, email, pwd, birthdate, gender, join_date) 
                  VALUES(?, ?, ?, ?, ?, ?, UTC_TIMESTAMP())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$fname, $lname, $email, $password, $birthdate, $gender]);
        header("Location: ../public/homepage.php");
    }