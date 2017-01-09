<?php
$message = "";

if (isset($_GET["logout"])) {
	unset($_SESSION["user_$cookieKey"]);
	header("Location: $baseUrl");
}
else
if (isset($_SESSION["user_$cookieKey"])) {
	$message = $langs["AlreadyLogin"];
}
else
if (isset($_POST["reg_nick"]) && isset($_POST["reg_password"])) {
	$nick = slashes($_POST["reg_nick"]);
	$password = slashes($_POST["reg_password"]);
	
	$password = md5($password);
	$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `name`= '$nick' AND `password` = '$password' AND `active`=1");
	if ($row = mysqli_fetch_assoc($r)) {
		$_SESSION["user_$cookieKey"] = $row;
		header("Location: $baseUrl/ucp");
	}
	else {
		echo $player = $row["player"];
		$r = mysqli_query($db, "SELECT * FROM `unr_activate` WHERE `player`= '$player'");
		if ($row = mysqli_fetch_assoc($r)) {
			$message = $langs["InActive"];
		}
		else {
			$message = $langs["UserNotFound"];
		}	
	}
}

assign('message', $message); 
?>