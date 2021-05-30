const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorTxt = form.querySelector(".error-text");

form.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting 
}

continueBtn.onclick = () => {
    //ajax

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200 ){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                }
                else {
                    errorTxt.textContent = data;
                    errorTxt.style.display = "block";
                }
            }
        }
    }
    // sending form data through ajax to php
    let formData = new FormData(form) // create new formData object
    xhr.send(formData); //sending form data to php
}