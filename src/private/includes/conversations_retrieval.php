<?php
    include_once("dbconnect.php");
    $id = $_SERVER["id"];

    $query = "SELECT * FROM conversations WHERE user1 = ? OR user2 = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute($id, $id);
    
?>