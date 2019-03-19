function addTestStudents() {
    var s1 = new Student({
        "id": 417000563,
        "fname": "D'shon",
        "lname": "Henry",
        "email": "dshon.henry@gmail.com",
    });
    var s2 = new Student({
        "id": 417000565,
        "fname": "Jim",
        "lname": "Jones",
        "email": "jim.jones@gmail.com"
    });
    var s3 = new Student({
        "id": 417000343,
        "fname": "Matt",
        "lname": "Murdock",
        "email": "dare.devil@marvel.com"
    });
    var s4 = new Student({
        "id": 417000563,
        "fname": "Biggy",
        "lname": "Small",
        "email": "dingdong@gmail.com",
    });
    var s5 = new Student({
        "id": 417000565,
        "fname": "Kikoko",
        "lname": "Umami",
        "email": "Sushi.masta@gmail.com"
    });
    var s6 = new Student({
        "id": 417000343,
        "fname": "David",
        "lname": "Tennant",
        "email": "theDoctah@whomail.com"
    });

    var list = new StudentList();
    list.students.push(s1, s2, s3);

    var list2 = new StudentList();
    list2.students.push(s4,s5,s6);
    
    localStorage.removeItem("students-2016");    
    localStorage.removeItem("students-2018");
    localStorage.setItem("students-2016", JSON.stringify(list.students));           
    localStorage.setItem("students-2018", JSON.stringify(list2.students));
}


function populateTable(year) {
    var list = new StudentList();
    localStorage.setItem("year", year);

    var table = document.getElementById('studentTable');
    table.innerHTML="";
    
    list.students = getStudents(year);
    if (list.students == "") {
        var message = document.createElement("td");
        message.innerHTML = "No Students";
        table.appendChild(document.createElement("tr")).appendChild(message);
        return;
    }

    list.students.forEach(student => {
        var record = document.createElement("tr");

        record.innerHTML = 
        `<td><a href="#">Edit</a></td>
        <td><a href="#">Delete</a></td>
        <td>${student.id}</td> 
        <td>${student.fname}</td>
        <td>${student.lname}</td>
        <td>${student.email}</td>`;

        table.appendChild(record);
    });
}

function loadStudents(year) {
    populateTable(year);
    var years = document.getElementById("content").children[1].children;
    for(var i = 0; i<3; i++){
        years[i].style.background = "#eeeeee";          
        years[i].style.color = "black"; 
    }
    var newYear = document.getElementById(year.toString());
    newYear.style.background = "#f9f9f9";
    newYear.style.color = "#2ecc71";
}

if(localStorage.getItem("students-2016")==null){
    addTestStudents();
}
populateTable(2016);