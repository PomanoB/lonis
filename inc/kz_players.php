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
if (isset($_GET['type']) && isset($types[$_GET['type']]))
	$type = $_GET['type'];

$smarty->assign('type', $type);
$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

if ((isset($_GET['id']) && ($id = abs((int)$_GET['id']))) || (isset($playerId) && $id = $playerId))
{
	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $id";
	$r = mysql_query($q);

	if($name = mysql_result($r, 0))
	{
		$smarty->assign('name', $name);
		$smarty->assign('id', $id);
		
		$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id {$types[$type]}";
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
		$smarty->assign('pageUrl', "$baseUrl/$name/kreedz/$type/page%page%");
		
		$start = ($page - 1) * $mapsPerPage;
		
		$q = "SELECT * FROM (SELECT * FROM `kz_map_top` WHERE `player` = $id ORDER BY `time`) AS `tmp` WHERE 1 {$types[$type]} GROUP BY `map` ORDER BY `map` LIMIT $start, $mapsPerPage";
		
		$r = mysql_query($q);
		
		$maps = array();
		while($row = mysql_fetch_array($r))
		{
			$min = floor($row['time']/60);
			$sec = $row['time'] % 60;
			if ($min < 10)
				$min = '0'.$min;
			if ($sec < 10)
				$sec = '0'.$sec;	
			$row['time'] = $min.':'.$sec;
			$row['weapon_name'] = $weaponNames[$row['weapon']];
			$maps[] = $row;
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
	$smarty->assign('pageUrl', "$baseUrl/kreedz/players/$type/page%page%");
	
	$start = ($page - 1) * $playersPerPage;
	
	$q = "SELECT * FROM `unr_players` RIGHT JOIN (SELECT `player`, COUNT(DISTINCT `map`) AS `records` FROM `kz_map_top` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` ON `unr_players`.`id` = `tmp`.`player` ORDER BY `records` DESC LIMIT $start, $playersPerPage";
	
	$r = mysql_query($q);
	$i = ($page - 1)*$playersPerPage + 1;
	
	$players = array();
	$i = ($page - 1)*$playersPerPage + 1;
	while($row = mysql_fetch_array($r))
	{
		$row['number'] = $i++;
		$players[] = $row;
	}
	$smarty->assign('players', $players);
	
	$template = 'kz_players.tpl';

//	print_r($players);
}
?>