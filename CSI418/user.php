<!--
CSI 418
Modified from my CS410 - Intro to Databases Final Project
    
    This script creates the user landing page. The landing page
    contains links to all of the user functions, listed below. 
<img src="plus.png" height="240" width="320">
<?php include "templates/header.php"; ?>

-- takes user to page to add a portfolio -- 
    Create a new portfolio here!
    <a href="addPortfolio.php"><img src="plus.png"></a>


<?php include "templates/footer.php"; ?>
    -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="userStyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<!--https://stackoverflow.com/questions/11651366/php-pass-data-to-html-form  -->
<?php
$uname = $_GET['uname'];
?>     
<div class="dropdown">
  <button class="dropbtn">My Profile - <?php echo $uname ?></button>
  <div class="dropdown-content">
    <a href="#">Account Settings</a>
    <a href="#">Portfolios</a>
    <a href="#">Support</a>
    <a href="index.php">Log Out</a>
  </div>
</div>
<div class="container">
    
    <div class="panel panel-default">
        <div class="panel-body"><a href="#"><img src="plusText.png" /></a></div>
    </div>
</div>


</body>
</html>

