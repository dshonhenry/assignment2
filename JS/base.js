localStorage.clear();

function ToggleMenu(i){
    i.classList.toggle("change");    
    var dropDown = document.getElementById("dropdownContent");
    
    dropDown.style.display = dropDown.style.display == "" ? "block" : "";
    dropDown.style.opacity = dropDown.style.opacity == 0? 100 : 0;    
}

