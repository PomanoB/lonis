<?php
error_reporting(E_ALL | E_STRICT);

session_start();

define('IN_KZ_TOP', 1);

include "inc/config.php";
include "inc/function.php";
include "inc/smarty_unr.php";
//include "inc/geoip/geoip.inc";
include "inc/geoip/geoipcity.inc";

// Geo IP
$gi = geoip_open("inc/geoip/GeoIPCity.dat", GEOIP_STANDARD);



// Read setting from config.php
foreach($conf as $key=>$value) {
	$$key = $value;
}

// Timezone
date_default_timezone_set($timezone);

// quotes $_POST and $_GET
if (!get_magic_quotes_gpc()) {
	foreach($_POST as $key=>$value) { 
		$_POST[$key]=addslashes($value);
	}
	foreach($_GET as $key=>$value) { 
		$_POST[$key]=addslashes($value);
	}
}

// Global vars
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$baseUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";

// Smarty
$smarty = new Smarty_unr();
$config_dir = $smarty->config_dir;

// Read setting from config file or create default
$config_path = $config_dir.'/'.$config_file;
if(file_exists($config_path)) {
	$conf = parse_ini_file($config_path);
	foreach($conf as $key=>$value) {
		$$key = $value;
	}
}
else {
	save_config_file($config_path);
}

// Connect to mysql
if(isset($_GET['action']) && $_GET['action']!="setup") {	
	if($conn = !db_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db, $charset)) {
		header("Location: $baseUrl/setup");
	}
}

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

if(!file_exists($config_dir."/".$config_lang)) {
	die('Default Languge file: $config_lang - not found');
}

$smarty->config_load($config_lang);
$smarty->config_load($config_lang, $lang);
	
if(isset($lang_custom)) {
	if(file_exists($config_dir."/lang_$action.ini")) {
		$smarty->config_load("lang_$action.ini");
		$smarty->config_load("lang_$action.ini", $lang);
	}	
}

$langlist = explode(" ", $langlist);
foreach($langlist as $key=>$value) {
	$langselect[$value] = $smarty->get_config_vars('langLang_'.$value);
}
$smarty->assign('langselect', $langselect);

// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);

// Read themes
$themelist = explode(" ", $themelist);
foreach($themelist as $key=>$value) {
	$themeselect[$value] = $smarty->get_config_vars('langTheme_'.$value);
}
$smarty->assign('themeselect', $themeselect);

if (isset($_POST['theme']))
{
	if (file_exists('templates/css/theme_'.$_POST['theme'].'.css')) {
		$theme = $_POST['theme'];
		$_SESSION['unr_theme'] = $_POST['theme'];
	}
	else {
		$langTheme = $smarty->get_config_vars('langTheme_'.$theme);
		echo "<script>alert('Theme $langTheme not found')</script>";
	}
}

// CS Style
$cs = isset($_SESSION['cs']) ? $_SESSION['cs'] : $cs;
if(isset($_GET['cs'])) { $cs = $_GET['cs']; $_SESSION['cs'] = $cs; }
if(isset($_POST['cs'])) { $cs = $_POST['cs']; $_SESSION['cs'] = $cs; }

if($cs) {
	$smarty->assign('cs', $cs);
	$_SESSION['unr_theme'] = $cstheme;
	$menu = $menuCS;
}

if (isset($_SESSION['unr_theme']))
	$theme = $_SESSION['unr_theme'];

$smarty->assign('theme', $theme);

// Select Player
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
	
	array_replace($menu, $menuNotLogged, $menuLogged);
}

// Get name from DB
if (isset($_GET['name'])) {
	$q = "SELECT * FROM `unr_players` WHERE `name` = '$name' OR `name` = REPLACE('$name', '_', ' ') LIMIT 1";	
	$r = mysql_query($q);	
	if($info = mysql_fetch_assoc($r))
		$playerId = $info['id'];
}

// Menu
foreach($menu as $value) {
	$menulist[$value]['name'] = $smarty->get_config_vars("lang_".$value);
	$menulist[$value]['url'] = $menuAction[$value];
}
$smarty->assign('menulist', $menulist);
	
// Include action
if(file_exists("inc/$action.php"))
	include "inc/$action.php";

// Global temlate vars
$smarty->assign('action', $action);
$smarty->assign('baseUrl', $baseUrl);
$smarty->assign('langAction', $smarty->get_config_vars("lang_".$action));

// Template
$smarty->display("index.tpl");
		
geoip_close($gi);
?>