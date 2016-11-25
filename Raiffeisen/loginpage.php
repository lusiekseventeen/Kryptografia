<?php 


$page = <<<EOT

<!DOCTYPE html>

<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Raiffeisen Polbank</title>
  <meta name="description" content= "Projekt I, Nowoczesne Technologie www">
  <meta name="keywords" content= "WPPT, PWr, programy, algorytmy, najwiekszy wspólny dzielnik, NWD, GCC">  
  <meta name="viewport"  content= "width=device-width, initial-scale=1.0"/>
  <link href="styles/loginstyle.css" rel="stylesheet">
  <script src="js/log.js"></script>

  <style>
  body
  {
    background-image: url(../images/weather/{{WEATHER}}.jpg);
  }
  </style>
</head>


<body>
  <div id = "loginBox"> 
    <div class="row naglowek">
      <center id = "textLogo">Raiffeisen</center>
      <center><img src="images/logo.png" id="logo" alt="Logo W11/K2"></center>
      <center>
      <form method="post" action="https://localhost/Raiffeisen/php/login.php?check=user" id="forma">
        <input type="text" name = "user" size="20"
        maxlength="40" placeholder="username" required id="fUser"> 
        <br><br>
        <input type="password" name = "password" size="20" 
        maxlength="40" placeholder="password" required id="fPass">   
        <br><br>
        <input id="login" type="submit"  class="button" value="log in">
      </form>
      </center>
      <center><div id = "info">{{INFO}}</div></center>

    </div>
  </div>
</body>
</html>


EOT;


$activeBG = "mostly";

$F = (string) str_replace("{{WEATHER}}", $activeBG,  $page);
if (isset($_GET['error']))
{
  $F = (string) str_replace("{{INFO}}", "wrong password/username",  $F);
}
else
{
  $F = (string) str_replace("{{INFO}}", "",  $F);
}
echo $F;

?>
