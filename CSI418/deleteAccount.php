<?php
    require "config.php";
    require "common.php";
session_start();

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $getPassword = $connection->prepare("SELECT password FROM user WHERE user_id =:user_id");

    $getPassword->execute(['user_id'=>$_SESSION['user_id']]);
    $retrievedPassword = $getPassword->fetch();
    $password = implode((array_unique(array_values($retrievedPassword))));
    
    $getPortfolios = $connection->prepare("SELECT portfolio_id from portfolios WHERE user_id=:user_id");
    $getPortfolios->execute(['user_id'=>$_SESSION['user_id']]);
    $retrievedPortfolios = $getPortfolios->fetchAll();
    $retrievedPortfolios = array_values($retrievedPortfolios);

     //   for($counter = 0; $counter<=count($retrievedPortfolios);$counter++){
    //        foreach(array_unique(array_values($retrievedPortfolios[$counter])) as $value){
  //              echo $value;
    //        }
     //   }
    }
    


catch(PDOException $e)
    {
    echo "error <br>" . $e->getMessage();
    }


if(isset($_POST['currentPassword'])){

    if((password_verify($_POST['currentPassword'],$password)) && ($_POST['currentUsername'] == $_SESSION['uname'])){
        if($_POST['areYouSure'] == "YES"){
            
                    
        $_SESSION['pswMessage'] = "Your account has been successfully deleted. If you wish to login, you will have to create a new account.";
            try {
                
    for($counter = 0; $counter<count($retrievedPortfolios);$counter++){
        foreach(array_unique(array_values($retrievedPortfolios[$counter])) as $value){
                                
        $stmt = $connection->prepare("DELETE FROM stocks WHERE portfolio_id=:portfolio_id"); 
        $stmt->execute(['portfolio_id'=>$value]);
        $stmt2 = $connection->prepare("DELETE FROM portfolios WHERE portfolio_id=:portfolio_id");
        $stmt2->execute(['portfolio_id'=>$value]);
        }
    }
                $stmt3 = $connection->prepare("DELETE FROM user WHERE user_id=:user_id");
                $stmt3->execute(['user_id'=>$_SESSION['user_id']]);





            
            
            
            
           header("Location: logout.php");
           exit();
        }
            
            catch(PDOException $e)
    {
    echo "error <br>" . $e->getMessage();
    }
        }
        else{
            $_SESSION['pswMessage'] = "Please type 'YES' (exactly as it appears, without the quotations) or else you will be unable to delete your account!";
            header("Location: settings.php");
            exit();
        }

    }
    else{
            $_SESSION['pswMessage'] = "Make sure to enter your current username and password correctly or else you will be unable to delete your account! ";
        

         header("Location: settings.php");
         exit;  
        }    
}
else{
        $_SESSION['pswMessage'] = "Make sure to enter your current username and password correctly or else you will be unable to delete your account! ";
    

         header("Location: settings.php");
         exit;  
}

?>   