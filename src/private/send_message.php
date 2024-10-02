<?php
    include("../private/includes/hello_api.php");
    session_start();

    $sender_id = $_SESSION["id"];
    $message = $_POST['m'];
    $recipient_id = $_POST['oid'];
    $conversation_id = $_POST['c'];

    $messages_obj = new Messages();
    $is_sent = $messages_obj->sendMessage($sender_id, $recipient_id, $message ,$conversation_id);

    echo " 
            <div class='chat sent'>
                <div class='bubble-sent'>
                    <p class='chat-text'>".$message."</p>
                </div>
            </div>
            ";