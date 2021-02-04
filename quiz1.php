<?php
session_start();
require_once "pdo.php";


if(!isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['pw'])){
    die("user not logged in");
}

else{
    $score=$_POST['score'];
    $smt=$pdo->prepare("SELECT user_id FROM users WHERE email=:email");
    $smt->execute(array(":email"=>$_SESSION['email']));
    $row=$smt->fetch(PDO::FETCH_ASSOC);

    $smt2=$pdo->prepare("SELECT * FROM score WHERE user_id=:user_id");
    $smt2->execute(array(":user_id"=>$row['user_id']));
    $row2=$smt2->fetch(PDO::FETCH_ASSOC);

    if($row2==True)
    {
         $stmt1=$pdo->prepare("UPDATE score SET scores=:scores WHERE user_id=:user_id");
         $stmt1->execute(array(
             ':scores'=>$score,
             ':user_id'=>$row['user_id']
         ));
    }

else{
    $stmt =$pdo->prepare("INSERT INTO score(user_id,scores) VALUES(:user_id,:score)");
    $stmt->execute(array(
        ":user_id"=>$row['user_id'],
        ":score"=>$score
    ));
}
}
?>
<html>
<?php
global $row;
echo($row['user_id']);
?>
</html>