<?php


if (!(isset($_SESSION["user_$cookieKey"]) && $admin == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	$addres = slashes($_POST["addres"]);	

	$id = $_POST["id"];
	$mod = $_POST["mod"];
	$name = slashes($_POST["name"]);

	if (strlen($addres) > 0)
		mysqli_query($db, "UPDATE `servers` SET `addres` = '$addres', `mod` = '$mod', `name` = '$name' WHERE `id` = $id");
	else
		$message = $langs["Error"];
}
else
if ($act == "add") {
	$addres = slashes($_POST["addres"]);
	
	$mod = $_POST["mod"];
	$name = $_POST["name"];
		
	if (strlen($addres) > 0)
		mysqli_query($db, "INSERT INTO `servers` (`addres`, `mod`, `name`) VALUES ('$addres', '$mod', '$name')");
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


$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
$ssearch = slashes($search);
$where = $search ? "AND `addres` LIKE '%$ssearch%' OR `name` LIKE '%$ssearch%'" : "";

// Servser
$q = "SELECT * FROM `servers` WHERE 1 {$where}";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $playerPerPage, "{$baseUrl}/admin/langs/page%page%/{$search}");	

if ($total) {
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $playerPerPage);

	$players = array();
	foreach($rows_limit as $row) {
		$servers[] = $row;
	}
}

// Servser Mod
$r = mysqli_query($db, "SELECT * FROM `servers_mod`");

$mod = array();
while($row = mysqli_fetch_assoc($r)) {
	$mod[] = $row;
}

?>