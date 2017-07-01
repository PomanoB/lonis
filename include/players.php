<?php
$name = isset($_GET["name"]) ? url_replace($_GET["name"], BACK) : "";

if($name) {
	$sname = slashes($name);
		
	$q = "SELECT * FROM `players` WHERE `name` = '{$sname}' ORDER BY `id` LIMIT 1";	
	$r = mysqli_query($db, $q);
	$player = mysqli_fetch_assoc($r);
	
	$player["name_url"] = url_replace($player["name"]);
}
	
if(isset($player["id"])) {
	$geoip = geoip($db, $player["lastIp"], $lang);
	$player["countryName"] = $geoip["country"];
	$player["countryCode"] = $geoip["code"];
	
	$img = "{$bTheme}/img/country/".$player["countryCode"].".png";
	$player["countryImg"] = file_exists($img) ? $img : "";
	
	$player["lastTime"] = date('d.m.Y G:i:s', $player["lastTime"]);
	
	$q = "SELECT COUNT(*) FROM `players_achiev`, `achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["achievCompleted"] = mysqli_result($r, 0);
	
	$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["mapCompleted"] = mysqli_result($r, 0);
	
	$player["name_url"] = url_replace($player["name"]);
	
	$player["onlineTimes"] = time_elasped($player["onlineTime"]);
	
	if(!$player["steam_id_64"])
		$player["steam_id_64"] = getSteamId64($player["steam_id"]);
	
	$player["avatar"] = getAvatar($player["id"], $player["steam_id_64"], $player["email"], "avatarfull");
}
else {
	if($name) $_POST["search"] = $name;
	
	$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;
	$order = isset($_GET["order"]) && $_GET["order"] ? $_GET["order"] : "";
	$sort = isset($_GET["sort"]) && $_GET["sort"] ? $_GET["sort"] : "";
	
	$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
	$ssearch = slashes($search);

	$where = $search ? "AND `name` LIKE '%$ssearch%'" : "";

	$orderby = $order ? "`{$order}` {$sort}, `name` {$sort}" : "`name`";

	$q = "SELECT * FROM `playerz` WHERE (`lang`='{$lang}' OR `lang` IS NULL) {$where} ORDER BY {$orderby}";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);

	$pages = generate_page($page, $total, $playerPerPage);
	
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $playerPerPage);
	
	$players = array(); $i=0;
	foreach($rows_limit as $row) {
		if(!$row["steam_id_64"] && isset($row["steam_id"]))
			$row["steam_id_64"] = getSteamId64($row["steam_id"]);

		$row["avatar"] = getAvatar($row["id"], $row["steam_id_64"], $row["email"], "avatar");
		
		$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$row["id"]}";
		$r = mysqli_query($db, $q);
		$row["mapCompleted"] = mysqli_result($r, 0);
	
		$players[] = $row;
	}
}

?>