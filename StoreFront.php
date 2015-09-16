<?php
include 'DBHandle.php';

function showStoreFront(){
	echo "<h2 id=\"sf_header\">phones-R-us</h2>";
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
