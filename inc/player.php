<?php
$id = 0;
$message = "";
$info = array();
	
if (isset($playerId))
	$id = $playerId;
elseif (isset($_GET["id"]))
	$id = abs((int)$_GET["id"]);

if ($id) {
	$q = "SELECT * FROM `unr_players` WHERE `id` = $id";
	$r = mysqli_query($db, $q);
	
	if($info = mysqli_fetch_assoc($r)) {
		if($ipInfo = geoip_record_by_addr($gi, $info["lastIp"]) && !is_null($ipInfo))
		{
			$info["ipInfo"]["country_code"] = strtolower($ipInfo->country_code);
			$info["ipInfo"]["country_code3"] = $ipInfo->country_code3;
			$info["ipInfo"]["country_name"] = $ipInfo->country_name;
			$info["ipInfo"]["region"] = $ipInfo->region;
			$info["ipInfo"]["city"] = $ipInfo->city;
			$info["ipInfo"]["continent_code"] = $ipInfo->continent_code;
			$info["ipInfo"]["region"] = $ipInfo->region;
		}
		else
			$info["ipInfo"]["country_code"] = '';
		
		
		$info["gravatar"] = 'http://www.gravatar.com/avatar/'.md5($info["email"]).'?d=wavatar&s='.$gravatarSize;
		$info["lastTime"] = date('d.m.Y G:i:s', $info["lastTime"]);
		
		$q = "SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = $id";
		$r = mysqli_query($db, $q);
		$info["achievCompleted"] = mysqli_result($r, 0);
		
		$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id";
		$r = mysqli_query($db, $q);
		$info["mapCompleted"] = mysqli_result($r, 0);
		
		$znak = strpos($info["name"], "?");
		$info["name_url"] = $znak===false ? rawurlencode($info["name"]) : "unrid$id";
		
		$smarty->assign('info', $info);
	}
	else {
		$message = $langs['langPlayerNotFound'];
	}
}
else {
	$message = $langs['langPlayerNotFound'];
}

$smarty->assign('message', $message)
?>