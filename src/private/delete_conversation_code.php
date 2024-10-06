<?php
    include_once ("../private/includes/hello_api.php");
    session_start();

    $id = $_SESSION['id'];
    $conversations = new Conversation();
    $code = $_GET["code"];

    $conversations->deleteNewConversationCode($code);