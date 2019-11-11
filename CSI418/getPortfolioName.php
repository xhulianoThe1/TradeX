
<?php
    
    require "config.php";
    require "common.php";
session_start();
foreach ($_POST as $name => $val)
{
     $_SESSION['nameOfPortfolio'] =  htmlspecialchars($name);
}
$_SESSION['nameOfPortfolio'] = str_replace("_"," ",$_SESSION['nameOfPortfolio']);
    try {
      
        /* This try block connects to the database and builds the SQL statement.
         * It accesses the required information, and then inserts it into the user table using an
         * insert command.
        */

        $connection = new PDO($dsn, $username, $password, $options);
        //CURRENTLY THIS SHOULD BREAK IF TWO PORTFOLIOS SHARE THE SAME NAME IN THE DATABASE
        $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name LIMIT 1");
    
        $selectPortId->execute(['portfolio_name'=>$_SESSION['nameOfPortfolio']]);

        $arr = $selectPortId->fetch();
        $_SESSION['currentPortId'] = $arr[0];
        header("Location: displayHighstocks.php");
        exit;
        
    }
        catch(PDOException $error) {
        echo "error";
  }


?>