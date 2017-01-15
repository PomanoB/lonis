<?php

$addFlags = array();
		
if(!isset($_SESSION["user_$cookieKey"])) {
	header("Location: {$baseUrl}/auth/");
}

if (isset($_POST["name"]) && $_POST["name"] != '') {
	$nick =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["name"])));
	$password =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["password"])));
	$ip =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["ip"])));
	$steam_id =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["steam_id"])));
	$auth = abs((int)$_POST["authType"]);
	
	preg_match("/^STEAM_[0-9]:[0-9]:[0-9]+/", $steam_id, $steam_id_match);
	preg_match("/^(?:(?:25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(?:25[0-5]|2[0-4]\d|[01]?\d\d?)$/", $ip, $ip_match);
	
	if(!isset($ip_match[0]) && $auth==2) {
		$message = $langs["WrongIp"];
	}
	if(!isset($steam_id_match[0]) && $auth==1) {
		$message = $langs["WrongSteamId"];
	}
	else {	
		$flag = 0;		
		if ($ip != '') $flag |= (1<<0);
		if ($steam_id != '') $flag |= (1<<1);  			
		if ($password) $password = md5($password);				
		
		
		$addFlag = "";
		foreach($additional_flags as $key => $value) {
			if (isset($_POST[$key])) $addFlag .= $value;
		}
				
		$icq = abs((int)$_POST["icq"]);
		
		$update_sql = "";
		$sql_password = $password ?  ", `password` = '$password'" : '';
		
		$sql_steam_id = ", `steam_id` = '$steam_id'";
	
		$sql = "UPDATE `unr_players` 
			SET `name` = '$nick' $sql_password,`ip` = '$ip' $sql_steam_id,
			`flags` = $flag, `amxx_flags` = '$addFlag', `auth` = $auth, `icq` = {$icq}
			WHERE `id` = ". $_SESSION["user_$cookieKey"]["id"];

		if (mysqli_query($db, $sql))
			$message = $langs["DataUpdated"];
		else
			$message = $langs["AlreadyUsed"]; 
	}
}
else {   	
	$i = 0;
	foreach($additional_flags as $key => $value)
	{
		$addFlags[$i]["flag"] = $key;
		$addFlags[$i]["lang"] = $lang;
		$addFlags[$i]["checked"] = (strstr($_SESSION["user_$cookieKey"]["amxx_flags"], $value) == FALSE ? 0 : 1);
		$i++;
	}
}
?>