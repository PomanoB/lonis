<?php

if(isset($_SESSION["user_$cookieKey"])) {
	header("Location: {$baseUrl}/ucp/");
}
	
unset($_SESSION["steamId64"]);

foreach($_GET as $key=>$value) { 
	$_GET[$key] = urldecode($value);
}

include 'lightopenid.php';

$openid = new LightOpenID();

if(!$openid->mode) {
	$openid->identity = 'http://steamcommunity.com/openid';
	header("Location: ".$openid->authUrl());
}
else
if($openid->mode == 'cancel') {
	header("Location: {$baseUrl}/auth/");
}
else {
	if($openid->validate()) {
		$id = $openid->identity;
		$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
		preg_match($ptn, $id, $matches);
		
		if(isset($matches[1])) 
			$_SESSION["steamId64"] = $matches[1];
	}
			
	header("Location: {$baseUrl}/auth/");
}
?>