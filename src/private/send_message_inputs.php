<?php
    echo '
    <div id="messageInput">
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
    ';
