<?php
	require_once("mysql.php");

	function logRequest($username, $password)
	{
		$con = myDB();

		$stmt = $con->prepare("SELECT `password` FROM `users` WHERE `username`= ? ");
 
    	$stmt->bind_param("s", $username);
 
    	$stmt->execute();

        $stmt->bind_result($pass);

        $stmt->fetch();

        $stmt->close();

        $pass2check = $pass;
        if(password_verify($password, $pass2check))
            return true;
        else
        	return false;
    		

	}

?>