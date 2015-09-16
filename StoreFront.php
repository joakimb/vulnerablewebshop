<?php
include 'DBHandle.php';
function showStoreFront(){
	echo "<p>Hello Wooooooorld!</p>";
	//echo "<p>";
	$dbHandle = new DBHandle();
	$result = $dbHandle->getProducts();
	print_r($result);
}
?>
