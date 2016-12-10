<?php
$id = 0;
//var_dump($_GET);
//die();
/*
if (isset($_GET['name']))
{
	if (get_magic_quotes_gpc())
	{
		$name = $_GET['name'];
	}
	else
	{
		$name = addslashes($_GET['name']);
	}
	
	$q = "SELECT * FROM `unr_players` WHERE `name` = '$name'";
	$r = mysql_query($q);
	
	if($info = mysql_fetch_assoc($r))
		$id = $info['id'];
}
*/
if (isset($playerId))
	$id = $playerId;
elseif (isset($_GET['id']))
	$id = abs((int)$_GET['id']);

if ($id)
{
	$q = "SELECT * FROM `unr_players` WHERE `id` = $id";
	$r = mysql_query($q);
	
	if($info = mysql_fetch_assoc($r))
	{
		
		if($ipInfo = geoip_record_by_addr($gi, $info['lastIp']) && !is_null($ipInfo))
		{
			$info['ipInfo']['country_code'] = strtolower($ipInfo->country_code);
			$info['ipInfo']['country_code3'] = $ipInfo->country_code3;
			$info['ipInfo']['country_name'] = $ipInfo->country_name;
			$info['ipInfo']['region'] = $ipInfo->region;
			$info['ipInfo']['city'] = $ipInfo->city;
			$info['ipInfo']['continent_code'] = $ipInfo->continent_code;
			$info['ipInfo']['region'] = $ipInfo->region;
		}
		else
			$info['ipInfo']['country_code'] = '';
		
		
		$info['gravatar'] = 'http://www.gravatar.com/avatar/'.md5($info['email']).'?d=wavatar&s='.$gravatarSize;
		$info['lastTime'] = date('d.m.Y G:i:s', $info['lastTime']);
		
		$q = "SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` WHERE `achievId` = `id` AND `count` = `progress` AND `playerId` = $id";
		$r = mysql_query($q);
		$info['achievCompleted'] = mysql_result($r, 0);
		
		$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `player` = $id";
		$r = mysql_query($q);
		$info['mapCompleted'] = mysql_result($r, 0);
	
		$template = 'player.tpl';
		$smarty->assign('info', $info);
	}
	else
	{
		$template = 'message.tpl';
		$smarty->assign('message', 'Игрок не найден!');
	}
}
else
{
	header("HTTP/1.1 404 Not Found");
//	var_dump($_SERVER);
}
?>