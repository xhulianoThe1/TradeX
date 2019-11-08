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
        <script>
    window.onload = function() {
  inactivityTime(); 
}
    </script>   
</head>
<body>
    
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" id ="nav">
  <a class="navbar-brand" href="#">Trade X <?php echo $uname ?></a>
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
      <!-- Portfolio Viewer Page link -->
      <li class="nav-item">
        <a class="nav-link" href="highchartsTest.php">Graphical Viewer</a>
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

    <!--Content Div's-->
   <br>
   <div class="container"><h4>Trade X User Manual</h4></div>
   <div class="container">
       <!--The User Manual contents --> 
       <br>
         <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#signup" aria-expanded="false" aria-controls="signup">
    Account Sign-In/Sign-Up
  </button>
       <div class="collapse" id="signup">
       <div class="signupBody">
       <ol type = "1">
        <li><b><u>Creating an Account</u></b></li>
                <ol type = "i">
                    <li> Creating an account will require you to navigate to the top left corner of your screen when on the home page, clicking or tapping on <b> "Sign up". </b></li>
                                        <img src ="User_Manual_Images/signupButton.png" height ="108" width ="391">
                    <li> Once there, you should see a prompt to enter in sign-up credentials, including your email, first and last name, and password.</li> 
                    <img src ="User_Manual_Images/signupPrompt.png" height = "200" width = "300">
                    <li> Enter your credentials as prompted. Keep in mind that we require that you reenter your password to ensure that you signup with the correct credentials.</li>
                    <li> Note that when making a password, we require a certain level of security in doing so. This means the following: </li>
                    <ul>
                        <li> Your password must contain one of these characters (not including the brackets): <b> [ ! @ # $ % & ]. </b> </li>
                        <li> Your password must have at least <b> one uppercase letter.</b> </li>
                        <li> Your password must have at least <b> one lowercase letter.</b> </li>
                        <li> Your password must be <b> 8 characters or longer </b> in length. </li>
                    </ul>
                    <li> Failure to uphold these strength requirements will result in being prompted to try again with a new password. </li>
                    <li> This is a sample password matching the above criteria <b>(NOTE: FOR SECURITY REASONS, WE RECOMMEND YOU DO NOT USE THIS EXACT PASSWORD) "tradeXisGREAT!!1" </b> </li>
                    <img src ="User_Manual_Images/signupSample.png" height = "200" width = "300">
                    <li> Upon successful account creation, you will be prompted to sign in with your new account. That's it! </li>
                    <img src ="User_Manual_Images/accountCreated.png" height = "200" width = "400">
                </ol>

            <li><b><u>Signing in to your Account</u></b></li>
                <ol type ="i">
                    <li>You will not be able to login until after creating an account. If you haven't yet done so, please refer to the above section on how to do so labeled <b>"Creating an Account". </b></li>
                    <li>Once you have an account on our system, please proceed to the top right corner of the home page, clicking or tapping on <b> "Sign in"</b></li>
                    <img src = "User_Manual_Images/signinButton.png" height = "108">
                    <li>You will then be prompted to enter the <b>email </b> and <b>password </b> you signed up with.</li>
                    <li>Upon entering your credentials correctly and navigating to <b>"Login"</b> you will be logged in and redirected to the page with all of your portfolios.</li>
                    <img src ="User_Manual_Images/sampleLogin.png" height ="200" width = "400">
                    <li>Notice that the top of the page you will see the email attached to your account as well as differing options available to you for working within your portfolios. That's it!</li>
           
           </ol>
           
       </ol>
    </div>
    </div>
       <!--End of The User Manual contents -->
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
        
   

</body>
</html>
