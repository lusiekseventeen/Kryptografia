<?php
	namespace SESJA;
	require_once("checkDB.php");

	function CheckUser(){
	  //utrudniamy życie hakerom: w naglowku się nie uda przesłać info; 
	  if (!( isset($_POST['user']) and isset($_POST['password']) )){
		return false;
	  }
	  $NICK = $_POST['user'];
	  $PASS = $_POST['password'];
	  //To trzeba zastąpić porządnym sprawdzeniem
	  if (logRequest($NICK, $PASS)){
		$time = 60*60;
		session_set_cookie_params($time); //czas w sekundach
		session_start();
		$_SESSION['NICK'] = $NICK;
		$_SESSION['Imie'] = "Jacek";
		$_SESSION['Nazwisko'] = 'Cichoń';
		return true;
	  } else {
		return false;
	  }
	}
	function CheckSession(){
	  session_start();
	  return isset($_SESSION['NICK']);
	}
	function StopSession(){
	  session_start();
	  $params = session_get_cookie_params();
	  session_unset();
	  session_destroy(); 
	  setcookie(session_name(), '', 1, 
		$params['path'], $params['domain'], 
		$params['secure'], isset($params['httponly'])
	  );
	}
?>