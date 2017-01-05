<?php
$message = "";

if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	if(get_magic_quotes_gpc()) {
		$addres = $_POST["addres"];
	}
	else {
		$addres = addslashes($_POST["addres"]);	
	}
		
	$id = $_POST["id"];
	$mod = $_POST["mod"];

	if (strlen($addres) > 0)
		mysqli_query($db, "UPDATE `servers` SET `addres` = '$addres', `mod` = '$mod' WHERE `id` = $id");
	else
		$message = $langs["langError"];
}
else
if ($act == "add") {
	if(get_magic_quotes_gpc()) {
		$addres = $_POST["addres"];
	}
	else {
		$addres = addslashes($_POST["addres"]);	
	}
	
	$mod = $_POST["mod"];
		
	if (strlen($addres) > 0)
		mysqli_query($db, "INSERT INTO `servers` (`addres`, `mod`) VALUES ('$addres', '$mod')");
	else
		$message = $langs["langError"];
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
	
		mysqli_query($db, "DELETE FROM `servers` WHERE `id`= $id");
	}
	else
		$message = $langs["langConfirm"];
}

$smarty->assign('message', $message);

// Servser
$r = mysqli_query($db, "SELECT * FROM `servers`");

$servers = array();
while($row = mysqli_fetch_array($r)) {
	$servers[] = $row;
}
$smarty->assign('servers', $servers);

// Servser Mod
$r = mysqli_query($db, "SELECT * FROM `servers_mod`");

$mod = array();
while($row = mysqli_fetch_array($r)) {
	$mod[] = $row;
}
$smarty->assign('mod', $mod);

?>