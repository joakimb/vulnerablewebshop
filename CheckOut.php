<?php


if($_SERVER['SERVER_PORT'] != '443') {
	header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	exit();
}
error_reporting(-1);
ini_set('display_errors', 1);

if(!isset($_SESSION)) { 
	session_start(); 
}



if(!isset($_SESSION["uname"])){

	header('Location: index.php');
	die();
}





?>

<html>
<head>
	<title>phones-R-us</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main">
		<?php 

			include("Header.php");
			
		?>
		Your products will be sent to your address within 7 work days, payment will be administered on delivery.

	</div>
</body>
</html>

