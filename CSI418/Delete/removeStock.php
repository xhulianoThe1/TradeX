<?php
    session_start();
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";

foreach ($_POST as $name => $val)
{
     $_SESSION['nameOfTicker'] =  htmlspecialchars($name);
}

//$_SESSION['nameOfTicker'] = str_replace("_"," ",$_SESSION['nameOf']);

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("DELETE FROM stocks WHERE ticker=:ticker AND portfolio_id=:portfolio_id");

    
        $data = [
    'ticker' => $_SESSION['nameOfTicker'],
    'portfolio_id' => $_SESSION['currentPortId'],
];
    
    $stmt->execute($data);
    $_SESSION['tickerReport'] = "The asset associated with ticker: ".$_SESSION['nameOfTicker']." has been completely removed from your portfolio.";
   header("Location: ../Graphs and Analytics/".$_SESSION['graphCameFrom']);
   exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>