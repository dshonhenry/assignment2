<!--LOGIN.PHP-->

<?php
function loginUser(array $data) {
    session_start();
    $file = file("./CSV/procoms_user.csv");
    $userFound =[];
    
    foreach ($file as $line) {
        if ($data['email']==str_getcsv($line)[0] && $data['password'] == str_getcsv($line)[1]){                    
            $userFound['em'] = str_getcsv($line)[0];            
            $userFound['pass'] = str_getcsv($line)[1];                     
            $userFound['fname'] = str_getcsv($line)[2];         
            $userFound['lname'] = str_getcsv($line)[3];                     
            $userFound['role'] = str_getcsv($line)[4];                 
            $userFound['loginTime'] = date("d-m-Y H:i:s");
            $_SESSION['user'] = $userFound;
            break;               
        }
    }
    
    session_write_close();
    header('Location: console.php');   
    exit(); 
}

function isUserLoggedIn(){
    session_start();
    return isset($_SESSION['user']);
}

function getUserInfo($field) {
    return $_SESSION['user'][$field];
}

?>