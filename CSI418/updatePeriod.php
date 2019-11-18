<?php 
session_start();
$_SESSION['period'] = $_POST['period'];
header("Location: SMA.php");
exit();
?>