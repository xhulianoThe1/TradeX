<?php
    
    require "config.php";
    require "common.php";
session_start();
foreach ($_POST as $name => $val)
{
     echo $name." ";
     $_SESSION['currentId'] =  htmlspecialchars($name);
    
}

$_SESSION['currentId'] = str_replace("_"," ",$_SESSION['currentId']);
echo $_SESSION['currentId'];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("DELETE FROM stocks WHERE portfolio_id=:portfolio_id");

    
    $stmt->execute(['portfolio_id'=>$_SESSION['currentId']]);
    
        $stmt2 = $connection->prepare("DELETE FROM portfolios WHERE portfolio_id=:portfolio_id");

    
    $stmt2->execute(['portfolio_id'=>$_SESSION['currentId']]);
    
   header("Location: user.php");
   exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>