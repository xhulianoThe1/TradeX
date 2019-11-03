<?php

/** CSI 418
Modified from my CS410 - Intro to Databases Final Project
  */

/*
$host       = "localhost";
$username   = "root";
$password   = "mike6151"; // this password will be changed when the database is uploaded to a webhosting service, for now its configured to the password of the local machine
$dbname     = "TRADEX_DATABASE"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

*/
//mysql://bb874a893dce20:84f548c8@us-cdbr-iron-east-05.cleardb.net/heroku_a6afaaba3422b9a?reconnect=true



$host       = "us-cdbr-iron-east-05.cleardb.net";
$username   = "bb874a893dce20";
$password   = "84f548c8"; // this password will be changed when the database is uploaded to a webhosting service, for now its configured to the password of the local machine
$dbname     = "heroku_a6afaaba3422b9a"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>