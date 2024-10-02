// Intervals for retrievals
setInterval(getConversations, 1000);

// conversation ID
let conversationID = 0;

// Functions
function getConversations(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../private/conversations_retrieval.php", true);
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("conversationList").innerHTML = "";
            document.getElementById("conversationList").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function getConvID(cid){
    conversationID = cid;
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
            document.getElementById("messageRoll").prepend(this.responseText);
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("m=" + message);

}