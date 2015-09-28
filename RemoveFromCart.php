<?php
session_start();
 
// get the product id
$id = isset($_GET['product_id']) ? $_GET['product_id'] : "";
echo $id;

	if(!isset($_SESSION['cart_items'])){
	    $_SESSION['cart_items'] = array();
	}else{
	    //$_SESSION['cart_items'][$id]=$name;
	
		$_SESSION['cart_items'][$id] = $_SESSION['cart_items'][$id]-1;

		if($_SESSION['cart_items'][$id] < 0){
			$_SESSION['cart_items'][$id] = 0;
		}

		header('Location: Cart.php');
	}

?>

