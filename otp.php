<?php

require_once "pdo.php";
//  require_once "submit.php";
//  require_once "sign.php";
// require_once __DIR__.'/config.php';

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['pw']) && isset($_SESSION['email']) && isset($_SESSION['otp']) && isset($_POST['otp_given']) && isset($_SESSION['school'])){
if($_SESSION['otp']==strval($_POST['otp_given']))

    {
                $stmt = $pdo->prepare('INSERT INTO users
              (username, pw, email,school) VALUES ( :username, :pw, :email,:school )');
            $stmt->execute(array(
               
              ':username' => htmlentities($_SESSION["username"]),
              ':pw' =>htmlentities( $_SESSION["pw"]),
           
              ':email' =>htmlentities( $_SESSION['email']),
              ':school'=>htmlentities($_SESSION['school'])

            // ':score' =>""
            ));
        $_SESSION['valid']==true;
        // $_SESSION["username"]=$_POST['username'];
        // $_SESSION["email"]=$_POST["email"];
        // $_SESSION["pw"]=$_POST["pw"];
         header("Location:landingpage.php");
        return;
    }
    else{
        $_SESSION['error']="Incorrect Verification code";
        unset($_SESSION["username"]);
        unset($_SESSION["email"]);
        unset($_SESSION["pw"]);
        unset($_SESSION['otp']);
        unset($_SESSION['school']);
        header("Location:submit.php");
        return;
    }
}
else{
    die("go first to sign up page");
}
 ?>

