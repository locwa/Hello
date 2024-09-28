<?php
    include_once("dbconnect.php");
    $id = $_SESSION["id"];
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];

    $query =   "SELECT DISTINCT
                    c.conversation_id, a.id, a.first_name, a.last_name
                FROM
                    accounts a
                INNER JOIN
                    conversations c ON c.user1 = a.id OR c.user2 = a.id
                WHERE 
                    (
                        (a.first_name <> ?) 
                        OR (a.last_name <> ?)
                    ) 
                    AND 
                    (
                        (c.user1 = ?) 
                        OR (c.user2 = ?)
                    )
                ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name, $last_name, $id, $id]);
    $conversations = $stmt->fetchAll();
    for ($i = 0; $i < $stmt->rowCount(); $i++){
        echo "
        <div class='conversation'>
                <h4 class='sm'>" . $conversations[$i]['first_name'] . " " . $conversations[$i]['last_name'] . "</h4>
                <p class='xs'>message</p>
        </div>
            ";
    }  
?>