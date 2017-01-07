<?php
$message = "";

if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	$addres = slashes($_POST["addres"]);	

	$id = $_POST["id"];
	$mod = $_POST["mod"];

	if (strlen($addres) > 0)
		mysqli_query($db, "UPDATE `servers` SET `addres` = '$addres', `mod` = '$mod' WHERE `id` = $id");
	else
		$message = $langs["Error"];
}
else
if ($act == "add") {
	$addres = slashes($_POST["addres"]);
	
	$mod = $_POST["mod"];
		
	if (strlen($addres) > 0)
		mysqli_query($db, "INSERT INTO `servers` (`addres`, `mod`) VALUES ('$addres', '$mod')");
	else
		$message = $langs["Error"];
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
	
		mysqli_query($db, "DELETE FROM `servers` WHERE `id`= $id");
	}
	else
		$message = $langs["Confirm"];
}

assign('message', $message);

// Servser
$r = mysqli_query($db, "SELECT * FROM `servers`");

$servers = array();
while($row = mysqli_fetch_array($r)) {
	$servers[] = $row;
}
assign('servers', $servers);

// Servser Mod
$r = mysqli_query($db, "SELECT * FROM `servers_mod`");

$mod = array();
while($row = mysqli_fetch_array($r)) {
	$mod[] = $row;
}
assign('mod', $mod);

?>