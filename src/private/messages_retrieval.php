<?php
    include_once("../private/includes/hello_api.php");
    session_start();
    $conv_id = $_GET['c'];

    $messages = new Messages();
    $row_count = $messages->getMessages($conv_id)->rowCount();
    $message_roll = $messages->getMessages($conv_id)->fetchAll();
    if ($row_count === 0) {
        echo "<div id='emptyMessage'>
                    <p>Wow, such empty.</p>
              </div>
              ";
    }
    else{
        $_SESSION["msg_id"] = $message_roll[0]["message_id"];
        for($i = 0; $i<$row_count; $i++){
            $sender_id = $message_roll[$i]['sender_id'];
            $text_content = $message_roll[$i]['text_content'];
            if ($sender_id != $_SESSION['id']) {
                echo "
                  <div class='chat received'>
                      <div class='bubble-received'>
                          <p class='chat-text'>".$text_content."</p>
                      </div>
                  </div>
            ";
            }
            else{
                echo " 
                <div class='chat sent'>
                    <div class='bubble-sent'>
                        <p class='chat-text'>".$text_content."</p>
                    </div>
                </div>
                ";
            }
        }
    }

