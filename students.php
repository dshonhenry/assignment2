<!--STUDENTS.PHP-->

<?php
    require_once("./Scripts/login.php");    
    require_once("./Scripts/viewStudents.php");
    require_once("./Scripts/nav.php");

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
    <link rel="stylesheet" type="text/css" href="./CSS/base.css">
    <link rel="stylesheet" type="text/css" href="./CSS/tables.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <script type="text/javascript" src="./JS/base.js"></script>
    <title>Students</title>
</head>

<body>
    <?php echo viewNavBar() ?>

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