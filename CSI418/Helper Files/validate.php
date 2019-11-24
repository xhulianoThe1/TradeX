<?php
//retrieved from https://www.w3schools.com/php/php_mysql_select.asp

session_start();

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }
    function current() {
        return parent::current();
    }

    function beginChildren() {
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";

//boolean values for validation, login credentials
if(isset($_POST['submit'])){    
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];
    $psw = trim($psw);
}
$uname = trim($uname);
$indicator = False;
$isadmin = False;
$pswObtained = False;

// Create connection
try{
    $conn = new PDO($dsn, $username, $password, $options);
    $stmt = $conn->prepare("SELECT email, password, is_admin FROM user");
    $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        
        if(($v == 1) && ($pswObtained == True)){
            $isadmin = True;
            break;
        }
        
        
        else if(($v == 0) && ($pswObtained == True)){
            break;
        }
        
        else if($v == $uname){
            $indicator = True;
            continue;
        }
        else if(password_verify($psw,$v)){
            if($indicator == True){
                $pswObtained = True;
                continue;
            }
            $indicator = False;
        }
        $indicator = False;
    }
    if( $indicator == False){
        $_SESSION['pswMessage'] = "You have entered incorrect login credentials. Please try again with the correct login!";
        header("Location: ../index.php");
    
    exit;
}
else if($isadmin == True){
    header("Location: admin.php");
    exit;
}
else{
    //session_start();
        
    $getId = $conn->prepare("SELECT user_id FROM user WHERE email =:uname");
    $getId->execute(['uname'=>$uname]);
    $getId = $getId->fetch();
    $getId = array_unique($getId);
    $getId = implode("",$getId);
    $_SESSION['loggedIn'] = true;
    $_SESSION['uname'] = $uname;
    $_SESSION['user_id'] = $getId;
    header("Location: ../homepage.php");
    exit;
}

}
 catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
