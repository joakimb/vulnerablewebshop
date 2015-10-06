<?php
include 'CSRFProtector.php';
if(!isset($_SESSION)) { 
    session_start(); 
}
 


// get the product id
$id = isset($_GET['product_id']) ? $_GET['product_id'] : "";
$csrfp = isset($_GET['csrfp']) ? $_GET['csrfp'] : '';
if(!CSRFProtector::nonceIsValid($csrfp)){
	echo "MALICIOUS LINK, ABORTING!!!!";
	die();
}
echo $id;

	if(!isset($_SESSION['cart_items'])){
	    $_SESSION['cart_items'] = array();
	}
		$_SESSION['cart_items'][$id] = $_SESSION['cart_items'][$id]+1;

	    // redirect to product list and tell the user it was added to cart
	   // header('Location: products.php?action=added&id' . $id . '&name=' . $name);
		header('Location: Cart.php');
	

?>

