<?php
    include_once ("../private/includes/hello_api.php");
    session_start();

    $conversations = new Conversation();
    $code = $_GET["code"];

    $conversations->deleteNewConversationCode($code);