<!--VIEWSTUDENT.PHP-->

<?php
    require_once('CSVManagement.php');
    function getStudents($year){
        $file = file("./CSV/students.csv");
        $students = [];

        foreach ($file as $line) {
            if(str_getcsv($line)[4] == $year) {
                $newStudent = readStudent($line);  
                $students[] = $newStudent;
            }
        }

        if(isset($students))
            return json_encode($students);
        else 
            return null;
    }

    function viewStudents($json) {
        
        $students = json_decode($json);
        $htmlString = '<table id="studentTable">';
        if($students == null) {
            $htmlString = $htmlString.'<tr>
                                <td>No Students</td>
                            </tr>';
        }
        else {
           foreach($students as $student) {
                $htmlString = 
                $htmlString.'<tr>
                                <td><a href="Scripts/manageStudents.php?id='.$student->studentId.'&action=del">Delete</a></td>
                                <td><a href="Scripts/manageStudents.php?id='.$student->studentId.'&action=edit">Edit</a></td>
                                <td>'.$student->studentId.'</td>                
                                <td>'.$student->fname.'</td>
                                <td>'.$student->lname.'</td>
                                <td>'.$student->email.'</td>
                            </tr>';
            }
        }
        $htmlString = $htmlString."</table>";
        return $htmlString;


    } 

    function getStudentById($id) {
        return readStudent(CSV_Manager::getRecordById("./CSV/students.csv",$id, 0));
    }

    function readStudent($line){
        if($line == null)
            return $line;
        $student['studentId'] = str_getcsv($line)[0];            
        $student['fname'] = str_getcsv($line)[1];                     
        $student['lname'] = str_getcsv($line)[2];         
        $student['email'] = str_getcsv($line)[3];                               
        $student['year'] = str_getcsv($line)[4];                                               
        $student['address'] = str_getcsv($line)[5];

        return $student;
    }
?>