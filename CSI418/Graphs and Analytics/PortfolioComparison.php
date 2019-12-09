<?php 
session_start();
$_SESSION['timestamp'] = time();
$_SESSION['inactive'] = false;
$_SESSION['graphCameFrom'] = 'PortfolioComparison.php';
$_SESSION['chosenTicker'] = '';

//checks to see if the user is actually logged in
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('location: ../index.php');
    exit;
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}


if(isset($_SESSION['tickerReport'])){
    if($_SESSION['tickerReport'] != ''){
        phpAlert($_SESSION['tickerReport']);
        $_SESSION['tickerReport'] = '';
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../templates/style.css">
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
    
    
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" >
  <a class="navbar-brand" id="logo" href="homepage.php">Trade X - <?php echo $_SESSION['uname'] ?></a>
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
        <a class="nav-link" href="../user.php">Portfolios</a>
      </li>
      <!-- User Manual link -->
      <li class="nav-item">
        <a class="nav-link" href="../UserManual.php">User Manual</a>
      </li>
      <!-- Settings link-->
      <li class="nav-item">
        <a class="nav-link" href="../settings.php">Settings</a>
      </li>
      <!--Sign-out link-->  
      <li class="nav-item">
        <a class="nav-link" href="../Helper Files/logout.php">Sign-out</a>
      </li>
    </ul>
    <!--End of Navbar links -->
  </div>  
</nav>
    
        
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark" >

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
   <!--End ofn Toggler/collapsibe Button -->  
    
    <!-- Navbar links -->
    <ul class="navbar-nav">
      <!-- landing Page link -->
      <li class="nav-item">
        <a class="nav-link" href="displayHighstocks.php">Line Chart</a>
      </li>
      <!-- Portfolio Viewer Page link -->
      <li class="nav-item">
        <a class="nav-link" href="HighchartsPieChart.php">Pie Chart</a>
      </li>
      <!-- User Manual link -->
      <li class="nav-item">
        <a class="nav-link" href="HighchartsBarChart.php">Bar Chart</a>
      </li>
                      <li class="nav-item">
        <a class="nav-link" href="HighchartsHighLow.php">HighLow Chart</a>
      </li>
                                              <li class="nav-item">
        <a class="nav-link" href="SMA.php">Simple Moving Average Analytic</a>
      </li>
                	  <li class="nav-item">
        <a class="nav-link" href="MACD.php">MACD Analytic</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="totalLineChart.php">Total Open Line Chart</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="../Helper Files/whichToCompare.php">Portfolio Comparison</a>
      </li>
    </ul>
    <!--End of Navbar links -->
  </div>  
</nav>

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
        location.href = '../Helper Files/inactiveLogout.php';
        
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 900000)
        // 1000 milliseconds = 1 second, so 900000 is 15 minutes
    }
};
   </script>


<!DOCTYPE html>
<html>
<head>
	<title>Testing highcharts</title>
  <!--Bootstrap v4 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
     
    
    </head>
<body>
    


    <!--Content Div's-->
    
        
       
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div> 
    
<?php
    
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";
      
    try {
      
        /* This try block connects to the database and builds the SQL statement.
         * It accesses the required information, and then inserts it into the user table using an
         * insert command.
        */
        $connection = new PDO($dsn, $username, $password, $options);
        $selectTickers = $connection->prepare("SELECT ticker FROM stocks WHERE portfolio_id =:portfolio_id");
        $selectTickers->execute(['portfolio_id'=>$_SESSION['currentPortId']]);
        $fetchType = $selectTickers->setFetchMode(PDO::FETCH_NUM);
 
                $checked = false;
        $condition = true;
        $entry = '';
        while($condition){
            $tickers = $selectTickers->fetch();
            if(!$checked){
                if(gettype($tickers) == 'array'){
                    $checked = true;
                }
                else{
                    $alert = "The portfolio you are trying to graph currently contains no assets. If this portfolio is owned by you, please search for an asset and add it to display portfolio information. If you are viewing a public portfolio, then either the portfolio has no assets or was deleted, please try viewing a different portfolio.";
                    phpAlert($alert);  

            }
            }
            if($tickers == ""){
                $entry = rtrim($entry, ',');
                $condition = false;
            }

            else{
                $entry = $entry.'"'.$tickers[0].'",';
            }
        }
        
                $connection = new PDO($dsn, $username, $password, $options);
        $selectTickers = $connection->prepare("SELECT ticker FROM stocks WHERE portfolio_id =:portfolio_id");
        $selectTickers->execute(['portfolio_id'=>$_SESSION['currentCompareId']]);
        $fetchType = $selectTickers->setFetchMode(PDO::FETCH_NUM);
 
                $checked = false;
        $condition = true;
        $entry2 = '';
        while($condition){
            $tickers = $selectTickers->fetch();
            if(!$checked){
                if(gettype($tickers) == 'array'){
                    $checked = true;
                }
                else{
                    $alert = "(THIS ONE)The portfolio you are trying to graph currently contains no assets. If this portfolio is owned by you, please search for an asset and add it to display portfolio information. If you are viewing a public portfolio, then either the portfolio has no assets or was deleted, please try viewing a different portfolio.";
                    phpAlert($alert);  

            }
            }
            if($tickers == ""){
                $entry2 = rtrim($entry2, ',');
                $condition = false;
            }

            else{
                $entry2 = $entry2.'"'.$tickers[0].'",';
            }
        }
        

    }
    catch(PDOException $error) {
        echo "pdo error";
  }

        //amount of each stock retrieved
        $stmt = $connection->prepare("SELECT amtOfStock FROM stocks WHERE portfolio_id =:portfolio_id");
        $stmt->execute(['portfolio_id'=>$_SESSION['currentPortId']]);
        $fetchType = $stmt->setFetchMode(PDO::FETCH_NUM);
        $amounts = $stmt->fetchAll();
      
            //date purchased for each stock retrieved
        $stmt = $connection->prepare("SELECT datePurchased FROM stocks WHERE portfolio_id =:portfolio_id");
        $stmt->execute(['portfolio_id'=>$_SESSION['currentPortId']]);
        $fetchType = $stmt->setFetchMode(PDO::FETCH_NUM);
        $_SESSION['date'] = $stmt->fetchAll();
      
      //same but for the portfolio being compared
              //amount of each stock retrieved
        $stmt = $connection->prepare("SELECT amtOfStock FROM stocks WHERE portfolio_id =:portfolio_id");
        $stmt->execute(['portfolio_id'=>$_SESSION['currentCompareId']]);
        $fetchType = $stmt->setFetchMode(PDO::FETCH_NUM);
        $_SESSION['amounts2'] = $stmt->fetchAll();
      $amounts2 = $_SESSION['amounts2'];
      
            //date purchased for each stock retrieved
        $stmt = $connection->prepare("SELECT datePurchased FROM stocks WHERE portfolio_id =:portfolio_id");
        $stmt->execute(['portfolio_id'=>$_SESSION['currentCompareId']]);
        $fetchType = $stmt->setFetchMode(PDO::FETCH_NUM);
        $_SESSION['date2'] = $stmt->fetchAll();
      
?>

<script>
    var tracker = 0;
        var dates = new Array();
        <?php foreach($_SESSION['date'] as $key => $val){ ?>
        dates.push('<?php echo $val[0]; ?>');
    <?php } ?>    
    var amounts = new Array();
        <?php foreach($amounts as $key => $val){ ?>
        amounts.push('<?php echo $val[0]; ?>');
    <?php } ?>
    
    //compared portfolio
            var dates2 = new Array();
        <?php foreach($_SESSION['date2'] as $key => $val){ ?>
        dates2.push('<?php echo $val[0]; ?>');
    <?php } ?>    
    var amounts2 = new Array();
        <?php foreach($amounts2 as $key => $val){ ?>
        amounts2.push('<?php echo $val[0]; ?>');
    <?php } ?>
    
var values = [],
	seriesCounter = 0,
	counter = 0,
	Tot1 = 0,
	Tot2 = 0,
	P1 = [<?php echo $entry ?>],
	P2 = [<?php echo $entry2 ?>];
	
function createChart() {

  Highcharts.chart('container', {
	chart: {
		plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
		type: 'pie'
	},
    title: {
        text: 'Pie Chart for Comparison of Portfolio Totals (' + "<?php echo $_SESSION['nameOfPortfolio'] ?>" +' vs. ' + "<?php echo $_SESSION['portfolioToCompare'] ?>",
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },    
    series: [{
		name: 'Total Value',
		data: values
		}]
  });
}

$.each(P1, function(i, name) {
tracker = tracker + 1;
  $.getJSON('https://www.quandl.com/api/v3/datasets/WIKI/' + name.toLowerCase() + '.json?&column_index=11&auth_token=W8yzMDsJZ_TEcrPjWxGn', function(data) {
    var newData = []
		NumberOfStocks = amounts[i];

    data.dataset.data.forEach(function(point) {
      newData.push([point[1]]);
    });
      
            
      document.getElementById('individualPrice' + i).innerHTML = 'Latest Adj. Closing Price: $'+ newData[0];
      document.getElementById('totalPrice' + i).innerHTML = 'Total Value the shares of this Asset Contribute to Portfolio: $'+ (newData[0]*NumberOfStocks);

    //newData.reverse();
	
	newData2 = newData[0];
	
	Tot1 = Tot1 + Number(newData2)*NumberOfStocks;
    
    // As we're loading the data asynchronously, we don't know what order it will arrive. So
    // we keep a counter and create the chart when all the data is loaded.
    seriesCounter += 1;

    if (seriesCounter === P1.length) {
		values[0] = {
		name: "<?php echo $_SESSION['nameOfPortfolio'] ?>",
		y: Tot1
    };
    }
  }).fail(function(){
	  alert("Too many API calls have been made, please wait to refresh :)");
  });
});

$.each(P2, function(i, name) {
  $.getJSON('https://www.quandl.com/api/v3/datasets/WIKI/' + name.toLowerCase() + '.json?&column_index=11&auth_token=XWDL3_uZV9Gw1jsCZPmZ', function(data) {
    var newData = []
		NumberOfStocks = amounts2[i];
    data.dataset.data.forEach(function(point) {
      newData.push([point[1]]);
    });
           document.getElementById('individualPrice' + tracker).innerHTML = 'Latest Adj. Closing Price: $'+ newData[0];
      document.getElementById('totalPrice' + tracker).innerHTML = 'Total Value the shares of this Asset Contribute to Portfolio: $'+ (newData[0]*NumberOfStocks); 
 
    //newData.reverse();
	
	newData2 = newData[0];
	
	Tot2 = Tot2 + Number(newData2)*NumberOfStocks;
    
    // As we're loading the data asynchronously, we don't know what order it will arrive. So
    // we keep a counter and create the chart when all the data is loaded.
    counter += 1;
    if (counter === P2.length) {
		values[1] = {
		name: "<?php echo $_SESSION['portfolioToCompare'] ?>",
		y: Tot2
    };
      createChart();
    }
            tracker = tracker + 1;
  }).fail(function(){
	  alert("Too many API calls have been made, please wait to refresh :)");
  });
});
</script>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: lightblue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
</head>     
<br>
<br>
<div class="container">
<h2><b>Portfolio 1: <?php echo $_SESSION['nameOfPortfolio'] ?></b></h2>
<h2><b>Portfolio 2: <?php echo $_SESSION['portfolioToCompare'] ?></b></h2>   
<div class="card-columns">
    <div class="card bg-info">
      <div class="card-body card-md text-left">
        <div class="container">
         <?php

    
echo "<table style='border: solid 1px black;'>";
 echo "<h2><b>Assets in Both Portfolios [Date is shown as year-month-day]:<b><h2></tr>";


      class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 3px solid black; font-weight: bold; font-size:20px;'>" . parent::current(). "</td>";
    }

    function beginChildren() {            
        echo "<tr style='  background-color: #4CAF50; color: white;'>";

    }

    function endChildren() {
        echo "</tr>" . "\n";
            if(isset($_SESSION['secondPort'])){
                if($_SESSION['secondPort']){
                         echo '<td style="width: 500px; border: 3px solid black; font-weight: bold;"> <p>Number of shares of asset: '.$_SESSION['amounts2'][$_SESSION['counter']][0].'</p><p> Date Shares Purchased: '.$_SESSION['date2'][$_SESSION['counter']][0].' </p> <p id ="individualPrice'.$_SESSION['identifier'].'"></p> <p id ="totalPrice'.$_SESSION['identifier'].'"> <td>';
            $_SESSION['counter'] = $_SESSION['counter'] + 1;
            $_SESSION['identifier'] = $_SESSION['identifier'] + 1;                   
                }
                else{
                           echo '<td style="width: 500px; border: 3px solid black; font-weight: bold;"> <p>Number of shares of asset: '.$_SESSION['amounts'][$_SESSION['counter']][0].'</p><p> Date Shares Purchased: '.$_SESSION['date'][$_SESSION['counter']][0].' </p> <p id ="individualPrice'.$_SESSION['identifier'].'"></p> <p id ="totalPrice'.$_SESSION['identifier'].'"> <td>';
            $_SESSION['counter'] = $_SESSION['counter'] + 1;
            $_SESSION['identifier'] = $_SESSION['identifier'] + 1;                 
                }
            }
        else{
                        echo '<td style="width: 500px; border: 3px solid black; font-weight: bold;"> <p>Number of shares of asset: '.$_SESSION['amounts'][$_SESSION['counter']][0].'</p><p> Date Shares Purchased: '.$_SESSION['date'][$_SESSION['counter']][0].' </p> <p id ="individualPrice'.$_SESSION['identifier'].'"></p> <p id ="totalPrice'.$_SESSION['identifier'].'"> <td>';
            $_SESSION['counter'] = $_SESSION['counter'] + 1;
            $_SESSION['identifier'] = $_SESSION['identifier'] + 1;
        }
    }
}


try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $retrieveTickers = $connection->prepare("SELECT ticker FROM stocks WHERE portfolio_id=:pid");
        $retrieveTickers->execute(['pid'=>$_SESSION['currentPortId']]);
        $result2 = $retrieveTickers->setFetchMode(PDO::FETCH_ASSOC);
        $_SESSION['counter'] = 0;
    $_SESSION["identifier"] = 0;

            foreach(new TableRows(new RecursiveArrayIterator($retrieveTickers->fetchAll())) as $o=>$p) {
                echo $p;
                $_SESSION['nameOfTicker'] = $p;
                $_SESSION['nameOfTicker'] = ltrim($p, "<td style='width: 150px; border: 3px solid black; font-weight: bold; font-size:20px;'>");
                $_SESSION['nameOfTicker'] = str_replace("</td>","",$_SESSION['nameOfTicker']);
            }
        
    
        //now load the portfolio to be compared
    $_SESSION['secondPort'] = true;
                $retrieveTickers = $connection->prepare("SELECT ticker FROM stocks WHERE portfolio_id=:pid");
        $retrieveTickers->execute(['pid'=>$_SESSION['currentCompareId']]);
        $result2 = $retrieveTickers->setFetchMode(PDO::FETCH_ASSOC);
$_SESSION['counter'] = 0;
            foreach(new TableRows(new RecursiveArrayIterator($retrieveTickers->fetchAll())) as $o=>$p) {
                echo $p;
                $_SESSION['nameOfTicker'] = $p;
                $_SESSION['nameOfTicker'] = ltrim($p, "<td style='width: 150px; border: 3px solid black; font-weight: bold; font-size:20px;'>");
                $_SESSION['nameOfTicker'] = str_replace("</td>","",$_SESSION['nameOfTicker']);
            }
    $_SESSION['secondPort'] = false;
        
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo "</table>";

?>   

        </div> 
      </div>
    </div>
</div>

</div>
</body>
</html>


    
    

</body>
</html>
   

</body>
</html>
