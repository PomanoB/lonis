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
$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

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
	$r = mysql_query($q);
	while($row = mysql_fetch_array($r))
	{
		$map_num = $row["records"];
	}
	$smarty->assign('map_num', $map_num);

	$map_top1 = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_tops` WHERE `player`=$id {$types[$type]} GROUP BY `player`";
	$r = mysql_query($q);
	while($row = mysql_fetch_array($r))
	{
		$map_top1 = $row["records"];
	}
	$smarty->assign('map_top1', $map_top1);	

	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $id";
	$r = mysql_query($q);

	if($name = mysql_result($r, 0))
	{
		$smarty->assign('name', $name);
		$smarty->assign('id', $id);
		
		if($rec=="norec") {
			$q = "SELECT COUNT(*) FROM (SELECT * FROM `kz_norec` WHERE `player` <> $id AND `player` = 0) AS tmp";
		}
		else {
			$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id {$types[$type]}";
		}
		$r = mysql_query($q);

		$total = mysql_result($r, 0);
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
			$q = "SELECT * FROM (SELECT * FROM `kz_norec` WHERE `player` <> 1 AND `player` = 0) AS tmp LIMIT $start, $mapsPerPage";
			
			$maps = array();
			$r = mysql_query($q);
			while($row = mysql_fetch_array($r)) {
				$maps[] = $row;
			}
		}
		else {
			$q = "SELECT `tmp`.*, MIN(`wrs`.`time`) AS timerec, `wrs`.`player` AS plrrec, `wrs`.`country` FROM 
			(SELECT * FROM `kz_norec` WHERE `player` = $id ORDER BY `time`) AS `tmp`,
			(SELECT * FROM `kz_map_rec` ORDER BY `time`) AS `wrs`
			WHERE `wrs`.`mapname` = `tmp`.`map` {$types[$type]} 
			GROUP BY `map` ORDER BY `map` LIMIT $start, $mapsPerPage";

			$r = mysql_query($q);
			
			$maps = array();
			while($row = mysql_fetch_array($r))
			{
				$row["time"] = timed($row["time"], 5);
				$row["timerec"] = timed($row["timerec"], 2);
			
				$row["weapon_name"] = $langs["lang_wpn_".$row["weapon"]];
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