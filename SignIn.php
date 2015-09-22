<?php
	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 

 	$dbHandle = new DBHandle();
 	$dbPass = $dbHandle->getPwd($uname);

 	if(!strcmp($pass, $dbPass)){
 		echo "Logged in";
 	} else{
 		echo "Wrong Pass";
 	}
?>