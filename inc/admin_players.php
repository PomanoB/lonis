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
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

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

$q = "SELECT * FROM `unr_players` WHERE 1 {$where} ORDER BY `name`";
$r = mysqli_query($db, $q);

$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $playerPerPage);
$pages["pageUrl"] = "$baseUrl/admin/players/page%page%/$search";
assign('pages', $pages);	

if ($total) {
	$i=0;
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>$pages["start"] && $i<$pages["end"])
			$rows_limit[] = $rows;
	}

	$players = array();
	foreach($rows_limit as $row) {
		$players[] = $row;
	}
	assign('players', $players);
}

?>