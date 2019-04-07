<!--CONSOLE.PHP-->

<?php
    require_once("./Scripts/login.php");
    require_once("./Scripts/nav.php");
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

        <?php echo viewNavBar(); ?>

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