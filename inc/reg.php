<?php
	
if (isset($_SESSION['user']) && !isset($_GET['key']))
{
	$smarty->assign('message', $smarty->get_config_vars('langAlreadyRegister'));
}
else
if (isset($_POST['reg_nick']) && isset($_POST['reg_password']))
{
	if (get_magic_quotes_gpc()) {
		$nick = $_POST['reg_nick'];
		$password = $_POST['reg_password'];
		$mail = $_POST['email'];
	}
	else {
		$nick = addslashes($_POST['reg_nick']);
		$password = addslashes($_POST['reg_password']);
		$mail = addslashes($_POST['email']);
	}
	$errors = array();
	
	if (!$nick) $errors[] = $smarty->get_config_vars('langNotInputNick');
	if (!$password) $errors[] = $smarty->get_config_vars('langNotInputPassword');	
	if (!$mail) $errors[] = $smarty->get_config_vars('langNotInputMail');
		
	if (count($errors) == 0) {
		$password = md5($password);
		$r = mysql_query("SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `email` = '$mail'");	
		if (!$row = mysql_fetch_assoc($r)) {	
			$time = time();
			$key = md5($nick.$time.'magic_word');
			$player = mysql_insert_id();
			mysql_query("INSERT INTO `unr_activate` SET `player`= '$player', `key` = '$key', `time` = '$time'");
			
			$langActiveMail = $smarty->get_config_vars('langActiveMail');
			
			if(mail($_POST['email'], '[K.lan]', "$langActiveMail \n $baseUrl/reg/$key", 'From: $email')) {
				$smarty->assign('message', $smarty->get_config_vars('lang_sendMailError'));
			}
			else {
				mysql_query("INSERT INTO `unr_players` SET `name`= '$nick', `password` = '$password', `email` = '$mail'");	
				$smarty->assign('message', $smarty->get_config_vars('lang_regSuccess'));
			}
		}
		else
		{
			$smarty->assign('message', $smarty->get_config_vars('langAlreadyUsed'));
		}
	}
	else
	{
		$smarty->assign('message', $smarty->get_config_vars('langRegErrors') . implode('<br />', $errors));
	}
}
else
if (isset($_GET['key']) && $_GET['key'] != '')
{
	if (get_magic_quotes_gpc())
		$key = $_GET['key'];
	else
		$key =  addslashes($_GET['key']);
	
	$r = mysql_query("SELECT * FROM `unr_activate` WHERE `key`= '$key' AND `time` + $activateTime > UNIX_TIMESTAMP()");
	if ($row = mysql_fetch_array($r))
	{
		$id = $row['id'];
		$player = $row['player'];
		mysql_query("UPDATE `unr_players` SET `active` = 1 WHERE `id` = $player");
		mysql_query("DELETE FROM `unr_activate` WHERE `id` = $id");
		
		$smarty->assign('message', $smarty->get_config_vars('langActiveSuccess'));
	}
	else
	{
		$smarty->assign('message', $smarty->get_config_vars('langActiveError'));
	}
}
?>