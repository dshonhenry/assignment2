<!--CONSOLE.PHP-->

<?php
    require_once("login.php");
    if (!isUserLoggedIn()) {
        header('Location: index.php');
        exit();
    }
    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./CSS/base.css">
        <link rel="stylesheet" type="text/css" href="./CSS/console.css">         
        <script type="text/javascript" src="./JS/base.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>PROCOMS</title>
    </head>
    <body>
        <div class="nav">
            <div class="heading">
                <h1>Program: Msc. Information Technology</h1>
                <inline id="name" class="subtle"> User: <?php echo($user['fname']." ".$user['lname']) ?> </inline>                
                <inline id="role" class="subtle"> Role: <?php echo($user['role']) ?> </inline>
            </div>
            <div class="menu" >
                <div class="hamburger" onclick="ToggleMenu(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <div id="dropdownContent">
                    <a href="#">Account</a>                    
                    <a href="#">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class=cardStack>
            <div class="card">
                <a href="students.php">Students</a>
            </div>

            <div class="card">
                <a href="courses.php">Courses</a>
            </div>

            <div class="card">
                <a href="#">Correspondance</a>
            </div>

            <div class="card">
                <a href="#">Lectures</a>
            </div>

            <div class="card">
                <a href="#">Schedule</a>
            </div>
            <div class="card">
                <a href="#">Documenation</a>
            </div>
        </div>
    </body>
  
</html>