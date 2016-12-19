<?php

// achive
if (isset($_GET["aname"])) {
	$aname = urldecode($_GET["aname"]);
	$aname = get_magic_quotes_gpc() ? $aname : addslashes($aname);
	
	$q = "SELECT `id`, `name`, `description` 
		FROM achiev 
		WHERE `lname`='$lang' AND `ldesc`='$lang' 
			AND (`name` = '$aname' OR `name` = REPLACE('$aname', '_', ' '))
			LIMIT 1";
	$r = mysql_query($q);
	if ($row = mysql_fetch_array($r))  {
		$id = $row["id"];
		$smarty->assign('achiev', $row);
		
		$q = "SELECT `p`.`id` AS `plid`, `p`.`name` AS `plname`, 
				(SELECT COUNT(*) FROM `unr_players_achiev`, `achiev`
					WHERE `unr_players_achiev`.`achievId` = `achiev`.`id` 
						AND `achiev`.`count` = `unr_players_achiev`.`progress` 
						AND `unr_players_achiev`.`playerId` = `plid`) AS `achiev_total`
					FROM `unr_players` AS `p`, 
						`unr_players_achiev` AS `pa`, 
						`achiev` AS `a` 
				WHERE `a`.`count` = `pa`.`progress` AND `p`.`id` = `pa`.`playerId` AND `pa`.`achievId` = `a`.`id` AND `a`.`id` = $id";
		$r = mysql_query($q);
		$players = array();
		
		while($row = mysql_fetch_array($r)) {
			$players[] = $row;
		}
		
		$smarty->assign('players', $players);
		$smarty->assign('aname', $aname);
	}
	else {
		//header("Location: $baseUrl/error/404");
	}
}
else // player_achive
if (isset($_GET["plid"]) || isset($playerId)) { 
	if (isset($playerId))
		$plId = $playerId;
	else
		$plId = abs((int)$_GET["plid"]);
	
	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $plId";
	$r = mysql_query($q);
	if ($row = mysql_fetch_array($r))
	{
		$smarty->assign('playerName', $row["name"]);
		
		$q = "SELECT `id`, `name`, `description`, `count`, 
			IF(`progress` IS NULL, 0, `progress`) AS `progress` 
		FROM `achiev` 
		LEFT JOIN `unr_players_achiev` ON `achievId` = `id` AND `playerId` = $plId 
		WHERE `lname`='$lang' AND `ldesc`='$lang' 
		ORDER BY `progress` = `count` 
		DESC, `progress`/`count` DESC";
	
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
	}
	else
		header("Location: $baseUrl/achiev");
}
else {// achive_list
	$q = 'SET @playerCount := (SELECT COUNT(*) FROM `unr_players`)';
	mysql_query($q);
	$q = "SELECT `id` AS `aId`, `name`, `description`, 
		(SELECT COUNT(*) FROM `achiev`, `unr_players_achiev` 
		WHERE `unr_players_achiev`.`achievId` = `achiev`.`id` 
			AND `achiev`.`count` = `unr_players_achiev`.`progress` 
			AND `unr_players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
		FROM `achiev` 
		WHERE `lname`='$lang' AND `ldesc`='$lang' 		
		ORDER BY `completed` DESC";
	$r = mysql_query($q);
	
	$achievs = array();
		
	while($row = mysql_fetch_array($r)) {
		$row["completed"] = floor($row["completed"]*100)/100;
		$achievs[] = $row;
	}
	$smarty->assign('achievs', $achievs);
}
?>