<?php
session_start();
    require "config.php";
    require "common.php";
$fullName = $_POST["stockName"];

function changeTicker($fullName) {
    $isTicker = false;
    $ticker = array();
    $len = strlen($fullName);
    for($i = 0; $i <= $len; $i++){
        if($fullName[$i]== "("){
            $isTicker = true;
        }
        else if($isTicker ==true){
            if($fullName[$i]==")"){
                $newTicker = join("",$ticker);
                return $newTicker;
            }
            else{
                array_push($ticker, $fullName[$i]);
            }
        }
    }
};

$tickerToAdd = changeTicker($fullName);

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    $sql = "INSERT INTO stocks (ticker,portfolio_id) VALUES (:ticker,:currentPortId)";
    $stmt = $connection->prepare($sql);
    
    $data2 = [
    'ticker' => $tickerToAdd,
    'currentPortId' => $_SESSION['currentPortId'],
];
    
    $stmt->execute($data2);
    header("Location: ".$_SESSION['graphCameFrom']);
    exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>
