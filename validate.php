<!--VALIDATE.PHP-->

<?php
    require("login.php");
    global $errorString;
    $GLOBALS['errorString'] = "";
    if(isset($_POST['submitU'])) {
        $user_info['email'] = $_POST['email'];
        $user_info['password'] = $_POST['password'];
        if(!isset($_COOKIE['scriptEnabled'])) {

            if(!isEmailValid($user_info['email'])) {                
                $GLOBALS['errorString'] = "Invalid Email"; 
                return;
            }
            if(!isPasswordValid($user_info['password'])) {
                $GLOBALS['errorString'] = "Invalid Password"; 
                return;
            } 
        }
        else {setcookie('scriptEnabled', '', time() - 3600);}  

        if(areCredentialsValid($user_info)) {
            $file = file("procoms_user.csv");
            $users = [];
            foreach ($file as $line) {
                $newUser['em'] = str_getcsv($line)[0];            
                $newUser['pass'] = str_getcsv($line)[1];                     
                $newUser['fname'] = str_getcsv($line)[2];         
                $newUser['lname'] = str_getcsv($line)[3];                     
                $newUser['role'] = str_getcsv($line)[4];
                $users[] = $newUser;
            }
            foreach ($users as $user){
                if ($user['em']==$user_info['email'] && $user['pass'] == $user_info['password']){
                    $userFound = $user;                
                }
            }
            loginUser($userFound);
        }    
    }

    function areCredentialsValid(array $user_info) {   
        $file = file("procoms_user.csv");     
        $recordMatches = 0;

       
        foreach ($file as $line) {
            if ($user_info['email']==str_getcsv($line)[0] && $user_info['password'] == str_getcsv($line)[1]){
                $recordMatches++;           
            }
        }        
      
        if($recordMatches == 1) {
            return true;       
        }
        return false;
              
    }

    function isEmailValid($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;           
        }
        return true;
    }

    function isPasswordValid($password) {
        if(strlen($password) < 8)
            return false;

        $numFound = false;
        for($i = 0; $i<strlen($password); $i++) {
            $char = $password[$i];
            if(is_numeric($char)){
                $numFound = true;
                break;
            }
        }
        if(!$numFound)
            return false;

        return true;
    }

    function isIdValid($id) {
        if(strlen($id) != 9)
            return false;
        if($id[0] != "4")
            return false;
        return true;
    }

    function isNameValid($name) {
        if (!ctype_alpha($name))
            return false;
        return true;
    }

    function isAddressValid($address) {
        if($address == "")
            return false;
        $specialFound = false;
        for($i = 0; $i<strlen($address); $i++) {
            $char = $address[$i];
            if(ctype_punct($char)) {
                $specialFound = true;
                break;
            }
        }
        return !$specialFound;
    }
?>