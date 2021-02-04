<?php
session_start();
require_once "pdo.php";
$data=[];


if(!isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['pw'])){
    die("user not logged in");
}
elseif (isset($_POST['submit'])) {
    $fb=$_POST['feedback'];

    $smt=$pdo->prepare("SELECT user_id FROM users WHERE email=:email");
    $smt->execute(array(":email"=>$_SESSION['email']));
    $row=$smt->fetch(PDO::FETCH_ASSOC);

    $smt2=$pdo->prepare("SELECT * FROM feedback WHERE user_id=:user_id");
    $smt2->execute(array(":user_id"=>$row['user_id']));
    $row2=$smt2->fetch(PDO::FETCH_ASSOC);

    if($row2==True)
    {
         $stmt1=$pdo->prepare("UPDATE feedback SET fb=:fb WHERE user_id=:user_id");
         $stmt1->execute(array(
             ':fb'=>$fb,
             ':user_id'=>$row['user_id']
         ));
    }

else{
    $stmt =$pdo->prepare("INSERT INTO feedback(user_id,fb) VALUES(:user_id,:fb)");
    $stmt->execute(array(
        ":user_id"=>$row['user_id'],
        ":fb"=>$fb
    ));
}
    # code...
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
    <title>InQuiziTeens :: Thank You!</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="grid-container">
        <div class="rules">
            <div class="Rules">
                <div class="form format top">
                    <p id="thanks">
                        Thanks for Playing! Hope to see you around.
                    </p>
                    <br>
                    <p id="score-view">Click on the button below to view your score in the leaderboard.</p>
                    <button class="start-button" onclick="func()">View Leaderboard</button>
                    <script>
                    function func(){
                        window.location.replace("landingpage.php");

                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="leaderboard">
            <div class="Rules">
                <div class="form format  top-spacing">
                    <p id="thanks">A project by:</p>
                    <span>
                        <p class="names">Ankan Pramanik</p>
                        <span>
                            <div class="centre-icons">
                                <ul class="social-icons">
                                    <li><a href="https://www.facebook.com/ankan.pramanik.31/" target="_blank"
                                            class="social-icon"> <i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/ankan-pramanik-67b911199/" target="_blank"
                                            class="social-icon"> <i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="https://github.com/ankanpramanik?tab=repositories" target="_blank"
                                            class="social-icon">
                                            <i class="fa fa-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </span>
                        <p class="names">Pritam Chakraborty</p>
                        <span>
                            <div class="centre-icons">
                                <ul class="social-icons bottom">
                                    <li><a href="https://www.blank.org/" target="_blank" class="social-icon"> <i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/pritam-chakraborty-085861200/" target="_blank" class="social-icon"> <i
                                                class="fa fa-linkedin"></i></a></li>
                                    <li><a href="https://github.com/PritamC-2k01" target="_blank" class="social-icon">
                                            <i class="fa fa-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </span>
                </div>
            </div>
        </div>

        <div class="feedbackform">
            <button class="open-button" onclick="openForm()">Give Feedback</button>

            <div class="form-popup" id="myForm">
                <form method="POST" class="form-container">
                    <h2 class="h2">Feedback Form</h2>
    
                    <label for="text"><b></b></label>
                    <textarea id="feed" name="feedback" rows="4" cols="50" required></textarea>
                    <input type="submit" class="btn" name="submit" value="Submit"/>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
    
            <script>
                function openForm() {
                    document.getElementById("myForm").style.display = "block";
                }
    
                function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                }
            </script>
    

        </div>

    





    </div>
    </div>
    <footer>
        <p>Copyright &copy 2021 | We'd love to hear from you: <a id="mail"
                href="mailto:inquiziteens@gmail.com">inquiziteens@gmail.com</a>
        </p>
    </footer>
</body>

</html>