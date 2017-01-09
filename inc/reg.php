<?php
$message = "";
if (isset($_SESSION["user_$cookieKey"]) && !isset($_GET["key"]))
{
	$message = $langs["AlreadyRegister"];
}
else
if (isset($_POST["reg_nick"]) && isset($_POST["reg_password"])) {
	$nick = slashes($_POST["reg_nick"]);
	$password = slashes($_POST["reg_password"]);
	$mail = slashes($_POST["email"]);

	$errors = array();
	if (!$nick) $errors[] = $langs["NotInputNick"];
	if (!$password) $errors[] = $langs["NotInputPassword"];	
	if (!$mail) $errors[] = $langs["NotInputMail"];
		
	if (count($errors) == 0) {
		$password = md5($password);
		$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `email` = '$mail'");	
		if (!$row = mysqli_fetch_assoc($r)) {	
			$time = time();
			$key = md5($nick.$time.'magic_word');
			$player = mysqli_insert_id($db);
			mysqli_query($db, "INSERT INTO `unr_activate` SET `player`= '$player', `key` = '$key', `time` = '$time'");
			
			$langActiveMail = $langs["ActiveMail"];
			
			if(mail($_POST["email"], '[K.lan]', "$langActiveMail \n $baseUrl/reg/$key", 'From: $email')) {
				$message = $langs["sendMailError"];
			}
			else {
				mysqli_query($db, "INSERT INTO `unr_players` SET `name`= '$nick', `password` = '$password', `email` = '$mail'");	
				$message = $langs["regSuccess"];
			}
		}
		else
		{
			$message = $langs["AlreadyUsed"];
		}
	}
	else {
		$message = $langs["RegErrors"] . implode('<br />', $errors);
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
		
		$message = $langs["ActiveSuccess"];
	}
	else {
		$message = $langs["ActiveError"];
	}
}

assign('message', $message); 
?>