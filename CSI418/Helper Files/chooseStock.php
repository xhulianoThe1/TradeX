<?php
    session_start();
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";

foreach ($_POST as $name => $val)
{
     $_SESSION['chosenTicker'] =  htmlspecialchars($name);
}

   header("Location: ../Graphs and Analytics/".$_SESSION['graphCameFrom']);
   exit;


?>