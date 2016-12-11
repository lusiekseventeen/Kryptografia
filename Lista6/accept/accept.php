<?php 
require_once("php/session.php");
require_once("php/deliveries.php");


  if (!SESJA\CheckSession()){
    header("location: loginpage.php");
  }
  if (!($_SESSION['NICK'] == 'admin'))
  {
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
  <script src="js/acp.js"></script>
  <link href="styles/notifystyle.css" rel="stylesheet">
  <link href="styles/main.css" rel="stylesheet">
  <script>
$(document).ready(function(){
    $("#addButton").click(function(){
        $("#pharmasList").fadeIn(500);
        $("#dowoz").fadeIn(500);
        $("#saveButton").fadeIn(2000);
    });
});
</script>
</head>

<body>
 <div id="bar">
    <a href="php/login.php?logout"><div id="logout"><b> wyloguj </b></div></a>
    <div id="wall"></div>
    <a href="driverpanel.php"><div id="username" value = "{{USER}}""><b>{{USER}}</b></div></a>
    <img src="images/pharmas/{{USER}}.png" id="profilowe" alt="profilowe">
  </div>

  
  <input id="b" type='button'  class='editNotificationBtn' value='pod'>
 {{FORMS}}

</body>
EOT;

$form = "<form id='form{{i}}' method='post' action='php/confirm.php'>
  <br>
  <h1>{{DATES}}</h1>
  <br>
  <p>{{NOTIFICATION}}</p>
    <input class = 'input' type = 'hidden' name = 'id' value = '{{ID}}' >
    <input type='submit'  class='editNotificationBtn' name = 'action' value='potwierdź'>
  </form>";

$coms = getTransfersAdmin();

$FORMS = "";
$f = "";
$d = "";

for ($i=0; $i < count($coms) ; $i++) 
{ 
  $d = $coms[$i]["customer"]." &#10513; ".$coms[$i]["receiver"];

  $f = $form;

  $f = (string) str_replace("{{DATES}}", $d,  $f);
  $f = (string) str_replace("{{i}}", $i,  $f);
  $f = (string) str_replace("{{ID}}", $coms[$i]["id"],  $f);
  $f = (string) str_replace("{{NOTIFICATION}}", $coms[$i]["acc"]."<br>".$coms[$i]["amount"],  $f);
  $FORMS .= $f;
}

if(count($coms) == 0)
{
  $FORMS = "<form method='post' action='driverpanel.php'>
  <br>
  <h1>brak przelewów w bazie</h1>
  <input type='submit'  class='notifyBtn' name = 'action' value='powrót'>
  </form>";
}

$content = (string) str_replace("{{USER}}", $_SESSION['NICK'],  $content); 

$content = (string) str_replace("{{FORMS}}", $FORMS,  $content);


echo $content;   
?>