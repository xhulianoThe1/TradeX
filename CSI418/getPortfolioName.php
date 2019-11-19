
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
        $connection = new PDO($dsn, $username, $password, $options);
        //CURRENTLY THIS SHOULD BREAK IF TWO PORTFOLIOS SHARE THE SAME NAME IN THE DATABASE
        $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name AND user_id=:user_id LIMIT 1");
    
                 $data = [
    'portfolio_name' => $_SESSION['nameOfPortfolio'],
    'user_id' => $_SESSION['user_id'],
];
        $selectPortId->execute($data);

        $arr = $selectPortId->fetch();
        $_SESSION['currentPortId'] = $arr[0];
        header("Location: displayHighstocks.php");
        exit;
        
    }
        catch(PDOException $error) {
        echo "error";
  }


?>