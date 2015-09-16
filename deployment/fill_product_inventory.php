#!/usr/bin/php
<?php



$inventory_file = "./products/inventory.txt";
$inventory = fopen($inventory_file, "r") or die("Unable to open file!");
//echo fread($inventory,filesize($inventory_file));

global $argc, $argv;
$db = $argv[1];
$user = $argv[2];
$pass = $argv[3];
$pdo = new PDO("mysql:host=localhost;dbname=$db", $user, $pass);

while (!feof($inventory)){
   $line = fgets($inventory);
   if(!strcmp($line, "PRODUCT")) break;
   $name = fgets($inventory);
   $price= fgets($inventory);
   $description = fgets($inventory);
   $imgPath = fgets($inventory);
   insert($pdo, $name, $price, $description, $imgPath);
}

fclose($inventory);

function insert($pdo, $name, $price, $description, $imgPath){
	
	$params = array(':title' => $name, ':price' => $price, ':description' => $description, ':img_path' => $imgPath);
     
	$stmt = $pdo->prepare("INSERT INTO products (title, price, description, img_path) VALUES (?, ?, ?, ?)");
	$stmt->bindParam(1, $name);
	$stmt->bindParam(2, $price);
	$stmt->bindParam(3, $description);
	$stmt->bindParam(4, $imgPath);
	$stmt->execute();
	
}

?> 