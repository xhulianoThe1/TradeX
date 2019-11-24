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
  <link rel="stylesheet" href="templates/style.css">
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
    <a href="user.php" type="button" id="vp" class="btn btn-secondary btn-lg">View Portfolios</a>
    <a href="Helper Files/logout.php" type="button" id="so" class="btn btn-secondary btn-lg">Sign Out</a>
    <br>
    <br>
    <br>
    <br>
    <div class="container">    
    <div class="jumbotron" style="background-color:gray;">
    <h4>About Trade X</h4>
        <!-- https://www.flickr.com/photos/maguisso/218840988/in/photolist-kkBNu-cr2yJQ-3giWe5-9F1n3C-5C2aid-88qWS-9aeC6-6wYs7z-91djvW-XJAST-dePZQb-Gy1TwB-5t8dCa-frzWBv-4ksTmn-5B6KiY-8Co2Tw-4bnVMd-9Jcdov-bmBZZ9-5FxDfC-kqo5E-f2dVN1-GvDoc9-Gy1RZZ-GeGk6Y-GvDoJS-6mm2Nr-Gy1STT-GvDpuQ-GeGfLW-GvDq2w-HLcpsx-Gy1ThD-GvDpmJ-GDRpAx-GeGjQC-FJtWnn-Gy1S8p-GvDovL-Gy1RN6-FJjcUW-Gy1PB2-GeGma1-HDUuUv-HBwu7A-GBtVTd-GeGmhW-GvDpCL-FJtZ4p -->
    <img src ="templates/welcome.jpg" class="img-fluid" height = "200" width = "300">
    <p>Trade X is a portfolio management application that provides financial data on publicly traded NASDAQ assets, all from the comfort of your computer or phone. Create a portfolio now to view information on stock prices, graphs, and analytics. Navigate either to the View Portfolios button above to get started, or access the Portfolios tab on our website header at any time to view your portfolio information. Please also refer to our User Manual on the header as well for any questions you may have.</p>
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
