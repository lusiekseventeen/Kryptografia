<?php
require_once("deliveries.php");

$fr = $_POST["from"];

if(isset($_POST["receiver"]) && !empty($_POST["receiver"]) && isset($_POST["acc"]) && !empty($_POST["acc"]) && isset($_POST["amount"]) && !empty($_POST["amount"]))
{
	addTransfer($_POST["from"], $_POST["receiver"], $_POST["acc"], $_POST["amount"]);
}
else
{
	header("location: /Raiffeisen/transfer.php");
}

header("location: /Raiffeisen/home.php");

?>