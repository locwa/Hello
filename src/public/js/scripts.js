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

// Sets message limit based on window height
let messageLimit = Math.ceil(window.innerHeight / 30);

// Shows previous messages if maximum top scroll is reached
let messageOffset = messageLimit;

document.getElementById("messageRoll").addEventListener("scroll", function () {
    let messageRoll = document.getElementById('messageRoll');
    let elementHeight = messageRoll.offsetHeight - messageRoll.scrollHeight;
    let currentPosition = Math.floor(messageRoll.scrollTop) - 1;
    if ((elementHeight >= currentPosition)){
        let url = "../private/retrieve_previous_messages.php";
        let xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.onload = function(){
            if (this.statusText = "200"){
                document.getElementById("messageRoll").scrollTo(0, elementHeight);
                messageOffset += messageLimit;
                if (this.responseText !== ""){
                    document.getElementById("loaderContainer").remove();
                }
                document.getElementById("messageRoll").insertAdjacentHTML("beforeend", this.responseText);
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("messageOffset=" + messageOffset + "&conversationID=" + conversationID + "&messageLimit=" + messageLimit);
    }
});

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
    let url = "../private/messages_retrieval.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
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
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convId + "&limit=" + messageLimit);
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
    let sentMessage = document.getElementById("messageText").value;
    let url = "../private/send_message.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageText").value = "";
            document.getElementById("messageRoll").innerHTML = "";
            document.getElementById("messageRoll").insertAdjacentHTML("afterbegin", this.responseText);
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("m=" + sentMessage + "&oid=" + otherID + "&c=" + conversationID);
}

function getLatestMessage(convID) {
    let url = "../private/get_latest_message.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            if(this.responseText != ""){
                document.getElementById("emptyMessage").remove();
                document.getElementById("messageRoll").insertAdjacentHTML("afterbegin", this.responseText);
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convID);
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
            document.getElementById("newConvPopup").style.display = "none";
        }
    }
    xhr.send();
}