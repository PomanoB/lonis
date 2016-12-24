<?php
$message = "";

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
	mysqli_query($db, $q);
}
else
if ($act == "add") {
	if(get_magic_quotes_gpc()) {
		$type = $_POST["type"];
	}
	else {
		$type = addslashes($_POST["type"]);		
	}
	
	$count = abs((int)$_POST["count"]);
	if (!$count)
		$count = 1;
	
	$q = "INSERT INTO `unr_achiev` (`count`, `type`) VALUES ($count, '$type')";

	if(mysqli_query($db, $q)) {
		$insert = mysqli_insert_id($db);
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `ltype`, `lang`) VALUES ($insert, 'name', 'ru')");
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `ltype`, `lang`) VALUES ($insert, 'desc', 'ru')");
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `ltype`, `lang`) VALUES ($insert, 'name', 'en')");
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `ltype`, `lang`) VALUES ($insert, 'desc', 'en')");
	}
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
		
		$q = "DELETE FROM `unr_achiev` WHERE `id`= $id";
		mysqli_query($db, $q);
		
		$q = "DELETE FROM `unr_achiev_lang` WHERE `achievid` = $id";
		mysqli_query($db, $q);
	}
	else
		$message = $langs["langConfirm"];
}
if ($act == "editlang") {
	if(get_magic_quotes_gpc()) {
		$value = $_POST["value"];
	}
	else {
		$value = addslashes($_POST["value"]);		
	}
	
	$lid = $_POST["lid"];
	
	$q = "UPDATE `unr_achiev_lang` SET `value` = '$value' WHERE `lid` = $lid";
	mysqli_query($db, $q);
}

$smarty->assign('message', $message); 

// Achiev
$q = "SELECT * FROM `achiev` WHERE `lang` = '$lang' ORDER BY `type`";
$r = mysqli_query($db, $q);

$achievs = array();
while($row = mysqli_fetch_array($r))
{
	$achievs[] = $row;
}
$smarty->assign('achievs', $achievs);

// Achiev Lang
$q = "SELECT * FROM `unr_achiev_lang` LEFT JOIN `unr_achiev` 
	ON `unr_achiev`.`id` = `unr_achiev_lang`.`achievid` 
	ORDER BY `unr_achiev`.`type`, `count`, `lang`, `ltype` DESC";
$r = mysqli_query($db, $q);

$lasttype = "";
$lastlang = "";
$pretype = "";
$achievs_lang = array();
while($row = mysqli_fetch_array($r))
{
	$type = $row['type']."_".$row['count'];
	
	$row['hr'] = $type!=$pretype ? 1 : 0;
	$pretype = $type;

	$row['part'] = $type==$lasttype ? 1 : 0;
	$lasttype = $type;

	$row['part2'] = $row['lang']==$lastlang ? 1 : 0;
	$lastlang = $row['lang'];
	
	$achievs_lang[] = $row;
}
$smarty->assign('achievs_lang', $achievs_lang);
?>