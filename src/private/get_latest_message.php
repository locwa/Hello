<?php
    include("../private/includes/hello_api.php");
    session_start();
    error_reporting(E_ALL ^ E_WARNING);

    $id = $_SESSION["id"];
    $conv_id = $_POST["c"];

    if ($conv_id) {
        $messages = new Messages();
        $returned_values = $messages->getLatestMessagesReceived($conv_id);
        $received_message = $returned_values['text_content'];
        $sender_id = $returned_values['sender_id'];
        $received_message_id = $returned_values['message_id'];

        if (($sender_id != $id) && ($_SESSION["msg_id"] != $received_message_id) && ($returned_values !== false)) {
            echo "
                  <div class='chat received'>
                      <div class='bubble-received'>
                          <p class='chat-text'>".$received_message."</p>
                      </div>
                  </div>
                ";
            $_SESSION["msg_id"] = $received_message_id;
        }

    }



