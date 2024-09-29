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
        <form action="../private/logout.php" method="post">
            <button>out</button>
        </form>
    </nav>
    <div class="message msg-list">
        <div class="msg-list-content">
            <div class="inbox-header">
                <h1 class="heading">Chats</h1>
                <div class="new-chat-button">
                    <svg  
                        xmlns="http://www.w3.org/2000/svg"  
                        width="24"  
                        height="24"  
                        viewBox="0 0 24 24"  
                        fill="none"  
                        stroke="currentColor"  
                        stroke-width="2"  
                        stroke-linecap="round"  
                        stroke-linejoin="round"  
                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-circle-plus">
                        <path 
                            stroke="none" 
                            d="M0 0h24v24H0z" 
                            fill="none"
                        />
                        <path 
                            d="M12.007 19.98a9.869 9.869 0 0 1 -4.307 -.98l-4.7 1l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c1.992 1.7 2.93 4.04 2.747 6.34" 
                        />
                        <path 
                            d="M16 19h6" 
                        />
                        <path 
                            d="M19 16v6" 
                        />
                    </svg>
                </div>
            </div>
            <input type="text" name="inbox-search" placeholder="Search" class="inbox-search"> 
            <div class="conversation-list">
                <?php include("../private/includes/conversations_retrieval.php"); ?>
            </div>
        </div>    
    </div>
    <div class="message msg-contents">
        <div class="message-header">
            <div class="recepient-details">
                <h4 class="sm">Jane Doe</h4>
                <p class="xs">online</p>
            </div>  
        </div>
        <div class="message-roll">
            <div class="chat received">
                <div class="bubble-received">
                    <p class="chat-text">hi</p>
                </div>
            </div>
            <div class="chat sent">
                <div class="bubble-sent">
                    <p class="chat-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi eveniet aperiam doloribus rem nam aut? Perferendis, asperiores placeat eveniet temporibus sequi consectetur. Tenetur similique sapiente repudiandae provident debitis! Nam, vitae!</p>
                </div>
            </div>
        </div>
        <div class="message-input">
            <div class="send-inputs">
                <svg  
                    xmlns="http://www.w3.org/2000/svg"  
                    width="22"  
                    height="22"  
                    viewBox="0 0 24 24"  
                    fill="none"  
                    stroke="currentColor"  
                    stroke-width="2"  
                    stroke-linecap="round"  
                    stroke-linejoin="round"  
                    class="upload-button attach">
                    <path 
                        stroke="none" 
                        d="M0 0h24v24H0z" 
                        fill="none"
                    />
                    <path 
                        d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" 
                    />
                </svg>
                <svg  
                    xmlns="http://www.w3.org/2000/svg"  
                    width="22"  
                    height="22"  
                    viewBox="0 0 24 24"  
                    fill="none"  
                    stroke="currentColor"  
                    stroke-width="2"  
                    stroke-linecap="round"  
                    stroke-linejoin="round"  
                    class="upload-button attach">
                    <path 
                        stroke="none" 
                        d="M0 0h24v24H0z" 
                        fill="none"
                    />
                    <path 
                        d="M15 8h.01" 
                    />
                    <path 
                        d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" 
                    />
                    <path 
                        d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" 
                    />
                    <path 
                        d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" 
                    />
                </svg>
                <input class="message-draft" type="text" name="message" placeholder="Aa">
                <svg  
                    xmlns="http://www.w3.org/2000/svg"  
                    width="24"  
                    height="24"  
                    viewBox="0 0 24 24"  
                    fill="none"  
                    stroke="currentColor"  
                    stroke-width="2"  
                    stroke-linecap="round"  
                    stroke-linejoin="round"  
                    class="upload-button send">
                    <path 
                        stroke="none" 
                        d="M0 0h24v24H0z" 
                        fill="none"
                    />
                    <path 
                        d="M10 14l11 -11" 
                    />
                    <path 
                        d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" 
                    />
                </svg>
            </div>
        </div>
    </div>
</body>
</html>