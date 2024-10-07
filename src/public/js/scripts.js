// Intervals for retrievals
setInterval(getLatest, 1000);

// conversation ID
let conversationID = 0;
let otherID = 0;

// Functionality for new conversation
const newChatButton = document.getElementById("newChatButton");
const closeNewConversationButton = document.getElementById("closeNewConversationButton");
const numFields = document.getElementsByClassName("num-fields");
const submitCode = document.getElementById("submitCode");

newChatButton.addEventListener("click", function (){
    document.getElementById("newConvPopup").style.display = "flex";
    numFields[0].focus();
})
closeNewConversationButton.addEventListener("click", function(){
    document.getElementById("newConvPopup").style.display = "none";
})

submitCode.onclick = addConversationFromCode;

// Number fields navigation
for (let i = 0; i < numFields.length; i++){
    numFields[i].addEventListener("keydown", function(){
        let key = event.key;
        switch (key){
            case "Backspace":
                event.preventDefault();
                numFields[i].value = "";
                if (i > 0){
                    if (i != 5){
                        numFields[i-1].value = "";
                    }
                    numFields[i-1].focus();
                }
                break;
            case "ArrowLeft":
                if (i > 0){
                    numFields[i-1].focus();
                }
                break;
            case "ArrowRight":
                if (i < 5){
                    numFields[i+1].focus();
                }
                break;
        }
    })
    numFields[i].addEventListener("input", function(){
        if (i < 5){
            console.log(numFields[i].value);
            numFields[i+1].focus();
        }
        else{
            console.log(numFields[i].value);
            numFields[i].focus();
        }
    })
}

// Functions
function getLatest(){
    getConversations(conversationID);
    getLatestMessage(conversationID);
}
function getConversations(convID){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../private/conversations_retrieval.php?c=" + convID, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("conversationList").innerHTML = "";
            document.getElementById("conversationList").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function getConvID(cid, oid){
    conversationID = cid;
    otherID = oid;
    getMessage(conversationID);
    getMessageRecipient(conversationID);
}

function getMessage(convId){
    let url = "../private/messages_retrieval.php?c=" + convId;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageRoll").innerHTML = "";
            document.getElementById("messageRoll").innerHTML = this.responseText;
            let conversationElements = document.getElementsByClassName("conversation")
            for (let i = 0; i < conversationElements.length; i++){
                conversationElements[i].classList.remove("active");
            }
            document.getElementById(convId).classList.add("active");
        }
    }
    xhr.send();
}

function getMessageRecipient(convId){
    let url = "../private/recipient_retrieval.php?c=" + convId;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageHeader").innerHTML = "";
            document.getElementById("messageHeader").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function sendMessage() {
    event.preventDefault();
    let message = document.getElementById("messageText").value;
    let url = "../private/send_message.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageText").value = "";
            document.getElementById("messageRoll").insertAdjacentHTML("afterbegin", this.responseText);
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("m=" + message + "&oid=" + otherID + "&c=" + conversationID);
}

function getLatestMessage(convID) {
    let url = "../private/get_latest_message.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageRoll").insertAdjacentHTML("afterbegin", this.responseText);
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convID);
}

function getNewConversationCode() {
    let url = "../private/generate_conversation_code.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("popupContainer").innerHTML = "";
            document.getElementById("popupContainer").innerHTML = this.responseText;
            // interval for new code
            let code = document.getElementById("code").textContent;
            otpTimer(code);
            // Back to new conversation prompt
            document.getElementById("backToNewConversation").addEventListener("click", function (){
                let url = "../private/new_conversation_prompt.php";
                let xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.onload = function(){
                    if (this.statusText = "200"){
                        document.getElementById("popupContainer").innerHTML = "";
                        document.getElementById("popupContainer").innerHTML = this.responseText;
                        document.getElementById("closeNewConversationButton").addEventListener("click", function(){
                            document.getElementById("newConvPopup").style.display = "none";
                        });
                    }
                }
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send();
            });
            document.getElementById("closeNewConversationButton").addEventListener("click", function(){
                document.getElementById("newConvPopup").style.display = "none";
            });
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function otpTimer(code) {
    let seconds = 30;
    setInterval(function(){
        document.getElementById("time").innerText = seconds;
        seconds -= 1;
        if (seconds < 0){
            deleteConversationCode(code);
            getNewConversationCode();
            seconds = 30;
        }
    }, 1000)
}

function deleteConversationCode(code) {
    let url = "../private/delete_conversation_code.php?code=" + code;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.send();
}

function addConversationFromCode() {
    let code = ""
    for (let i = 0; i < numFields.length; i++){
        code += numFields[i].value;
    }
    let url = "../private/add_new_conversation.php?code=" + code;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function() {
        if (this.statusText = "200"){
            document.getElementById("popupContainer").innerHTML = "";
            document.getElementById("popupContainer").innerHTML = this.responseText;
        }
    }
    xhr.send();
}