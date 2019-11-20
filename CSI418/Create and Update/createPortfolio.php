<?php
session_start();
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php"; 

if(isset($_POST['portfolioName'])){
    try {
        $data = [
            'name' => $_POST['portfolioName'],
            'id' => $_SESSION['user_id'],
        ];
        
        
        
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    $checkForExist = $connection->prepare("SELECT COUNT(*) FROM portfolios 
WHERE EXISTS 
(SELECT portfolio_name 
FROM portfolios WHERE portfolio_name =:name AND user_id=:id)");
    $checkForExist->execute($data);
        $result = $checkForExist->fetch();
        if($result[0] > 0 ){
            $_SESSION['portExists'] = "The name of the portfolio you are currently trying to create is already being used by another portfolio that you own! Please try again with a portfolio name that you haven't used.";
                header("Location: ../user.php");
                exit;
        }

        
        
    $createPortfolio = $connection->prepare("INSERT INTO portfolios (portfolio_name, user_id) VALUES (:name,:id)");
    $createPortfolio->execute($data);
    header("Location: ../user.php");
    exit;
}
    
   catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}
?>