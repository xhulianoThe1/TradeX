<?php
    session_start();
    require "config.php";
    require "common.php";

foreach ($_POST as $name => $val)
{
     $_SESSION['chosenTicker'] =  htmlspecialchars($name);
}

   header("Location: ".$_SESSION['graphCameFrom']);
   exit;


?>