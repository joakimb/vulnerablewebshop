<?php
	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 

 	$dbHandle = new DBHandle();
 	$dbPass = $dbHandle->getPwd($uname);

 	if(!strcmp($pass, $dbPass)){
 		setLoginCookie($uname);
 		echo "Logged in";
 		header('Location: http://'.$_SERVER['HTTP_HOST'] . "/vulnweb/");
		exit();
 	} else{
 		echo "Wrong Pass";
 	}

 	function setLoginCookie($uname){
 		session_start();
 		setcookie("user", $uname, time() + 3600, "/");
 	}
?>