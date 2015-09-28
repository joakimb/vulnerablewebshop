<?php
require 'Config.php';
require 'Product.php';
require 'Comment.php';
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

    public function putComment($comment){
        try{
            $query = $this->pdo->prepare("INSERT INTO comments(comment) VALUES(?)");
 
            $query->execute(array($comment));
 
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                die();
                }
//        echo "Thanks for your comment";
        }

    public function getComments(){

    echo("yoyotsrgrg");
    	$query = $this->pdo->prepare("SELECT * FROM comments;");
		$query->execute();

		$res = $query->fetchAll();


if (count($res) > 0) {
    // output data of each row
		for ($i=0; $i < count($res); $i++) { 
			echo("y");
			$row = $res[$i];
	

			$comment = new Comment();
			$comment->commentId = $row["comment_id"];
			$comment->comment = $row["comment"];

//			$comment->user = $row["uname"];
			$comment = $row["comment"];
			echo $comment . '<br />';
			$comments[$i] = $comment;
		}

		return $comments;
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

	public function getPwd($user){
		try{
		$query = $this->pdo->prepare("SELECT pwd FROM users where uname = ?");
		$query->execute(array($user));
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
		$result = $query->fetch();
		return $result["pwd"];
	}

	public function newUser($user, $pass, $addr){
		try{
			$statement = $this->pdo->prepare("INSERT INTO users(uname, pwd, address) VALUES(?, ?, ?)");

			$statement->execute(array($user, $pass, $addr));
		} catch (PDOException $e) {
			echo "Username taken";
			die();
			//echo "Error: " . $e->getMessage();
		}
		echo "You have been registered!";

		
	}	

}

?>