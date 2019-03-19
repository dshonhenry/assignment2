<!--LOGIN.PHP-->

<?php
    function loginUser(array $data) {
        session_start();
        $data['loginTime'] = date("d-m-Y H:i:s");
        $_SESSION['user'] = $data;
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