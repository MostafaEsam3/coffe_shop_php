let submitBtn = document.getElementById("submitBtn");
let email = document.getElementById("email");
let password = document.getElementById("password");
let helpText = document.getElementById("help-text");

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};

submitBtn.onmouseover = () => {
    if (validateEmail(email.value) && password.value.length > 8) {
        helpText.innerText = "Now you can submit"
    } else {
        if (submitBtn.style.alignSelf === "flex-end") {
            submitBtn.style.alignSelf = "flex-start"
        }
        else {
            submitBtn.style.alignSelf = "flex-end"
        }
        helpText.innerText = "You cannot submit until your email is validated and passowrd is greater than 8 characters"
    }
}