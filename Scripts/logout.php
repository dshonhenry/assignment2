<!--LOGOUT.PHP-->

<?php
logoutUser();

function logoutUser() {
    session_start();
    session_destroy();
    header('location: ../index.php');
}
?>