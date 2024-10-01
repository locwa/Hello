<?php
    include_once("./includes/hello_api.php");
    session_start();
    $id = $_SESSION["id"];
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];


    $conversation = new Conversation();
    $row_count = $conversation->fetchConversations($first_name, $last_name, $id)->rowCount();
    $conversation_list = $conversation->fetchConversations($first_name, $last_name, $id)->fetchAll();

    for ($i = 0; $i < $row_count; $i++){
        $conversations_fname = $conversation_list[$i]['first_name'];
        $conversations_lname = $conversation_list[$i]['last_name'];
        $conversations_id = $conversation_list[$i]['conversation_id']; 
        $sender_id = $conversation_list[$i]['id'];

        $sent_message = $conversation->messagePreview($conversations_id);
        $msg_preview = $sent_message['text_content'];
        $sender_id = $sent_message['sender_id'];

        if($sender_id == $id){
            $msg_preview = "You: ".$sent_message['text_content'];
        }
        echo($_GET['c']);
        echo "
        <a id='".$conversations_id."' class='conversation'>
                <h4 class='sm'>".$conversations_fname." ".$conversations_lname."</h4>
                <p class='xs'>".$msg_preview."</p>
        </a>
            ";
    }  
?>