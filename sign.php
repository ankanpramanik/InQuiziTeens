<?php
session_start();
require_once "pdo.php";
require_once __DIR__.'/vendor/autoload.php'; 
require_once __DIR__.'/functions.php';
?>
  
<html>


<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>InQuiziTeens :: Signup</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/site.webmanifest">
 
</head>
<body>
<script src="main.js" async defer></script>

<p>

<div class="login-page">
            <div class="form">

              <form class="login-form" method= "POST" action="submit.php">  




              <img src="logo.png" class="logo" alt="brand logo"/><br/>
            <label for ="username">Name</label>
            <input type"text" name="username"  title="Hi !" placeholder="name" size=40 id="username" ><br/>
            <label for ="email">Email</label>
            <input type ="text" name="email" size=40 id="email"  placeholder="email address"title ="Enter your Email address" ><br/>
            <label for ="pw">Password</label>
            <input type ="password" name="pw"  placeholder="password" size="40" id="id_1723"pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!-@]).{8,}" title="Password must contain: &#013;• At least 8 characters &#013;• Both uppercase and lowercase alphabets &#013;• Combination of letters and numbers &#013;• At least one special character ! @ # ?" >
            <label for ="school">School/ College</label>
            <input type="text" name="school" title="enter your school/ college name" placeholder="school/college" id="school"></br>
            <?php 
if(isset($_SESSION['error'])){
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}

?>
</p>

<p><p></p></P>
<!-- <input type="submit" value="Log In" name="log" onclick="doValidate();" > -->
<button type="submit" name="sign">Sign up</button>
<br><br>
<button type="submit" class="cancel " value="Cancel" name="cancel" style="background-color:red;">Cancel</button>

</form>
</div>
</div>

<footer>
            <p>Copyright &copy 2021 | We'd love to hear from you: <a id ="mail" href="mailto:inquiziteen@gmail.com">inquiziteen@gmail.com</a></p>
        </footer>
        <div class="cookie-banner" style="display: none">
          <p>
              By using our website, you agree to our cookie policy.
          </p>
          </div>  
</body>
</html>

 



