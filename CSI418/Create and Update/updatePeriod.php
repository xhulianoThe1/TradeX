<?php 
session_start();
$_SESSION['period'] = $_POST['period'];
header("Location: ../Graphs and Analytics/SMA.php");
exit();
?>