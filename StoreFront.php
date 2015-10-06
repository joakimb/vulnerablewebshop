<?php
include 'DBHandle.php';
include 'CSRFProtector.php';
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
		?>
		<form method="get" action="AddToCart.php">
			<input type="hidden" name="product_id" value="<?php echo $product->productId; ?>">
			<input type="submit" id="submit" value="Buy">
			<input name='csrfp' type='hidden' value='<?php echo CSRFProtector::CSRFNonce(); ?>' /> 
		</form>
		<?php

	}
}
?>


