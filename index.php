<?php
if($_SERVER['SERVER_PORT'] != '443') {
	header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	exit();
}
error_reporting(-1);
ini_set('display_errors', 1);

?>

<html>
<head>
	<title>phones-R-us</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-32" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main">
		<?php 

			include("Header.php");
			if(isset($_GET['content'])){

				/*
				$content = $_GET['content'];
				if(strcmp($content, "guestbook") == 0){
					include("Guestbook.php");
				}
				*/
				/**
				VULNERABLE EDITION:
				*/

				include($_GET['content'] . ".php");

			} else {
				include("StoreFront.php"); 
			}

		?>
	</div>
</body>
</html>
