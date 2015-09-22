 <?php 
 	include 'DBHandle.php';

 	$uname = $_POST["username"]; 
 	$pass = $_POST["password"]; 
 	$addr = $_POST["address"]; 

 	$dbHandle = new DBHandle();
 	$dbHandle->newUser($uname, $pass, $addr);	
 ?>

