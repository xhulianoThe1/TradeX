<?php
//retrieved from https://www.w3schools.com/php/php_mysql_select.asp


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
    require "config.php";
    require "common.php";

//boolean values for validation, login credentials
if(isset($_POST['submit'])){    
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];
}
$uname = trim($uname);
$psw = trim($psw);
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
        else if($v == $psw){
            if($indicator == True){
                $pswObtained = True;
                continue;
            }
            $indicator = False;
        }
        $indicator = False;
    }
    if( $indicator == False){
        header("Location: index.html");
    
    exit;
}
else if($isadmin == True){
    header("Location: admin.php");
    exit;
}
else{
    header("Location: user.php?uname=$uname");
    exit;
}

}
 catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
