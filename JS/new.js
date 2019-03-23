//NEW.JS

function validateStudent(form) {
    var valid = true;
    if (!validId(form.id))
        valid = false;
    changeColor(validId(form.id), "studentId");

    if (!validName(form.fname))
        valid = false;
    changeColor(validName(form.fname), "fname");

    if (!validName(form.lname))
        valid = false;
    changeColor(validName(form.lname), "lname")

    if (!validEmail(form.email))
        valid = false;
    changeColor(validEmail(form.email), "email")

    if (!validAddress(form.address))
        valid = false;
    changeColor(validAddress(form.address), "address")
    return valid;
}

function newStudent() {
    var form = {
        id: document.forms['form']['studentId'].value,
        fname: document.forms['form']['fname'].value,
        lname: document.forms['form']['lname'].value,
        email: document.forms['form']['email'].value,
        address: document.forms['form']['address'].value,
    }
    
    var year = parseInt(localStorage.getItem("year"));
    var list = new StudentList();
    
    if (!validateStudent(form)){
        return false;
    }
    list.students = getStudents(year);
    console.log(list.students);
    var newStudent = new Student(form);
    if(list.students == null)
        list.students = [newStudent];
    else 
        list.students.push(newStudent);    
    localStorage.setItem(`students-${year}`, JSON.stringify(list.students)); 
    return true;
}

function validId(id) {
    if (id.length != 9)
        return false;
    if (!/\d{9}/.test(id))
        return false;
    if (!/^4/.test(id))
        return false;
    return true;
}

function validName(name) {
    if (name.length == 0)
        return false;
    if (!/^[a-zA-Z]+$/.test(name))
        return false;
    if (/\d/.test(name))
        return false;
    return true;
}

function validEmail(email) {
    if (!/@.+\./.test(email))
        return false;
    return true;
}

function validAddress(address) {
    if (address.length == 0)
        return false;
    if(!/^[_A-z0-9]*((-|\s)*[_A-z0-9])*$/g.test(address))
        return false;
    return true;
}

function changeColor(valid, elementName) {
    if (!valid) {
        document.getElementsByName(elementName)[0].style.borderBottomColor = "tomato";
    } else {
        document.getElementsByName(elementName)[0].style.borderBottomColor = "#2ecc71";
    }
}

function resetColors() {
    var inputFields = ["studentId", "fname", "lname", "email", "address"];
    inputFields.forEach(field => {
        document.getElementsByName(field)[0].style.borderBottomColor = "#2ecc71";
    })
}

document.getElementById("form").onsubmit = newStudent;
document.getElementById("form").onreset = resetColors;
