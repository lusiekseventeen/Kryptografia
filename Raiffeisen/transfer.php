<?php 
require_once("php/session.php");
require_once("php/deliveries.php");
//require_once("php/dates.php");
//require_once("php/pharmas.php");

  if (!SESJA\CheckSession()){
    header("location: loginpage.php");
  } 
$content = <<<EOT
<!DOCTYPE html>

<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>System dowozów - Twoje Apteki</title>
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon/logo3232.png">
  <meta name="description" content= "System dowozów - Twoje Apteki">
  <meta name="viewport"  content= "width=device-width, initial-scale=1.0"/>
  <link href="styles/reset.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="js/main.js"></script>
  <link href="styles/style.css" rel="stylesheet">
  <link href="styles/stylemain.css" rel="stylesheet">
  <script>
$(document).ready(function(){
    $("#addButton").click(function(){
        $("#pharmasList").fadeIn(500);
        $("#dowoz").fadeIn(500);
        $("#saveButton").fadeIn(2000);
    });
});
$(document).ready(function(){
    $("#acceptBtn").click(function(){
        $("#cover").fadeOut(600);
        $(".notification").fadeOut(300);
    });
});
</script>
</head>

<body>
 <div id="bar">
    <a href="php/login.php?logout"><div id="logout"><b> wyloguj </b></div></a>
    <div id="wall"></div>
    <a href="home.php"><div id="username" value = "{{USER}}""><b>{{USER}}</b></div></a>
    <img src="images/pharmas/{{USER}}.png" id="profilowe" alt="profilowe">
  </div>

  <div id='dowoz' class='pharmas'><img src='images/pharmas/dowoz.png' class='pharmIMG' alt='dowoz'></div>
  
  <form id="tranform" method="post" action="https://localhost/Raiffeisen/php/addtransfer.php">
    Nazwa:
    <input type="text" name="receiver" value="">
    <br>Numer konta:
    <input type="text" name="acc" value="">
    <br>Kwota:
    <input type="text" name="amount" value="">
    <input type="hidden" name="from" value="{{USER}}">
  </form>

  <div id = "potwierdzenie">
    <b>Nazwa:</b>
    <div id = "od"></div>
    <br><b>Numer konta:</b>
    <div id = "numer"></div>
    <br><b>Kwota:</b>
    <div id = "kwota"></div>
  </div>

  <div id = 'more_ddBtn'>
    <button id = 'nextBtn'>dalej</button>
  </div>

  <div id = 'more_ddBtn'>
    <button id = 'submitBtn'>wyślij</button>
  </div>
    
</body>
EOT;

$content = (string) str_replace("{{USER}}", $_SESSION['NICK'],  $content); 


echo $content;   
?>