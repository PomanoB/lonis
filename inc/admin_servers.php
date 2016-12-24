<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$addres = $_POST["addres"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$addres = addslashes($_POST["addres"]);	
	}
		
	$id = $_POST["id"];
	
	if (strlen($name) > 0) {
		$q = "UPDATE `servers` SET `name` = '$name', `addres` = '$addres' WHERE `id` = $id";
		mysqli_query($db, $q);
	}
	else
		$smarty->assign('message', $langs["langError"]);
}
else
if ($act == "add") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$addres = $_POST["addres"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$addres = addslashes($_POST["addres"]);	
	}

	if (strlen($name) > 0) {	
		$r = mysqli_query($db, "INSERT INTO `servers` (`name`, `addres`) VALUES ('$name', '$addres')");
		$insert = mysql_insert_id();
		
		mysqli_query($db, "INSERT INTO `servers_lang` (`serverid`, `lang`, `desc`) VALUES ($insert, 'ru','')");
		mysqli_query($db, "INSERT INTO `servers_lang` (`serverid`, `lang`, `desc`) VALUES ($insert, 'en','')");
	}
	else
		$smarty->assign('message', $langs["langError"]);
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
		
		mysqli_query($db, "DELETE FROM `servers` WHERE `id`= $id");
		mysqli_query($db, "DELETE FROM `servers_lang` WHERE `serverid`= $id");
	}
	else
		$smarty->assign('message', $langs["langConfirm"]);
}
if ($act == "editlang") {
	if(get_magic_quotes_gpc()) {
		$desc =  $_POST["desc"];
	}
	else {
		$desc = addslashes($_POST["desc"]);
	}
	
	$lid = $_POST["lid"];
	
	mysqli_query($db, "UPDATE `servers_lang` SET `desc` = '$desc' WHERE `id` = $lid");
}


// Servser
$r = mysqli_query($db, "SELECT * FROM `servers`");

$servers = array();
while($row = mysqli_fetch_array($r))
{
	$servers[] = $row;
}
$smarty->assign('servers', $servers);

// Servsers Lang
$r = mysqli_query($db, "SELECT *, `servers_lang`.`id` AS `lid` FROM `servers_lang` LEFT JOIN `servers` ON `servers`.`id` = `serverid`");

$servers_lang = array();
$lastname = "";
while($row = mysqli_fetch_array($r))
{
	if($row['name']==$lastname) $row['part'] = 1;
	$lastname = $row['name'];
	
	$servers_lang[] = $row;
}
$smarty->assign('servers_lang', $servers_lang);

?>