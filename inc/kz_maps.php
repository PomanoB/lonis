<?php

if (isset($_POST['map']))
{
	header('Location: kreedz/'.$_POST['map']);
	exit();
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);	

$type = 'all';
if (isset($_GET['type']) && isset($types[$_GET['type']]))
	$type = $_GET['type'];

$typesLang = array(
	'pro' => 'langKzPro',
	'noob' => 'langKzNoob',
	'all' => 'langKzAll'
);	
	
$smarty->assign('type', $type);
$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE 1 {$types[$type]}";
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

$maps = array();

if ($total)
{	
	$start = ($page - 1) * $mapsPerPage;

	$q = "SELECT `tmp`.*, `unr_players`.`name` FROM (SELECT * FROM `kz_map_top` ORDER BY `time`) AS `tmp`, `unr_players` WHERE `unr_players`.`id` = `player` {$types[$type]} GROUP BY `map` ORDER BY `map` LIMIT $start, $mapsPerPage";

	$r = mysql_query($q);
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
}
$smarty->assign('maps', $maps);

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);
$smarty->assign('pageUrl', "$baseUrl/kreedz/$type/page%page%");
	
$template = 'kz_maps.tpl';	
	
?>