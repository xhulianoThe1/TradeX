<?php
    require "../Data Initialization/config.php";
    require "../Data Initialization/common.php";
session_start();

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $getPassword = $connection->prepare("SELECT password FROM user WHERE user_id =:user_id");

    $getPassword->execute(['user_id'=>$_SESSION['user_id']]);
    $retrievedPassword = $getPassword->fetch();
    $password = implode(array_unique(array_values($retrievedPassword)));

}

catch(PDOException $e)
    {
    echo "error <br>" . $e->getMessage();
    }


if(isset($_POST['currentPassword'])){
    if($_POST['currentPassword'] == $_POST['newPassword']){
        $_SESSION['pswMessage'] = "Your new password must be different from your current password, please try again!";
    }
    else if(password_verify($_POST['currentPassword'],$password)){
        if($_POST['newPassword'] == $_POST['confirmPassword']){
            if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/",$_POST['newPassword'])){
                $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $changePassword = $connection->prepare("UPDATE user SET password=:password WHERE user_id =:user_id");
                        $data = [
                            'password' => $newPassword,
                            'user_id' => $_SESSION['user_id'],
                        ];
                $changePassword->execute($data);
                $_SESSION['pswMessage'] = "Your new password has been set. When logging in, please be sure to use your new password in the future, as your old password will no longer work!";
            }
            else{
                $_SESSION['pswMessage'] = "Your password does not meet our strength requirements, please try again! Passwords must contain 1 lowercase letter, 1 uppercase letter, 1 numeric character, 1 special character (%,$,&,@,#,!), and must be 8 characters in length or longer.";
            }
        }
        else{
            $_SESSION['pswMessage'] = "Your must correctly confirm your new password, please try again!";
        }
    }
    else{
        $_SESSION['pswMessage'] = "Make sure to enter your current password correctly or else you will be unable to change your password! ";
    }
    
}


         header("Location: ../settings.php");
         exit;  
?>   