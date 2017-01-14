<?php
$message = array();
$act = isset($_GET["act"]) ? $_GET["act"] : "";
$act = isset($_POST["act"]) ? $_POST["act"] : $act;

if($act=="logout") {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $baseUrl/auth/");
}

if(isset($_SESSION["user_$cookieKey"])) {
	header("Location: {$baseUrl}/ucp/");
}
else
if(isset($_SESSION["steamId64"])) {
	$steamId64 = $_SESSION["steamId64"];
	$steamId = getSteamId($_SESSION["steamId64"]);
	$nick = getSteamInfo($steamId64, "steamID");
	
	$r = mysqli_query($db, "SELECT `id` FROM `unr_players` WHERE `steam_id` = '{$steamId}' LIMIT 1");
	if ($row = mysqli_fetch_assoc($r)) {
		$_SESSION["user_$cookieKey"]["id"] = $row["id"];
	}
	else {
		if(isset($_SESSION["nick"])) $nick = $_SESSION["nick"];
		$q = "INSERT INTO `unr_players` SET `name`= '{$nick}', `flags` = 2, `auth` = 1, `steam_id` = '{$steamId}', `steam_id_64` = '{$steamId64}', `active` = 1";
		if (!mysqli_query($db, $q)) {
			$_SESSION["nick"] = $nick."(".rand(1, 99).")";
			header("Location: {$baseUrl}/auth/");
		}
		
		$_SESSION["user_$cookieKey"]["id"] = mysqli_insert_id($db);
	}
	
	unset($_SESSION["steamId64"]);
	header("Location: {$baseUrl}/ucp/");
}
else
if (isset($_SESSION["user_$cookieKey"]) && !isset($_GET["key"])) {
	$message['msg'] = $langs["AlreadyRegister"];
}
else
if (isset($_POST["new_nick"]) && isset($_POST["new_password"])) {
	$nick = slashes($_POST["new_nick"]);
	$password = slashes($_POST["new_password"]);
	$email = slashes($_POST["new_email"]);
	
	preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email, $email_match);
	
	if(!$nick) $message["nick"] = $langs["NotInputNick"];
	if(!$email) $message["email"] = $langs["NotInputMail"];
	else if(!isset($email_match[0])) $message["email"] = $langs["WrongEmail"];
	if(!$password) $message["password"] = $langs["NotInputPassword"];
	
	if($act!="reset") {
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
				
				$mail = "From: $server_email <br> Theme: $server_name <br> {$langs["ActiveMail"]} <br> $baseUrl/auth/$key";
				//fakemail($_POST["email"], $server_name, "{$langs["ActiveMail"]} \n $baseUrl/auth/$key", "From: $server_email");
				mail($_POST["email"], $server_name, "{$langs["ActiveMail"]} \n $baseUrl/auth/$key", "From: $server_email");
				
				$message["all"] = $langs["regSuccess"]."<br>".$langs["regActivate"];
			}
		}
		else 
		if($act=="reset") {
			$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `email` = '$email' LIMIT 1");	
			if($row = mysqli_fetch_assoc($r)) {
				$player = $row["id"];
				
				$message["all"] = $langs["regActivate"];
			}
			else {
				$message["all"] = $langs["UserNotFound"];
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
				$message["login_all"] = $langs["InActive"];
			}
		}
		else {
			$message["login_all"] = $langs["UserNotFound"];
		}	
	}
}


assign('info', $_POST); 
assign('message', $message); 

function fakemail($email, $theme, $msg, $from) {
	$fp = fopen($email, 'w');
	$text = "$from\n\n$themes\n\n$msg";
	fwrite($fp, $text);
	fclose($fp);
}
?>