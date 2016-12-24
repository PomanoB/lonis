<?php
	
if (isset($_SESSION["user_$cookieKey"]) && !isset($_GET["key"]))
{
	$smarty->assign('message', $langs["langAlreadyRegister"]);
}
else
if (isset($_POST["reg_nick"]) && isset($_POST["reg_password"]))
{
	if (get_magic_quotes_gpc()) {
		$nick = $_POST["reg_nick"];
		$password = $_POST["reg_password"];
		$mail = $_POST["email"];
	}
	else {
		$nick = addslashes($_POST["reg_nick"]);
		$password = addslashes($_POST["reg_password"]);
		$mail = addslashes($_POST["email"]);
	}
	$errors = array();
	
	if (!$nick) $errors[] = $langs["langNotInputNick"];
	if (!$password) $errors[] = $langs["langNotInputPassword"];	
	if (!$mail) $errors[] = $langs["langNotInputMail"];
		
	if (count($errors) == 0) {
		$password = md5($password);
		$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `email` = '$mail'");	
		if (!$row = mysqli_fetch_assoc($r)) {	
			$time = time();
			$key = md5($nick.$time.'magic_word');
			$player = mysql_insert_id();
			mysqli_query($db, "INSERT INTO `unr_activate` SET `player`= '$player', `key` = '$key', `time` = '$time'");
			
			$langActiveMail = $langs["langActiveMail"];
			
			if(mail($_POST["email"], '[K.lan]', "$langActiveMail \n $baseUrl/reg/$key", 'From: $email')) {
				$smarty->assign('message', $langs["lang_sendMailError"]);
			}
			else {
				mysqli_query($db, "INSERT INTO `unr_players` SET `name`= '$nick', `password` = '$password', `email` = '$mail'");	
				$smarty->assign('message', $langs["lang_regSuccess"]);
			}
		}
		else
		{
			$smarty->assign('message', $langs["langAlreadyUsed"]);
		}
	}
	else
	{
		$smarty->assign('message', $langs["langRegErrors"] . implode('<br />', $errors));
	}
}
else
if (isset($_GET["key"]) && $_GET["key"] != '')
{
	if (get_magic_quotes_gpc())
		$key = $_GET["key"];
	else
		$key =  addslashes($_GET["key"]);
	
	$r = mysqli_query($db, "SELECT * FROM `unr_activate` WHERE `key`= '$key' AND `time` + $activateTime > UNIX_TIMESTAMP()");
	if ($row = mysqli_fetch_array($r))
	{
		$id = $row["id"];
		$player = $row["player"];
		mysqli_query($db, "UPDATE `unr_players` SET `active` = 1 WHERE `id` = $player");
		mysqli_query($db, "DELETE FROM `unr_activate` WHERE `id` = $id");
		
		$smarty->assign('message', $langs["langActiveSuccess"]);
	}
	else
	{
		$smarty->assign('message', $langs["langActiveError"]);
	}
}
?>