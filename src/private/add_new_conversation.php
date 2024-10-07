<?php
    include_once ("../private/includes/hello_api.php");
    session_start();

    $conversations = new Conversation();

    $code = $_GET["code"];
    $user1 = $_SESSION['id'];
    $res = $conversations->getSenderIDFromCode($code)[0];
    $user2 = $res['sender_id'];

    $conversations->addNewConversation($user1, $user2);

    echo "<h1>".var_dump($user2)."</h1>";
