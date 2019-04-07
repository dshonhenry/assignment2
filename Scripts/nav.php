<!--NAV.PHP-->

<?php
    function viewNavBar() {
        $role = $_SESSION['user']['role'];
        $name = $_SESSION['user']['fname']." ".$_SESSION['user']['lname'];
        return '<div class="nav">
        <div class="heading">
            <h1><a href =  "console.php" >Program: Msc. Information Technology</a></h1>
            <inline id="name" class="subtle"> User: '.$name.'</inline>                
            <inline id="role" class="subtle"> Role: '.$role.'</inline>
        </div>
        <div class="menu" >
            
            <input type="checkbox" id="item1">
            <label for="item1" id="label">
                <div id="hamburger" onclick="ToggleMenu(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </label>
            <div id="dropdownContent">
                <a href="#">Account</a>                    
                <a href="#">Settings</a>
                <a href="Scripts/logout.php">Logout</a>
            </div>
        </div>
    </div>';
    }
?>