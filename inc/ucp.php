<?php
$message = "";
$addFlags = array();
		
if (isset($_SESSION["user_$cookieKey"])) {
    if (isset($_POST["name"]) && $_POST["name"] != '') {
		$nick =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST["name"])));
		if (!isset($_SESSION["user_$cookieKey"]["steam_id_64"])) {
			$password =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["password"])));
			$ip =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["ip"])));
			$steam_id =  str_replace(array('"', "'"), array('', ''), slashes(trim($_POST["steam_id"])));
		}
		
		if (!isset($_SESSION["user_$cookieKey"]["steam_id_64"])) {
			$flag = 0;		
			if ($ip != '') $flag |= (1<<0);
			if ($steam_id != '') $flag |= (1<<1);  			
			if ($password) $password = md5($password);				
			$auth = abs((int)$_POST["authType"]);
			if ($auth > 1) $auth = 0;
		}
		
		$addFlag = "";
		foreach($additional_flags as $key => $value) {
			if (isset($_POST[$key])) $addFlag .= $value;
		}
				
		$icq = abs((int)$_POST["icq"]);
		
		$update_sql = "";
		if (!isset($_SESSION["user_$cookieKey"]["steam_id_64"])) {
			$pass = $password ?  ", `password` = '$password'" : '';
			
			$steam_id = trim($steam_id);
			$steam_id_64 = GetAuthID64($steam_id);
			
			$update_sql = "UPDATE `unr_players` 
				SET `name` = '$nick' $pass,`ip` = '$ip', `steam_id` = '$steam_id', `steam_id_64` = '$steam_id_64',
				`flags` = $flag, `amxx_flags` = '$addFlag', `auth` = $auth, `icq` = {$icq}
				WHERE `id` = ". $_SESSION["user_$cookieKey"]["id"];
		}
		else {
			$update_sql = "UPDATE `unr_players`
				SET `name` = '$nick', `amxx_flags` = '$addFlag', `icq` = $icq
				WHERE `id` = ". $_SESSION["user_$cookieKey"]["id"];
		}
		if (mysqli_query($db, $update_sql))
			$message = $langs["DataUpdated"];
		else
			$message = $langs["AlreadyUsed"];     
    }
    else
    {   
	
		$i = 0;
		foreach($additional_flags as $key => $value)
		{
			$addFlags[$i]["flag"] = $key;
			$addFlags[$i]["lang"] = $lang;
			$addFlags[$i]["checked"] = (strstr($_SESSION["user_$cookieKey"]["amxx_flags"], $value) == FALSE ? 0 : 1);
			$i++;
		}
		

	}
}
else {
    $message = $langs["MustLogin"];
}

assign('addFlags', $addFlags);
assign('message', $message);
?>