<?php
$message = "";

if (isset($_GET["logout"])) {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $baseUrl");
}
else
if (isset($_SESSION["user_$cookieKey"])) {
	$message = $langs["langAlreadyLogin"];
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
	$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `active`=1");
	if ($row = mysqli_fetch_assoc($r)) {
		$_SESSION["user_$cookieKey"] = $row;
		header("Location: $baseUrl/ucp");
	}
	else {
		echo $player = $row["player"];
		$r = mysqli_query($db, "SELECT * FROM `unr_activate` WHERE `player`= '$player'");
		if ($row = mysqli_fetch_array($r)) {
			$message = $langs["langInActive"];
		}
		else {
			$message = $langs["langUserNotFound"];
		}	
	}
}

$smarty->assign('message', $message); 
?>