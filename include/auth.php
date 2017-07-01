<?
$fmsg = array();

if(isset($_GET["logout"])) {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $bUrl");
}

if(isset($_SESSION["steamId64"])) {
	$steamId64 = $_SESSION["steamId64"];
	$steamId = getSteamId($steamId64);
	
	$r = mysqli_query($db, "SELECT `id` FROM `players` WHERE `steam_id` = '{$steamId}' LIMIT 1");
	if ($id = mysqli_result($r, 0)) {
		$_SESSION["user_$cookieKey"]["id"] = $id;
	}
	else {
		
		$steamInfo = getSteamInfo($steamId64);
		$new_nick = $steamInfo["personaname"];
		
		$r = mysqli_query($db, "SELECT COUNT(`id`) FROM `players` WHERE `name` = '{$new_nick}'");
		if(mysqli_result($r, 0)) $new_nick .= " ".substr(md5(uniqid()), 0, 5);
			
		$q = "INSERT INTO `players` SET `name`= '{$new_nick}', `flags` = 2, `auth` = 1, `steam_id` = '{$steamId}', `steam_id_64` = '{$steamId64}', `active` = 1";
		mysqli_query($db, $q);
		
		$_SESSION["user_$cookieKey"]["id"] = $id = mysqli_insert_id($db);
		
		getAvatar($id, $steamId64, $id, 'avatar');
		getAvatar($id, $steamId64, $id, 'avatarmedium');
		getAvatar($id, $steamId64, $id, 'avatarfull');
	}
	
	unset($_SESSION["steamId64"]);
	
	header("Location: $bUrl/account/");
}

if(isset($_GET["steam"])) {
	foreach($_GET as $key=>$value) { 
		$_GET[$key] = urldecode($value);
	}

	include 'plugins/lightopenid.php';
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
		
		header("Location: $bUrl/account/");
	}
}

if (isset($_POST["new_nick"]) && isset($_POST["new_password"]) && isset($_POST["new_email"])) {
	$new_nick = slashes($_POST["new_nick"]);
	$new_password = slashes($_POST["new_password"]);
	$new_email = slashes($_POST["new_email"]);
	
	preg_match("/^[\w_]{3,16}$/", $new_nick, $new_nick_match);
	preg_match("/^[\w_]{6,18}$/", $new_password, $new_password_match);
	preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $new_email, $new_email_match);

	if(!$new_nick) $fmsg["nick"] = langs("You did not enter nick!");
	if(!$new_email) $fmsg["email"] = langs("You have not entered e-mail!");
	else if(!isset($new_email_match[0])) $fmsg["email"] = langs("Wrong E-mail");
	if(!$new_password) $fmsg["password"] = langs("You have not entered a password!");
	
	/*if($act!="reset" && $new_nick && $new_email) {
		$r = mysqli_query($db, "SELECT * FROM `players` WHERE `name`= '$new_nick' OR `email` = '$new_email'  LIMIT 1");	
		if ($row = mysqli_fetch_assoc($r)) {
			$fmsg["nick"] = langs("This player is already exists!");
		}
	}*/

	if (count($fmsg) == 0) {
		$new_password = md5($new_password);
		$time = time();
		$key = md5($new_nick.$time.'zasranec');
		
		$q = "INSERT INTO `players` SET `name`= '$new_nick', `password` = '$new_password', `email` = '$new_email'";
		if(mysqli_query($db, $q)) {
			$player = mysqli_insert_id($db);
			mysqli_query($db, "INSERT INTO `activate` SET `player`= '$player', `key` = '$key', `time` = '$time'");
			
			$send_msg = langs("To activate click on the following link:")."\n <a href=\"{$bUrl}/?key={$key}\">{$bUrl}/?key={$key}";
			@mail($new_email, $server_name, $send_msg, "From: $server_email");
			
			$fmsg["reg"] = langs("You have successfully registered!")."<br>".langs("Activation link sent to your e-mail");
		}
		else {
			$fmsg["reg"] = langs("The name is already taken");
		}
		
		/*if($act=="reset") {
			$r = mysqli_query($db, "SELECT * FROM `players` WHERE `name`= '$new_nick' AND `email` = '$new_email' LIMIT 1");	
			if($row = mysqli_fetch_assoc($r)) {
				$player = $row["id"];
				
				$fmsg["reg"] = langs("You have successfully registered!");
			}
			else {
				$fmsg["reg"] = langs("Player not found");
			}			
		}*/
	}
}

if (isset($_GET["key"]) && $_GET["key"] != '') {
	$key =  slashes($_GET["key"]);
	
	$q = "SELECT * FROM `activate` WHERE `key`= '$key' AND `time` + $activateTime > UNIX_TIMESTAMP()";
	$r = mysqli_query($db, $q);
	
	if ($row = mysqli_fetch_assoc($r)) {
		$id = $row["id"];
		$player = $_SESSION["user_$cookieKey"]["id"] = $row["player"];
		
		mysqli_query($db, "UPDATE `players` SET `active` = 1 WHERE `id` = $player");
		mysqli_query($db, "DELETE FROM `activate` WHERE `id` = $id");
		
		header("Location: {$bUrl}/account/");
	}
	else {
		$fmsg['msg'] = langs("Error");
	}
}

if (isset($_POST["login_user"]) && isset($_POST["login_password"])) {
	$login_user = slashes($_POST["login_user"]);
	$login_password = slashes($_POST["login_password"]);

	if(!$login_user) $fmsg["login_user"] = langs("You did not enter nick!");
	if(!$login_password) $fmsg["login_password"] = langs("You have not entered a password!");
	
	preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $login_user, $new_email_match);
	
	$sql_where = (!isset($new_email_match[0])) ? "`name` = '$login_user'" : "`email` = '$login_user'";

	if (count($fmsg) == 0) {		
		$login_password = md5($login_password);
		$r = mysqli_query($db, "SELECT * FROM `players` WHERE {$sql_where} AND `password` = '$login_password' AND `active`=1");
		if ($row = mysqli_fetch_assoc($r)) {
			$_SESSION["user_$cookieKey"] = $row;
			header("Location: $bUrl/account/");

			$player = $row["player"];
			$r = mysqli_query($db, "SELECT * FROM `activate` WHERE `player`= '$player'");
			if ($row = mysqli_fetch_assoc($r)) {
				$fmsg["login"] = langs("Account inactive!");
			}
		}
		else {
			$fmsg["login"] = langs("Player not found");
		}	
	}
}

?>