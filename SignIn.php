<?php
	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 

 	$dbHandle = new DBHandle();
// 	$dbPass = $dbHandle->getPwd($uname);
// 	$isValid = $dbHandle->checkPwd($pass, $uname);

 	if($dbHandle->checkPwd($pass, $uname)){
 		setLoginCookie($uname);
 		echo "Logged in";

 		header('Location: http://'.$_SERVER['HTTP_HOST'] . "/vulnweb/");
		exit();
 	} else{
 		echo "Wrong Pass";
 	}

 	function setLoginCookie($uname){
 		session_start();
 		//session_set_cookie_params($lifetime = 0, $path = '/', $domain, $secure = true, $httponly = true);
 		setcookie("user", $uname, time() + 3600, "/");
 		
 	}
?>