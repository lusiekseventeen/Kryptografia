<?php
require_once("mysql.php");


function addTransfer($fr, $cu, $acc, $am)
{
	$con = myDB();			
	mysqli_query($con, "INSERT INTO montran (customer, receiver, acc, amount) VALUES ('".$fr."', '".$cu."', ".$acc.", ".$am." )");

	mysqli_close($con);
}

function getTransfers($pharm)
{
	$con = myDB();
	$rows   = array();
	$query = "SELECT * FROM montran WHERE customer LIKE '".$pharm."'";
	$del = mysqli_query($con, $query);
	if (!$del) 
	{
		echo "Blad pytania: " . $q . "<br>\n";  //Nie w kodzie produkcyjnym
		echo "Numer bledu : " . $mysqli->errno . "<br>\n";
		echo "Blad: " . $mysqli->error . "\n";			
	} 
	else 
	{
		while ($row = $del->fetch_assoc()) 
		{
				$rows[] = $row;
		}
	}
	mysqli_close($con);
		    	
	return $rows;
}

?>