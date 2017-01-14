<?php


if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	$name = slashes($_POST["name"]);
	$descr = slashes($_POST["descr"]);
	$type = slashes($_POST["type"]);		
	
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
	$type = slashes($_POST["type"]);
	
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
		$message = $langs["Confirm"];
}
if ($act == "editlang") {
	$value = slashes($_POST["value"]);		
	
	$lid = $_POST["lid"];
	
	$q = "UPDATE `unr_achiev_lang` SET `value` = '$value' WHERE `lid` = $lid";
	mysqli_query($db, $q);
}

assign('message', $message); 

// Achiev
$q = "SELECT * FROM `achiev` WHERE `lang` = '$lang' ORDER BY `type`";
$r = mysqli_query($db, $q);

$achievs = array();
while($row = mysqli_fetch_assoc($r)) {
	$achievs[] = $row;
}
assign('achievs', $achievs);

// Achiev Lang
$q = "SELECT * FROM `unr_achiev_lang` LEFT JOIN `unr_achiev` 
	ON `unr_achiev`.`id` = `unr_achiev_lang`.`achievid` 
	ORDER BY `unr_achiev`.`type`, `count`, `lang`, `ltype` DESC";
$r = mysqli_query($db, $q);

$lasttype = "";
$lastlang = "";
$pretype = "";
$achievs_lang = array();
while($row = mysqli_fetch_assoc($r)) {
	$type = $row['type']."_".$row['count'];
	
	$row['hr'] = $type!=$pretype ? 1 : 0;
	$pretype = $type;

	$row['part'] = $type==$lasttype ? 1 : 0;
	$lasttype = $type;

	$row['part2'] = $row['lang']==$lastlang ? 1 : 0;
	$lastlang = $row['lang'];
	
	$achievs_lang[] = $row;
}
assign('achievs_lang', $achievs_lang);
?>