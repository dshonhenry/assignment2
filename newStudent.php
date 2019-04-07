<!--NEWSTUDENT.PHP-->

<?php
    require_once("./Scripts/login.php");
    require_once("./Scripts/viewStudents.php");
    require_once("./Scripts/nav.php");

    if (!isUserLoggedIn()) {
        header('Location: index.php');
        exit();
    }

    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if(isset($_SESSION['formInfo'])) {
        $formInfo = $_SESSION['formInfo'];        
        unset($_SESSION['formInfo']);
    }

    $operation = null;
    if(isset($_GET['id'])) {
        $formInfo = getStudentById($_GET['id']);
    }

    $butString = "Add";

    if(isset($_GET['action'])){
        $operation = $_GET['action'];
        $butString = ($_GET['action'] == "edit" ? "Update" : "Confirm");
    }
    $actionString = "Scripts/manageStudents.php";
    if($operation != null)
        $actionString = $actionString."?action=".$operation;
    
?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./CSS/base.css">
    <link rel="stylesheet" type="text/css" href="./CSS/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php echo viewNavBar(); ?>
  
    <div id="content" class = "big-row">
        <form id="form" class = "col-1" name="newStudentInput" action="<?php echo $actionString?>" method="POST">
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
                    <input name="fname" type="text" value="<?php if(isset($formInfo)) echo($formInfo['fname']) ?>" <?php if(isset($_GET['id']) && $_GET['action']=="del") echo('readonly="readonly"')?>>
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="lname">Last Name:</label>
                </div>
                <div class="col-2"> 
                    <input name="lname" type="text" value="<?php if(isset($formInfo)) echo($formInfo['lname']) ?>" <?php if(isset($_GET['id']) && $_GET['action']=="del") echo('readonly="readonly"')?>>
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="email">Email:</label>
                </div>
                <div class="col-2"> 
                    <input name="email" type="text" value="<?php if(isset($formInfo)) echo($formInfo['email'])?>" <?php if(isset($_GET['id']) && $_GET['action']=="del") echo('readonly="readonly"')?>>
                </div>
            </div>

            <div class="row">
                <div class="col-1">
                    <label for="address">Address:</label>
                </div>
                <div class="col-2"> 
                    <textarea name="address" type="text" <?php if(isset($_GET['id']) && $_GET['action']=="del") echo('readonly="readonly"')?>><?php if(isset($formInfo)) echo($formInfo['address']);?></textarea>
                </div>
            </div>

            <p id="delString"><?php if(isset($_GET['id']) && $_GET['action']=="del") echo "Please confirm that you want to delete this record" ?></p>

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