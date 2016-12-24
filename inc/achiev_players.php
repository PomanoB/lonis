<?php

$smarty->assign('pageUrl', "$baseUrl/achiev/players/page%page%");

$q = "SELECT COUNT(DISTINCT `playerId`) FROM `unr_achiev`, `unr_players_achiev` WHERE `achievId` = `id` AND `count` = `progress`";
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);

if (isset($_GET["page"]))
	$page = abs((int)$_GET["page"]);
else
	$page = 1;
if (!$page)
	$page = 1;

$totalPages = ceil($total/$playerPerPage);	
if ($page > $totalPages)
	$page = 1;
	

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);	
	
$players = array();

if ($total) {	
	$start = ($page - 1) * $playerPerPage;

	$q = "SELECT * FROM (SELECT `id` AS `plid`, `name`, 
		(SELECT COUNT(*) FROM `unr_players_achiev`, `achiev` 
			WHERE `lang`='{$lang}' AND `achievId` = `achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev_total`
		FROM `unr_players`) AS `tmp34` WHERE `achiev_total` > 0 ORDER BY `achiev_total` DESC LIMIT $start, $playerPerPage";


	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$players[] = $row;
	}
}

$smarty->assign('players', $players);
?>