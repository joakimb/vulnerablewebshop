<?php
require 'Config.php';

class DBHandle {
	
	var $pdo;

	public function DBHandle(){
		$db = Config::$db;
		$user = Config::$user;
		$pass = Config::$pass;
		$this->pdo = new PDO("mysql:host=localhost;dbname=$db", $user, $pass);
	}

	public function getProducts(){

		$query = $this->pdo->prepare("SELECT * FROM products");
		$query->execute();

		/* Fetch all of the remaining rows in the result set */
		$result = $query->fetchAll();
		return $result;

	}

}

?>