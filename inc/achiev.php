<?php
// achiev || /achiev/%aname%
if (isset($_GET["aname"]) && $_GET["aname"]!="") {
	$aname = slashes(urldecode($_GET["aname"]));
	assign('aname', $aname);
	
	$q = "SELECT `id`, `name`, `description` FROM achiev 
			WHERE `lang`='{$lang}' 
			AND (`name` = '$aname' OR `name` = REPLACE('$aname', '_', ' '))
		LIMIT 1";
	$r = mysqli_query($db, $q);
	
	if ($row = mysqli_fetch_array($r))  {
		$id = $row["id"];
		assign('achiev', $row);
		
		$q = "SELECT `p`.`id` AS `plid`, `p`.`name` AS `plname`, 
			(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
				WHERE `unr_players_achiev`.`achievId` = `unr_achiev`.`id` 
					AND `unr_achiev`.`count` = `unr_players_achiev`.`progress` 
					AND `unr_players_achiev`.`playerId` = `plid`) AS `achiev_total` 
				FROM `unr_players` AS `p`, `unr_players_achiev` AS `pa`, `unr_achiev` AS `a` 
				WHERE `a`.`count` = `pa`.`progress` 
					AND `p`.`id` = `pa`.`playerId` 
					AND `pa`.`achievId` = `a`.`id` 
					AND `a`.`id` = $id";	
		$r = mysqli_query($db, $q);
		
		$players = array();
		while($row = mysqli_fetch_array($r)) {
			$row["plname_url"] = url_replace($row["plname"]);
			$players[] = $row;
		}
		
		assign('players', $players);
	}
	else {
		$message = $langs["PageNotFound"];
	}
}
else // player_achiev || /%name%/achiev/
if (isset($_GET["plid"]) || isset($playerId)) { 
	$plId = isset($playerId) ? $playerId : abs((int)$_GET["plid"]);
	assign('plId');
	
	$q = "SELECT `name` FROM `unr_players` WHERE `id` = $plId";
	$r = mysqli_query($db, $q);
	if ($row = mysqli_fetch_array($r)) {
		$q = "SELECT COUNT(*) FROM `achiev` WHERE `lang`='{$lang}'";	 
		$r = mysqli_query($db, $q);
		
		$total = mysqli_result($r, 0);
		assign('total', $total);
		
		$pages = generate_page($_GET["page"], $total, $achievPerPage);
		$pages["pageUrl"] = "$baseUrl/$name/achiev/page%page%/";
		assign('pages', $pages);

		$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];
	
		assign('playerName', $row["name"]);
		
		$q = "SELECT `id`, `name`, `description`, `count`, 
				IF(`progress` IS NULL, 0, `progress`) AS `progress`
			FROM `achiev` 
			LEFT JOIN `unr_players_achiev` ON `achievId` = `id` AND `playerId` = $plId 
			WHERE `lang`='{$lang}' 
			ORDER BY `progress` = `count` DESC, `progress`/`count` DESC {$limit}";
		$r = mysqli_query($db, $q);
	
		$achievs = array();
		while($row = mysqli_fetch_array($r)) {
			if ($row["count"] != 1 && $row["count"] != $row["progress"])
				$row["width"] = $row["progress"] * 100 / $row["count"];
			
			$achievs[] = $row;
		}
		assign('achievs', $achievs);
	}
	else
		$message = $langs["PlayerNotFound"];
}
else {// achiev_list || /achiev
	$q = "SELECT COUNT(*) FROM `unr_achiev`"; 
	$r = mysqli_query($db, $q);
	
	$total = mysqli_result($r, 0);
	assign('total', $total);

	$pages = generate_page($_GET["page"], $total, $achievPerPage);
	$pages["pageUrl"] = "$baseUrl/achiev/page%page%/";
	assign('pages', $pages);

	$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];
		
	$q = 'SET @playerCount := (SELECT COUNT(*) FROM `unr_players`)';
	mysqli_query($db, $q);
	$q = "SELECT `id` AS `aId`, `name`, `description`, 
		(SELECT COUNT(*) FROM `unr_achiev`, `unr_players_achiev` 
		WHERE `unr_players_achiev`.`achievId` = `unr_achiev`.`id` 
			AND `unr_achiev`.`count` = `unr_players_achiev`.`progress` 
			AND `unr_players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
		FROM `achiev` WHERE `lang`='{$lang}' ORDER BY `completed` DESC {$limit}";
	$r = mysqli_query($db, $q);
	
	$achievs = array();
	while($row = mysqli_fetch_array($r)) {
		$row["completed"] = floor($row["completed"]*100)/100;
		$achievs[] = $row;
	}
	
	assign('achievs', $achievs);
}

assign('message');

?>