<?php
 	setcookie("user", $uname, 0, "/");
	header('Location: http://'.$_SERVER['HTTP_HOST'] . "/vulnweb/");
	exit();
?>