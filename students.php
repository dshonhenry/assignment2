<!--STUDENTS.PHP-->

<?php
    require("login.php");    
    require("viewStudents.php");

    if (!isUserLoggedIn()) {
        header('Location: index.php');
        exit();
    }

    $availableYears = array("2016", "2017", "2018");
    $year = "2016";
    $_SESSION['year'] = $year;

    if(isset($_GET['year'])) {
        $year = $_GET['year'];
        if(in_array($year, $availableYears)) { 
            $_SESSION['year'] = $year;
        }
        else {
            header('Location: students.php');
            exit();
        }
    }    
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="base.css">
    <link rel="stylesheet" type="text/css" href="students.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <script type="text/javascript" src="base.js"></script>
    <title>Students</title>
</head>

<body>
    <div class="nav">
        <div class="heading">
            <h1><a href = "console.php">Program: Msc. Information Technology</a></h1>
            <inline id="name" class="subtle"> User: <?php echo(getUserInfo("fname")." ".getUserInfo("lname")) ?> </inline>                
            <inline id="role" class="subtle"> Role: <?php echo(getUserInfo("role")) ?> </inline>
        </div>
        <div class="menu">
            <div class="hamburger" onclick="ToggleMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div id="dropdownContent">
                <a href="#">Account</a>
                <a href="#">Settings</a>
                <a href="index.php">Logout</a>
            </div>
        </div>
    </div>

    <div id="content">
        <h1>Students</h1>
        <ul>
            <?php foreach($availableYears as $avYear) {?>
                <?php if($year == $avYear) : ?>
                    <li id="chosenYear">
                <?php else : ?>
                    <li>
                <?php endif ;
                echo('<a href="students.php?year='.$avYear.'">'.$avYear.'</a></li>');
                
            }?>
        </ul>
        <a href="newStudent.php">New Student</a>
        <?php echo(viewStudents(getStudents($year))); ?>
    </div>
</body>

</html>