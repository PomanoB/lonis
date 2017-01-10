<?php
$error = "";

foreach($_GET as $key=>$value) { 
	$_GET[$key] = urldecode($value);
}

include 'lightopenid.php';

$openid = new LightOpenID;

if (isset($_SESSION["user_$cookieKey"])) {
	header("Location: {$baseUrl}/ucp");
}
else
if(isset($_SESSION["steamId64"])) {
	if (!empty($_POST["reg_nick"]) && $_POST["reg_nick"]) {
		$steamId = GetAuthID($_SESSION["steamId64"]);
		$steamName = GetAuthID($_SESSION["steamName"]);
		
		$nick = slashes(trim($_POST["reg_nick"]));
		
		$q = "INSERT INTO `unr_players` SET `name`= '{$nick}', `flags` = 2, `auth` = 1, `steam_id` = '{$steamId}', `active` = 1, `steam_id_64` = '{$_SESSION["steamId64"]}'";
		if (mysqli_query($db, $q)) {
			$_SESSION["user_$cookieKey"]["id"] = mysqli_insert_id($db);
			unset($_SESSION["steamId64"]);
			header("Location: {$baseUrl}/ucp");
		}
		else {
			$error = $langs["AlreadyUsed"];
		}
	}
}
else
if(!$openid->mode) {
	$openid->identity = 'http://steamcommunity.com/openid';
	header("Location: {$openid->authUrl()}");
}
else
if($openid->mode == 'cancel') {
	header("Location: {$baseUrl}/login");
}
else
if ($openid->validate()) {
	$steamId64 = explode('/', $openid->identity);
	$steamId64 = slashes($steamId64[5]);
	
    preg_match("/^(7[0-9]{15,25}+)$/", $steamId64, $matches);
	
	if(isset($matches[1])) {	
		$steamId = GetAuthID($steamId64);
		$steam_data = file_get_contents("http://steamcommunity.com/profiles/{$steamId64}/?xml=1");
		
		$r = mysqli_query($db, "SELECT `id` FROM `unr_players` WHERE `steam_id_64` = '{$steamId64}' OR `steam_id` = '{$steamId}' LIMIT 1");
		if ($row = mysqli_fetch_assoc($r)) {
			$_SESSION["user_$cookieKey"]["id"] = $row["id"];
			header("Location: {$baseUrl}/ucp");
		}
		else {
			$_SESSION["steamId64"] = $steamId64;
			$_SESSION["steamName"] = get_steam_info($steam_data, "steamID");
			
			header("Location: {$baseUrl}/steam");
		}
	}
	else
		header("Location: {$baseUrl}/login");
}
else {
	header("Location: {$baseUrl}/login");
}

assign('error', $error);
?>