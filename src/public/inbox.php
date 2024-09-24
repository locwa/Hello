<?php
    session_start();
    if(!isset($_SESSION["check"]) || $_SESSION["check"] !== true){
        header("Location: ./");
        exit();
    }
    $page_name = "Inbox | Hello";
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../private/includes/header.php");?>
<body class="inbox">
    <nav class="message navbar">
        <h1>h</h1>
    </nav>
    <div class="message msg-list">
        <h1 class="heading">Chats</h1>
        <form action="../private/logout.php" method="post">
            <button>Logout</button>
        </form>
    </div>
    <div class="message msg-contents">
        <h1>hi</h1>
    </div>
</body>
</html>