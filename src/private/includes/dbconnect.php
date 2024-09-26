<?php
    $user = "root";
    $pwd = "";
    $host = "localhost";
    $dbname = "hello";

    $dsn = "mysql:host=". $host .";dbname=". $dbname;

    // connectton to database
    try{
        $pdo = new PDO($dsn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo "connection failed:". $e->getMessage();
    }
