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
//mysql://bd9acdd9020e4f:c31a396a@us-cdbr-iron-east-05.cleardb.net/heroku_bf9276ba3a568af?reconnect=true



$host       = "us-cdbr-iron-east-05.cleardb.net";
$username   = "bd9acdd9020e4f";
$password   = "c31a396a"; // this password will be changed when the database is uploaded to a webhosting service, for now its configured to the password of the local machine
$dbname     = "heroku_bf9276ba3a568af"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
