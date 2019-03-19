<!--NEWSTUDENT.PHP-->

<?php
    require("login.php");
    require("viewStudents.php");

    if (!isUserLoggedIn()) {
        header('Location: index.php');
        exit();
    }

    $operation = "add";

    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if(isset($_SESSION['formInfo'])) {
        $formInfo = $_SESSION['formInfo'];        
        unset($_SESSION['formInfo']);
    }

    if(isset($_GET['id'])) {
        $formInfo = getStudentById($_GET['id']);
        $operation = "edit";
    }

    $butString = ($operation == "add" ? "Add" : "Update");
?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./CSS/base.css">
    <link rel="stylesheet" type="text/css" href="./CSS/new.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
    <div id="content" class = "big-row">
        <form id="form" class = "col-1" name="newStudentInput" action="manageStudents.php?action=<?php echo($operation)?>" method="POST">
            <div class="row">
                <div class="col-1">
                    <label for="studentId">Student ID:</label>
                </div>
                <div class="col-2"> 
                    <input name="studentId" type="text" value="<?php if(isset($formInfo)) echo($formInfo['studentId']) ?>" <?php if(isset($_GET['id'])) echo('readonly="readonly"')?>> 
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="fname">First Name:</label>
                </div>
                <div class="col-2"> 
                    <input name="fname" type="text" value="<?php if(isset($formInfo)) echo($formInfo['fname']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="lname">Last Name:</label>
                </div>
                <div class="col-2"> 
                    <input name="lname" type="text" value="<?php if(isset($formInfo)) echo($formInfo['lname']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="email">Email:</label>
                </div>
                <div class="col-2"> 
                    <input name="email" type="text" value="<?php if(isset($formInfo)) echo($formInfo['email'])?>">
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="address">Address:</label>
                </div>
                <div class="col-2"> 
                    <textarea name="address" type="text"><?php if(isset($formInfo)) echo($formInfo['address']);?></textarea>
                </div>
            </div>

            <div class="row btn-row">
                <div class="col-1">
                    <button type="submit" name="submit"><?php echo($butString);?></button>
                </div>
                <div class="col-2"> 
                    <button type="submit" name="cancel">Cancel</button>
                </div>
            </div>
        </form>
        <?php if(isset($errors)) :?>
        <div class="col-2">
            <?php 
                $visibility = (isset($errors['studentId']) ? "visible" : "hidden");
                echo('<div class="row error '.$visibility.'"> Error: Invalid Student Id Format </div>');
            ?>
            <?php 
                $visibility = (isset($errors['fname']) ? "visible" : "hidden");
                echo('<div class="row error '.$visibility.'"> Error: Invalid Name Format </div>');
            ?>
            <?php 
                $visibility = (isset($errors['lname']) ? "visible" : "hidden");
                echo('<div class="row error '.$visibility.'"> Error: Invalid Name Format </div>');
            ?>
            <?php 
                $visibility = (isset($errors['email']) ? "visible" : "hidden");
                echo('<div class="row error '.$visibility.'"> Error: Invalid Email Format </div>');
            ?>
            <?php 
                $visibility = (isset($errors['address']) ? "visible" : "hidden");
                echo('<div class="row error '.$visibility.'"> Error: Invalid Address Format </div>');
            ?>

        </div>
        <?php endif;?>
    </div>
</body>

<script type="text/javascript" src="./JS/base.js"></script>
<script type="text/javascript" src="./JS/new.js"></script>

</html>