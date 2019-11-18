<?php
    require "config.php";
    require "common.php";
session_start();
$_SESSION['timestamp'] = time();
$_SESSION['inactive'] = false;
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

if(isset($_SESSION['pswMessage'])){
    if($_SESSION['pswMessage'] != ''){
        phpAlert($_SESSION['pswMessage']);
        $_SESSION['pswMessage'] = '';
    }
}
try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $getPassword = $connection->prepare("SELECT password FROM user WHERE user_id =:user_id");

    $getPassword->execute(['user_id'=>$_SESSION['user_id']]);
    $retrievedPassword = $getPassword->fetch();
    $password = implode(array_unique(array_values($retrievedPassword)));

}
catch(PDOException $e)
    {
    echo "error <br>" . $e->getMessage();
    }

?>   

<!DOCTYPE html>
<html>
<head>
<title>Trade X</title>
  <!--Bootstrap v4 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 50%;
}

input[type=submit] {
  background-color: lightblue;
  color: #fff;
  cursor: pointer;
}
      
    </style>
    <script>
    window.onload = function() {
  inactivityTime(); 
}
    
    </script>    

</head>
<body>
    
    
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" >
  <a class="navbar-brand" href="#">Trade X - <?php echo $_SESSION['uname'] ?></a>
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
        <a class="nav-link" href="#">Settings</a>
      </li>
      <!--Sign-out link-->  
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Sign-out</a>
      </li>
    </ul>
    <!--End of Navbar links -->
  </div>  
</nav>
    <!-- https://phppot.com/php/php-change-password-script/ -->
    
        <!--Content Div's-->
   <br>
   <div class="container"><h4>Account Settings</h4></div>
   <div class="container">
       <!--The Change Password contents --> 
       <!-- https://phppot.com/php/php-change-password-script/  for html format-->
       <br>
         <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#changepass" aria-expanded="false" aria-controls="changePassword">
    Click here to change your password
  </button>
       <div class="collapse" id="changepass">
       <div class="changePassword">
<form name="createNewPassword" method="post" action="changePassword.php">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField" id = "currentPass"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>

    </div>
    </div>
       <!--End of Change Password Contents -->
  </div>
    
    <div class="container">
       <!--The Delete Account contents --> 
       <br>
         <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#delete" aria-expanded="false" aria-controls="deleteAccount">
    Click here to delete your account
  </button>
       <div class="collapse" id="delete">
       <div class="deleteAccount">
<form name="deleteInfo" method="post" action="deleteAccount.php">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr>
<td width="40%"><label>Current User Name</label></td>
<td width="60%"><input type="text" name="currentUsername" class="txtField" id = "currentUser"/><span id="currentUsername"  class="required"></span></td>
</tr>
<tr>
<td><label>Current Password</label></td>
<td><input type="password" name="currentPassword" class="txtField" id = "currentPass"/><span id="currentPassword" class="required"></span></td>
</tr>
<tr>
<td><label><b>If you are sure you would like to delete your account, type "YES" (exactly as it appears, without the quotations). Note that this is irreversible, and all account information, including portfolios, will be lost.</b> </label></td>
<td><input type="text" name="areYouSure" class="txtField"/><span id="youSure" class="required"></span></td>
</tr>    
<tr>
<td colspan="2"><input style="background-color:red" type="submit" name="submit" value="DELETE MY ACCOUNT" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>

    </div>
    </div>
       <!--End of Change Password Contents -->
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
        time = setTimeout(logout, 30000)
        // 1000 milliseconds = 1 second, so 900000 is 15 minutes
        //settings page will have 30000 for the demo (loggout after 30secs)
    }
};
   </script> 
    