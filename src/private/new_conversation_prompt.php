<?php
    echo '
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
    </div>
    <div class="popup-content">
        <h3>Please enter the conversation code</h3>
        <fieldset>
            <input type="text"  autocomplete="off" name="num-code-0" class="num-fields" placeholder="0" maxlength="1">
            <input type="text"  autocomplete="off" name="num-code-1" class="num-fields" placeholder="0" maxlength="1">
            <input type="text"  autocomplete="off" name="num-code-2" class="num-fields" placeholder="0" maxlength="1">
            <input type="text"  autocomplete="off" name="num-code-3" class="num-fields" placeholder="0" maxlength="1">
            <input type="text"  autocomplete="off" name="num-code-4" class="num-fields" placeholder="0" maxlength="1">
            <input type="text"  autocomplete="off" name="num-code-5" class="num-fields" placeholder="0" maxlength="1">
        </fieldset>
        <br>
        <p id="newConversationCode" class="xs" onclick="getNewConversationCode()">Or generate your conversation code</p>
        <button type="submit" class="btn1">Submit</button>
    </div>
    ';