//FORM.JS

function validateSignIn() {
    document.cookie = "scriptEnabled=true;";
    var form = {
        email: document.forms['mainForm']['email'].value,
        password: document.forms['mainForm']['password'].value
    }
    var messageElem = document.getElementById('warning');
    
    if (!checkEmail(form.email, messageElem)) return false;
    if (!checkPassword(form.password, messageElem)) return false;
    
    return true;
}

function checkEmail(email, messageElem) {
    var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if(!email.match(reEmail)) {        
        messageElem.textContent = "Invalid email";
        return false;
    }
    return true;
}

function checkPassword(password, messageElem) {
    if (password.length < 8) {
        messageElem.textContent = "Password needs to be at least 8 characters";
        return false;
    }
    if (!/\d/.test(password)) {
        messageElem.textContent = "Password needs to contain at least 1 number";
        return false;
    }
    return true;
}

function checkUser(form, messageElem) {
    var record = JSON.parse(localStorage.getItem(form.email));
    if (record == null) {
        messageElem.textContent = "Invalid email";
        return false;
    }
    if (record.password == form.password) {
        sessionStorage.setItem('user', localStorage.getItem(`${record.id}`));
        return true;
    }
    messageElem.textContent = "Invalid email and password.";
    return false;

}

sessionStorage.clear();
localStorage.clear();

document.getElementById("mainForm").onsubmit = validateSignIn;