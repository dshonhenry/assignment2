<!--MANAGECOURSES.PHP-->

<?php
    include_once("CSVManagement.php");

    if(isset($_GET['id'])){
        removeCourse($_GET['id']);
    }

    if(isset($_POST['submit']) && $_GET['action']=="add") {
        unset($_POST['submit']);  
        addCourse($_POST);
    }

    if (isset($_POST['submit']) && $_GET['action']=="edit") {
        unset($_POST['submit']);  
        updateCourse($_POST);
    }

    function viewCourses() {
        $file = file("./CSV/courses.csv");
        $courses = [];

        foreach ($file as $line) {
            $course['id'] = str_getcsv($line)[0];
            $course['title'] = str_getcsv($line)[1];
            $courses[] = $course;
        }
        $htmlString = '<table id="studentTable">';
        if($courses == null) {
            $htmlString = $htmlString.'<tr>
                                          <td>No Courses</td>
                                       </tr>';
        }
        else {
           foreach($courses as $course) {
                $htmlString = 
                $htmlString.'<tr>
                                <td><a href="manageCourses.php?id='.$course['id'].'&action=delete">Delete</a></td>
                                <td><a href="newCourse.php?id='.$course['id'].'&action=edit">Edit</a></td>
                                <td>'.$course['id'].'</td>                
                                <td>'.$course['title'].'</td>
                            </tr>';
            }
        }
        $htmlString = $htmlString."</table>";
        return $htmlString;
    }

    function addCourse($course) {
        $courseArray = array($course['id'], $course['title']);
        CSV_Manager::addRecord("./CSV/courses.csv", $courseArray);
        header('location: courses.php');
    }

    function removeCourse($id) {
        CSV_Manager::removeRecordById("./CSV/courses.csv", $id, 0);
        header('location: courses.php');
    }

    function updateCourse($formInfo) {
        $course = array_values($formInfo);
        CSV_Manager::updateRecord("./CSV/courses.csv", $course, 0);
        header('Location: courses.php');
    }

    
?>