<?php
    include_once("../private/includes/hello_api.php");
    session_start();
    if(!isset($_SESSION["check"]) || $_SESSION["check"] !== true){
        header("Location: ./");
        exit();
    }

    $id = $_SESSION["id"];
    $page_name = "Conversation Code | Hello";
    $conversation = new Conversation();
    $otp = $conversation->generateNewConversationCode($id);

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../private/includes/header.php");?>
<body>
    <div class="code-container">
        <h4>One-time Code</h4>
        <h1 class="xl" id="code"><?php echo $otp;?></h1><br>
        <p class="xs">The code will regenerate in <span class="bold"><span id="time"></span> Seconds</span></p><br>
        <p class="xs">Please close this window you're done</p>
    </div>
    <script src="js/code_generation.js"></script>
</body>
</html>

