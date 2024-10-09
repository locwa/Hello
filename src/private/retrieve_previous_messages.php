<?php
    include_once("../private/includes/hello_api.php");
    session_start();

    $conversation_id = $_POST['conversationID'];
    $offset = (int)$_POST['messageOffset'];

    $messages = new Messages();
    $get_previous_message = $messages->getPreviousMessages($conversation_id, $offset);
    $row_count = $get_previous_message->rowCount();
    $message_list = $get_previous_message->fetchAll();

    for ($i = 0; $i < $row_count; $i++) {
        $sender_id = $message_list[$i]['sender_id'];
        $text_content = $message_list[$i]['text_content'];
        if ($sender_id != $_SESSION['id']) {
            echo "
                      <div class='chat received'>
                          <div class='bubble-received'>
                              <p class='chat-text'>" . $text_content . "</p>
                          </div>
                      </div>
                ";
        } else {
            echo " 
                    <div class='chat sent'>
                        <div class='bubble-sent'>
                            <p class='chat-text'>" . $text_content . "</p>
                        </div>
                    </div>
                    ";
        }
    }
    if ($row_count !== 0){
        echo '<div id="loaderContainer"><div class="message-loader"></div></div>';
    }
    else{
        echo "<br>";
    }