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

<?php

//https://stackoverflow.com/questions/13135131/php-getting-variable-from-another-php-file
   session_start();
   $uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Landing Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

body{
    background: linear-gradient(to right top,#443C2C,#678C9C) fixed;
}

        .container{
            text-align: center;
        }
.dropbtn {
  background-color: linear-gradient(to left top,azure, blue);
  color: darkslategray;
  padding: 16px;
  font-size: 16px;
  border: linear-gradient(to left top,azure, grey);
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: azure;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: darkgreen;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
        
        .portfolios{
              margin: 20px;
  border: 4px solid lightgray;
            text-align: center;
        }

.dropdown-content a:hover {background-color: greenyellow;}

.dropdown:hover .dropdown-content {
    display: block;   
        }

.dropdown:hover .dropbtn {background-color: dimgrey;}
</style>

</head>
<body>

<!--https://stackoverflow.com/questions/11651366/php-pass-data-to-html-form  -->
<div class="dropdown">
  <button class="dropbtn">My Profile - <?php echo $_SESSION['uname'] ?></button>
  <div class="dropdown-content">
    <a href="#">Account Settings (TBD)</a>
    <a href="#">Support (TBD)</a>
    <a href="user.php">Portfolios </a>
    <a href="index.php">Log Out</a>
  </div>
</div>



    <div class="container">
        <h1>Portfolio Name</h1>


        <div class="portfolios">
        <h1>{Portfolio Information Here}</h1>
            <h2>{This is where the graphing and stuff would be}</h2>
    
    </div>
        <input type="text" placeholder="Search for a stock">
    </div>
    
</body>
</html>