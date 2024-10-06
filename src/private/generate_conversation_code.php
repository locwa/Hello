<?php
    include_once("./includes/hello_api.php");
    session_start();
    $id = $_SESSION["id"];

    $conversations = new Conversation();

    $otp = $conversations->generateNewConversationCode($id);

    echo '
            <div class="title-bar spaced">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        id="closeNewConversationButton"
                >
                    <path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"
                    />
                    <path
                            d="M18 6l-12 12"
                    />
                    <path
                            d="M6 6l12 12"
                    />
                </svg>
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        id="backToNewConversation"
                        >
                    <path
                            stroke="none"
                            d="M0 0h24v24H0z"
                            fill="none"
                    />
                    <path
                            d="M5 12l14 0"
                    />
                    <path
                            d="M5 12l6 6"
                    />
                    <path
                            d="M5 12l6 -6"
                    />
                </svg>
            </div>
            <div class="popup-content">
                <h4>One-time Code</h4>
                <h1 class="xl">'.$otp.'</h1>
            </div>
    ';
