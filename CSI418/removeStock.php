<?php
    
    require "config.php";
    require "common.php";
session_start();
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
    header("Location: displayHighstocks.php");
    exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>