<?php

//print_r($_GET);

//die();
//$_GET['cs'] = 1;

error_reporting(E_ALL | E_STRICT);

session_start();



define('IN_KZ_TOP', 1);

include "inc/config.php";
include "inc/smarty_unr.php";
//include "inc/geoip/geoip.inc";
include "inc/geoip/geoipcity.inc";

$gi = geoip_open("inc/geoip/GeoIPCity.dat", GEOIP_STANDARD);

if (!@mysql_connect($mysql_host, $mysql_user, $mysql_password))
	die (mysql_error());

if (!mysql_select_db($mysql_db))
	die (mysql_error());
mysql_query("SET NAMES utf8");

$smarty = new Smarty_unr();

if (isset($_GET['cs']) || isset($_POST['cs']))
{
	$smarty->assign('cs', 1);
	$isCS = true;
}
else
	$isCS = false;

if (isset($_POST['lang']))
{
	$l = substr($_POST['lang'], 0, 2);
	if (file_exists('lang/'.$l.'.ini'))
	{
		$lang = $l;
		$_SESSION['unr_lang'] = $lang;
	}
	else
		echo "Lang not exsists";
}

if (isset($_SESSION['unr_lang']))
	$lang = $_SESSION['unr_lang'];
else	
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
else
	$lang = 'ru';

$smarty->assign('lang', $lang);
$smarty->config_load("$lang.ini");	

if (isset($_SESSION['user']['id']))
{
	$r = mysql_query("SELECT * FROM `unr_players` WHERE `id`= {$_SESSION['user']['id']}");
	if ($row = mysql_fetch_assoc($r))
	{
		foreach($row as $key => $value)
		{
			$_SESSION['user'][$key] = $value;
		}
		
		$smarty->assign('user', $_SESSION['user']);
	}
	else
		unset($_SESSION['user']);
}



if (isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = 'index';

if (isset($_GET['name']))
{
	//var_dump($_SERVER);
	//$name = substr($_SERVER[]);
	if (get_magic_quotes_gpc())
	{
		$name = $_GET['name'];
	}
	else
	{
		$name = addslashes($_GET['name']);
	}
	
	$q = "SELECT * FROM `unr_players` WHERE `name` = '$name' OR `name` = REPLACE('$name', '_', ' ') LIMIT 1";
	
	$r = mysql_query($q);
	
	if($info = mysql_fetch_assoc($r))
		$playerId = $info['id'];
}


$allowedActions = array(
	'reg' => 'inc/reg.php',
	'login' => 'inc/login.php',
	'achiev' => 'inc/achiev.php',
	'ucp' => 'inc/ucp.php',
	'achiev_admin' => 'inc/achiev_admin.php',
	'achiev_players' => 'inc/achiev_players.php',
	'kz_players' => 'inc/kz_players.php',
	'kz_map' => 'inc/kz_map.php',
	'kz_maps' => 'inc/kz_maps.php',
	'players' => 'inc/players.php',
	'player' => 'inc/player.php',
	'kz_duels' => 'inc/kz_duels.php',
	'steam_login' => 'inc/steam_login.php',
);	

if (isset($allowedActions[$action]))
	include $allowedActions[$action];
else
	$template = 'index.tpl';
$smarty->assign('action', $action);
$smarty->assign('baseUrl', $baseUrl);

if (isset($template))
{
	$tcs = ''; //$isCS ? "cs_" : "";
	$smarty->display($tcs.'header.tpl');
	$smarty->display($template);
	$smarty->display($tcs.'footer.tpl');

}


		
geoip_close($gi);

?>