// Intervals for retrievals
setInterval(getLatest, 1000);

// conversation ID
let conversationID = 0;
let otherID = 0;

// Functionality for new conversation
const newChatButton = document.getElementById("newChatButton");
const closeNewConversationButton = document.getElementById("closeNewConversationButton");
newChatButton.addEventListener("click", function (){
    document.getElementById("newConvPopup").style.display = "flex";
})
closeNewConversationButton.addEventListener("click", function(){
    document.getElementById("newConvPopup").style.display = "none";
})

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
    console.log(convID);
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