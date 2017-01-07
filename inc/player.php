<?php
$id = 0;
$message = "";
$row = array();
	
if (isset($playerId))
	$id = $playerId;
elseif (isset($_GET["id"]))
	$id = abs((int)$_GET["id"]);

if ($id) {
	$q = "SELECT * FROM `unr_players` WHERE `id` = $id";
	$r = mysqli_query($db, $q);
	
	if($row = mysqli_fetch_assoc($r)) {
		if(isset($row["lastIp"]) && $row["lastIp"]!="") {
			$q = "SELECT `code`, `country` FROM `geoip_countries` WHERE `ip_to` >= INET_ATON('{$row["lastIp"]}') ORDER BY `ip_to` ASC LIMIT 1";
			$geoip = mysqli_fetch_assoc(mysqli_query($db, $q));
		}
		
		$row["countryName"] = isset($geoip["country"]) ? $geoip["country"] : "";
		$row["countryCode"] = isset($geoip["code"]) ? $geoip["code"] : "";
		
		$img = 'img/country/'.$row["countryCode"].'.png';
		$row["countryImg"] = file_exists($img) ? $img : "";
		
		$row["avatarLink"] = "http://www.gravatar.com/avatar/";
		$row["avatar"] = $row["avatarLink"].md5($row["email"]).'?d=wavatar&s='.$avatarSize["Full"];
		
		$row["lastTime"] = date('d.m.Y G:i:s', $row["lastTime"]);
		
		$q = "SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = $id";
		$r = mysqli_query($db, $q);
		$row["achievCompleted"] = mysqli_result($r, 0);
		
		$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id";
		$r = mysqli_query($db, $q);
		$row["mapCompleted"] = mysqli_result($r, 0);
		
		$znak = strpos($row["name"], "?");
		$row["name_url"] = $znak===false ? rawurlencode($row["name"]) : "unrid$id";
		
		assign('info', $row);
	}
	else {
		$message = $langs['PlayerNotFound'];
	}
}
else {
	$message = $langs['PlayerNotFound'];
}

assign('message', $message)
?>