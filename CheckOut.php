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
			include "DBHandle.php" ;
			include("Header.php");

			$dbHandle = new DBHandle();
			         // get the product id
				//	echo print_r($_SESSION['cart_items']);
					$total_price = 0;
		
                  	for ($i=0; $i < 2; $i++) { 

						if (isset($_SESSION['cart_items'])){
							if(array_key_exists ( $i+1, $_SESSION['cart_items'] )){
								if($_SESSION['cart_items'][$i+1] > 0){
								
									$price = $dbHandle->getProductPrice($i+1);					
						
									$total_price += ($price*$_SESSION['cart_items'][$i+1]);
								}
							}
						}
					}
							
                               echo "Receipt:";
                                echo "<br>";
                                echo "Price: ";
                                echo $total_price;
                             	echo "<br>";
                                //echo "Products: ";
                                //echo $product;
                                echo "<br>";
                                echo "Date: ";
                                echo date('l jS \of F Y h:i:s A');
                                echo "<br>";
                                echo "Bought from phones-R-us"; 
                                echo "<br>";
                                echo "Your products will be sent to your address within 7 work days, payment will be administered on delivery.";
		?>
		

	</div>
</body>
</html>