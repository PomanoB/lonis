<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$search = $where = "";
if (isset($_POST["search"]) && $_POST["search"] !='') {
	$search = slashes($_POST["search"]);
	
	header("Location: $baseUrl/admin/players/$search");
}

if (isset($_GET["search"]) && $_GET["search"] != '') {
	$search = slashes($_GET["search"]);

	assign('search', stripslashes($search));
	
	$where = "AND `name` LIKE '%$search%'";
}

$message = "";

$act = isset($_POST["act"]) ? $_POST["act"] : "";	
if ($act == "edit") {
	$name = slashes($_POST["name"]);
	$password = slashes($_POST["password"]);
	$email = slashes($_POST["email"]);

	$active = isset($_POST["active"]) ? 1: 0;
	$webadmin = isset($_POST["webadmin"]) ? 1 : 0;
	$id = $_POST["id"];
	
	$setpass = "";
	if($password != "") {
		$password = md5($password);
		$setpass = "`password` = '$password',";
	}

	if (strlen($name) > 0) {
		$q = "UPDATE `unr_players` 
		SET `name` = '$name',{$setpass} `email` = '$email', `active` = '$active', `webadmin` = '$webadmin'
		WHERE `id` = $id";
		mysqli_query($db, $q);
		
		$message = $langs["Saved"];
	}
	else
		$message = $langs["Error"];
}		
else
if ($act == "add") {
	$name = slashes($_POST["name"]);
	$password = slashes($_POST["password"]);
	$email = slashes($_POST["email"]);
	
	$active = isset($_POST["active"]) ? 1: 0;
	$webadmin = isset($_POST["webadmin"]) ? 1 : 0;
		
	if (strlen($name) > 0 && $password != "") {
		$r = mysqli_query($db, "SELECT * FROM unr_players WHERE `name` = '$name'");
		if ($row = mysqli_fetch_assoc($r)) {
			assign('message', $langs["AlreadyUsed"]);
		}
		else {
			$password = md5($password);
			$q = "INSERT INTO `unr_players` (`name`, `password`, `email`, `active`, `webadmin`) VALUES ('$name', '$password', '$email', '$active', '$webadmin')";
			mysqli_query($db, $q);
			
			$message = $langs["Saved"];
			
			$search = $name;
		}

	}
	else
		$message = $langs["Error"];
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
		
		$q = "DELETE FROM `unr_players` WHERE `id`= $id";
		mysqli_query($db, $q);
	}
	else
		$message = $langs["Confirm"];
}

assign('message', $message); 

$q = "SELECT COUNT(*) FROM `unr_players` WHERE 1 {$where}";
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);

$pages = generate_page($_GET["page"], $total, $playerPerPage);
$pages["pageUrl"] = "$baseUrl/admin/players/page%page%/$search";
assign('pages', $pages);	

$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];

if ($total) {	
	$q = "SELECT * FROM `unr_players` WHERE 1 {$where} ORDER BY `name` {$limit}";
	$r = mysqli_query($db, $q);
	
	$players = array();
	while($row = mysqli_fetch_array($r)) {
		$players[] = $row;
	}
}

assign('players', $players);
?>