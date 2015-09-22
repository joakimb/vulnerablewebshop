<?php
require 'Config.php';
require 'Product.php';
class DBHandle {
	
	var $pdo;

	public function DBHandle(){
		try{
			$db = Config::$db;
			$user = Config::$user;
			$pass = Config::$pass;
			$this->pdo = new PDO("mysql:host=localhost;dbname=$db", $user, $pass);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getProducts(){

		$query = $this->pdo->prepare("SELECT * FROM products");
		$query->execute();

		$result = $query->fetchAll();
		$products = array();	

		for ($i=0; $i < count($result); $i++) { 

			$row = $result[$i];
			
			$product = new Product();
			$product->productId = $row["product_id"];
			$product->title = $row["title"];
			$product->price = $row["price"];
			$product->description = $row["description"];
			$product->imgPath = $row["img_path"];
			
			$products[$i] = $product;
		}
		
		return $products;
	}

	public function newUser($user, $pass, $addr){
		echo "jjjjj";
		$statement = $pdo->prepare("INSERT INTO users(uname, pwd, address) VALUES(:uname, :pwd, :address)");
		$res = $statement->execute(array(
    		"uname" => $user,
   			"pwd" => $pass,
   			"address => $addr"
		));


		
	}	

}

?>