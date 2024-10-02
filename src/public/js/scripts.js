// Intervals for retrievals
setInterval(getConversations, 1000);

// conversation ID
let conversationID = 0;

// Functions
function getConversations(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../private/conversations_retrieval.php", "true");
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("conversationList").innerHTML = "";
            document.getElementById("conversationList").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function getConvID(cid){
    console.log(cid);
    conversationID = cid;
    getMessage(conversationID);
}

function getMessage(convId){
    let url = "../private/messages_retrieval.php?c=" + convId;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, "true");
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("messageRoll").innerHTML = "";
            document.getElementById("messageRoll").innerHTML = this.responseText;
        }
    }
    xhr.send();
}