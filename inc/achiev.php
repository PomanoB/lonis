<?php

// achive || /achiev/%aname%
if (isset($_GET["aname"]) && $_GET["aname"]!="") {
	$aname = urldecode($_GET["aname"]);
	$aname = get_magic_quotes_gpc() ? $aname : addslashes($aname);
	
	$q = "SELECT `id`, `name`, `description` FROM achiev 
			WHERE `lang`='{$lang}_{$lang}' 
			AND (`name` = '$aname' OR `name` = REPLACE('$aname', '_', ' '))
		LIMIT 1";
	$r = mysql_query($q);
	if ($row = mysql_fetch_array($r))  {
		$id = $row["id"];
		$smarty->assign('achiev', $row);
		
		//$q = "SELECT COUNT(*) FROM `achiev_aname` WHERE `lang`='{$lang}_{$lang}'`";	 
		//$r = mysql_query($q);
		
		$total = mysql_result($r, 0);
		$smarty->assign('total', $total);

		if (isset($_GET["page"]))
			$page = abs((int)$_GET["page"]);
		else
			$page = 1;
		if (!$page)
			$page = 1;

		$totalPages = ceil($total/$achievPerPage);	
		if ($page > $totalPages)
			$page = 1;
		
		$start = ($page - 1) * $achievPerPage;
		
		$q = "SELECT * FROM `achiev_aname` WHERE `aid` = $id"; // LIMIT $start, $achievPerPage
		$r = mysql_query($q);
		$players = array();
		
		while($row = mysql_fetch_array($r)) {
			$players[] = $row;
		}
		
		$smarty->assign('players', $players);
		$smarty->assign('aname', $aname);
		
		//$smarty->assign('page', $page);
		//$smarty->assign('totalPages', $totalPages);
		//$smarty->assign('pageUrl', "$baseUrl/achiev/$aname/page%page%");
	}
	else {
		//header("Location: $baseUrl/error/404");
	}
}
else // player_achive || /%name%/achiev/
if (isset($_GET["plid"]) || isset($playerId)) { 
	if (isset($playerId))
		$plId = $playerId;
	else
		$plId = abs((int)$_GET["plid"]);
	
	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $plId";
	$r = mysql_query($q);
	if ($row = mysql_fetch_array($r))
	{
		
		$q = "SELECT COUNT(*) FROM `achiev` WHERE `lang`='{$lang}_{$lang}'";	 
		$r = mysql_query($q);
		
		$total = mysql_result($r, 0);
		$smarty->assign('total', $total);

		if (isset($_GET["page"]))
			$page = abs((int)$_GET["page"]);
		else
			$page = 1;
		if (!$page)
			$page = 1;

		$totalPages = ceil($total/$achievPerPage);	
		if ($page > $totalPages)
			$page = 1;
		
		$start = ($page - 1) * $achievPerPage;
	
		$smarty->assign('playerName', $row["name"]);
		
		$q = "SELECT `id`, `name`, `description`, `count`, 
			IF(`progress` IS NULL, 0, `progress`) AS `progress` 
		FROM `achiev` 
		LEFT JOIN `unr_players_achiev` ON `achievId` = `id` AND `playerId` = $plId 
		WHERE `lang`='{$lang}_{$lang}' 
		ORDER BY `progress` = `count` 
		DESC, `progress`/`count` DESC
		LIMIT $start, $achievPerPage";
	
		$r = mysql_query($q);
	
		$achievs = array();
		
		while($row = mysql_fetch_array($r))
		{
			if ($row["count"] != 1 && $row["count"] != $row["progress"])
				$row["width"] = $row["progress"] * 100 / $row["count"];
			$achievs[] = $row;
		}
		$smarty->assign('achievs', $achievs);
		$smarty->assign('plrs', 1);
		
		$smarty->assign('page', $page);
		$smarty->assign('totalPages', $totalPages);
		
		$name = str_replace("#", "%23", $name);
		$smarty->assign('pageUrl', "$baseUrl/$name/achiev/page%page%/");
	}
	else
		header("Location: $baseUrl/achiev");
	
}
else {// achive_list || /achiev
	$q = "SELECT COUNT(*) FROM `unr_achiev`"; 
	$r = mysql_query($q);
	
	$total = mysql_result($r, 0);
	$smarty->assign('total', $total);

	if (isset($_GET["page"]))
		$page = abs((int)$_GET["page"]);
	else
		$page = 1;
	if (!$page)
		$page = 1;

	$totalPages = ceil($total/$achievPerPage);	
	if ($page > $totalPages)
		$page = 1;
	
	$start = ($page - 1) * $achievPerPage;
		
	$q = 'SET @playerCount := (SELECT COUNT(*) FROM `unr_players`)';
	mysql_query($q);
	$q = "SELECT `id` AS `aId`, `name`, `description`, 
		(SELECT COUNT(*) FROM `achiev`, `unr_players_achiev` 
		WHERE `unr_players_achiev`.`achievId` = `achiev`.`id` 
			AND `achiev`.`count` = `unr_players_achiev`.`progress` 
			AND `unr_players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
		FROM `achiev` 
		WHERE `lang`='{$lang}_{$lang}'		
		ORDER BY `completed` DESC LIMIT $start, $achievPerPage";
	$r = mysql_query($q);
	
	$achievs = array();
		
	while($row = mysql_fetch_array($r)) {
		$row["completed"] = floor($row["completed"]*100)/100;
		$achievs[] = $row;
	}
	$smarty->assign('achievs', $achievs);
	
	$smarty->assign('page', $page);
	$smarty->assign('totalPages', $totalPages);
	$smarty->assign('pageUrl', "$baseUrl/achiev/page%page%/");
}

?>