<?php 
require_once("php/session.php");
require_once("php/deliveries.php");
//require_once("php/dates.php");
if (!SESJA\CheckSession())
{
  header("location: loginpage.php");
}
$u = $_SESSION['NICK'];



$PHARMAS = array("piastowska", "ok", "torebka", "dworcowa", "pgora", "arnica", "tesco", "zdroj");

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
  <script src="js/home.js"></script>
  <link href="styles/homestyle.css" rel="stylesheet">
  <link href="styles/underbar.css" rel="stylesheet">
</head>

<body>
 <div id="bar">
    <a href="php/login.php?logout"><div id="logout"><b> wyloguj </b></div></a>
    <div id="wall"></div>
    <a href="home.php"><div id="username" value = "{{USER}}""><b>{{USER}}</b></div></a>
    <img src="images/pharmas/{{USER}}.png" id="profilowe" alt="profilowe">
  </div>

  <form id="pharmEditform" method="post" action="transfer.php">
    <input type="hidden" name="edit" value="">
  </form>
  <div id="bList" class="buttonsList">
    <div id="addButton" class="buttons">
        <img src="images/addButton.png" id="addBtn" alt="addButton">
    </div>
  </div>

  <div id = "current">Potwierdzenia przelewów</div>
  <div id="todayList" class="pharmasList">
    {{MONEY_TRANSFERS}}
  </div>
</body>
EOT;

$dwTD = getTransfers($u);
$count = count($dwTD);

$dw = "";
while ($count > 0)
{
  $dw .= "<div id='dw1' class='pharmasDW'><h1>Przelew</h1><br>Num Ref: ".$dwTD[$count-1]['id']."<br>Nazwa: ".$dwTD[$count-1]['receiver']."<br>Numer: ".$dwTD[$count-1]['acc']."<br>Kwota: ".$dwTD[$count-1]['amount']."</div>";
  $count--;
}

$content = (string) str_replace("{{MONEY_TRANSFERS}}", $dw,  $content); 

$content = (string) str_replace("{{USER}}", $u,  $content); 

echo $content; 
?>