<?php
session_start();
require_once "pdo.php";



if(!isset($_SESSION['email']) && !isset($_SESSION['pw']) && $_SESSION['valid']==false){  /////////////////CHNGGGGG////////////
    
    die("user not logged in");


}
// if($_SESSION['turn']==NULL){$_SESSION['turn']=0;}

elseif (isset($_POST['logout'])) {
    
    header("Location:logout.php");
 
    return;
    # code...
}
///////////////////////// CHNGGGGGGGGGGGGGGGGGGGGG////////////////////////////


$stmt = $pdo->query("SELECT users.username,score.scores FROM users JOIN score ON users.user_id=score.user_id ORDER BY score.scores DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InQuiziTeens :: Rules</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
</head>

<body>
    <div class="navbar">
    <!-- <button onclick="window.location.href='logout.php';" class="nb-1">Log out</button> -->
    <form method="POST">
    <input type="submit" class="nb-1" name="logout" value= "Log out"></form>
        <p class="name">Hello, <?=$_SESSION['username'];?> !</p>

    <p class="brand"> InQuiziTeens</p>
   

</div>

    <div class="grid-container">
        <div class="rules">
            <div class="form format">
                <p id="rules">
                    Rules
                </p>
                <p>
                <ul class="niyom">
                    <li>There are total of 20 questions. Each worth 5 points.</li>
                    <li>Each question has four options. Only one is correct.</li>
                    <li>An incorrect answer draws a negative marking of 1 point.</li>
                    <li>Select a correct option and click on "Next" to move on to the next question. </li>
                    <li>To skip a question, simply click on 'Next'. Skipping a question awards 0 points.</li> 
                    <li>No time limit. You have the life's time to answer.</li>
                    <li>Don't be evil, don't Google!</li>

                </ul>
                </p>
                <button onclick="go();" class="start-button">Start !</button>
                <script>
    
    function go() {
        // turn+=1;
        // console.log(turn);
        window.location.href='quiz.php';
        
    }
    </script>




            </div>
        </div>
        <div class="leaderboard">
            <div class="Leaderboard">
                <div class="form format width">
                    <p id="leaderboard">
                        LeaderBoard
                    </p>
                    <!-- ENTER LEADER BOARD DETAILS HERE AND DELETE THE FOLLOWING LOREM TEXT -->

                    <table>
                    <tr>
                    <th>Username</th>
                    <th>Score</th>

                    <?php
                    global $rows;
                    if(is_array($rows) ){
                    foreach ( $rows as $row ) {
                        if($row['username']==$_SESSION['username']){
                            echo ("<tr style='background-color: #73ccff;'><td>");
                            echo($row['username']);
                            
                                echo("</td><td>");
                                echo($row['scores']);
                                echo("</td><tr>\n");
                        }
                        else{        
                            echo ("<tr style='background-color: #f3f8a7;'><td>");
                            echo($row['username']);
                   
                    
                        echo("</td><td>");
                        echo($row['scores']);
                        echo("</td><tr>\n");
                        
                        }
                        
                    }
                    }

                    ?>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>



    <footer>
        <p>Copyright &copy 2021 | We are listening: <a id="mail"
                href="mailto:inquiziteens@gmail.com">inquiziteens@gmail.com</a>
        </p>
    </footer>
</body>

</html>

