<?php
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

$plr = (isset($_GET["id"]) && ($id = abs((int)$_GET["id"]))) || (isset($playerId) && $id = $playerId);
if($plr) {
	$map_num = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top` WHERE `player`=$id {$types[$type]} GROUP BY `player`";	
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$map_num = $row["records"];
	}
	$smarty->assign('map_num', $map_num);

	$map_top1 = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top1` WHERE `player`=$id {$types[$type]} GROUP BY `player`";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$map_top1 = $row["records"];
	}
	$smarty->assign('map_top1', $map_top1);	

	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $id";
	$r = mysqli_query($db, $q);

	if($name = mysqli_result($r, 0))
	{
		$smarty->assign('name', $name);
		$smarty->assign('id', $id);
		
		if($rec=="norec") {
			$q = "SELECT COUNT(*) FROM (SELECT * FROM `kz_norec` WHERE `player` <> $id AND `player` = 0) AS tmp";
		}
		else {
			$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id {$types[$type]}";
		}
		$r = mysqli_query($db, $q);

		$total = mysqli_result($r, 0);
		$smarty->assign('total', $total);
		
		if (isset($_GET["page"]))
			$page = abs((int)$_GET["page"]);
		else
			$page = 1;
		if (!$page)
			$page = 1;

		$totalPages = ceil($total/$mapsPerPage);	
		if ($page > $totalPages)
			$page = 1;
		
		$smarty->assign('page', $page);
		$smarty->assign('totalPages', $totalPages);
		$smarty->assign('pageUrl', "$baseUrl/$name/kreedz/$type/page%page%/$rec");
		
		$start = ($page - 1) * $mapsPerPage;
		
		if($rec=="norec") {
			$q = "SELECT * FROM `kz_norec` WHERE `player` <> 1 AND `player` = 0 LIMIT $start, $mapsPerPage";
			
			$maps = array();
			$r = mysqli_query($db, $q);
			while($row = mysqli_fetch_array($r)) {
				$maps[] = $row;
			}
		}
		else {
			$q = "SELECT * FROM `kz_map_tops` WHERE `player` = {$id} {$types[$type]} ORDER BY `map` LIMIT $start, $mapsPerPage";

			$r = mysqli_query($db, $q);
			
			$maps = array();
			while($row = mysqli_fetch_array($r))
			{
				$row["time"] = timed($row["time"], 5);
				$row["timerec"] = timed($row["timerec"], 2);
			
				$maps[] = $row;
			}
		}
		$smarty->assign('maps', $maps);
	}
	else {
		$smarty->assign('message', 'Игрок не найден!');
	}
}
?>