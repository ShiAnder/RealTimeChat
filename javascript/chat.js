const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector(" button"),
chatBox = document.querySelector(".chat-box");


form.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting 
}

sendBtn.onclick = () =>{
    //ajax

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200 ){
                inputField.value = ""; //once message inserted to the database, input field leave blank
                scrollToBottom();
            }
        }
    }
    // sending form data through ajax to php
    let formData = new FormData(form) // create new formData object
    xhr.send(formData); //sending form data to php
}



setInterval(()=>{
    //ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200 ){
                let data = xhr.response;
                chatBox.innerHTML = data;
                scrollToBottom();
                
            }
        }
    }

    let formData = new FormData(form) // create new formData object
    xhr.send(formData); //sending form data to php

}, 500); // this function will run every 500ms

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}


$('html,body').animate({
    scrollTop: $(document).height() - $(window).innerHeight()
  }, 1000);