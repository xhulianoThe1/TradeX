
<?php
    
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";
session_start();
$_SESSION['deleteMode'] = false;
$_SESSION['nameOfPortfolio'] = '';
foreach ($_POST as $name => $val)
{
    $name = str_replace("_"," ",$name);
    if($_SESSION['nameOfPortfolio'] != ''){
        $publicUser = $name;
    }
    else{
     $_SESSION['nameOfPortfolio'] =  htmlspecialchars($name);
    }

}
//$_SESSION['nameOfPortfolio'] = str_replace("_"," ",$_SESSION['nameOfPortfolio']);
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        if(isset($publicUser)){
            echo $publicUser;
            $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name AND user_id=:user_id LIMIT 1");
                             $data = [
    'portfolio_name' => $_SESSION['nameOfPortfolio'],
    'user_id' => $publicUser,
];
            
        }
        else{
        $_SESSION['deleteMode'] = true;
        $selectPortId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolio_name =:portfolio_name AND user_id=:user_id LIMIT 1");
    
                 $data = [
    'portfolio_name' => $_SESSION['nameOfPortfolio'],
    'user_id' => $_SESSION['user_id'],
];
            
        }
        $selectPortId->execute($data);

        $arr = $selectPortId->fetch();
        $_SESSION['currentPortId'] = $arr[0];
        header("Location: ../Graphs and Analytics/displayHighstocks.php");
        exit;
        
    }
        catch(PDOException $error) {
        echo "error";
  }


?>