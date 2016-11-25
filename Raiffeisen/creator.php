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

  <div id="addButton" class="buttons">
    <img src="images/addButton.png" id="addBtn" alt="addButton">
  </div>

  <div id='dowoz' class='pharmas'><img src='images/pharmas/dowoz.png' class='pharmIMG' alt='dowoz'></div>
  
  <form id="pharmform" method="post" action="php/gnupg_adddecryptkey(identifier, fingerprint, passphrase)eliveries.php">
    <input type="hidden" name="dowozy" value="">
    <input type="hidden" name="test" value="">
    <div id = 'iterator1' class = "iterator">1</div>
    <input type="text" name="comment1" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="commentFirst" id="comment1" value="">
    
    <div id = 'iterator2' class = "iterator">2</div>
    <input type="text" name="comment2" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment2" value="">
    
    <div id = 'iterator3' class = "iterator">3</div>
    <input type="text" name="comment3" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment3" value="">
    
    <div id = 'iterator4' class = "iterator">4</div>
    <input type="text" name="comment4" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment4" value="">
    
    <div id = 'iterator5' class = "iterator">5</div>
    <input type="text" name="comment5" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment5" value="">
    
    <div id = 'iterator6' class = "iterator">6</div>
    <input type="text" name="comment6" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment6" value="">
    
    <div id = 'iterator7' class = "iterator">7</div>
    <input type="text" name="comment7" size="40"
        maxlength="100" placeholder="dowóz do klienta" class="comment" id="comment7" value="">
    <input type="hidden" name="from" value="{{USER}}">
  </form>

  <div id = 'more_ddBtn'>
    <button id = 'moreBtn'>&#43;</button>
  </div>
    
  <div id="saveButton" class="buttons">
    <img src="images/save.png" id="saveBtn" alt="saveButton">
  </div>
</body>
EOT;

$content = (string) str_replace("{{USER}}", $_SESSION['NICK'],  $content); 


echo $content;   
?>