<?php
foreach($_GET as $key=>$value) { 
	$_GET[$key] = urldecode($value);
}

$message = array();
$act = isset($_GET["act"]) ? $_GET["act"] : "";
$act = isset($_POST["act"]) ? $_POST["act"] : $act;

if(isset($_SESSION["steamId64"])) {
	$steamId64 = $_SESSION["steamId64"];
	$steamId = getSteamId($steamId64);
	
	$r = mysqli_query($db, "SELECT `id` FROM `unr_players` WHERE `steam_id` = '{$steamId}' LIMIT 1");
	if ($id = mysqli_result($r, 0)) {
		$_SESSION["user_$cookieKey"]["id"] = $id;
	}
	else {
		$nick = getSteamInfo($steamId64, "steamID");
		
		$r = mysqli_query($db, "SELECT COUNT(`id`) FROM `unr_players` WHERE `name` = '{$nick}'");
		if(mysqli_result($r, 0)) $nick .= " ".substr(md5(uniqid()), 0, 5);
			
		$q = "INSERT INTO `unr_players` SET `name`= '{$nick}', `flags` = 2, `auth` = 1, `steam_id` = '{$steamId}', `steam_id_64` = '{$steamId64}', `active` = 1";
		mysqli_query($db, $q);
		
		$_SESSION["user_$cookieKey"]["id"] = mysqli_insert_id($db);
	}
	
	unset($_SESSION["steamId64"]);
}
	
if($act=="logout") {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $baseUrl");
}
else
if($act=="steam") {
	include 'lightopenid.php';
	$openid = new LightOpenID();

	if(!$openid->mode) {
		$openid->identity = 'http://steamcommunity.com/openid';
		header("Location: ".$openid->authUrl());
	}
	else
	if($openid->mode == 'cancel') {
		// Cancel
	}
	else
	if($openid->validate()) {
		$id = $openid->identity;
		$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
		preg_match($ptn, $id, $matches);
		
		if(isset($matches[1])) $_SESSION["steamId64"] = $matches[1];
		
		header("Location: $baseUrl/ucp/");
	}
}
			
if(isset($_SESSION["user_$cookieKey"])) {
	$user = $_SESSION["user_$cookieKey"];
	$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `id`= {$user["id"]} LIMIT 1");
	if ($row = mysqli_fetch_assoc($r)) $user = $row;

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
		
			$sql = "UPDATE `unr_players` 
				SET `name` = '$nick' $sql_password,`ip` = '$ip' $sql_steam_id,
				`flags` = $flag, `amxx_flags` = '$addFlag', `auth` = $auth, `icq` = {$icq}
				WHERE `id` = ". $user["id"];

			if (mysqli_query($db, $sql))
				$message["msg"] = $langs["DataUpdated"];
			else
				$message["msg"] = $langs["AlreadyUsed"];
		}
	}
	else {   	
		$i = 0;
		foreach($additional_flags as $key => $value)
		{
			$addFlags[$i]["flag"] = $key;
			$addFlags[$i]["lang"] = $lang;
			$addFlags[$i]["checked"] = (strstr($user["amxx_flags"], $value) == FALSE ? 0 : 1);
			$i++;
		}
	}
}
else
if (isset($_POST["new_nick"]) && isset($_POST["new_password"])) {
	$nick = slashes($_POST["new_nick"]);
	$password = slashes($_POST["new_password"]);
	$email = slashes($_POST["new_email"]);
	
	preg_match("/^[\w_]{3,16}$/", $nick, $nick_match);
	preg_match("/^[\w_]{6,18}$/", $password, $password_match);
	preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email, $email_match);

	if(!$nick) $message["nick"] = $langs["NotInputNick"];
	if(!$email) $message["email"] = $langs["NotInputMail"];
	else if(!isset($email_match[0])) $message["email"] = $langs["WrongEmail"];
	if(!$password) $message["password"] = $langs["NotInputPassword"];
	
	if($act!="reset" && $nick && $email) {
		$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' OR `email` = '$email'  LIMIT 1");	
		if ($row = mysqli_fetch_assoc($r)) {
			$message["nick"] = $langs["AlreadyUsed"];
		}
	}
		
	if (count($message) == 0) {
		$password = md5($password);
		$time = time();
		$key = md5($nick.$time.'zasranec');
		
		if($act=="reg") {
			$q = "INSERT INTO `unr_players` SET `name`= '$nick', `password` = '$password', `email` = '$email'";
			if(mysqli_query($db, $q)) {
				$player = mysqli_insert_id($db);
				mysqli_query($db, "INSERT INTO `unr_activate` SET `player`= '$player', `key` = '$key', `time` = '$time'");
				
				//echo $mail = "From: $server_email <br> To: $email <br> Theme: $server_name <br> {$langs["ActiveMail"]} <br> $baseUrl/ucp/$key";
				mail($email, $server_name, "{$langs["ActiveMail"]} \n $baseUrl/ucp/$key", "From: $server_email");
				
				$message["reg"] = $langs["regSuccess"]."<br>".$langs["regActivate"];
			}
		}
		else 
		if($act=="reset") {
			$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `email` = '$email' LIMIT 1");	
			if($row = mysqli_fetch_assoc($r)) {
				$player = $row["id"];
				
				$message["reg"] = $langs["regActivate"];
			}
			else {
				$message["reg"] = $langs["UserNotFound"];
			}			
		}
	}
}
else
if (isset($_GET["key"]) && $_GET["key"] != '') {
	$key =  slashes($_GET["key"]);
	
	$q = "SELECT * FROM `unr_activate` WHERE `key`= '$key' AND `time` + $activateTime > UNIX_TIMESTAMP()";
	$r = mysqli_query($db, $q);
	
	if ($row = mysqli_fetch_assoc($r)) {
		$id = $row["id"];
		$player = $row["player"];
		
		mysqli_query($db, "UPDATE `unr_players` SET `active` = 1 WHERE `id` = $player");
		mysqli_query($db, "DELETE FROM `unr_activate` WHERE `id` = $id");
		
		$message['msg'] = $langs["ActiveSuccess"];
	}
	else {
		$message['msg'] = $langs["ActiveError"];
	}
}
else
if (isset($_POST["login_user"]) && isset($_POST["login_password"])) {
	$user = slashes($_POST["login_user"]);
	$password = slashes($_POST["login_password"]);

	if(!$user) $message["login_user"] = $langs["NotInputNick"];
	if(!$password) $message["login_password"] = $langs["NotInputPassword"];
	
	preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $user, $email_match);
	
	$sql_where = (!isset($email_match[0])) ? "`name` = '$user'" : "`email` = '$user'";

	if (count($message) == 0) {		
		$password = md5($password);
		$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE {$sql_where} AND `password` = '$password' AND `active`=1");
		if ($row = mysqli_fetch_assoc($r)) {
			$_SESSION["user_$cookieKey"] = $row;
			header("Location: $baseUrl/ucp/");

			$player = $row["player"];
			$r = mysqli_query($db, "SELECT * FROM `unr_activate` WHERE `player`= '$player'");
			if ($row = mysqli_fetch_assoc($r)) {
				$message["login"] = $langs["InActive"];
			}
		}
		else {
			$message["login"] = $langs["UserNotFound"];
		}	
	}
}
?>