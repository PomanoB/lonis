<?php

if (!isset($_REQUEST['map']))
		header("Location: $baseUrl/kreedz");
else
{	
	if (get_magic_quotes_gpc())
	{
		$map = $_REQUEST['map'];
	}
	else
	{
		$map = addslashes($_REQUEST['map']);
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
	if (isset($_GET['type']) && isset($types[$_GET['type']]))
		$type = $_GET['type'];
	
	$smarty->assign('type', $type);
	$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

	$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE `map` = '$map' {$types[$type]}";
	
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

	$start = ($page - 1) * $playersPerPage;
	
	$players = array();
	$smarty->assign('mapname', stripslashes($map));
	
	$q = "SELECT `tmp`.*, `unr_players`.`name` FROM (SELECT * FROM `kz_map_top` WHERE `map` = '$map' ORDER BY `time` ) AS `tmp`, `unr_players` WHERE `unr_players`.`id` = `player` {$types[$type]} GROUP BY `player` ORDER BY `time` LIMIT $start, $playersPerPage";
	$r = mysql_query($q);
	$i = ($page - 1)*$playersPerPage + 1;
	while($row = mysql_fetch_array($r))
	{
		$min = floor($row['time']/60);
		$sec = ($row['time'] % 60);
		$ms = floor(($row['time'] - floor($row['time']))*10000);
		$ms = str_pad($ms, 5, '0');
		
		if ($min < 10)
			$min = '0'.$min;
		if ($sec < 10)
			$sec = '0'.$sec;	
		$row['time'] = $min.':'.$sec.'.'.$ms;
		$row['weapon_name'] = $weaponNames[$row['weapon']];
		$row['number'] = $i++;
		$players[] = $row;
	}
	
	$smarty->assign('players', $players);
	
	$smarty->assign('page', $page);
	$smarty->assign('totalPages', $totalPages);
	$smarty->assign('pageUrl', "$baseUrl/kreedz/$map/$type/page%page%");
		
	$template = 'kz_map.tpl';
}
?>