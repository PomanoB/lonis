<?php
$message = array();
if(isset($avatarUpdate)) {
	$avatar_file = "{$bTheme}/img/players/{$_SESSION["user_$cookieKey"]["id"]}.jpg";
	if(!file_exists($avatar_file)) {
		unlink($avatar_file);
	}
}
			
if(isset($_SESSION["user_$cookieKey"])) {
	$user = $_SESSION["user_$cookieKey"];
	$r = mysqli_query($db, "SELECT * FROM `players` WHERE `id`= {$user["id"]} LIMIT 1");
	if ($player = mysqli_fetch_assoc($r)) {
		$steam_id_64 = getSteamId64($player["steam_id"]);
		$player["avatar"] = getAvatar($user["id"], $steam_id_64, $player["email"], "avatarfull");
	}

	$addFlags = array();
	if (isset($_POST["name"]) && $_POST["name"] != '') {
		$nick =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["name"])));
		$password = isset($_POST["password"]) ? str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["password"]))) : "";
	
		$auth = isset($_POST["authType"]) ? abs((int)$_POST["authType"]) : 0;
		$steam_id = isset($_POST["steam_id"]) ? $_POST["steam_id"] : 0;
		$ip = isset($_POST["ip"]) ? $_POST["ip"] : "";
		
		preg_match("/^STEAM_[0-9]:[0-9]:[0-9]+/", $steam_id, $steam_id_match);
		preg_match("/^(?:(?:25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(?:25[0-5]|2[0-4]\d|[01]?\d\d?)$/", $ip, $ip_match);
		
		if(!isset($ip_match[0]) && $auth==2) {
			$message["msg"] = $langs["WrongIp"];
		}
		if(!isset($steam_id_match[0]) && $auth==1) {
			$message["msg"] = $langs["WrongSteamId"];
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
		
			$sql = "UPDATE `players` 
				SET `name` = '$nick' $sql_password,`ip` = '$ip' $sql_steam_id,
				`flags` = $flag, `amxx_flags` = '$addFlag', `auth` = $auth, `icq` = {$icq}
				WHERE `id` = ". $user["id"];

			if (mysqli_query($db, $sql))
				$message["msg"] = $langs["Data updated successfully!"];
			//else
				//$message["msg"] = $langs["AlreadyUsed"];
		}
	}
	else {   	
		$i = 0;
		foreach($additional_flags as $key => $value)
		{
			$addFlags[$i]["flag"] = $key;
			$addFlags[$i]["lang"] = $lang;
			$addFlags[$i]["checked"] = (strstr($player["amxx_flags"], $value) == FALSE ? 0 : 1);
			$i++;
		}
	}
}
else {
	header("Location: {$bUrl}#auth");
}

?>