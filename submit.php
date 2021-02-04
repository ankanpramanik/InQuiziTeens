<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once "pdo.php";
// require_once "sign.php";
// require_once __DIR__.'/config.php';

session_start();

// if((!isset($_POST['email']) && !isset($_POST['pw']) && !isset($_POST['username']))|| !isset($_SESSION['error'])){  /////////////////CHNGGGGG////////////
    
//     die("go to signup page");
// }

if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['pw']) && isset($_POST['school'])){
    // unset($_SESSION['user_id']);
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['pw']);
    unset($_SESSION['otp']);
    unset($_SESSION['school']);

        if(isset($_POST['cancel'])){
            header("Location:index.php");
            return;
        }
        else{
             if (($_POST["username"])==NULL || $_POST['email']==NULL || $_POST['pw']==NULL || $_POST['school']==NULL) {
                error_log("empty field");
                $_SESSION['error']= "All fields are required";
                header("Location:sign.php");
                return;
            }
        //    elseif(strpos($_POST['email']))
        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']= "Please enter a valid email address.";
            header("Location:sign.php");
                return;

}

            elseif(strlen($_POST['pw'])<8 || !preg_match('@[A-Z]@', $_POST['pw']) || !preg_match('@[a-z]@', $_POST['pw']) || !preg_match('@[0-9]@', $_POST['pw']) || !preg_match('@[^\w]@', $_POST['pw'])){

                $_SESSION['error']="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
                header("Location:sign.php");
                return;
            }
            
            else{

                $smt1=$pdo->prepare("SELECT username FROM users WHERE username=:username");
                $smt1->execute(array(':username'=>$_POST['username']));
                $rows1= $smt1->fetch(PDO::FETCH_ASSOC);

                $smt2=$pdo->prepare("SELECT email FROM users WHERE email=:email");
                $smt2->execute(array(':email'=>$_POST['email']));
                $rows2= $smt2->fetch(PDO::FETCH_ASSOC);

                if($rows1==true){
                    $_SESSION['error']="Username taken";
                    header("Location:sign.php");
                    return;

                }
                elseif ($rows2==true) {
                    $_SESSION['error']="Email taken";
                    header("Location:sign.php");
                    return;
                    
                }
                else{
                
            //     $stmt = $pdo->prepare('INSERT INTO users
            //   (username, pw, email) VALUES ( :username, :pw, :email )');
            // $stmt->execute(array(
               
            //   ':username' => htmlentities($_POST["username"]),
            //   ':pw' =>htmlentities( $_POST["pw"]),
           
            //   ':email' =>htmlentities( $_POST['email'])
            // //   ':score' =>""
            // ));
            // $_SESSION["username"]=$_POST['username'];
            //     $_SESSION["email"]=$_POST["email"];
            //     $_SESSION["pw"]=$_POST["pw"];


$data=[];

// if(!isset($_SESSION['email']) || !isset($_SESSION['pw'])){  /////////////////CHNGGGGG////////////
    
//     die("user not logged in");


// }/////////////// config .php ///////////////////////////


/**
 * REQUIRED SETTINGS
 *
 * You will probably need to change all of these settings for your own site.
 */

// The name and address which should be used for the sender details.
// The name can be anything you want, the address should be something in your own domain. It does not need to exist as a mailbox.
define('CONTACTFORM_FROM_ADDRESS', 'SENDER EMAIL ADDRESS');
define('CONTACTFORM_FROM_NAME', 'InQuiziTeens');

// The name and address to which the contact message should be sent.
// These details should NOT be the same as the sender details.
define('CONTACTFORM_TO_ADDRESS', 'pchakra012@gmail.com');
define('CONTACTFORM_TO_NAME', 'hi user');

// The details of your SMTP service, e.g. Gmail.
define('CONTACTFORM_SMTP_HOSTNAME', 'smtp.gmail.com');
define('CONTACTFORM_SMTP_USERNAME', 'SENDER EMAIL ADDRESS');
define('CONTACTFORM_SMTP_PASSWORD', 'YOUR SMTP PASSWORD');

// The reCAPTCHA credentials for your site. You can get these at https://www.google.com/recaptcha/admin
// define('CONTACTFORM_RECAPTCHA_SITE_KEY', '');
// define('CONTACTFORM_RECAPTCHA_SECRET_KEY', '');

/**
 * Optional Settings
 */

// The debug level for PHPMailer. Default is 0 (off), but can be increased from 1-4 for more verbose logging.
define('CONTACTFORM_PHPMAILER_DEBUG_LEVEL', 0);

// Which SMTP port and encryption type to use. The default is probably fine for most use cases.
define('CONTACTFORM_SMTP_PORT', 587);
define('CONTACTFORM_SMTP_ENCRYPTION', 'tls');


//////////////////////////////////////////////////////////

// Basic check to make sure the form was submitted.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirectWithError("The form must be submitted with POST data.");
}



if (empty($_POST['username'])) {
    redirectWithError("Please enter your name");
}

if (empty($_POST['email'])) {
    redirectWithError("Please enter your email address");
}

// if (empty($_POST['subject'])) {
//     redirectWithError("Please enter your message in the form.");
// }

// if (empty($_POST['message'])) {
//     redirectWithError("Please enter your message in the form.");
// }

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    redirectWithError("Please enter a valid email address.");
}

// if (strlen($_POST['message']) < 10) {
//     redirectWithError("Please enter at least 10 characters in the message field.");
// }

// Everything seems OK, time to send the email.

$mail = new \PHPMailer\PHPMailer\PHPMailer(true);

try {

    $otp=rand(1000,9999);
    //Server settings
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
    $mail->Port = CONTACTFORM_SMTP_PORT;

    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress($_POST['email'], $_POST['username']);
    $mail->addReplyTo("SENDER EMAIL ADDRESS", "SENDER NAME ");

    // Content
    $mail->Subject = "Thank You for registering at InQuiziTeens!";
    $mail->Body    = <<<EOT
Hi, 
Thank you for registering at InQuiziTeens! We hope you have a great time here.

Your Verification code for signup is: {$otp}

Please send us your feedbacks at: inquiziteens@gmail.com
Happy Quizzing!	

-Team InQuiziTeens.


EOT;

    $mail->send();
    $_SESSION['otp']=$otp;
    $_SESSION['username']=$_POST['username'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['school']=$_POST['school'];

    $s="XyZzy12*_".$_POST['pw'];
    $pw=hash("md5",$s);

    $_SESSION['pw']=$pw;


} catch (Exception $e) {
    redirectWithError("An error occurred while trying to send your message: ".$mail->ErrorInfo);
}


    
            // header("Location:otp.php");
            // return; ///////////////////////chngggggggggggggggggggggggg//////////////////
    
         }

}

    }
  }


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
   <![endif]-->
<!--[if IE 7]>         
   <html class="no-js lt-ie9 lt-ie8">
      <![endif]-->
<!--[if IE 8]>         
      <html class="no-js lt-ie9">
         <![endif]-->
<!--[if gt IE 8]>      
         <html class="no-js">
            <!--<![endif]-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>InQuiziTeens :: Verify Email</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
  <div class="loader-wrapper">
    <!-- Loading square for squar.red network -->
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
  <div class="login-page">
    <div class="form">
      
      <form class="login-form" method="POST" action="otp.php">
        <p id="line">Enter the 4 digit Verification code sent to your registered email address</p>
        <input type="text" pattern=".{4,}" name="otp_given"  id="field" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Verification code here" title="Enter the 4 digit number Verification code sent to your registered email address" maxlength="4" required />
        <p style="font-size: 12px;">If you do not receive the verification code within a few minutes, please check your Spam folder or go back to change your email.</p>
        <button id="verify">verify</button>
        <br></br>
  <input type="button" id="back" value="Go Back" onclick="window.location.replace('sign.php');" style="background-color:rgb(255,0,0); color:white;"/>

        
      </form>

      <p class="otp-error" style="color: red; text-align: justify;" >

    <?php
    if(isset($_SESSION['error'])) {

        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        
        echo("<script>document.getElementById('field').style.display='none';
         document.getElementById('line').style.display='none';
         document.getElementById('verify').style.display='none';
        document.getElementById('back').value='Go back to Signup page'; 
        
        </script>");

    }
    unset($_SESSION['error']);?>
    </p>
    </div>
  </div>
  <footer>
    <p>Copyright &copy 2021 | We'd love to hear from you: <a id="mail"
        href="mailto:inquiziteen@gmail.com">inquiziteen@gmail.com</a></p>
  </footer>
  <script src="main.js" async defer></script>
</body>

</html>