<?php
    include_once("../private/includes/session_check.php");
    $page_name = "Inbox | Hello";
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../private/includes/header.php");?>
<body>
    <h1>Hello</h1>
    <form action="../private/logout.php" method="post">
        <button>Logout</button>
    </form>
</body>
</html>