<!--NEWCOURSE.PHP-->

<?php
  require_once("./Scripts/login.php");
  require_once("./Scripts/nav.php");

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
  $butString = "Add";

  if(isset($_GET['action'])){
      $operation = $_GET['action'];
      $butString = ($operation == "edit" ? "Update" : "Confirm");
  }
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

  <?php echo viewNavBar(); ?>

  <div id="content" class = "big-row">
    <form id="form" class = "col-1" name="newStudentInput" action="Scripts/manageCourses.php?action=<?php echo($operation)?>" method="POST">
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
          <input name="title" type="text" value="<?php if(isset($formInfo)) echo($formInfo['title']) ?>" <?php if(isset($_GET['id']) && $_GET['action']=="del") echo('readonly="readonly"')?>>
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
  </div>
</body>
</html>