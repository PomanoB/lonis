<?php
$name = isset($_GET["name"]) ? url_replace($_GET["name"], BACK) : "";

if($name) {
	$sname = slashes($name);
		
	$q = "SELECT * FROM `unr_players` WHERE `name` = '{$sname}' ORDER BY `id` LIMIT 1";	
	$r = mysqli_query($db, $q);
	$player = mysqli_fetch_assoc($r);
	
	$player["name_url"] = url_replace($player["name"]);
}
	
if(isset($player["id"])) {
	$geoip = geoip($db, $player["lastIp"], $lang);
	$player["countryName"] = $geoip["country"];
	$player["countryCode"] = $geoip["code"];
	
	$img = "img/country/".strtolower($player["countryCode"]).".png";
	$player["countryImg"] = file_exists($img) ? $img : "";
	
	$player["avatarLink"] = "http://www.gravatar.com";
	$player["avatar"] = $player["avatarLink"]."/avatar/".md5($player["email"])."?d=wavatar&s={$avatarSize_Full}";
	
	$player["lastTime"] = date('d.m.Y G:i:s', $player["lastTime"]);
	
	$q = "SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["achievCompleted"] = mysqli_result($r, 0);
	
	$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["mapCompleted"] = mysqli_result($r, 0);
	
	$player["name_url"] = url_replace($player["name"]);
	
	$player["onlineTimes"] = time_elasped($player["onlineTime"]);
	
	if(!$player["steam_id_64"])
		$player["steam_id_64"] = getSteamId64($player["steam_id"]);
}
else {
	if($name) $_POST["search"] = $name;
	
	$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;
	$order = isset($_GET["order"]) && $_GET["order"] ? $_GET["order"] : "";
	$sort = isset($_GET["sort"]) && $_GET["sort"] ? $_GET["sort"] : "";
	
	$search = "";
	if(isset($_POST["search"]) && $_POST["search"])
		$search = $_POST["search"];
	else 
	if(isset($_GET["search"]) && $_GET["search"])
		$search = $_GET["search"];
	
	$ssearch = slashes($search);

	$where = $search ? "AND `name` LIKE '%$ssearch%'" : "";

	$orderby = $order ? "`{$order}` {$sort}, `name` {$sort}" : "`name`";

	$q = "SELECT * FROM `players` WHERE (`lang`='{$lang}' OR `lang` IS NULL) {$where} ORDER BY {$orderby}";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);

	$pages = generate_page($page, $total, $playerPerPage, "{$baseUrl}/players/{$order}-{$sort}/page%page%/{$search}");

	if($total) {
		$i=0;
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], $playerPerPage);
		
		$rows = array();
		foreach($rows_limit as $row) {
			$img = 'img/country/'.strtolower($row["country"]).'.png';
			$row["countryImg"] = file_exists($docRoot."/".$img) ? $img : "";
			
			$row["avatarLink"] = "http://www.gravatar.com";
			$row["avatar"] = $row["avatarLink"]."/avatar/".md5($row["email"])."?d=wavatar&s={$avatarSize_Icon}";
			
			$row["name_url"] = url_replace($row["name"]);
			
			$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$row["id"]}";
			$r = mysqli_query($db, $q);
			$row["mapCompleted"] = mysqli_result($r, 0);
		
			$rows[] = $row;
		}
	}
}

?>