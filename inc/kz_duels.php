<?php

$q = "SELECT COUNT(*) FROM `kz_duel`";
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

$start = ($page - 1) * $mapsPerPage;	
	
$q = "SELECT *, 
	(SELECT `name` FROM `unr_players` WHERE `id` = `player1`) AS `name1`,
	(SELECT `name` FROM `unr_players` WHERE `id` = `player2`) AS `name2`
	FROM `kz_duel` LIMIT $start, $mapsPerPage";

$r = mysql_query($q);

$duels = array();

while($row = mysql_fetch_array($r))
{
	if ($row['result1'] < $row['result2'])
	{
		$row['winnerId'] = $row['player1'];
		$row['winnerName'] = $row['name1'];
		$row['winnerPoints'] = $row['result1'];
		$row['looserId'] = $row['player2'];
		$row['looserName'] = $row['name2'];
		$row['looserPoints'] = $row['result2'];
	}
	else
	{
		$row['winnerId'] = $row['player2'];
		$row['winnerName'] = $row['name2'];
		$row['winnerPoints'] = $row['result2'];
		$row['looserId'] = $row['player1'];
		$row['looserName'] = $row['name1'];
		$row['looserPoints'] = $row['result1'];
	}
	$duels[] = $row;
}

$smarty->assign('duels', $duels);

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);
$smarty->assign('pageUrl', "kz_duels-page%page%");
	
$template = 'kz_duels.tpl';

?>