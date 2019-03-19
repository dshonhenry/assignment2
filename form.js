function validateSignIn() {
    document.cookie = "scriptEnabled=true;";
    var form = {
        email: document.forms['mainForm']['email'].value,
        password: document.forms['mainForm']['password'].value
    }
    var messageElem = document.getElementById('warning');
    
    if (!checkEmail(form.email, messageElem)) return false;
    if (!checkPassword(form.password, messageElem)) return false;
    //if (!checkUser(form, messageElem)) return false;
    
    return true;
}

function checkEmail(email, messageElem) {

    if (!/@.+\./.test(email)) {
        messageElem.textContent = "Invalid email";
        return false;
    }
    return true;
}

function checkPassword(password) {
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

// function addTestUser() {
//     //localStorage.setItem('last', null)
//     /*localStorage.setItem("j@gmail.com", JSON.stringify({
//         id: "u2",
//         password: "john1234"
//     }));*/
//     //var id = localStorage.getItem('last') == 'null' ? `u${localStorage.length}` : localStorage.getItem('last');
//     var user = new User({
//         "id": id,
//         "fname": "John",
//         "lname": "Heizenburg",
//         "role": "Administrator",
//     })
//     localStorage.setItem("user", JSON.stringify(user));
// }

sessionStorage.clear();
localStorage.clear();
//addTestUser();
document.getElementById("mainForm").onsubmit = validateSignIn;