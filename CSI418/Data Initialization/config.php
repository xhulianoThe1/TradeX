<?php

//mysql://bb874a893dce20:84f548c8@us-cdbr-iron-east-05.cleardb.net/heroku_a6afaaba3422b9a?reconnect=true



$host       = "us-cdbr-iron-east-05.cleardb.net";
$username   = "bb874a893dce20";
$password   = "84f548c8"; 
$dbname     = "heroku_a6afaaba3422b9a"; 
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>