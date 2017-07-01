<?php


if (!(isset($_SESSION["user_$cookieKey"]) && $admin == 1)) {
	header('Location: '.$bUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";

// Get languages
$r = mysqli_query($db, "SELECT `lang` FROM `lang` WHERE `use`=1 AND `lang` <> 'en'");
while($row = mysqli_fetch_assoc($r)) {
	$lang_list[] = $row["lang"];
}

if ($act == "add") {
	$langkey = slashes($_POST["langkey"]);
	$var = slashes($_POST["var"]);
	$value = slashes($_POST["value"]);
	
	if($langkey && $var && $value) {
		$q = "INSERT INTO `langs` (`lang`, `var`, `value`) VALUES 
				('{$langkey}','{$var}','{$value}')";
		mysqli_query($db, $q);
	}
	else
		$message = $langs["Error"];
}
else
if ($act == "edit") {
	$id = $_POST["id"];
	$var = slashes($_POST["var"]);	
	$langkey = slashes($_POST["langkey"]);
	$value = slashes($_POST["value"]);
	
	$q = "UPDATE `langs` SET `value` = '{$value}', `lang` = '{$langkey}', `var` = '{$var}' WHERE id={$id}";
	mysqli_query($db, $q);
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {	
		$q = "DELETE FROM `langs` WHERE `id` = {$_POST["id"]}";
		mysqli_query($db, $q);
	}
	else {
		$message = "<script>alert('".$langs["Confirm"]."');</script>";
	}
}

$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
$ssearch = slashes($search);

$where = $search ? "AND `var` LIKE '%$ssearch%' OR `value` LIKE '%$ssearch%'" : "";

// Get language list
$q = "SELECT * FROM `langs` WHERE 1 {$where} ORDER BY `lang`, `id` DESC";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $playerPerPage);	

if ($total) {
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $playerPerPage);

	$players = array();
	foreach($rows_limit as $row) {
		$rows[] = $row;
	}
}
	
?>