<?php
if($player["id"]) {
	if(isset($player["lastIp"]) && $player["lastIp"]!="") {
		$q = "SELECT `code`, `country_name` as `country` FROM
					(SELECT * FROM `geoip_countries` WHERE `ip_to` >= INET_ATON('{$player["lastIp"]}') ORDER BY `ip_to` ASC LIMIT 1) AS `cnt`,
					`geoip_locations`
				WHERE `code` = `country_iso_code` AND `locale_code` = '{$lang}'";
		$geoip = mysqli_fetch_assoc(mysqli_query($db, $q));
	}
	
	$player["countryName"] = isset($geoip["country"]) ? $geoip["country"] : "";
	$player["countryCode"] = isset($geoip["code"]) ? $geoip["code"] : "";
	
	$img = "img/country/{$player["countryCode"]}.png";
	$player["countryImg"] = file_exists($img) ? $img : "";
	
	$player["avatarLink"] = "http://www.gravatar.com";
	$player["avatar"] = $player["avatarLink"]."/avatar/".md5($player["email"]).'?d=wavatar&s='.$avatarSize["Full"];
	
	$player["lastTime"] = date('d.m.Y G:i:s', $player["lastTime"]);
	
	$q = "SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["achievCompleted"] = mysqli_result($r, 0);
	
	$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = {$player["id"]}";
	$r = mysqli_query($db, $q);
	$player["mapCompleted"] = mysqli_result($r, 0);
	
	$znak = strpos($player["name"], "?");
	$player["name_url"] = $znak===false ? rawurlencode($player["name"]) : "unrid{$player["id"]}";
	
	$player["onlineTimes"] = time_elasped($player["onlineTime"]);
	
	assign('info', $player);
}
else {
	header("Location: {$baseUrl}/players/{$player["name"]}");
}
?>