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
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
		try{
			$statement = $this->pdo->prepare("INSERT INTO users(uname, pwd, address) VALUES(?, ?, ?)");

			$statement->execute(array($user, $pass, $addr));
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		echo "You have been registered!";

		
	}	

}

?>