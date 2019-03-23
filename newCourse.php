<!--NEWCOURSE.PHP-->

<?php
  require_once("login.php");

  if (!isUserLoggedIn()) {
    header('Location: index.php');
    exit();
  }
  $operation = "add";
  if(isset($_GET['id'])) {
    $formInfo = getCourseById($_GET['id']);
    $operation = "edit";
  }

  function getCourseById($id) {
    $file = file("./CSV/courses.csv");
    $courses = [];

    foreach ($file as $line) {
        if($id == str_getcsv($line)[0]) {
          $course['id'] = str_getcsv($line)[0];
          $course['title'] = str_getcsv($line)[1];                
          return $course;
        }
    }

    return null;  
  }
    $butString = ($operation == "add" ? "Add" : "Update");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <link rel="stylesheet" type="text/css" href="./CSS/base.css">
  <link rel="stylesheet" type="text/css" href="./CSS/form.css">
  <script type="text/javascript" src="./JS/base.js"></script>
  <title></title>
</head>

<body>
  <div class="nav">
    <div class="heading">
      <h1><a href = "console.php">Program: Msc. Information Technology</a></h1>
      <span id="name" class="subtle"> User: <?php echo(getUserInfo("fname")." ".getUserInfo("lname")) ?> </span>                
      <span id="role" class="subtle"> Role: <?php echo(getUserInfo("role")) ?> </span>
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
    <form id="form" class = "col-1" name="newStudentInput" action="manageCourses.php?action=<?php echo($operation)?>" method="POST">
      <div class="row">
        <div class="col-1">
          <label for="id">Course ID:</label>
        </div>
        <div class="col-2"> 
          <input name="id" type="text" value="<?php if(isset($formInfo)) echo($formInfo['id']) ?>" <?php if(isset($_GET['id'])) echo('readonly="readonly"')?>> 
        </div>
      </div>

      <div class="row">
        <div class="col-1">
          <label for="title">Course Title:</label>
        </div>
        <div class="col-2"> 
          <input name="title" type="text" value="<?php if(isset($formInfo)) echo($formInfo['title']) ?>">
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
  </div>
</body>
</html>