<?php
    $conv_id = $_GET['c'];
    echo '
        <div id="archivePopup">
            <div id="archivePopupContainer">
                <div class="title-bar">
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
                            id="closeArchivePopupButton"
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
                </div>
                <form class="archive popup-content" action="../private/archive_message_popup.php?c='.$conv_id.'" method="POST">
                    <p>Are you sure you want to archive this conversation?</p>
                    <div class="archive-btn-container">
                        <button type="button" class="btn1 archive-btn" id="archiveCancel">Cancel</button>
                        <button type="submit" name="archive" class="btn2 archive-btn important" id="archiveConversation">Archive</button>
                    </div>
                </form>
            </div>
        </div>';

        if (isset($_POST['archive'])) {
            include_once("../private/includes/hello_api.php");

            $conversation = new Conversation();
            $res = $conversation->archiveMessage($conv_id);
            if ($res == true){
                header("Location: ../public/inbox.php");
            }
        }