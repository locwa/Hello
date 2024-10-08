<?php
    include_once("../private/includes/hello_api.php");
    session_start();

    $id = $_SESSION["id"];
    $conv_id = $_GET['c'];
    $messages = new Messages();
    $recipient_name = $messages->getRecepientName($conv_id, $id)->fetchAll();

    echo "
            <div class='recipient-details'>
                <h4 class='sm'>".$recipient_name[0]['first_name']." ".$recipient_name[0]['last_name']."</h4>
                <p class='xs'>online</p>
            </div>  
            <div class='options'>
                <svg
                        xmlns='http://www.w3.org/2000/svg'
                        width='24'
                        height='24'
                        viewBox='0 0 24 24'
                        fill='none'
                        stroke='#ffffff'
                        stroke-width='2'
                        stroke-linecap='round'
                        stroke-linejoin='round'
                            >
                    <path
                            stroke='none'
                            d='M0 0h24v24H0z'
                            fill='none'
                    />
                    <path
                            d='M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0'
                    />
                    <path
                            d='M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0'
                                />
                    <path
                            d='M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0'
                    />
                </svg>
            </div>
    ";
