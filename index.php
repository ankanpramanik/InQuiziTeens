<?php
session_start();
require_once "pdo.php";

$_SESSION['valid']==false;    ///////////// CHNG////////////////

if(isset($_POST['pw']) && isset($_POST['username']) ){
  unset($_SESSION['pw']);
  unset($_SESSION['username']);
  $_SESSION['valid']==false;    ///////////// CHNG////////////////
}

if (isset($_POST['cancel'])) {
  session_destroy();
  header("Location: index.php");
  return;
  # code...session_stat
}

// if (isset($_POST['sign'])) {
//   session_destroy();
//   header("Location: sign.php");
//   return;
//   # code...session_stat
// }

if(isset($_POST['log'])){

  if( strlen($_POST['pw'])< 1 || strlen($_POST['username'])< 1){
   
    error_log("Login fail ");
    $_SESSION['error']="Username and password required";
    header("Location: index.php");
    return;

    }

    // $stmt1=$pdo->prepare("SELECT user_id FROM users WHERE username=:em ");
    // $stmt1->execute(array(":em" =>$_POST['username']));
    // $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    $s="XyZzy12*_".$_POST['pw'];
    $pw=hash("md5",$s);

    $stmt2=$pdo->prepare("SELECT username,email,pw FROM users WHERE username=:em AND pw=:pw");
    $stmt2->execute(array(":em" =>$_POST['username'] , ":pw" => $pw));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    
    if( $row2==false){
      $_SESSION['error']="The username or password you entered is incorrect";
      header("Location:index.php");
      return;

    }
    // elseif($row2==false){
    //   $_SESSION['error']="Incorrect password";
    //   header("Location: index.php");
    //   return;

    // } 
    elseif($row2==true)
    {
        
        error_log("Login success ".$_POST['username']);
        $_SESSION['email']=$row2['email'];
        $_SESSION['username']=$row2['username'];
        $_SESSION['pw']=$row2['pw'];

        //////////// CHNGGGG ///////////////////

        $_SESSION['valid']=true;
/////////////////////////////////////////////////////

        header("Location:landingpage.php");
        return;
    }


}
?>
<!DOCTYPE html>

    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>InQuiziTeens :: Welcome</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style2.css">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/site.webmanifest">
        <style>
#text {display:none;color:red}
</style>

<script>
    $(document).ready(function() {
    $('.login-page').delay(2000).fadeIn(400);
});
 </script>
    </head>
    <body>
    <script src="main.js" async defer></script>
  <!-- <div class="preloader" style="background-color: #fff"><div class="loader" style="
    background: url('loader.gif') no-repeat center center;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
	z-index: 9999999;
	"></div></div> -->
<div class="loader-wrapper">
<div class="loader"></div></div>


        <div class="login-page">
            <div class="form">
              <form class="register-form" method= "POST">
            
                  
             
              </form>
              <form class="login-form" method ="POST">
                <img src="logo.png" class="logo" alt="brand logo"/><br/>
                <input type="text" title="Hi !" placeholder="username" id="username" name="username" required/><br/>
                <input type="password" name="pw" id="id_1723" title="Password must contain: &#013;• At least 8 characters &#013;• Both uppercase and lowercase alphabets &#013;• Combination of letters and numbers &#013;• At least one special character ! @ # ?" placeholder="password" required/><br/>
                  <p>
                  <?php 
                  if(isset($_SESSION['error'])){
                      echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                      unset($_SESSION['error']);
                  }

                  ?>
                 </p>
                <button name="log">login</button>
                <p id="text">WARNING! Caps lock is ON.</p>



                <!-- <button name="sign">Signup</button> -->
                <p class="message">Not registered? <a href="sign.php">Create an account</a></p>
              </form>
            </div>
          </div>
          
          <script>

var input1 = document.getElementById("username");
var input2 = document.getElementById("id_1723");
var text = document.getElementById("text");
input1.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
input2.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});


// function doValidate() {

// console.log('Validating...');

// try {

// pw = document.getElementById('id_1723').value;
// username = document.getElementById('username').value;

// console.log("Validating pw="+pw);

// if (pw == null || pw == ""|| username=="" || username==null) {

// alert("Both fields must be filled out");

// return false;

// }

// return true;



// } catch(e) {

// return false;

// }

// return false;

// }
// </script>

          <footer>
            <p>Copyright &copy 2021 | We'd love to hear from you: <a id="mail" href="mailto:inquiziteen@gmail.com">inquiziteen@gmail.com</a></p>
        </footer>
        <div class="cookie-banner" style="display: none">
          <p>
              By using our website, you agree to our cookie policy.
          </p>
          </div>              
    </body>
</html>



