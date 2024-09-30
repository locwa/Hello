// DOM elements
;

// Intervals for retrievals
setInterval(getConversations, 1000);

// AJAX functions
function getConversations(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../private/includes/conversations_retrieval.php", "true");
    xhr.onload = function(){
        if (this.statusText = "200"){
            document.getElementById("conversationList").innerHTML = this.responseText;
            console.log("hello")
        }
    }
    xhr.send();
}
