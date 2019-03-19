<!--MANAGESTUDENTS.PHP-->

<?php
    include("validate.php");
    include("viewStudents.php");

    session_start();
    if(isset($_POST['cancel'])) {
        header('Location: students.php?year='.$_SESSION['year']);
        exit();
    }

    if($_GET['action']=="edit" && !isset($_POST['submit'])) {
        header('Location: newStudent.php?id='.$_GET['id']);
        exit();
    }

    if($_GET['action']=="delete" && !isset($_POST['submit'])) {
        removeStudent($_GET['id']);
        exit();
    }
     
    if(isset($_POST['submit']) && $_GET['action']=="add") {
        unset($_POST['submit']);        
        validateForm($_POST);
        newStudent($_POST);
    }

    if(isset($_POST['submit']) && $_GET['action']=="edit") {
        unset($_POST['submit']);        
        validateForm($_POST);
        updateStudent($_POST);
    }

    function newStudent($student) {

        $newStudent = array($student['studentId'] ,$student['fname'],$student['lname'],$student['email'],$_SESSION['year'], $student['address']);
        
        $file = fopen("students.csv", "a");
        fputcsv($file, $newStudent);
        fclose($file);
        header('Location: students.php?year='.$_SESSION['year']);
        exit();
        
    }

    function updateStudent($formInfo) {
        $file = file("students.csv");
        $students = [];

        foreach ($file as $line) {
            if($formInfo['studentId'] == str_getcsv($line)[0]) {
                $newStudent[0] = $formInfo['studentId'];  
                $newStudent[1] = $formInfo['fname'];                    
                $newStudent[2] = $formInfo['lname'];         
                $newStudent[3] = $formInfo['email'];                               
                $newStudent[4] =  $_SESSION['year'];                         
                $newStudent[5] = $formInfo['address'];           
            }
            else {
                $student = readStudent($line);
                $newStudent = array($student['studentId'] ,$student['fname'],$student['lname'],$student['email'],$student['year'], $student['address']);
            }
            $students[] = $newStudent;
        }
        fclose($file);

        $file = fopen("students.csv", "w");
        foreach($students as $student)
            fputcsv($file, $student);
        fclose($file);
        header('Location: students.php?year='.$_SESSION['year']);
    }

    function removeStudent($studentId) {
        $file = file("students.csv");
        $students = [];

        foreach ($file as $line) {
            if($studentId == str_getcsv($line)[0]) 
                continue;
            for($i =0; $i<6; $i++) {
                $newStudent[$i] = str_getcsv($line)[$i];     
            }   
            $students[] = $newStudent;
        }
        fclose($file);

        $file = fopen("students.csv", "w");
        foreach($students as $student)
            fputcsv($file, $student);

        header('Location: students.php?year='.$_SESSION['year']);
        exit();
    }

    function validateForm($student) {
        if(isset($_SESSION['errors']))
            unset($_SESSION['errors']);
            
        if(isset($_SESSION['formInfo']))
            unset($_SESSION['formInfo']);

        if(getStudentById($student['studentId']) != null && $_GET['operation']=="add") {            
            $errors['studentId'] = "true";
        }
        if(!isIdValid($student['studentId'])) {
            $errors['studentId'] = "true";
        }
        if(!isNameValid($student['fname'])) {            
            $errors['fname'] = "true";
        }
        if(!isNameValid($student['lname'])) {
            $errors['lname'] = "true";
        }
        if(!isEmailValid($student['email'])) {
            $errors['email'] = "true";
        }
        if(!isAddressValid($student['address'])) {
            $errors['address'] = "true";
        }
        
        if(isset($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['formInfo'] = $student;
            header('Location: newStudent.php');
            exit();
        }
    }
?>