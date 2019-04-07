<?php
    if(isset($_SESSION['user'])) {
        header('location: console.php');
    }
    require_once("./Scripts/validate.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="./CSS/base.css">  
        <link rel="stylesheet" type="text/css" href="./CSS/index.css">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <title>PROCOMS</title> 
    </head>
    <body>
        <div id="signIn">
            <h1>PROCOMS</h1>            
            <h2>M.Sc. Information Technology</h2>
            <p id="warning"> <?php echo($GLOBALS['errorString']) ?> </p>
            <form id="mainForm" name="mainForm" action="index.php" method="POST">
                <table>
                    <tr>
                        <td>
                            <label for="email">E</label>
                        </td>
                        <td>
                            <input name="email" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">P</label>
                        </td>
                        <td>
                            <input name="password" type="password">
                        </td>
                    </tr>
                </table>
                <button type="submit" name='submitU'>Sign In</button>
            </form>
            
            <p><a href="#">Forgot Password</a></p>
        </div>
    </body>
    
    <script type="text/javascript" src="./JS/base.js"></script> 
    <script type="text/javascript" src="./JS/form.js"></script> 
</html>