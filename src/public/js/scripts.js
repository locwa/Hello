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

newChatButton.addEventListener("click", function () {
    document.getElementById("newConvPopup").style.display = "flex";
    numFields[0].focus();
})
closeNewConversationButton.addEventListener("click", function () {
    document.getElementById("newConvPopup").style.display = "none";
})

submitCode.onclick = addConversationFromCode;

// Shows previous messages if maximum top scroll is reached
let messageLimit = Math.ceil(window.innerHeight / 30);
let messageOffset = messageLimit;

document.getElementById("messageRoll").addEventListener("scroll", function () {
    let messageRoll = document.getElementById('messageRoll');
    let elementHeight = messageRoll.offsetHeight - messageRoll.scrollHeight;
    let currentPosition = Math.floor(messageRoll.scrollTop) - 1;
    if ((elementHeight >= currentPosition)) {
        let url = "../private/retrieve_previous_messages.php";
        let xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.onload = function () {
            if (this.statusText = "200") {
                document.getElementById("messageRoll").scrollTo(0, elementHeight);
                messageOffset += messageLimit;
                if (this.responseText !== "") {
                    document.getElementById("loaderContainer").remove();
                }
                document.getElementById("messageRoll").insertAdjacentHTML("beforeend", this.responseText);
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("messageOffset=" + messageOffset + "&conversationID=" + conversationID + "&messageLimit=" + messageLimit);
    }
});

// Pagination for conversations
let conversationLimit = Math.ceil(window.innerHeight / 70);
document.getElementById("conversationList").addEventListener("scroll", function () {
    let conversationList = document.getElementById('conversationList');
    let convElementHeight = conversationList.offsetHeight - conversationList.scrollHeight;
    let convCurrentPosition = (Math.floor(conversationList.scrollTop) * -1) - 1;
    console.log(convCurrentPosition);
    console.log(convElementHeight);
    if (convElementHeight >= convCurrentPosition) {
        conversationLimit += conversationLimit;
    }
});

// Number fields navigation
for (let i = 0; i < numFields.length; i++) {
    numFields[i].addEventListener("keydown", function () {
        let key = event.key;
        switch (key) {
            case "Backspace":
                event.preventDefault();
                numFields[i].value = "";
                if (i > 0) {
                    if (i != 5) {
                        numFields[i - 1].value = "";
                    }
                    numFields[i - 1].focus();
                }
                break;
            case "ArrowLeft":
                if (i > 0) {
                    numFields[i - 1].focus();
                }
                break;
            case "ArrowRight":
                if (i < 5) {
                    numFields[i + 1].focus();
                }
                break;
        }
    })
    numFields[i].addEventListener("input", function () {
        if (i < 5) {
            console.log(numFields[i].value);
            numFields[i + 1].focus();
        } else {
            console.log(numFields[i].value);
            numFields[i].focus();
        }
    })
}

// Gets search conversations
let search = "";
document.getElementById("inboxSearch").addEventListener("keyup", function () {
    search = document.getElementById("inboxSearch").value;
    getConversations();
})

// Shows archived messages
const chatButton = document.getElementsByClassName("nav-button-container")[0];
const archiveButton = document.getElementsByClassName("nav-button-container")[1];
let conversationToggle = 0;
let isToggled = false;
const emptyMessage = "<div id='emptyMessage'><p>Wow, such empty.</p></div>"

chatButton.addEventListener("click", function () {
    chatButton.classList.add("active");
    archiveButton.classList.remove("active");
    document.getElementById("heading").innerText = "Chats";
    document.getElementById("messageHeader").innerHTML = "";
    document.getElementById("messageRoll").innerHTML = emptyMessage;
    isToggled = false;
    conversationToggle = 0;
    getConversations(conversationID, conversationToggle);
})

archiveButton.addEventListener("click", function () {
    archiveButton.classList.add("active");
    chatButton.classList.remove("active");
    document.getElementById("heading").innerText = "Archive";
    document.getElementById("messageHeader").innerHTML = "";
    document.getElementById("messageRoll").innerHTML = emptyMessage;
    if (document.getElementById("messageInput") != null) {
        document.getElementById("messageInput").remove();
    }
    conversationToggle = 1;
    getConversations(conversationID, conversationToggle);
})

// Functions
function getLatest() {
    getConversations(conversationID, conversationToggle);
    getLatestMessage(conversationID);
}

function getConversations(convId, toggle) {
    let xhr = new XMLHttpRequest();
    let url = "../private/conversations_retrieval.php"
    xhr.open("POST", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            if (this.responseText != "") {
                document.getElementById("conversationList").innerHTML = "";
                document.getElementById("conversationList").innerHTML = this.responseText;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convId + "&limit=" + conversationLimit + "&searchValue=" + search + "&toggle=" + toggle);
}

function getConvID(cid, oid) {
    conversationID = cid;
    otherID = oid;
    getMessage(conversationID);
    getMessageRecipient(conversationID);
}

function getMessage(convId) {
    let url = "../private/messages_retrieval.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            document.getElementById("messageRoll").innerHTML = "";
            document.getElementById("messageRoll").innerHTML = this.responseText;
            let conversationElements = document.getElementsByClassName("conversation")
            for (let i = 0; i < conversationElements.length; i++) {
                conversationElements[i].classList.remove("active");
            }
            document.getElementById(convId).classList.add("active");
            showMessageInput(isToggled);
            isToggled = true;
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convId + "&limit=" + messageLimit);
}

function getMessageRecipient(convId) {
    let url = "../private/recipient_retrieval.php?c=" + convId;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            document.getElementById("messageHeader").innerHTML = "";
            document.getElementById("messageHeader").innerHTML = this.responseText;
            document.getElementById("archiveConversationButton").addEventListener("click", function () {
                showArchivePopup();
            })
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
    xhr.onload = function () {
        if (this.statusText = "200") {
            if (document.getElementById("emptyMessage") != null) {
                document.getElementById("emptyMessage").remove();
            }
            document.getElementById("messageText").value = "";
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
    xhr.onload = function () {
        if (this.statusText = "200") {
            if (this.responseText != "") {
                if (document.getElementById("emptyMessage") != null) {
                    document.getElementById("emptyMessage").remove();
                }
                document.getElementById("messageRoll").insertAdjacentHTML("afterbegin", this.responseText);
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("c=" + convID);
}

function addConversationFromCode() {
    let code = ""
    for (let i = 0; i < numFields.length; i++) {
        code += numFields[i].value;
    }
    let url = "../private/add_new_conversation.php?code=" + code;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            document.getElementById("newConvPopup").style.display = "none";
        }
    }
    xhr.send();
}

function showArchivePopup() {
    const archivePopup = document.getElementById("archivePopup");
    let url = "../private/archive_message_popup.php?c=" + conversationID;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            document.getElementsByTagName("body")[0].insertAdjacentHTML("afterbegin", this.responseText);
            // Closes archive popup container
            document.getElementById("closeArchivePopupButton").addEventListener("click", function () {
                archivePopup.remove();
            })
            document.getElementById("archiveCancel").addEventListener("click", function () {
                archivePopup.remove();
            })
        }
    }
    xhr.send();
}

function showMessageInput(isToggled) {
    let url = "../private/send_message_inputs.php";
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (this.statusText = "200") {
            if (!isToggled) {
                document.getElementsByClassName("msg-contents")[0].insertAdjacentHTML("beforeend", this.responseText);
            }
        }
    }
    xhr.send();
}