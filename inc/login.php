<?php
	
if (isset($_GET["logout"])) {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $baseUrl");
}
else
if (isset($_SESSION["user_$cookieKey"])) {
	$smarty->assign('message', $langs["langAlreadyLogin"]);
}
else
if (isset($_POST["reg_nick"]) && isset($_POST["reg_password"])) {
	if (get_magic_quotes_gpc()) {
		$nick = $_POST["reg_nick"];
		$password = $_POST["reg_password"];
	}
	else {
		$nick = addslashes($_POST["reg_nick"]);
		$password = addslashes($_POST["reg_password"]);
	}
	
	$password = md5($password);
	$r = mysql_query("SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `active`=1");
	if ($row = mysql_fetch_assoc($r)) {
		$_SESSION["user_$cookieKey"] = $row;
		//$loc = isset($_SESSION["last_url_$cookieKey"]) ? $_SESSION["last_url"] : $baseUrl;
		header("Location: $baseUrl/action/ucp");
	}
	else {
		echo $player = $row["player"];
		$r = mysql_query("SELECT * FROM `unr_activate` WHERE `player`= '$player'");
		if ($row = mysql_fetch_array($r)) {
			$smarty->assign('message', $langs["langInActive"]);
		}
		else {
			$smarty->assign('message', $langs["langUserNotFound"]);
		}	
	}
}
?>