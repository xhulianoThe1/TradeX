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
//$tickerToAdd = "\,\'".$tickerToAdd."\'";

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $getPortfolioId = $connection->prepare("SELECT portfolio_id FROM portfolios WHERE portfolios.user_id =:user_id");
    
    
    $sql = "INSERT INTO stocks (ticker,portfolio_id) VALUES (:ticker,:currentPortId)";
    $stmt = $connection->prepare($sql);
    
    $data2 = [
    'ticker' => $tickerToAdd,
    'currentPortId' => $_SESSION['currentPortId'],
];
    
    $stmt->execute($data2);
    header("Location: displayHighstocks.php");
    exit;
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


?>

<!--
    function testFunction(result){
        var isTicker = false;
        var ticker = [];
        var len = result.value.length;
        for(var i = 0; i <= len; i++){
            if(result.value[i] == "("){
                isTicker = true;
                continue;
            }
            else if(isTicker == true){
                if(result.value[i] == ")"){
                    var newTicker = (ticker.join(''));
                    return newTicker;
                    break;
                }
                else{
                ticker.push(result.value[i]);
            }
            }
        }
    }
-->