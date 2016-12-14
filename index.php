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

// Read setting from config.php
foreach($conf as $key=>$value) {
	$$key = $value;
}

// Smarty
$smarty = new Smarty_unr();
$config_dir = $smarty->config_dir;

// Read setting from config file
// Create new config file from config.php (default)
if (!file_exists($config_dir.'/'.$config_file)) {
	$fp = fopen($config_dir.'/'.$config_file, 'w');
	$text = "";
	foreach($conf as $key=>$value) {
		$text .= $key." = '".$value."'\n";
	}
	fwrite($fp, $text);
	fclose($fp);
}
else {
	$smarty->config_load($config_file);
	$config_vars = $smarty->get_config_vars();
	foreach($config_vars as $key=>$value) {
		$$key = $value;
		$conf[$key] = $value;
	}
}

// Connect to mysql
if(isset($_GET['action']) && $_GET['action']!="setup") {	
	if($conn = !db_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db, $charset)) {
		header("Location: $baseUrl/setup");
	}
}

// Timezone
date_default_timezone_set($timezone);

// Read language 
if (isset($_POST['lang'])) {
	$lang = $_POST['lang'];
	$_SESSION['unr_lang'] = $lang;
}
	
if (isset($_SESSION['unr_lang']))
	$lang = $_SESSION['unr_lang'];
else	
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

$smarty->assign('lang', $lang);
$smarty->config_load("lang.ini");
$smarty->config_load("lang.ini", $lang);	

$langlist = explode(" ", $langlist);
foreach($langlist as $key=>$value) {
	$langselect[$key]['name'] = $value;
	$langselect[$key]['desc'] = $smarty->get_config_vars('langLang_'.$value);
}
$smarty->assign('langselect', $langselect);

// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);

// Read themes
if (isset($_POST['theme']))
{
	if (file_exists('templates/css/'.$_POST['theme'].'.css')) {
		$theme = $_POST['theme'];
		$_SESSION['unr_theme'] = $_POST['theme'];
	}
}

if (isset($_SESSION['unr_theme']))
	$theme = $_SESSION['unr_theme'];

$smarty->assign('theme', $theme);

$themelist = explode(" ", $themelist);
foreach($themelist as $key=>$value) {
	$themeselect[$key]['name'] = $value;
	$themeselect[$key]['desc'] = $smarty->get_config_vars('langTheme_'.$value);
}
$smarty->assign('themeselect', $themeselect);

// CS Style
$cs = isset($_GET['cs'])  ? $_GET['cs'] : (isset($_POST['cs']) ? $_POST['cs'] : 0);

if($cs) {
	$smarty->assign('cs', $cs);
	$theme = $cstheme;
}

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

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if (isset($_GET['name'])) {
	$name = get_magic_quotes_gpc() ? $_GET['name'] : addslashes($_GET['name']);
	
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
	'setup' => 'inc/setup.php'
);	

if (isset($allowedActions[$action]))
	include $allowedActions[$action];
else
	$template = 'index.tpl';

$smarty->assign('action', $action);
$smarty->assign('baseUrl', $baseUrl);

$langActions = array(
	'index' => 'langStart',
	'reg' => 'langRegister',
	'login' => 'langLogin',
	'achiev' => 'langAchiev',
	'ucp' => 'langUcp',
	'achiev_admin' => 'langAchievAdmin',
	'achiev_players' => 'langAchievPlayers',
	'kz_players' => 'langKzPlayers',
	'kz_map' => 'langKzMap',
	'kz_maps' => 'langKzMaps',
	'players' => 'langPlayers',
	'player' => 'langPlayer',
	'kz_duels' => 'langKzDuel',
	'steam_login' => 'langSteamLogin',
	'logout' => 'langLogOut',
	'setup' => 'langSetup'
);

$typeDescription = array(
		'pro' => 'langKzPro',
		'noob' => 'langKzNoob',
		'all' => 'langKzAll'
	);	
	
$smarty->assign('langAction', $smarty->get_config_vars($langActions[$action]));

if (isset($template))
{
	$smarty->display('header.tpl');
	$smarty->display($template);
	$smarty->display('footer.tpl');

}
		
geoip_close($gi);

/*---------------------------------------------------------------------------------------------*/

// Connect to db
function db_connect($host, $user, $password, $db, $charset) {
	if (!mysql_connect($host, $user, $password)) return 0;
	if (!mysql_select_db($db)) return 0;
	if (!mysql_fetch_assoc(mysql_query("show tables"))) return 0;
	
	mysql_query("SET NAMES ".$charset);
	return 1;
}

// Time format ##:##.##
function timed($ftime, $pad=0) {
	$min = floor($ftime/60);
	$sec = $ftime%60;
	$ms = $ftime * pow(10,$pad) % pow(10,$pad);
	if ($min < 10) $min = '0'.$min;
	if ($sec < 10) $sec = '0'.$sec;
	$ms = str_pad($ms, $pad, '0');
	if ($ms < pow(10,$pad-1) && $ms!=0) $ms = '0'.$ms;
	

	return $min.':'.$sec.'.'.$ms;
}

// Name of variable
function vname( &$var, $scope=false, $prefix="unique", $suffix="value") {
	$vals = $scope ? $scope : $GLOBALS;
	$old = $var;
	$var = $new = $prefix.rand().$suffix;
	$vname = FALSE;
	foreach($vals as $key => $val) {
		if($val === $new) $vname = $key;
	}
	$var = $old;
	return $vname;
}

?>