<?php
	
if (isset($_GET['logout']))
{
	unset($_SESSION['user']);
	header("Location: $baseUrl");
}
else
if (isset($_SESSION['user']))
{
	$smarty->assign('message', $smarty->get_config_vars('langAlreadyLogin'));
}
else
if (isset($_POST['reg_nick']) && isset($_POST['reg_password']))
{
	if (get_magic_quotes_gpc())
	{
		$nick = $_POST['reg_nick'];
		$password = $_POST['reg_password'];
	}
	else
	{
		$nick = addslashes($_POST['reg_nick']);
		$password = addslashes($_POST['reg_password']);
	}
	
	$password = md5($password);
	$r = mysql_query("SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password'");
	if ($row = mysql_fetch_assoc($r))
	{
		$_SESSION['user'] = $row;
		header("Location: $baseUrl/ucp");
	}
	else
	{
		$smarty->assign('message', $smarty->get_config_vars('langUserNotFound'));
	}
}
//$template = 'login_form.tpl';
$template = 'login.tpl';
?>