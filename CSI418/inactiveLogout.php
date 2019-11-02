<<<<<<< HEAD
<?php
//retrieved from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

session_start();

$_SESSION['inactive'] = true;

// Redirect to login page
header("location: index.php");
exit;

?>
=======
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
>>>>>>> 3760ce4551e02755a513a2ff1e00f7664e92f11c
