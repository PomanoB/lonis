<?php
if (isset($_POST["player"]) && $_POST["player"] !='') {
	if (get_magic_quotes_gpc()) {
		$player = $_POST["player"];
	}
	else {
		$player = addslashes($_POST["player"]);
	}
	
	$smarty->assign('player', stripslashes($player));
	
	header("Location: $baseUrl/$player/kreedz");
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);	

$typesLang = array(
	'pro' => 'langKzPro',
	'noob' => 'langKzNoob',
	'all' => 'langKzAll'
);

$type = 'all';
if (isset($_GET["type"]) && isset($types[$_GET["type"]])) $type = $_GET["type"];

$smarty->assign('type', $type);
$smarty->assign('langType', $langs[$typesLang[$type]]);

$sort = 'num';
if (isset($_GET["sort"])) $sort = $_GET["sort"];
if(!$sort) $sort = 'num';
$smarty->assign('sort', $sort);

$rec = 'rec';
if (isset($_GET["rec"])) $rec = $_GET["rec"];
if(!$rec) $rec = 'rec';
$smarty->assign('rec', $rec);

// Players top
$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE 1 {$types[$type]}";
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);
$smarty->assign('total', $total);

if (isset($_GET["page"]))
	$page = abs((int)$_GET["page"]);
else
	$page = 1;
if (!$page)
	$page = 1;

$totalPages = ceil($total/$playersPerPage);	
if ($page > $totalPages)
	$page = 1;

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);
$smarty->assign('pageUrl', "$baseUrl/kreedz/players/$type/page%page%/$sort");

$start = ($page - 1) * $playersPerPage;

if($sort=="top1") {
	$q = "SELECT `tmp`.*, `unr_players`.`name` FROM `unr_players` RIGHT JOIN (
		SELECT *, COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top1` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` 
		ON `unr_players`.`id` = `tmp`.`player` ORDER BY `records` DESC LIMIT $start, $playersPerPage";	
}
else {
	$q = "SELECT `tmp`.*, `unr_players`.`name` FROM `unr_players` RIGHT JOIN (
		SELECT *, COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` 
		ON `unr_players`.`id` = `tmp`.`player` ORDER BY `records` DESC LIMIT $start, $playersPerPage";
}

$r = mysqli_query($db, $q);

$players = array();
$i = ($page - 1)*$playersPerPage + 1;
while($row = mysqli_fetch_array($r))
{
	$row["number"] = $i++;
	$players[] = $row;
}	

$smarty->assign('players', $players);
?>