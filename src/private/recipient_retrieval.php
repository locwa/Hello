<?php
    include_once("../private/includes/hello_api.php");
    session_start();

    $id = $_SESSION["id"];
    $conv_id = $_GET['c'];
    $window_width = $_GET['windowWidth'];
    $messages = new Messages();
    $row_count = $messages->getRecepientName($conv_id, $id)->rowCount();
    $recipient_name = $messages->getRecepientName($conv_id, $id)->fetchAll();

    if($row_count > 0){
        $is_online = $recipient_name[0]["is_online"];
        if ($is_online == 0) {
            $is_online = "offline";
        }
        else {
            $is_online = "online";
        }

        echo "<div class='top-left-container'>";

        if ($window_width <= 800){
            echo'
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        id="backButton"
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
            ';
        }
        echo "<div class='recipient-details'>
                <h4 class='sm'>".$recipient_name[0]['first_name']." ".$recipient_name[0]['last_name']."</h4>
                <p class='xs'>".$is_online."</p>
            </div>  
            ";
        echo "</div>";
        if ($recipient_name[0]['status'] == 0){
            echo "
            <div class='options' id='archiveConversationButton'>
                <svg
                    xmlns='http://www.w3.org/2000/svg'
                    width='20'
                    height='20'
                    viewBox='0 0 24 24'
                    fill='currentColor'
                    class='nav-button chats'
                >
                <path
                        stroke='none'
                        d='M0 0h24v24H0z'
                        fill='none'
                />
                <path
                        d='M2 3m0 2a2 2 0 0 1 2 -2h16a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2 -2z'
                />
                <path
                        d='M19 9c.513 0 .936 .463 .993 1.06l.007 .14v7.2c0 1.917 -1.249 3.484 -2.824 3.594l-.176 .006h-10c-1.598 0 -2.904 -1.499 -2.995 -3.388l-.005 -.212v-7.2c0 -.663 .448 -1.2 1 -1.2h14zm-5 2h-4l-.117 .007a1 1 0 0 0 0 1.986l.117 .007h4l.117 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z'
                />
            </svg>
            </div>";
        }
    }

