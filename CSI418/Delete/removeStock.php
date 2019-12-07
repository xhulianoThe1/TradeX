<?php
    session_start();
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";

foreach ($_POST as $name => $val)
{
     $_SESSION['nameOfTicker'] =  htmlspecialchars($name);
     break;
}

//$_SESSION['nameOfTicker'] = str_replace("_"," ",$_SESSION['nameOf']);

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("DELETE FROM stocks WHERE ticker=:ticker AND portfolio_id=:portfolio_id AND datePurchased =:date");

    
        $data = [
    'ticker' => $_SESSION['nameOfTicker'],
    'portfolio_id' => $_SESSION['currentPortId'],
            'date' => $_POST['dateOrigin'],
];
    
    $stmt->execute($data);
    $_SESSION['tickerReport'] = "The asset and all of its shares associated with ticker: ".$_SESSION['nameOfTicker']." originally purchased on ".$_POST['dateOrigin']." have been completely removed from your portfolio.";
   header("Location: ../Graphs and Analytics/".$_SESSION['graphCameFrom']);
   exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>