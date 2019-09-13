<?php

/** CSI 418
Modified from my CS410 - Intro to Databases Final Project
  */

$host       = "localhost";
$username   = "root";
$password   = "mike6151"; // this password will be changed when the database is uploaded to a webhosting service, for now its configured to the password of the local machine
$dbname     = "portfolio-database"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
