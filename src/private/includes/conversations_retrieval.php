<?php
    include_once("dbconnect.php");
    $id = $_SESSION["id"];

    $query =   "SELECT 
                    c.conversation_id, c.user1, a1.first_name, a1.last_name, c.user2, a2.first_name, a2.last_name
                FROM 
                    conversations c
                JOIN	
                    accounts a1 ON c.user1 = a1.id
                JOIN	
                    accounts a2 ON c.user2 = a2.id
                WHERE
                    c.user1 = ? OR c.user2 = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$id, $id]);
    $conversations = $stmt->fetch();
?>