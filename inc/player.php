<?php
if($player["id"]) {
	$geoip = geoip($db, $player["lastIp"], $lang);
	$player["countryName"] = $geoip["country"];
	$player["countryCode"] = $geoip["code"];
	
	$img = "img/country/{$player["countryCode"]}.png";
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
	
	$znak = strpos($player["name"], "?");
	$player["name_url"] = $znak===false ? rawurlencode($player["name"]) : "unrid{$player["id"]}";
	
	$player["onlineTimes"] = time_elasped($player["onlineTime"]);
	
	assign('info', $player);
}
else {
	header("Location: {$baseUrl}/players/{$player["name"]}");
}
?>