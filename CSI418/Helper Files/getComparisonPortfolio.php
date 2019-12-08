
<?php
    
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";
session_start();
$_SESSION['portfolioToCompare'] = '';
foreach ($_POST as $name => $val)
{
    $name = str_replace("_"," ",$name);
    if($_SESSION['portfolioToCompare'] != ''){
        $publicUser = $name;
    }
    else{
     $_SESSION['portfolioToCompare'] =  htmlspecialchars($name);
    }

}
//$_SESSION['portfolioToCompare'] = str_replace("_"," ",$_SESSION['portfolioToCompare']);
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        if(isset($publicUser)){
            echo $publicUser;
            $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name AND user_id=:user_id LIMIT 1");
                             $data = [
    'portfolio_name' => $_SESSION['portfolioToCompare'],
    'user_id' => $publicUser,
];
            
        }
        else{
        $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name AND user_id=:user_id LIMIT 1");
    
                 $data = [
    'portfolio_name' => $_SESSION['portfolioToCompare'],
    'user_id' => $_SESSION['user_id'],
];
            
        }
        $selectPortId->execute($data);

        $arr = $selectPortId->fetch();
        $_SESSION['currentCompareId'] = $arr[0];
        header("Location: ../Graphs and Analytics/PortfolioComparison.php");
        exit;
        
    }
        catch(PDOException $error) {
        echo "error";
  }


?>