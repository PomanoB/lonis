<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$act = isset($_GET["act"]) ? $_GET["act"] : "";

// url=/achievs/
if($act=="achievs") {
	$q = "SELECT * FROM (SELECT `id` AS `plid`, `name`, 
		(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
			WHERE `achievId` = `unr_achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev_total`
		FROM `unr_players`) AS `tmp34` WHERE `achiev_total` > 0 ORDER BY `achiev_total` DESC";
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);

	$pages = generate_page($_GET["page"], $total, $achievPlayersPerPage);
	$pages["pageUrl"] = "$baseUrl/achievs/page%page%";

	if ($total) {
		$rows_limit = mysqli_fetch_assoc_limit($r, $pages["start"], $achievPlayersPerPage);
			
		$players = array();
		foreach($rows_limit as $row) {
			$players[] = $row;
		}
	}
}
else { // url=/achiev/%aname%
	$aname = (isset($_GET["aname"])) ? $_GET["aname"] : "";
	
	if($aname) {
		$aname = slashes(urldecode($_GET["aname"]));
		
		$q = "SELECT `id`, `name`, `description` FROM achiev WHERE `lang`='{$lang}' AND `name` = '{$aname}' LIMIT 1";
		$r = mysqli_query($db, $q);
		$achiev = mysqli_fetch_assoc($r);
		
		if(!$achiev) {
			header("Location: {$baseUrl}/achiev/");
		}
		else {
			assign('aname', $aname);
			$id = $achiev["id"];
			
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
			
			$total = mysqli_num_rows($r);

			$pages = generate_page($page, $total, $achievPlayersPerPage);
			$pages["pageUrl"] = "$baseUrl/achiev/page%page%/{$aname}";
		
			if($total) {
				$rows_limit = mysqli_fetch_assoc_limit($r, $pages["start"], $achievPlayersPerPage);
				
				$players = array();
				foreach($rows_limit as $row) {
					$row["plname_url"] = url_replace($row["plname"]);
					$players[] = $row;
				}
			}
		}
	}
	else
	if ($player["id"]) { // url=/%name%/achiev/
		$q = "SELECT `id`, `name`, `description`, `count`, 
				IF(`progress` IS NULL, 0, `progress`) AS `progress`
			FROM `achiev` 
			LEFT JOIN `unr_players_achiev` ON `achievId` = `id` AND `playerId` = {$player["id"]}
			WHERE `lang`='{$lang}' 
			ORDER BY `progress` = `count` DESC, `progress`/`count` DESC";
		$r = mysqli_query($db, $q);
		
		$total = mysqli_num_rows($r);
		
		$pages = generate_page($page, $total, $achievPerPage);
		$pages["pageUrl"] = "{$baseUrl}/{$name}/achiev/page%page%/";

		if($total) {
			$rows_limit = mysqli_fetch_assoc_limit($r, $pages["start"], $achievPerPage);
			
			$achievs = array();
			foreach($rows_limit as $row) {
				if ($row["count"] != 1 && $row["count"] != $row["progress"])
					$row["width"] = $row["progress"] * 100 / $row["count"];
				
				$achievs[] = $row;
			}
		}
	}
	else { // url=/achiev/
		$q = 'SET @playerCount := (SELECT COUNT(*) FROM `unr_players`)';
		mysqli_query($db, $q);
		
		$q = "SELECT `id` AS `aId`, `name`, `description`, 
			(SELECT COUNT(*) FROM `unr_achiev`, `unr_players_achiev` 
			WHERE `unr_players_achiev`.`achievId` = `unr_achiev`.`id` 
				AND `unr_achiev`.`count` = `unr_players_achiev`.`progress` 
				AND `unr_players_achiev`.`achievId` = `aId`)/@playerCount*100 AS `completed` 
			FROM `achiev` WHERE `lang`='{$lang}' ORDER BY `completed` DESC";
		$r = mysqli_query($db, $q);

		$total = mysqli_num_rows($r);

		$pages = generate_page($page, $total, $achievPerPage);
		$pages["pageUrl"] = "$baseUrl/achiev/page%page%/";

		if($total) {
			$rows_limit = mysqli_fetch_assoc_limit($r, $pages["start"], $achievPerPage);

			$achievs = array();
			foreach($rows_limit as $row) {
				$row["completed"] = floor($row["completed"]*100)/100;
				$achievs[] = $row;
			}		
		}
	}
}
?>