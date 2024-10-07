let seconds = 30;
let code = document.getElementById("code").textContent;
console.log(code)
setInterval(function(){
    document.getElementById("time").innerText = seconds;
    seconds -= 1;
    if (seconds < 0){
        deleteConversationCode(code);
        location.reload();
    }
}, 1000);


function deleteConversationCode(code) {
    let url = "../private/delete_conversation_code.php?code=" + code;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.send();
}

window.onbeforeunload = function(){
    deleteConversationCode(code);
}
