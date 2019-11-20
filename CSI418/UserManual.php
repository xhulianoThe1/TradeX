<?php
session_start();
$_SESSION['timestamp'] = time();
$_SESSION['inactive'] = false;
$_SESSION['chosenTicker'] = '';
$_SESSION['period'] = 7;

//checks to see if the user is actually logged in
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('location: index.php');
    exit;
}

if(isset($_GET['uname'])){    
    $uname = $_GET['uname'];
    $_SESSION['uname'] = $uname;
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
      <script>
         window.onload = function() {
         inactivityTime(); 
         }
      </script>   
      
   </head>
   <body>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark" id ="nav">
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
                  <a class="nav-link" href="settings.php">Settings</a>
               </li>
               <!--Sign-out link-->  
               <li class="nav-item">
                  <a class="nav-link" href="Helper Files/logout.php">Sign-out</a>
               </li>
            </ul>
            <!--End of Navbar links -->
         </div>
      </nav>
      <!--Content Div's-->
      <br>
      <div class="container">
         <h4>Trade X User Manual</h4>
      </div>
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
                   <!--Sign Up-->
                  <li> Creating an account will require you to navigate to the top right corner of your screen when on the home page, clicking or tapping on <b> "Sign up". </b></li>
                  <img src ="User_Manual_Images/signupButton.png" class="img-fluid" height ="108" width ="391">
                  <li> Once there, you should see a prompt to enter in sign-up credentials, including your email, first and last name, and password.</li>
                  <img src ="User_Manual_Images/SignUp1.png" class="img-fluid" height = "200" width = "300">
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
                  <img src ="User_Manual_Images/SignUp2.png" class="img-fluid" height = "200" width = "300">
                  <li> Upon successful account creation, you will be prompted to sign in with your new account. That's it! </li>
                  <img src ="User_Manual_Images/accountCreated.png" class="img-fluid" height = "200" width = "400">
               </ol>
               <li><b><u>Signing in to your Account</u></b></li>
               <ol type ="i">
                  <!--Sign in-->
                  <li>You will not be able to login until after creating an account. If you haven't yet done so, please refer to the above section on how to do so labeled <b>"Creating an Account". </b></li>
                  <li>Once you have an account on our system, please proceed to the top right corner of the home page, clicking or tapping on <b> "Sign in"</b></li>
                  <img src = "User_Manual_Images/SignInButton.png" class="img-fluid" height = "108">
                  <li>You will then be prompted to enter the <b>email </b> and <b>password </b> you signed up with.</li>
                  <li>Upon entering your credentials correctly and navigating to <b>"Login"</b> you will be logged in and redirected to the page with all of your portfolios.</li>
                  <img src ="User_Manual_Images/SignIn.png" class="img-fluid" height ="200" width = "400">
                  <li>Notice that the top of the page you will see the email attached to your account as well as differing options available to you for working within your portfolios. That's it!</li>
               </ol>
            </ol>
         </div>
      </div>
      <br>
      <br>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#portfolio" aria-expanded="false" aria-controls="portfolio">
      Creating a Portfolio
      </button>
      <div class="collapse" id="portfolio">
         <div class="portfolioBody">
            <!--Creating Portfolio-->
            <b><u>Creating a Portfolio</u></b>
            <p> To get started, once have signed in, you will land on the main page which will consist of creating a new portfolio. Click or tap on the “Enter portfolio name here” and enter the name you would like for your portfolio, then click or tap <b> “Submit Query”. </b> </p>
            <img src ="User_Manual_Images/SubmitQuery.png" class="img-fluid" height ="108" width ="270">  <br>
            Once you have entered and selected a name, you will see the newly created portfolio, in this case, <b>My Portfolio.</b> <br> <br>
            <img src ="User_Manual_Images/PortfolioCreated.png" class="img-fluid" height ="110" width ="170">
         </div>
      </div>
      <br>
      <br>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#adding" aria-expanded="false" aria-controls="adding">
      Adding Assets
      </button>
      <div class="collapse" id="adding">
         <div class="addingBody">
            <!--Adding Asset-->
            <b><u>Adding an Asset</u></b>
            <P>Once you have successfully created your portfolio, then you can go ahead and add your desired assets for comparison. For Adding assets, you can click or tap on <b>“Open My Portfolio in Graphical View” </b> <i>(Figure 1).</i> Once there you will see an area where you can search for a asset <i>(Figure 2).</i> In the search bar, you can either search for the desired asset by typing the full name of the asset or put the ticker of the asset in parenthesis. The search bar is set up to have auto-complete for any asset(s) that you would like to add. An example of adding an asset to <b>My Portfolio</b> would be Facebook, which can be entered by typing the first few letters of the company or by inputting FB inside the parenthesis like so: (FB) and clicking or tapping the <b>“Submit Query” </b> button to add the following asset to <b>My Portfolio</b>. If you are not sure of the ticker, you can start typing the first few letters of the organization and the auto-complete feature implemented into the search bar will provide suggestions or similar key words of other organizations as well as the ticker for those organizations <i>(Figure 3)</i>. </P>
            <br> <img title="Figure 1" src ="User_Manual_Images/Figure1.png" class="img-fluid" height ="38" width ="270">  <br>
            <br> <img title="Figure 2" src ="User_Manual_Images/Figure2.png" class="img-fluid" height ="140" width ="270">  <br>
            <br> <img title="Figure 3" src ="User_Manual_Images/Figure3.png" class="img-fluid" height ="350" width ="240">  
            <p>Once you have finished adding your desired asset(s), by default the line chart showing the value of the asset(s) can be viewed. If you would like to see a different chart such as a pie chart, bar chart or a high-low chart of specific asset(s), you can navigate to the top left of the screen to choose from the variety of different methods of showing the data over a specific period of time <i>(Figure 4).</i> All the charts can be adjusted based on performance of the asset over a period of time such as <i>All</i> which considers the performance of the asset since the beginning of when the organization first became publicly-traded and an owned entity, a <i>year</i>, <i>YTD</i> (Year-to-Date, a period, starting from the beginning of the current calendar year or fiscal year and continuing up to the present day, <i>six months</i>, <i>three months </i>as well as <i>one month</i>. All of these adjustments for performance can be toggled through the following location at the left side of the screen above the charts being shown <i>(Figure 5).</i> Finally, on the right corner of your screen, (as shown in  <i>(Figure 6).</i> you will see the following 
               <img src ="User_Manual_Images/Toggle.png" class="img-fluid" height ="60" width ="60">  
               which will toggle a drop-down menu that lets you view the specific chart in full screen, print the chart, download the chart as PNG, JPEG, PDF or SVG vector image forms for your convenience. 
            </p>
            <img title="Figure 4" src ="User_Manual_Images/Figure4.png"  class="img-fluid"  height ="350" width ="800">  <br>
            <br>  <img title="Figure 5" src ="User_Manual_Images/Figure5.png" class="img-fluid" height ="350" width ="800">  <br>
            <br>  <img title="Figure 6" src ="User_Manual_Images/Figure6.png" class="img-fluid" height ="350" width ="800">  <br>             
         </div>
      </div>
      <br>
      <br>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#removing" aria-expanded="false" aria-controls="removing">
      Removing Assets
      </button>
      <div class="collapse" id="removing">
         <div class="removingBody">
             <!--Removing Asset -->
             <!--Removing Asset -->
            <b><u>Removing an Asset</u></b>
            <p>You can remove specific asset(s) from your portfolio in a very simple yet intuitive way. From the main log-in page, click or tap on <b>“Portfolios”</b> at the top of the page to get your list of portfolios, from there you can choose to select a specific portfolio by clinking or tapping on <b>“Open My Portfolio in Graphical View”.</b> Once there, using our Facebook example which is already in <b>“My Portfolio” </b>you can choose to remove it by clicking or tapping on <b> “Click to remove FB from Portfolio” </b><i>(Figure 7).</i> Once removed, if there are any other assets in the portfolio, they will automatically adjust and re-fresh their performance data on the charts. </p>
            <br>  <img title="Figure 7" src ="User_Manual_Images/Figure7.png" height ="180" width ="240">  <br>       
         </div>
      </div>
      <br>
      <br>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#understanding" aria-expanded="false" aria-controls="understanding">
      Understanding the Charts
      </button>
      <div class="collapse" id="understanding">
         <div class="understandingBody">
             <!--Charts-->
            <b><u>Understanding our Chart and Analytic Options</u></b>
            <p>As mentioned before, there are four different types of charts available for you to compare assets in your portfolio(s). A <b>Line Chart </b>is a graphical representation of an asset's historical price action that connects a series of data points with a continuous line. This is the most basic type of chart used in finance and typically only depicts a security's closing prices over time. Since asset prices tend to trend, trendlines that connect the highs or lows in the asset's price history can help identify the current trend and predict what the Asset price might do in the future. The following depicts a line chart using Facebook (FB) and Google (GOOG).</p>
            <br>  <img title="Line Chart" src ="User_Manual_Images/Line.png" class="img-fluid" height ="200" width ="700">  <br> 
            <br> 
            <p>A <b>Pie Chart</b> is generally used to show percentage or proportional data and usually the percentage represented by each category is provided next to the corresponding slice of pie. Pie charts are good for displaying data for around 6 categories or fewer. The following depicts a pie chart using Facebook (FB) and Google (GOOG)</p>
            <br>  <img title="Pie Chart" src ="User_Manual_Images/Pie.png" class="img-fluid" height ="150" width ="200">  <br> 
            <br> 
            <p>A <b>Bar Chart </b>is one of the other several ways that we have provide for your to visually analyze asset prices. A bar chart consists of a horizontal series of vertical lines, or bars, that each show a asset's price for a certain time period. With a quick glance at a bar chart, you can see how a asset’s price has recently behaved and spot any potential price patterns. The following depicts a bar chart using Facebook (FB) and Google (GOOG)</p>
            <br> 
            <img title="Bar Chart" src ="User_Manual_Images/Bar.png" class="img-fluid"  height ="200" width ="700">  <br> 
            <br>
            <p><b>High-Low Charts</b> show the high and low price an asset attained for a particular period of time. The chart displays a series of vertical lines where the top of the line shows the high price, the bottom of the line the low price. It is typically a technical indicator used by investors who view the 52-week high or low as an important factor in determining a asset's current value and predicting future price movement. The following depicts a high-low chart for Facebook (FB) and Google (GOOG)</p>
            <img title="High-Low Chart" src ="User_Manual_Images/High-Low.png" class="img-fluid" height ="200" width ="700"> 
             <br>
             <p>It is important to note that for High-Low Charts, you are only able to view one asset at a time from your portfolio. By default, the first asset shown will be the first asset in your portfolio, but this
             can be altered easily as shown below. Just select the button below the asset you wish to display labled: "Click to display [Your asset will show here] from Portfolio".</p>
             <img title="High-Low Chart Choice" src ="User_Manual_Images/High-LowChoice.png" class="img-fluid" height ="200" width ="700">
             <br>
             <p>Finally, our <b>Simple Moving Average Analytic</b>, (see as the black dotted line) similarily to the High-Low Chart, works with one asset at a time (the current asset displayed is changed in the same manner, see instructions above). Simple Moving averages are an arithmetic average calculated by the summation of recent closing prices over a given period of days. By default, the average displayed will be over a period of 7 days, that is to say the price reflected by the Simple Moving Average will be that of the average of the last 7 day's worth of closing prices for the current asset. Behind the simple moving average (seen in black) is a blue candlestick view that demonstrates 4 separate price values over the same period, open, high, low, and closing prices. This is for comparison purposes to draw data between average values and these values at the same time. </p>
             <img title="Simple Moving Average" src ="User_Manual_Images/Simple-Moving-Average.png" class="img-fluid" height ="200" width ="700">
             <br>
             <p>  It should be noted that the period can be changed to any value from 1 to 500 using the entry box seen below. </p>
             <img title="Simple Moving Average Period" src ="User_Manual_Images/Simple-Moving-Average-Period.png" class="img-fluid" height ="200" width ="700">
         </div>
      </div>
      <br> 
      <br> 
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#deleting" aria-expanded="false" aria-controls="deleting">
      Deleting Portfolio
      </button>
      <div class="collapse" id="deleting">
         <div class="deletingBody">
             <!--Deleting Portfolio-->
            <b><u>Deleting Portfolio</u></b>
            <p>Anytime you want to remove your portfolio(s), you can head over to your list of created portfolios by navigating to the top of your screen and clicking or tapping on <b>“Portfolios”.</b> </p>
            <img title="Getting to your Portfolio(s)" src ="User_Manual_Images/Portfolios.png" class="img-fluid" height ="450" width ="500"> 
            <br>
            <br>  
            <p> Once there, you can alter your portfolio(s) by deleting them from your account by clicking or tapping on <b> “Delete My Portfolio from Portfolios”. </b>This will remove all the assets associated with the portfolio to be deleted permanently from your account. Upon making the selection, the page will refresh automatically with what is left of your current active portfolio(s).</p>
            <img title="Deleting your Portfolio(s)" src ="User_Manual_Images/DeletingPortfolios.png" class="img-fluid" height ="350" width ="300"> 
         </div>
      </div>
      <br> 
      <br> 
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="settings">
      Settings
      </button>
      <div class="collapse" id="settings">
         <div class="settingsBody">
             <!--Settings-->
            <b><u>Settings</u></b>
            <p>The settings section at the top of your page includes access to change your password and to permanently delete your account. By navigating to the<b>“Settings”</b> option as shown in <i>(Figure 8)</i>, you will be able to change your current password. In order to successfully to change your password you MUST populate both the current password, new password and confirm the password fields. These fields require the same level of security such as strength requirements when you initially made an account (please refer to section iii of the account sign-in/sign-up portion under the user manual). Also included in the <b>“Settings” </b>option is the ability to give you the preference of completely deleting and removing your individual account. <b><i>WARNING: This option will remove ALL of your created and existing portfolio(s); THIS ACTION CAN NOT BE UNDONE.</i></b> For your protection so that you don’t wind up removing your account and all of its portfolios by accident, we have made three criteria that need to be fulfilled when deleting your account. These consist of typing in your username, current password as well as a phrase. To begin the process of deleting your account, you MUST type your user name including current password associated with the username and the phrase <b>YES</b> in the text box located as shown in <i>(Figure 9)</i>. Failing to fulfil any of the three options mentioned above, your account will not be deleted. </p>
            <img title="Figure 8 " src ="User_Manual_Images/Figure8.png" class="img-fluid" height ="350" width ="300"> 
            <img title="Figure 9 " src ="User_Manual_Images/Figure9.png" class="img-fluid" height ="350" width ="300"> 
         </div>
      </div>
      <br> 
      <br> 
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#inactivity" aria-expanded="false" aria-controls="inactivity">
      Inactivity/Signout
      </button>
      <div class="collapse" id="inactivity">
         <div class="inactivityBody">
            <!--Inactivity/Signout -->
            <b><u>Inactivity/Signout</u></b>
            <p> For your protection, we have enabled automatic logout due to user inactivity. After 15 minutes of inactivity, our system will automatically log you off and you will have to sign back in to get back to your portfolios.</p>
            <img title="Inactivity Warning" src ="User_Manual_Images/Inactivity.png" class="img-fluid" height ="150" width ="300">  <br>
            <br>
            <p>Once you are ready to signout of the application, you can easily do so by navigating to the top of your screen and tapping or clicking on <b>"Sign-out"</b> as shown in <i>Figure 10</i>. Doing so will ensure that you do not leave your account open to anybody who happens to have access to your computer. We recommend whenever your session on our site is over that you manually sign-out in this fashion as it is safer than letting our system automatically log you out for inactivity.</p>
            <img title="Signning Out" src ="User_Manual_Images/Figure10.png" class="img-fluid" height ="50" width ="300">  <br>
         </div>
      </div>
      <br> 
      <br> 
      <!--End of The User Manual contents -->              
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
             location.href = 'Helper Files/inactiveLogout.php';
             
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