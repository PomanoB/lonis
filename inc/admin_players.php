<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$message = "";

$act = isset($_POST["act"]) ? $_POST["act"] : "";	

if ($act == "edit") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$password = $_POST["password"];
		$email = $_POST["email"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$password = addslashes($_POST["password"]);
		$email = addslashes($_POST["email"]);		
	}

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
		
		$message = $langs["langSaved"];
	}
	else
		$message = $langs["langError"];
}		
else
if ($act == "add") {
	if(get_magic_quotes_gpc()) {
		$name =  $_POST["name"];
		$password = $_POST["password"];
		$email = $_POST["email"];
	}
	else {
		$name = addslashes($_POST["name"]);
		$password = addslashes($_POST["password"]);
		$email = addslashes($_POST["email"]);		
	}
	
	$active = isset($_POST["active"]) ? 1: 0;
	$webadmin = isset($_POST["webadmin"]) ? 1 : 0;
		
	if (strlen($name) > 0 && $password != "") {
		$r = mysqli_query($db, "SELECT * FROM unr_players WHERE `name` = '$name'");
		if ($row = mysqli_fetch_assoc($r)) {
			$smarty->assign('message', $langs["langAlreadyUsed"]);
		}
		else {
			$password = md5($password);
			$q = "INSERT INTO `unr_players` (`name`, `password`, `email`, `active`, `webadmin`) VALUES ('$name', '$password', '$email', '$active', '$webadmin')";
			mysqli_query($db, $q);
			
			$message = $langs["langSaved"];
			
			$search = $name;
		}

	}
	else
		$message = $langs["langError"];
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$id = $_POST["id"];
		
		$q = "DELETE FROM `unr_players` WHERE `id`= $id";
		mysqli_query($db, $q);
	}
	else
		$message = $langs["langConfirm"];
}

if (isset($_REQUEST["search"]) && $_REQUEST["search"] != '')
{
	if (get_magic_quotes_gpc()) {
		$search = $_REQUEST["search"];
	}
	else {
		$search = addslashes($_REQUEST["search"]);
	}
	$smarty->assign('pageUrl', "$baseUrl/admin_players/$search/page%page%");
		
	$smarty->assign('search', stripslashes($search));
	
	$where = "WHERE `name` LIKE '%$search%'";
}
else
{
	$where = '';
	$smarty->assign('pageUrl', "$baseUrl/admin_players/page%page%");
}

$smarty->assign('message', $message); 

$q = "SELECT COUNT(*) FROM `unr_players` $where";
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);

if (isset($_GET["page"]))
	$page = abs((int)$_GET["page"]);
else
	$page = 1;
if (!$page)
	$page = 1;

$totalPages = ceil($total/$playerPerPage);	
if ($page > $totalPages)
	$page = 1;

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);	
	
$players = array();

if ($total)
{	
	$start = ($page - 1) * $playerPerPage;

	$q = "SELECT * FROM `unr_players` $where ORDER BY `name` LIMIT $start, $playerPerPage";

	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{

			
		$players[] = $row;
	}
}
$smarty->assign('players', $players);
?>