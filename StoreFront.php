<?php
include 'DBHandle.php';

showStoreFront();

function showStoreFront(){

	echo "<p>Our products:</p>";

	$dbHandle = new DBHandle();
	$products = $dbHandle->getProducts();
	for ($i=0; $i < count($products); $i++) { 
		$product = $products[$i];
		echo $product->title . "<br>";
		echo $product->description. "<br>";
		echo $product->price . " sek<br>";
		echo "<br>";
	}
}
?>
