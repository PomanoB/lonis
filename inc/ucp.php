<?php
if (isset($_SESSION["user_$cookieKey"]))
{
    if (isset($_POST["name"]) && $_POST["name"] != '')
    {
        if (get_magic_quotes_gpc())
		{
				$nick = str_replace(array('"', "'"), array('', ''), trim($_POST["name"]));
				if (!$_SESSION["user_$cookieKey"]["steam_id_64"])
				{
					$password = trim($_POST["password"]);
					$ip = str_replace(array('"', "'"), array('', ''), trim($_POST["ip"]));
					$steam_id = str_replace(array('"', "'"), array('', ''), trim($_POST["steam_id"]));
				}
		}
		else
		{
				$nick =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST["name"])));
				if (!isset($_SESSION["user"]["steam_id_64"]))
				{
					$password =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST["password"])));
					$ip =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST["ip"])));
					$steam_id =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST["steam_id"])));
				}
		}
		
		if (!isset($_SESSION["user_$cookieKey"]["steam_id_64"]))
		{
			$flag = 0;		
			if ($ip != '') $flag |= (1<<0);
			if ($steam_id != '') $flag |= (1<<1);  			
			if ($password) $password = md5($password);				
			$auth = abs((int)$_POST["authType"]);
			if ($auth > 1) $auth = 0;
		}
		
        $addFlag = '';
		foreach($additional_flags as $key => $value) {
			if (isset($_POST[$key])) $addFlag .= $value;
		}
				
		$icq = abs((int)$_POST["icq"]);
		
		$update_sql = "";
		if (!isset($_SESSION["user_$cookieKey"]["steam_id_64"])) {
			$pass = $password ?  ", `password` = '$password'" : '';
			
			$update_sql = "UPDATE `unr_players` 
			SET `name` = '$nick' $pass,`ip` = '$ip', `steam_id` = '$steam_id', 
			`flags` = $flag, `amxx_flags` = '$addFlag', `auth` = $auth, `icq` = {$icq}
			WHERE `id` = ". $_SESSION["user_$cookieKey"]["id"];
		}
		else {
			$update_sql = "UPDATE `unr_players`
				SET `name` = '$nick', `amxx_flags` = '$addFlag', `icq` = $icq
				WHERE `id` = ". $_SESSION["user_$cookieKey"]["id"];
		}
		if (mysql_query($update_sql))
			$smarty->assign('message', $langs["langDataUpdated"]);
		else
			$smarty->assign('message', $langs["langAlreadyUsed"]);     
    }
    else
    {   
	
		$addFlags = array();
		$i = 0;
		foreach($additional_flags as $key => $value)
		{
			$addFlags[$i]["flag"] = $key;
			$addFlags[$i]["lang"] = $smarty->get_config_vars($key);
			$addFlags[$i]["checked"] = (strstr($_SESSION["user_$cookieKey"]["amxx_flags"], $value) == FALSE ? 0 : 1);
			$i++;
		}
		$smarty->assign('addFlags', $addFlags);
	}
}
else
{
    $smarty->assign('message', $langs["langMustLogin"]);
}
?>