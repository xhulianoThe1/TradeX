<?php
session_start();
$_SESSION['timestamp'] = time();
$_SESSION['inactive'] = false;
$_SESSION['chosenTicker'] = '';
$_SESSION['period'] = 7;

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}


//checks to see if the user is actually logged in
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('location: index.php');
    exit;
}

if(isset($_GET['uname'])){    
    $uname = $_GET['uname'];
    $_SESSION['uname'] = $uname;
}  

if(isset($_SESSION['portExists'])){
    if($_SESSION['portExists'] != ''){
        phpAlert($_SESSION['portExists']);
        $_SESSION['portExists'] = '';
    }

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Trade X</title>
  <!--Bootstrap v4 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Cinzel|Marck+Script|Philosopher&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script>
    window.onload = function() {
    inactivityTime(); 
}
    
    </script>    

</head>
<body>
    
    <!--Nav bar -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="homepage.php" id="logo"  >Trade X - <?php echo $_SESSION['uname'] ?></a>
   <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
   <!--End ofn Toggler/collapsibe Button -->  
    
    <!-- Navbar links -->
    <ul class="navbar-nav">
      <!-- landing Page link -->
      <li class="nav-item">
        <a class="nav-link" href="user.php">Portfolios</a>
      </li>
      <!-- User Manual link -->
      <li class="nav-item">
        <a class="nav-link" href="UserManual.php">User Manual</a>
      </li>
      <!-- Settings link-->
      <li class="nav-item">
        <a class="nav-link" href="settings.php">Settings</a>
      </li>
      <!--Sign-out link-->  
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Sign-out</a>
      </li>
    </ul>
    <!--End of Navbar links -->
  </div>  
</nav>

    <!--Content Div's-->


   
    <div class="container">
    <br>
    <br>
    <br>
    <h1 class="display-3" id="logo">Trade X</h1>
    <br>
    <a href="user.html" type="button" id="vp" class="btn btn-secondary btn-lg">View Portfolios</a>
    <a href="#" type="button" id="so" class="btn btn-secondary btn-lg">Sign Out</a>
    <br>
    <br>
    <br>
    <br>
    <div class="container">    
    <div class="jumbotron" style="background-color:gray;">
    <h4>About Trade X</h4>
    <p>place holder text</p>
    </div>
    </div>

     
    
    
 <script>
    //  https://stackoverflow.com/questions/667555/how-to-detect-idle-time-in-javascript-elegantly?page=1&tab=votes#tab-top
    var inactivityTime = function () {
    var time;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
    document.onmousedown = resetTimer; // touchscreen presses
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer;     // touchpad clicks
    document.onkeypress = resetTimer;

        //this is a separate logout page for users who are automatically logged out
    function logout() {
        location.href = 'inactiveLogout.php';
        
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 900000)
        // 1000 milliseconds = 1 second, so 900000 is 15 minutes
    }
};
   </script> 
    </div>
</body>
</html>
