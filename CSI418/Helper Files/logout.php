<?php
//retrieved from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
$message = '';
// Initialize the session
session_start();

if(isset($_SESSION['pswMessage'])){
    if($_SESSION['pswMessage'] == ''){
        //
    }
    else{
        $message = $_SESSION['pswMessage'];
    }
}

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

session_start();

if($message != ''){
    $_SESSION['pswMessage'] = $message;
}

$_SESSION['inactive'] = false;

// Redirect to login page
header("location: ../index.php");
exit;

?>
