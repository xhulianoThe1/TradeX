<?php

/** CSI 418
Page for account creation and entry into user table, modified from my CS410 Library Database Project
  *
  * This script is used to create a new entry in the users table.
  * The first section of code builds the SQL statement necessary to insert new data.
  * The second section of code builds the user interface, allowing for a new user to be created.
  */

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
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";

$uname = "";
$indicator = False;
//boolean values for validation, login credentials
if(isset($_POST['submit'])){    
    $uname = $_POST['uname'];
             $new_user = array(
            "first_name" => $_POST['first_name'],
            "last_name"  => $_POST['last_name'],
            "email"     => $_POST['email'],
            "password"   => $_POST['password'],
            "is_admin" => 0,
        );
$uname = trim($uname);
}


// Create connection
try{
    $conn = new PDO($dsn, $username, $password, $options);
    $stmt = $conn->prepare("SELECT email FROM user");
    $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            if($v == $uname){
                $indicator = True;
                continue;
        }
    }
    if($indicator){
        echo "Email is currently attached to an existing account, please try again with a new email.";
        header("Location: ../index.php");
        exit;
}
    else{
        echo "Account successfully created. Proceed to sign-in!";

            $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "user",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
        header("Location: ../index.php");
        exit;
    }
    }
 catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
