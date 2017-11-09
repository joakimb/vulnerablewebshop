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

	public function getProductPrice($id){
 
                $query = $this->pdo->prepare("SELECT price FROM products where product_id = ?");
                $query->execute(array($id));
 
                $result = $query->fetch();
                       
               
               return $result["price"];
               
				//return $result[0]["price"];
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

    public function putComment($comment){
        try{
        	$str = "INSERT INTO comments(comment) VALUES('".$comment."')";
            $query = $this->pdo->prepare($str);
 			
        	/* good
            $query = $this->pdo->prepare("INSERT INTO comments(comment) VALUES(?)");
            //BAD

            
         
			*/
          

            $query->execute(array($comment));
 
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                die();
                }
//        echo "Thanks for your comment";
        }

    public function getComments(){

    	$query = $this->pdo->prepare("SELECT * FROM comments;");
		$query->execute();

		$res = $query->fetchAll();


		if (count($res) > 0) {
		    // output data of each row
				for ($i=0; $i < count($res); $i++) { 
					$row = $res[$i];

					$comment = new Comment();
					$comment->commentId = $row["comment_id"];
					$comment->comment = $row["comment"];

		//			$comment->user = $row["uname"];
					$comment = $row["comment"];
					
					$comments[$i] = $comment;
				}

				return $comments;
    }
  
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

	public function checkPwd($clearPW, $user){
		$storedPW = $this->getPwd($user);
		$hashedPW = $this->passwordHash($clearPW);
		
		if(password_verify($clearPW, $storedPW)){
			return true;
		}else{
			return false;
		}
	}

	public function passwordHash($password){
		$options = array('cost' => 11);
//		password_hash($password, PASSWORD_BCRYPT, $options);

		$hashedPW = password_hash($password, PASSWORD_BCRYPT, $options);
		return $hashedPW;
	}

	public function newUser($user, $pass, $addr){
		try{

		$statement = $this->pdo->prepare("INSERT INTO users(uname, pwd, address) VALUES(?, ?, ?)");

		$hashedPW = $this->passwordHash($pass);
		$statement->execute(array($user, $hashedPW, $addr));

		} catch (PDOException $e) {
			echo "Username taken";
			die();
			//echo "Error: " . $e->getMessage();
		}
		echo "You have been registered!";

		
	}

		public function userExists($user){
		$query = $this->pdo->prepare("SELECT uname FROM users where uname = ?");
		$query->execute(array($user));

		$res = $query->fetchAll();
		$row = $res[0];
		$uname = $row['uname'];

		if(strcasecmp($uname, $user) == 0){
			return true;
		}else{
			return false;
		}
	}

	public function checkLoginAttempts($user){
		$query = $this->pdo->prepare("SELECT attempts, (CASE when lastlogin is not NULL and DATE_ADD(lastlogin, INTERVAL 30 MINUTE)>NOW() then 1 else 0 end) AS Denied FROM loginattempts WHERE uname = ?");
		$query->execute(array($user));

		$res = $query->fetchAll();

		if(!$res){
			return 0;
		}
		$attRow = $res[0]["attempts"];
		$denRow = $res[0]["Denied"];

		if($attRow >= 3){
			if($denRow == 0){
				return 1;
			}else{
				$this->clearLoginAttempts($user);
				return 0;
			}
		}
		return 0;
	}


	public function addLoginAttempt($user){
		try{
		$query = $this->pdo->prepare("SELECT attempts FROM loginattempts WHERE uname = ?");
		$query->execute(array($user));
		$res = $query->fetchAll();
		}catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
		
		$row = $res[0];
		
		if($row['attempts'] !=  NULL){
			$currAttempts = $row['attempts'];
			$attempts = $currAttempts+1;

			if($attempts == 3){
				try{
					$query = $this->pdo->prepare("UPDATE loginattempts SET attempts = ?, lastlogin = NOW() WHERE uname = ?");
					$query->execute(array($attempts, $user));
				}catch (PDOException $e) {
					echo "Error: " . $e->getMessage();
					die();
				}
				//$res = $query->fetchAll();
			}else{
				try{
					$query = $this->pdo->prepare("UPDATE loginattempts SET attempts = ? WHERE uname = ?");
					$query->execute(array($attempts, $user));
				}catch (PDOException $e) {
					echo "Error: " . $e->getMessage();
					die();
				}
		//	$res = $query->fetchAll();
			}
		}else{
					try{
			$query = $this->pdo->prepare("INSERT INTO loginattempts(uname, attempts, lastlogin) VALUES(?, ?, NOW())");
			$query->execute(array($user, 1));
		}catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
		}

		//$res = $query->fetchAll();
	}

	public function clearLoginAttempts($user){
		try{
			$query = $this->pdo->prepare("UPDATE loginattempts SET attempts = 0 WHERE uname = ?");
			$query->execute(array($user));
		}catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
//		$res = $query->fetchAll();
//		return $res;
	}
	

}

?>
