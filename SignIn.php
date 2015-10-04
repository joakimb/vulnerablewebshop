<?php
	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 

 	$dbHandle = new DBHandle();

 	if($dbHandle->checkPwd($pass, $uname)){
 		setLoginCookie($uname);
 		echo "Logged in";

 		header('Location: http://'.$_SERVER['HTTP_HOST'] . "/vulnweb/");
		exit();
 	} else{
 		echo "Wrong Pass";
 	}

 	function setLoginCookie($uname){  
 		//setcookie("user", $uname, time() + 3600, "/");
        session_regenerate_id();
 		session_start();
 		$_SESSION['uname'] = $uname;

 	}
?>