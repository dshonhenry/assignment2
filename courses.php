<!--COURSES.PHP-->

<?php
    require_once("./Scripts/login.php"); 
    require_once("./Scripts/nav.php");   
    require_once("./Scripts/manageCourses.php");

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
    <title>Courses</title>
</head>

<body>
    <?php echo viewNavBar(); ?>

    <div id="content">
        <h1>Courses</h1>
        <a href="newCourse.php">New Course</a>
        <?php echo(viewCourses()); ?>
    </div>
</body>

</html>