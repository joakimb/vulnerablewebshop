<?php
include 'DBHandle.php';
if($_SERVER['SERVER_PORT'] != '443') {
	header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	exit();
}
error_reporting(-1);
ini_set('display_errors', 1);

session_start();
?>

<html>
<head>
	<title>Shoping Cart</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main">
		<?php 
			include("Header.php");
		

			echo "<p>In shopping cart:</p>";

			$dbHandle = new DBHandle();
			$products = $dbHandle->getProducts();
			
			for ($i=0; $i < count($products); $i++) { 

				if (isset($_SESSION['cart_items'])){
					if(array_key_exists ( $i+1, $_SESSION['cart_items'] )){
						if($_SESSION['cart_items'][$i+1] > 0){

							$product = $products[$i];
							echo "Quantity: " . $_SESSION['cart_items'][$i+1] . " " ;
							echo $product->title . " ";

							echo $product->price . " sek";

							?>
							<form method="get" action="RemoveFromCart.php">
								<input type="hidden" name="product_id" value="<?php echo $product->productId; ?>">
								<input type="submit" id="submit" value="Remove">
							</form>
							<?php
						}
					}
				}
			}

			?>
		<form method="get" action="CheckOut.php">
			<input type="hidden" name="product_id" value="<?php $_SESSION['cart_items']; ?>">
			<input type="submit" id="submit" value="Checkout">
		</form>
		<form method="get" action="index.php">
			<input type="submit" id="submit" value="Back to product listing">
		</form>
	</div>

</body>
</html>
