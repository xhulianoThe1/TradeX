<?php

/** CSI 418
Modified from my CS410 - Intro to Databases Final Project
  */

$host       = "us-cdbr-iron-east-05.cleardb.net";
$username   = "bb08ccb364f632";
$password   = "cd4d0490"; // this password will be changed when the database is uploaded to a webhosting service, for now its configured to the password of the local machine
$dbname     = "heroku_6c090cb7cb60414e"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

//mysql://bb08ccb364f632:cd4d0490@us-cdbr-iron-east-05.cleardb.net/heroku_6c090cb7cb60414?reconnect=true