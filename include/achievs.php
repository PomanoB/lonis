<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$act = isset($_GET["act"]) ? $_GET["act"] : "";

// url=/achievs/
if($act=="achievs") {
	$q = "SELECT * FROM (SELECT steam_id_64, email, `id` AS `plid`, `name`, 
		(SELECT COUNT(*) FROM `players_achiev`, `achiev` 
			WHERE `achievId` = `achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev_total`
		FROM `players`) AS `tmp34` WHERE `achiev_total` > 0 ORDER BY `achiev_total` DESC";
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);
	
	$pages = generate_page($_GET["page"], $total, $achievPlayersPerPage);
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPlayersPerPage);
	
	$rows = array();
	foreach($rows_limit as $player) {						
		$player["avatar"] = getAvatar($player["plid"], $player["steam_id_64"], $player["email"], "avatarmedium");
			
		$rows[] = $player;
	}
}
else { // url=/achiev/%aname%
	$aname = isset($_GET["aname"]) ? $_GET["aname"] : "";
	$name = isset($_GET["name"]) ? url_replace($_GET["name"], BACK) : "";
	
	if($aname) {
		$aname = slashes($_GET["aname"]);
		
		$q = "SELECT `id`, `name`, `desc` FROM `achievz` WHERE `lang`='{$lang}' AND `name` = '{$aname}' LIMIT 1";
		$r = mysqli_query($db, $q);
		$achiev = mysqli_fetch_assoc($r);
		
		if($achiev) {
			$q = "SELECT steam_id_64, email, `p`.`id` AS `plid`, `p`.`name` AS `plname`, 
				(SELECT COUNT(*) FROM `players_achiev`, `achiev` 
					WHERE `players_achiev`.`achievId` = `achiev`.`id` 
						AND `achiev`.`count` = `players_achiev`.`progress` 
						AND `players_achiev`.`playerId` = `plid`) AS `achiev_total` 
					FROM `players` AS `p`, `players_achiev` AS `pa`, `achiev` AS `a` 
					WHERE `a`.`count` = `pa`.`progress` 
						AND `p`.`id` = `pa`.`playerId` 
						AND `pa`.`achievId` = `a`.`id` 
						AND `a`.`id` = {$achiev["id"]}";	
			$r = mysqli_query($db, $q);
			$total = mysqli_num_rows($r);
			
			$aname_url = urlencode($aname);
			$pages = generate_page($page, $total, $achievPlayersPerPage);
			$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPlayersPerPage);
			
			$rows = array();
			foreach($rows_limit as $player) {
				$player["plname_url"] = url_replace($player["plname"]);
				
				$player["avatar"] = getAvatar($player["plid"], $player["steam_id_64"], $player["email"], "avatarmedium");;
				
				$rows[] = $player;
			}
		}
	}
	else
	if ($name) { // url=/%name%/achiev/
		$q = "SELECT `icon`, `a`.`id`, `a`.`name`, `a`.`desc`, `count`, 
				IF(`progress` IS NULL, 0, `progress`) AS `progress`
			FROM `achievz` `a`
			LEFT JOIN `players_achiev` `pa` ON `pa`.`achievId` = `a`.`id` 
			LEFT JOIN `players` `p` ON `pa`.`playerId` = `p`.`id`
			WHERE `a`.`lang`='{$lang}' AND `p`.`name` = '{$name}'
			ORDER BY `progress` = `count` DESC, `progress`/`count` DESC";
		$r = mysqli_query($db, $q);
		$total = mysqli_num_rows($r);
		
		$name_url = urlencode($name);
		$pages = generate_page($page, $total, $achievPerPage);
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], $achievPerPage);	

		$rows = array();
		foreach($rows_limit as $achiev) {
			if ($achiev["count"] != 1 && $achiev["count"] != $achiev["progress"])
				$achiev["width"] = $achiev["progress"] * 100 / $achiev["count"];
			
			$achiev["img"] = "{$bUrl}/{$bTheme}/img/achiev/{$achiev["id"]}.png";
			if(!file_exists("{$bTheme}/img/achiev/{$achiev["id"]}.png"))
				$achiev["img"] = "{$bUrl}/{$bTheme}/img/achiev/0.png";
			
			$rows[] = $achiev;
		}
	}
	else { // url=/achiev/
		$q = 'SET @playerCount := (SELECT COUNT(*) FROM `players`)';
		mysqli_query($db, $q);
		
		$q = "SELECT `icon`, `id` AS `aId`, `name`, `desc`, 
			(SELECT COUNT(*) FROM `achiev`, `players_achiev` 
			WHERE `players_achiev`.`achievId` = `achiev`.`id` 
				AND `achiev`.`count` = `players_achiev`.`progress` 
				AND `players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
			FROM `achievz` WHERE `lang`='{$lang}' ORDER BY `completed` DESC";
		$r = mysqli_query($db, $q);

		$total = mysqli_num_rows($r);

		$pages = generate_page($page, $total, $achievPerPage);
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
	return "http://gravatar.com/avatar/".md5($id)."?d=identicon";
}
?>