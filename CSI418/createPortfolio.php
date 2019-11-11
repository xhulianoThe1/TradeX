<?php
session_start();
    require "config.php";
    require "common.php"; 

if(isset($_POST['portfolioName'])){
    try {
        $data = [
            'name' => $_POST['portfolioName'],
            'id' => $_SESSION['user_id'],
        ];

        
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $createPortfolio = $connection->prepare("INSERT INTO portfolios (portfolio_name, user_id) VALUES (:name,:id)");
    $createPortfolio->execute($data);
    header("Location: user.php");
    exit;
}
    
   catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}
?>