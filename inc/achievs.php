<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$act = isset($_GET["act"]) ? $_GET["act"] : "";

// url=/achievs/
if($act=="achievs") {
	$q = "SELECT * FROM (SELECT steam_id_64, email, `id` AS `plid`, `name`, 
		(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
			WHERE `achievId` = `unr_achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev_total`
		FROM `unr_players`) AS `tmp34` WHERE `achiev_total` > 0 ORDER BY `achiev_total` DESC";
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);
	
	$pages = generate_page($_GET["page"], $total, $achievPlayersPerPage, "$baseUrl/achievs/page%page%");
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPlayersPerPage);
	
	$rows = array();
	foreach($rows_limit as $player) {						
		$player["avatar"] = getAvatar($player["plid"], $player["steam_id_64"], $player["email"], "avatarMedium");
			
		$rows[] = $player;
	}
}
else { // url=/achiev/%aname%
	$aname = isset($_GET["aname"]) ? $_GET["aname"] : "";
	$name = isset($_GET["name"]) ? $_GET["name"] : "";
	
	if($aname) {
		$aname = slashes($_GET["aname"]);
		
		$q = "SELECT `id`, `name`, `desc` FROM achiev WHERE `lang`='{$lang}' AND `name` = '{$aname}' LIMIT 1";
		$r = mysqli_query($db, $q);
		$achiev = mysqli_fetch_assoc($r);
		
		if($achiev) {
			$q = "SELECT steam_id_64, email, `p`.`id` AS `plid`, `p`.`name` AS `plname`, 
				(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
					WHERE `unr_players_achiev`.`achievId` = `unr_achiev`.`id` 
						AND `unr_achiev`.`count` = `unr_players_achiev`.`progress` 
						AND `unr_players_achiev`.`playerId` = `plid`) AS `achiev_total` 
					FROM `unr_players` AS `p`, `unr_players_achiev` AS `pa`, `unr_achiev` AS `a` 
					WHERE `a`.`count` = `pa`.`progress` 
						AND `p`.`id` = `pa`.`playerId` 
						AND `pa`.`achievId` = `a`.`id` 
						AND `a`.`id` = {$achiev["id"]}";	
			$r = mysqli_query($db, $q);
			$total = mysqli_num_rows($r);
			
			$aname_url = urlencode($aname);
			$pages = generate_page($page, $total, $achievPlayersPerPage, "$baseUrl/achiev/page%page%/$aname_url");
			$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPlayersPerPage);
			
			$rows = array();
			foreach($rows_limit as $player) {
				$player["plname_url"] = url_replace($player["plname"]);
				
				$player["avatar"] = getAvatar($player["plid"], $player["steam_id_64"], $player["email"], "avatarMedium");;
				
				$rows[] = $player;
			}
		}
	}
	else
	if ($name) { // url=/%name%/achiev/
		$q = "SELECT `icon`, `a`.`id`, `a`.`name`, `a`.`desc`, `count`, 
				IF(`progress` IS NULL, 0, `progress`) AS `progress`
			FROM `achiev` `a`
			LEFT JOIN `unr_players_achiev` `pa` ON `pa`.`achievId` = `a`.`id` 
			LEFT JOIN `unr_players` `p` ON `pa`.`playerId` = `p`.`id`
			WHERE `a`.`lang`='{$lang}' AND `p`.`name` = '{$name}'
			ORDER BY `progress` = `count` DESC, `progress`/`count` DESC";
		$r = mysqli_query($db, $q);
		$total = mysqli_num_rows($r);
		
		$name_url = urlencode($name);
		$pages = generate_page($page, $total, $achievPerPage, "{$baseUrl}/{$name_url}/achiev/page%page%/");
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPerPage);	

		$rows = array();
		foreach($rows_limit as $achiev) {
			if ($achiev["count"] != 1 && $achiev["count"] != $achiev["progress"])
				$achiev["width"] = $achiev["progress"] * 100 / $achiev["count"];
			
			$achiev["img"] = "{$baseUrl}/{$dimg}/achiev/{$achiev["id"]}.png";
			if(!file_exists("{$dimg}/achiev/{$achiev["id"]}.png"))
				$achiev["img"] = "{$baseUrl}/{$dimg}/achiev/0.png";
			
			$rows[] = $achiev;
		}
	}
	else { // url=/achiev/
		$q = 'SET @playerCount := (SELECT COUNT(*) FROM `unr_players`)';
		mysqli_query($db, $q);
		
		$q = "SELECT `icon`, `id` AS `aId`, `name`, `desc`, 
			(SELECT COUNT(*) FROM `unr_achiev`, `unr_players_achiev` 
			WHERE `unr_players_achiev`.`achievId` = `unr_achiev`.`id` 
				AND `unr_achiev`.`count` = `unr_players_achiev`.`progress` 
				AND `unr_players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
			FROM `achiev` WHERE `lang`='{$lang}' ORDER BY `completed` DESC";
		$r = mysqli_query($db, $q);

		$total = mysqli_num_rows($r);

		$pages = generate_page($page, $total, $achievPerPage, "$baseUrl/achiev/page%page%/");
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPerPage);

		$rows = array();
		foreach($rows_limit as $achiev) {
			$achiev["completed"] = floor($achiev["completed"]*100)/100;
			
			$rows[] = $achiev;
		}		
	}
}

// FUNCTION
function achievImg($id) {
	global $dimg, $baseUrl;
	
	if(!file_exists("{$dimg}/achiev/achiev-{$id}.png"))
		return "{$baseUrl}/{$dimg}/achiev/achiev-0.png";
	else
		return "{$baseUrl}/{$dimg}/achiev/achiev-{$id}.png";
}
?>