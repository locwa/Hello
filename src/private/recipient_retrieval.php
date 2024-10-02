<?php
    include_once("../private/includes/hello_api.php");
    session_start();

    $id = $_SESSION["id"];
    $conv_id = $_GET['c'];
    $messages = new Messages();
    $recipient_name = $messages->getRecepientName($conv_id, $id)->fetchAll();

    echo "
            <div class='recipient-details'>
                <h4 class='sm'>".$recipient_name[0]['first_name']." ".$recipient_name[0]['last_name']."</h4>
                <p class='xs'>online</p>
            </div>  
    ";
