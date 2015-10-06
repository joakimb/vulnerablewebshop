<?php
include_once 'Config.php';
class CSRFProtector {

//returns active nonce for a session id or creates a new one valid for 24 Hours
static function CSRFNonce(){
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	CSRFProtector::checkActive();

	$ttl = time() + 3600*24;
	$nonce = hash("sha512", session_id() . $ttl . Config::$secret) . ";" . $ttl;

	
	return $nonce;
}

static function nonceIsValid($nonce){
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	CSRFProtector::checkActive();
	$arr = explode(";", $nonce);
	$hash = $arr[0];
	$ttl= $arr[1];
	
	if($ttl < time()){
		return false;
	}

	$test = hash("sha512", session_id() . $ttl . Config::$secret) . ";" . $ttl;

	return ! strcmp($test, $nonce);

}

static function checkActive(){
	if(!isset($_SESSION["uname"])){
		echo ("NO ACTIVE SESSION, ABORTING");
		die();
	}

}

}