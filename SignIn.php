<?php
	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 

 	$dbHandle = new DBHandle();
	$userExists = $dbHandle->userExists($uname);

 	if($userExists == true){
  		$logAttempts = $dbHandle->checkLoginAttempts($uname);
 	if($logAttempts == 0){
 	if($dbHandle->checkPwd($pass, $uname)){
 		setLoginCookie($uname);

 		header('Location: http://'.$_SERVER['HTTP_HOST'] . "/vulnweb/");
		exit();
 	}else{
 		$dbHandle->addLoginAttempt($uname);
 		echo "Wrong Pass";
 	}
 }else if($logAttempts == 1){
		echo "Access denied for 30 minutes!";
 	}
}else{
	echo "No such user";
}

 	function setLoginCookie($uname){  
 		//setcookie("user", $uname, time() + 3600, "/");
        session_regenerate_id();
 		session_start();
 		$_SESSION['uname'] = $uname;

 	}
?>