<?php
require_once("session.php");

if (isset($_GET['check'])){
		if (SESJA\CheckUser())
		{
			header("location: /Raiffeisen/home.php");
		} 
		else 
		{
			header("location: /Raiffeisen/loginpage.php?error=login");
		}
	}

	if (isset($_GET['logout'])){
		SESJA\StopSession();
		header("location: /Raiffeisen/loginpage.php");
	}

	$blad = isset($_GET['error']);
?>