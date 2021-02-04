<?php
session_start();
require_once "pdo.php";
$data=[];


if(!isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['pw'])){
    die("user not logged in");
}

else{
    $stmt1=$pdo->query("SELECT * FROM questions");
    $qs_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    // while ($qs_rows = $stmt1 -> fetch(PDO::FETCH_ASSOC)) {
    //     $data[count($data)] = $qs_rows;
    // }

    // echo(json_encode($data, JSON_PRETTY_PRINT));



    
}


?>
<!DOCTYPE html>
<title>InQuiziTeens :: Play</title>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<!-- <script src="index.js"></script> -->
<script>
var passedArray = 
<?php echo json_encode($qs_rows); ?>; 

function shuffle(arra1) {
    var ctr = arra1.length, temp, index;

// While there are elements in the array
    while (ctr > 1 ) {
// Pick a random index
        index = Math.floor(Math.random() * ctr)+1;
// Decrease ctr by 1
        ctr--;
// And swap the last element with it
        temp = arra1[ctr];
        arra1[ctr] = arra1[index];
        arra1[index] = temp;
    }
    return arra1;
}
var passedArray=shuffle(passedArray);


function content1(){
    var x= document.getElementById("option1").innerHTML;
    document.getElementById("new").innerHTML=x;
    // document.getElementsByClassName("choice-container")[0].style.removeProperty("background-color");
    for(var i=0;i<4;i++){
        if(i==0){
            
            document.getElementsByClassName("choice-container")[i].style.backgroundColor="rgba(108, 164, 248, 0.781)";
        }
        else{
            document.getElementsByClassName("choice-container")[i].style.removeProperty("background-color"); 
        }
    }
// console.log(document.getElementById("new").innerHTML==passedArray[i-1]['ans']); 

}
function content2(){
    var x= document.getElementById("option2").innerHTML;
    document.getElementById("new").innerHTML=x;

    for(var i=0;i<4;i++){
        if(i==1){
            
            document.getElementsByClassName("choice-container")[i].style.backgroundColor="rgba(108, 164, 248, 0.781)";
        }
        else{
            document.getElementsByClassName("choice-container")[i].style.removeProperty("background-color"); 
        }
    }
// console.log(document.getElementById("new").innerHTML==passedArray[i-1]['ans']); 

}
function content3(){
    var x= document.getElementById("option3").innerHTML;
    document.getElementById("new").innerHTML=x;
    for(var i=0;i<4;i++){
        if(i==2){
            
            document.getElementsByClassName("choice-container")[i].style.backgroundColor="rgba(108, 164, 248, 0.781)";
        }
        else{
            document.getElementsByClassName("choice-container")[i].style.removeProperty("background-color"); 
        }
    }
// console.log(document.getElementById("new").innerHTML==passedArray[i-1]['ans']); 

}
function content4(){
    var x= document.getElementById("option4").innerHTML;
    document.getElementById("new").innerHTML=x;

    for(var i=0;i<4;i++){
        if(i==3){
            
            document.getElementsByClassName("choice-container")[i].style.backgroundColor="rgba(108, 164, 248, 0.781)";
        }
        else{
            document.getElementsByClassName("choice-container")[i].style.removeProperty("background-color"); 
        }
    }
// console.log(document.getElementById("new").innerHTML==passedArray[i-1]['ans']); 

}


var i=1;
var score=0;

const increse = () => {
    // console.log('dfdg');
    // n+=1;

    // document.getElementById("endpage").style.display="none";

    if(i<passedArray.length){
    document.getElementById('quesiton').innerHTML=passedArray[i]['qs'];
    document.getElementById('option1').innerHTML=passedArray[i]['option1'];
    document.getElementById('option2').innerHTML=passedArray[i]['option2'];
    document.getElementById('option3').innerHTML=passedArray[i]['option3'];
    document.getElementById('option4').innerHTML=passedArray[i]['option4'];
    // console.log(passedArray[i]['image']);

    if(passedArray[i]['image']==null )
    {
        document.getElementById('quiz-img').src="null";
        document.getElementById('quiz-img').style.display="none";
        // console.log("source null");
    }
    else{

        document.getElementById('quiz-img').src=passedArray[i]['image'];
        document.getElementById('quiz-img').style.display="block";
        // console.log("source not null");
    }
    // console.log("src "+ document.getElementById('quiz-img').src);
     console.log(passedArray[i-1]['qs_id']);
    
  

if(document.getElementById("new").innerHTML==passedArray[i-1]['ans']){score+=5;}
else if(document.getElementById("new").innerHTML==""){score+=0;}
else{score-=1;} 

document.getElementById("new").innerHTML="";
console.log(passedArray[i-1]['ans']);

console.log(score);

for(var j=0;j<4;j++){
    document.getElementsByClassName("choice-container")[j].style.removeProperty("background-color"); 
            
    }

    i+=1;
    return 0;

  


}
    else{
  

    if(document.getElementById("new").innerHTML==passedArray[i-1]['ans']){score+=5;}
    else if(document.getElementById("new").innerHTML==""){score+=0;}
else{score-=1;} 
document.getElementById("new").innerHTML=="";
console.log(passedArray[i-1]['ans'])
console.log(score);

    location.replace("end.php");


$.post('quiz1.php',{
    score : score
    

},
()=> {
    console.log("recorded");

});


    } // document.getElementById("score").innerHTML= document.getElementById("new").innerHTML+passedArray[i]['ans']; 

}


</script>

</head>



    <meta charset="UTF-8"/>
    <title>InQuiziTeens :: Play</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Quick Quiz - Play</title>
    
    <link rel="stylesheet" href="app.css"/>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">


    <body>
    <div class="grid-container">
      <div class="questions">
            <div class="form">
                <div id="game" class="justify-center flex-column">
                    
                     <!-- Below here you just need to insert the first question, options ansewer, image url in the respective postions shown below ,
 and then upon clicking the NEXT button it will automtically fetch all questions amd respective options from database,
 Looking forard to your contributions to fix this issue :) -->
                    
                    <h3 id="quesiton">YOUR FIRST QUESTION</h3>
                    <img id="quiz-img" src="iIMAGE_URL" alt="" width="200" height="250">
                    <button class="choice-container" onclick="content1();"  >
                        <p class="choice-prefix">A</p>
                        <p id="option1" >OPTION1</p>
                    </button>
                    <button class="choice-container" onclick="content2();" >
                        <p class="choice-prefix">B</p>
                        <p id="option2">OPTION2</p>
                    </button>
                    <button class="choice-container" onclick="content3();">
                        <p class="choice-prefix">C</p>
                        <p id="option3">OPTION3</p>
                    </button>
                    <button class="choice-container" onclick="content4();">
                        <p class="choice-prefix">D</p>
                        <p id="option4">OPTION4</p>
                    </button>

                    <div class="next-button">
                        <button id="pushMe" onclick="increse();" name="next"> Next </button>
                    </div>
    
    
                </div>
    
            </div>
        </div>
    </div>
    <div id="new" style="display:none"></div>
   
   

      
</body>
</html>
