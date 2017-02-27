<?php


if (!(isset($_SESSION["user_$cookieKey"]) && $admin == 1)) {
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
		SET `count` = $count, `type` = '$type'
		WHERE `id` = $id";
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
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `lang`) VALUES ($insert, 'ru')");
		mysqli_query($db, "INSERT INTO `unr_achiev_lang` (`achievid`, `lang`) VALUES ($insert, 'en')");
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
	$name = slashes($_POST["name"]);
	$desc = slashes($_POST["desc"]);	
	
	$lid = $_POST["lid"];
	
	$q = "UPDATE `unr_achiev_lang` SET `name` = '$name', `desc` = '$desc' WHERE `lid` = $lid";
	mysqli_query($db, $q);
}

// Achiev
$q = "SELECT * FROM `achiev` WHERE `lang` = '$lang' ORDER BY `type`";
$r = mysqli_query($db, $q);

$achievs = array();
while($row = mysqli_fetch_assoc($r)) {
	$achievs[] = $row;
}

// Achiev Lang
$q = "SELECT * FROM `achiev` ORDER BY `type`, `count`, `lang`";
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
?>