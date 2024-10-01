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

function getCID(cid){
    console.log(cid);
    conversationID = cid;
}
