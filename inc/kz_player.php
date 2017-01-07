<?php
$message = "";

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = 'all';
if (isset($_GET["type"]) && isset($types[$_GET["type"]])) $type = $_GET["type"];

assign('type', $type);

$sort = 'num';
if (isset($_GET["sort"])) $sort = $_GET["sort"];
if(!$sort) $sort = 'num';
assign('sort', $sort);

$rec = 'rec';
if (isset($_GET["rec"])) $rec = $_GET["rec"];
if(!$rec) $rec = 'rec';
assign('rec', $rec);

$plr = (isset($_GET["id"]) && ($id = abs((int)$_GET["id"]))) || (isset($playerId) && $id = $playerId);
if($plr) {
	$map_num = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top` WHERE `player`=$id {$types[$type]}";	
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$map_num = $row["records"];
	}
	assign('map_num', $map_num);

	$map_top1 = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top1` WHERE `player`=$id {$types[$type]}";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$map_top1 = $row["records"];
	}
	assign('map_top1', $map_top1);	

	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $id";
	$r = mysqli_query($db, $q);

	if($name = mysqli_result($r, 0))
	{
		assign('name', $name);
		
		$name_url = url_replace($name);
		assign('name_url', $name_url);
		
		assign('id', $id);
		
		if($rec=="norec") {
			$q = "SELECT COUNT(*) FROM (SELECT * FROM `kz_norec` WHERE `player` <> {$id} AND `player` = 0) AS tmp";
		}
		else {
			if($sort=="top1")
				$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top1` WHERE `player` = {$id} {$types[$type]}";
			else 
				$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$id} {$types[$type]}";
		}
		$r = mysqli_query($db, $q);

		$total = mysqli_result($r, 0);
		assign('total', $total);
		
		$pages = generate_page($_GET["page"], $total, $mapsPerPage);
		$pages["pageUrl"] = "$baseUrl/$name_url/kreedz/$type/page%page%/$rec/$sort";
		assign('pages', $pages);

		$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];
		
		$maps = array();
		if($rec=="norec") {
			$q = "SELECT * FROM `kz_norec` WHERE `player` <> 1 AND `player` = 0 LIMIT $start, $mapsPerPage";
		}
		else {
			if($sort=="top1") {
					$q = "SELECT * FROM `kz_map_top1` WHERE `player` = {$id} {$types[$type]} {$limit}";
			}
			else {
				$q = "SELECT `tmp`.*, `weapons`.`name` AS `wname` 
					FROM (SELECT * FROM `kz_map_top` ORDER BY `time`) AS `tmp`, `weapons`
					WHERE `player` = {$id} AND `weapons`.`id` = `tmp`.`weapon` {$types[$type]} 
					GROUP BY `map` ORDER BY `map` {$limit}";
			}
		}	
		$r = mysqli_query($db, $q);
		
		while($row = mysqli_fetch_array($r)) {
			$row["time"] = timed($row["time"], 5);
		
			$maps[] = $row;
		}
		
		assign('maps', $maps);
	}
	else {
		$message = $langs["PlayerNotFound"];
	}
}

assign('message', $message);
assign('plr', $plr);
?>