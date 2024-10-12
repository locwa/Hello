<?php
    include_once("./includes/hello_api.php");
    session_start();
    $id = $_SESSION["id"];
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];
    $conv_id = $_POST["c"];
    $limit = $_POST["limit"];
    $search_value = $_POST["searchValue"];
    $toggle = (int)$_POST["toggle"];

    $conversation = new Conversation();
    $row_count = $conversation->fetchConversations($first_name, $last_name, $id, $limit, $toggle, $search_value)->rowCount();
    $conversation_list = $conversation->fetchConversations($first_name, $last_name, $id, $limit, $toggle, $search_value)->fetchAll();

    if ($row_count === 0) {
        echo "<p>There are no conversations yet.</p>";
    }
    else{
        for ($i = 0; $i < $row_count; $i++){
            $conversations_fname = $conversation_list[$i]['first_name'];
            $conversations_lname = $conversation_list[$i]['last_name'];
            $conversations_id = $conversation_list[$i]['conversation_id'];
            $other_id = $conversation_list[$i]['id'];

            $sent_message = $conversation->messagePreview($conversations_id);
            $msg_preview = "";
            $sender_id = "";
            // Shows preview message
            if ($sent_message == false){
                $msg_preview = "<p class='xs italic'>There are no messages yet.</p>";
            }
            else{
                $msg_preview = "<p class='xs'>".$sent_message['text_content']."</p>";
                $sender_id = $sent_message['sender_id'];
            }

            // Checks if latest message is sent by the user
            if($sender_id == $id){
                $msg_preview = "You: ".$sent_message['text_content'];
            }

            // Checks if conversation is selected
            if ($conv_id == $conversations_id) {
                echo "<a href='#' id='".$conversations_id."' class='conversation active' onclick='getConvID(this.id, $other_id)'>";
            }
            else{
                echo "<a href='#' id='".$conversations_id."' class='conversation' onclick='getConvID(this.id, $other_id)'>";
            }
            echo "
                <h4 class='sm'>".$conversations_fname." ".$conversations_lname."</h4>
                <p class='xs'>".$msg_preview."</p>
            ";
        }
    }