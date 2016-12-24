<?php
error_reporting(E_ALL | E_STRICT);

session_start();

define('IN_KZ_TOP', 1);

include "inc/function.php";
include "inc/config.php";
include "inc/smarty_unr.php";
//include "inc/geoip/geoip.inc";
include "inc/geoip/geoipcity.inc";

// Geo IP
$gi = geoip_open("inc/geoip/GeoIPCity.dat", GEOIP_STANDARD);

// Read setting from config.php
foreach($dconf as $key=>$value) {
	$$key = $value;
}

// Timezone
date_default_timezone_set($timezone);

// Base URL
$baseUrl = str_replace("/index.php", "", $_SERVER["PHP_SELF"]);

// Parse URI
$uri = str_replace($baseUrl."/", "", $_SERVER["REQUEST_URI"]);
if($uri!="") {
	$url = parse_urls(parse_uri($uri, $parseRules));
	if(isset($url["url"]) && isset($url["path"]) && $url["path"]!="index.php") {
		header("Location: ".$url["url"]);
	}
	$_GET = $url["uri"];
}

$baseUrl = "http://{$_SERVER["HTTP_HOST"]}{$baseUrl}";

// Debug trace

//print_p();
//print_p($_SESSION);
//print_p($_SERVER);
//die();

// Action
$action = isset($_GET["action"]) && $_GET["action"]!="" ? $_GET["action"] : $menuStart;

// Smarty
$smarty = new Smarty_unr();
$config_dir = $smarty->config_dir;

// Read setting from config file or create default
$config_path = $config_dir.'/'.$config_file;
if(file_exists($config_path)) {
	$conf = array_replace($dconf, parse_ini_file($config_path));
	foreach($conf as $key=>$value) {
		$$key = $value;
	}
}
else {
	$conf = $dconf;
	save_config_file($config_path);
}

// Connect to mysql
$conn = db_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db, $charset);
if($action!="setup" && !$conn) {	
	header("Location: $baseUrl/action/setup");
}

// Read language 
if (isset($_POST["lang"])) {
	$lang = $_POST["lang"];
	$_SESSION["unr_lang_$cookieKey"] = $lang;
}
	
if (isset($_SESSION["unr_lang_$cookieKey"]))
	$lang = $_SESSION["unr_lang_$cookieKey"];
else	
	if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
		$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
	
$smarty->assign('lang', $lang);

// Read language from file
$dblangs = array();
if($conn) {
	$r = mysql_query("SELECT * FROM `lang` WHERE `lang`='$lang'");
	while($row = mysql_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["value"];
	}
}

$langs = array_replace($langs, $dblangs);
unset($dblangs);

foreach($langs as $key=>$value) {
	$smarty->assign($key, $value);
}

// Lang list
$langlist = explode(" ", $langlist);
foreach($langlist as $key=>$value) {
	if(!isset($langs["langLang_$value"])) 
			$langs["langLang_$value"] = "";
		
	$langselect[$value] = $langs["langLang_$value"];
}
$smarty->assign('langselect', $langselect);

// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);

// Read themes
$themelist = explode(" ", $themelist);
foreach($themelist as $key=>$value) {
	$themeselect[$value] = $langs["langTheme_$value"];
}
$smarty->assign('themeselect', $themeselect);

if (isset($_POST["theme"]))
{
	if (file_exists('templates/css/theme_'.$_POST["theme"].'.css')) {
		$theme = $_POST["theme"];
		$_SESSION["unr_theme_$cookieKey"] = $_POST["theme"];
	}
	else {
		$langTheme1 = $langs["langTheme_".$_POST["theme"]];
		$langTheme2 = $langs["langThemeNotFound"];
	echo "<script>alert('$langTheme1 $langTheme2')</script>";
	}
}

// CS Style
$cs = isset($_SESSION["cs_$cookieKey"]) ? $_SESSION["cs_$cookieKey"] : $cs;
if(isset($_GET["cs"])) { 
	$cs = $_GET["cs_$cookieKey"];
	$_SESSION["cs_$cookieKey"] = $cs;
}
if(isset($_POST["cs"])) {
	$cs = $_POST["cs_$cookieKey"];
	$_SESSION["cs_$cookieKey"] = $cs;
}

if($cs) {
	$smarty->assign('cs', $cs);
	$_SESSION["unr_theme_$cookieKey"] = $cstheme;
	$menu = $menuCS;
}

if (isset($_SESSION["unr_theme_$cookieKey"]))
	$theme = $_SESSION["unr_theme_$cookieKey"];

$smarty->assign('theme', $theme);

// Select Player
if (isset($_SESSION["user_$cookieKey"]["id"]) && $action!="setup") {
	"SELECT * FROM `unr_players` WHERE `id`= ".$_SESSION["user_$cookieKey"]["id"];
	$r = mysql_query("SELECT * FROM `unr_players` WHERE `id`= ".$_SESSION["user_$cookieKey"]["id"]);
	if ($row = mysql_fetch_assoc($r)) {
		foreach($row as $key => $value) {
			$_SESSION["user_$cookieKey"][$key] = $value;
		}
		
		if($row["webadmin"]==1) $smarty->assign('webadmin', 1);
		
		$smarty->assign('user', $_SESSION["user_$cookieKey"]);
		
	}
	else
		unset($_SESSION["user_$cookieKey"]);
	
	$menu = $menuLogged;
}

// Get name from DB
if (isset($_GET["name"])) {
	$name = $_GET["name"];
	$q = "SELECT * FROM `unr_players` WHERE `name` = '$name' OR `name` = REPLACE('$name', '_', ' ') LIMIT 1";	
	$r = mysql_query($q);
	if($info = mysql_fetch_assoc($r))
		$playerId = $info["id"];
}

// Menu
function create_menu($menu) {
	global $langs;
	
	foreach($menu as $key=>$item) {
		$val = explode("|", $item);
		if($item!="-") {
			$menulist[$key]["item"] = $item;
			$menulist[$key]["name"] = $langs["lang_".$val[0]];
			$menulist[$key]["url"] = "/".$val[0];
			if(isset($val[1])) {
				foreach($val as $k=>$subitem) {
					$menulist[$key][$k]["name"] = $langs["lang_$subitem"];
					$menulist[$key][$k]["url"] = "/".$subitem;	
				}	
			}
		}
	}
	
	return $menulist;
}

$smarty->assign('menulist', create_menu($menu));
$smarty->assign('menuadminlist', create_menu($menuAdmin));

// Menu Footer
$smarty->assign('menu_footer', $menu_footer);
	
// Include action
if(file_exists("inc/$action.php"))
	include "inc/$action.php";

if(file_exists("templates/$action.tpl"))
	$smarty->assign('action', $action);
else
	header("Location: $baseUrl/error/404");

// Global temlate vars
$smarty->assign('baseUrl', $baseUrl);

if(isset($langs["lang_$action"]))
	$smarty->assign('langAction', $langs["lang_$action"]);

// Template
$smarty->display("index.tpl");

// Last URL
$_SESSION["lastUrl_$cookieKey"] = $baseUrl;

$smarty->clear_all_cache();
$smarty->clear_all_assign();
unset($_GLOBALS);
unset($_GET);
unset($_POST);
		
geoip_close($gi);
?>