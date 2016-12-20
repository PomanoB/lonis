<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$descr = $_POST["descr"];
		$type = $_POST["type"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$descr = addslashes($_POST["descr"]);
		$type = addslashes($_POST["type"]);		
	}
	
	$count = abs((int)$_POST["count"]);
	if (!$count)
		$count = 1;
		
	$id = abs((int)$_POST["id"]);
	if (!$id)
		$id = 1;
	
	if (strlen($name) > 0) {
		$q = "UPDATE `unr_achiev` 
		SET `name` = '$name', `description` = '$descr', `count` = $count, `type` = '$type'
		WHERE `id` = $id";
	}
	else {
		$q = "DELETE `unr_achiev`, `unr_players_achiev` 
			FROM `unr_achiev`, `unr_players_achiev` 
			WHERE `unr_achiev`.`id` = $id AND `unr_players_achiev`.`achievId` = $id";
	}
	mysql_query($q);
}
else
if ($act == "add") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$descr = $_POST["descr"];
		$type = $_POST["type"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$descr = addslashes($_POST["descr"]);
		$type = addslashes($_POST["type"]);		
	}
	
	$count = abs((int)$_POST["count"]);
	if (!$count)
		$count = 1;
	
	$q = "INSERT INTO `unr_achiev` (`name`, `description`, `count`, `type`) VALUES ('$name', '$descr', $count, '$type')";
	mysql_query($q);
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
		
		$q = "DELETE FROM `unr_achiev` WHERE `id`= $id";
		mysql_query($q);
	}
	else
		$smarty->assign('message', $langs["langConfirm"]);
}

$q = "SELECT * FROM `unr_achiev`";
$r = mysql_query($q);

$achievs = array();
while($row = mysql_fetch_array($r))
{
	$achievs[] = $row;
}
$smarty->assign('achievs', $achievs);

?>