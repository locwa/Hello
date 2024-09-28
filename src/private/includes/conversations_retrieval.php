<?php
    include_once("dbconnect.php");
    include_once("message_api.php");
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

    // Executes the query for getting all conversations
    $pdo = new DBConnection();
    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name, $last_name, $id, $id]);
    $conversations = $stmt->fetchAll();

    // Message API for preview message in conversation list
    $conversation_details = new Conversation();

    for ($i = 0; $i < $stmt->rowCount(); $i++){
        $conversations_fname = $conversations[$i]['first_name'];
        $conversations_lname = $conversations[$i]['last_name'];
        $conversations_id = $conversations[$i]['conversation_id']; 
        $sender_id = $conversations[$i]['id'];

        $sent_message = $conversation_details->messagePreview($conversations_id);
        $msg_preview = $sent_message['text_content'];
        $sender_id = $sent_message['sender_id'];
        
        if($sender_id == $id){
            $msg_preview = "You: ".$sent_message['text_content'];
        }

        echo "
        <div class='conversation'>
                <h4 class='sm'>".$conversations_fname." ".$conversations_lname."</h4>
                <p class='xs'>".$msg_preview."</p>
        </div>
            ";
    }  
?>