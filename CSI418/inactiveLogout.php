<?php
//retrieved from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the current session.
session_destroy();

session_start();

$_SESSION['inactive'] = true;

// Redirect to login page
header("location: index.php");
exit;

?>

