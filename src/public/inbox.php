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
<script src="./js/scripts.js"></script>
<body>
    <div class="new-conversation-popup">
        <div class="popup-container">
            h
        </div>
    </div>
    <div class="inbox">
        <nav class="message navbar">
            <div class="nav-button-group">
                <div class="nav-button-container">
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="nav-button chats">
                        <path
                                stroke="none" d="M0 0h24v24H0z" fill="none"
                        />
                        <path
                                d="M5.821 4.91c3.899 -2.765 9.468 -2.539 13.073 .535c3.667 3.129 4.168 8.238 1.152 11.898c-2.841 3.447 -7.965 4.583 -12.231 2.805l-.233 -.101l-4.374 .931l-.04 .006l-.035 .007h-.018l-.022 .005h-.038l-.033 .004l-.021 -.001l-.023 .001l-.033 -.003h-.035l-.022 -.004l-.022 -.002l-.035 -.007l-.034 -.005l-.016 -.004l-.024 -.005l-.049 -.016l-.024 -.005l-.011 -.005l-.022 -.007l-.045 -.02l-.03 -.012l-.011 -.006l-.014 -.006l-.031 -.018l-.045 -.024l-.016 -.011l-.037 -.026l-.04 -.027l-.002 -.004l-.013 -.009l-.043 -.04l-.025 -.02l-.006 -.007l-.056 -.062l-.013 -.014l-.011 -.014l-.039 -.056l-.014 -.019l-.005 -.01l-.042 -.073l-.007 -.012l-.004 -.008l-.007 -.012l-.014 -.038l-.02 -.042l-.004 -.016l-.004 -.01l-.017 -.061l-.007 -.018l-.002 -.015l-.005 -.019l-.005 -.033l-.008 -.042l-.002 -.031l-.003 -.01v-.016l-.004 -.054l.001 -.036l.001 -.023l.002 -.053l.004 -.025v-.019l.008 -.035l.005 -.034l.005 -.02l.004 -.02l.018 -.06l.003 -.013l1.15 -3.45l-.022 -.037c-2.21 -3.747 -1.209 -8.391 2.413 -11.119z"
                        />
                    </svg>
                </div>
                <div class="nav-button-container">
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="nav-button chats">
                        <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"
                        />
                        <path
                                d="M2 3m0 2a2 2 0 0 1 2 -2h16a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2 -2z"
                        />
                        <path
                                d="M19 9c.513 0 .936 .463 .993 1.06l.007 .14v7.2c0 1.917 -1.249 3.484 -2.824 3.594l-.176 .006h-10c-1.598 0 -2.904 -1.499 -2.995 -3.388l-.005 -.212v-7.2c0 -.663 .448 -1.2 1 -1.2h14zm-5 2h-4l-.117 .007a1 1 0 0 0 0 1.986l.117 .007h4l.117 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z"
                        />
                    </svg>
                </div>
            </div>
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
                <div id="conversationList">
                    <div class="conversation-loader-container">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="message msg-contents">
            <div id="messageHeader">
            </div>
            <div id="messageRoll">
                <div class="empty-message">
                    <p>Start a new message, or select a conversation on the chats window</p>
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
                    <form action="" id="messageDraft" class="message-draft" method="post" onsubmit="sendMessage()">
                        <input id="messageText" type="text" name="message" placeholder="Aa" autocomplete="off">
                        <button type="submit" name="send-message" class="send-message-button">
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
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>