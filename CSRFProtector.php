<?php
error_reporting(-1);
ini_set('display_errors', 1);

$secret = "hehehemligt";
session_start();


nonceIsValid( CSRFNonce());

//returns active nonce for a session id or creates a new one valid for 24 Hours
function CSRFNonce(){
	checkActive();
	global $secret;

	$ttl = time() + 3600*24;
	$nonce = hash("sha512", session_id() . $ttl . $secret) . ";" . $ttl;

	echo "<br>" . $nonce . "<br>";
	return $nonce;
}

function nonceIsValid($nonce){
	checkActive();
	$arr = explode(";", $nonce);
	$hash = $arr[0];
	$ttl= $arr[1];
	echo $ttl;
	echo "<br>";
	echo $hash;
	if($ttl < time()){
		return false;
	}

}

function checkActive(){
	if(!isset($_SESSION["uname"])){
		echo ("NO ACTIVE SESSION, ABORTING");
		die();
	}

}