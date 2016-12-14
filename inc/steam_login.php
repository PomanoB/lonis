<?php

include 'lightopenid.php';

$openid = new LightOpenID;

if (isset($_SESSION['user']))
{
	header('Location: ' . $baseUrl. '/ucp');
}
else
{
	if (isset($_SESSION['steamId64']))
	{
		$smarty->assign('steamId64', $_SESSION['steamId64']);
		$smarty->assign('steamName', $_SESSION['steamName']);
		$template = 'steam_reg.tpl';
		
		if (!empty($_POST['reg_nick']) && ($nick = trim($_POST['reg_nick'])))
		{
			$steamID = GetAuthID($_SESSION['steamId64']);
			
			if (!get_magic_quotes_gpc())
				$nick = addslashes($nick);
			if (mysql_query("INSERT INTO `unr_players` SET `name`= '{$nick}', `flags` = 2, `auth` = 1, `steam_id` = '{$steamID}', `active` = 1, `steam_id_64` = '{$_SESSION['steamId64']}'"))
			{
				$_SESSION['user']['id'] = mysql_insert_id();
				header('Location: ' . $baseUrl. '/ucp');
				
				unset($_SESSION['steamId64']);
				unset($_SESSION['steamName']);
			}
			else
			{
				$smarty->assign('error', $smarty->get_config_vars('langAlreadyUsed'));
			}
		}
		
	}
	else
	if(!$openid->mode)
	{
		$openid->identity = 'http://steamcommunity.com/openid';
		header('Location: ' . $openid->authUrl());
	}
	else
	if($openid->mode == 'cancel') 
	{
        header('Location: ' . $baseUrl);
    }
	else
	{
        if ($openid->validate())
		{
			$steamId = explode('/', $openid->identity);
		
			if (!get_magic_quotes_gpc())
				$steamId = addslashes($steamId[5]);
			else
				$steamId = $steamId[5];
				
			$r = mysql_query("SELECT `id` FROM `unr_players` WHERE `steam_id_64` = '{$steamId}' LIMIT 1");
			if ($row = mysql_fetch_assoc($r))
			{
				$_SESSION['user']['id'] = $row['id'];
				header('Location: ' . $baseUrl. '/ucp');
			}
			else
			{
				$data = file_get_contents("http://steamcommunity.com/profiles/{$steamId}/?xml=1");
				
				$p1 = strpos($data, '<steamID><![CDATA[') + strlen('<steamID><![CDATA[');
				$p2 = strpos($data, ']]></steamID>');
				$steamName = substr($data, $p1, $p2 - $p1);
				
				$_SESSION['steamId64'] = $steamId;
				$_SESSION['steamName'] = $steamName;
								
				header('Location: ' . $baseUrl .'/steam_login');
			}
				}
		else
			header('Location: ' . $baseUrl);
    }	
}


function GetAuthID($i64friendID)
{
	$tmpfriendID = $i64friendID;
	$iServer = "1";
	if(bcmod($i64friendID, "2") == "0")
	{
		$iServer = "0";
	}
	$tmpfriendID = bcsub($tmpfriendID,$iServer);
	if(bccomp("76561197960265728",$tmpfriendID) == -1)
		$tmpfriendID = bcsub($tmpfriendID,"76561197960265728");
	$tmpfriendID = bcdiv($tmpfriendID, "2");
	return ("STEAM_0:" . $iServer . ":" . $tmpfriendID);
}

?>