<?php
if (isset($_POST['player']) && $_POST['player'] !='') {
	if (get_magic_quotes_gpc()) {
		$player = $_POST['player'];
	}
	else {
		$player = addslashes($_POST['player']);
	}
	
	$smarty->assign('player', stripslashes($player));
	
	//header('Location: '.$baseUrl.'/'.$_POST['player'].'/kreedz'); exit();
	header('Location: '.$baseUrl.'/'.$player.'/kreedz'); exit();
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
if (isset($_GET['type']) && isset($types[$_GET['type']])) $type = $_GET['type'];

$smarty->assign('type', $type);
$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

$sort = 'num';
if (isset($_GET['sort'])) $sort = $_GET['sort'];
if(!$sort) $sort = 'num';
$smarty->assign('sort', $sort);

$rec = 'rec';
if (isset($_GET['rec'])) $rec = $_GET['rec'];
if(!$rec) $rec = 'rec';
$smarty->assign('rec', $rec);

if ((isset($_GET['id']) && ($id = abs((int)$_GET['id']))) || (isset($playerId) && $id = $playerId))
{
	$map_num = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top` WHERE `player`=$id {$types[$type]} GROUP BY `player`";	
	$r = mysql_query($q);
	while($row = mysql_fetch_array($r))
	{
		$map_num = $row['records'];
	}
	$smarty->assign('map_num', $map_num);
	
	$map_top1 = 0;
	$q = "SELECT COUNT(DISTINCT `map`) AS `records` FROM `kz_tops` WHERE `player`=$id {$types[$type]} GROUP BY `player`";
	$r = mysql_query($q);
	while($row = mysql_fetch_array($r))
	{
		$map_top1 = $row['records'];
	}
	$smarty->assign('map_top1', $map_top1);	
	
	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $id";
	$r = mysql_query($q);

	if($name = mysql_result($r, 0))
	{
		$smarty->assign('name', $name);
		$smarty->assign('id', $id);
		
		if($rec=="norec") {
			$q = "SELECT COUNT(DISTINCT `mapname`) FROM `kz_norec` WHERE (`player` <> $id {$types[$type]}) OR ISNULL(`id`)";
		}
		else {
			$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id {$types[$type]}";
		}
		$r = mysql_query($q);

		$total = mysql_result($r, 0);

		if (isset($_GET['page']))
			$page = abs((int)$_GET['page']);
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
			$q = "SELECT * FROM `kz_norec` WHERE (`player`<>$id {$types[$type]}) OR ISNULL(`id`) LIMIT $start, $mapsPerPage";
			
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
				$min = floor($row['time']/60);
				$sec = $row['time'] % 60;
				$ms = floor(($row['time'] - floor($row['time']))*100);
				if ($min < 10)
					$min = '0'.$min;
				if ($sec < 10)
					$sec = '0'.$sec;	
				$row['time'] = $min.':'.$sec.'.'.$ms;
				
				$min = floor($row['timerec']/60);
				$sec = $row['timerec'] % 60;
				$ms = substr($row['timerec'], -2);
				if ($min < 10)
					$min = '0'.$min;
				if ($sec < 10)
					$sec = '0'.$sec;	
				$row['timerec'] = $min.':'.$sec.'.'.$ms;
			
				$row['weapon_name'] = $weaponNames[$row['weapon']];
				$maps[] = $row;
			}
		}
		$smarty->assign('maps', $maps);
		
		$template = 'kz_player.tpl';
	}
	else
	{
		$template = 'message.tpl';
		$smarty->assign('message', 'Игрок не найден!');
	}
}
else
{
	// Players top
	$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE 1 {$types[$type]}";
	$r = mysql_query($q);

	$total = mysql_result($r, 0);

	if (isset($_GET['page']))
		$page = abs((int)$_GET['page']);
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
		$q = "SELECT * FROM `unr_players` RIGHT JOIN (
		SELECT `player`, COUNT(DISTINCT `map`) AS `records` FROM `kz_tops` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` 
		ON `unr_players`.`id` = `tmp`.`player` ORDER BY `records` DESC LIMIT $start, $playersPerPage";	
	}
	else {
		$q = "SELECT * FROM `unr_players` RIGHT JOIN (SELECT `player`, COUNT(DISTINCT `map`) AS `records` 
		FROM `kz_map_top` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` ON `unr_players`.`id` = `tmp`.`player` 
		ORDER BY `records` DESC LIMIT $start, $playersPerPage";
	}
	
	$r = mysql_query($q);
	
	$players = array();
	$i = ($page - 1)*$playersPerPage + 1;
	while($row = mysql_fetch_array($r))
	{
		$row['byid'] = strpos(addslashes($row['name']), "\#")!=false ? 1 : 0;
		$row['number'] = $i++;
		$players[] = $row;
	}	
	
	$smarty->assign('players', $players);
	
	$template = 'kz_players.tpl';

//	print_r($players);
}
?>