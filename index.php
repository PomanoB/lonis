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

//$smarty->error_reporting = E_ALL & ~E_NOTICE;

$config_dir = $smarty->getConfigDir();

// Read setting from config file or create default
$config_path = $config_dir[0].'/'.$config_file;
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

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password);
if($db) {
	$conn = 1;
	if (!mysqli_select_db($db, $mysql_db)) $conn = 0;
	if (!mysqli_fetch_assoc(mysqli_query($db, "show tables"))) $conn = 0;
	
	mysqli_query($db, "SET NAMES ".$charset);
}
else
	$conn = 0;


	
// Connect to mysql
if($action!="setup" && !$conn) {	
	header("Location: $baseUrl/action/setup");
}

$smarty->assign('conn', $conn);

if($conn) {
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
	$r = mysqli_query($db, "SELECT * FROM `langs` WHERE `lang`='$lang'");
	while($row = mysqli_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["value"];
	}

	$r = mysqli_query($db, "SELECT * FROM `lang` ORDER BY `name`");
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1)
			$lang = $row['lang'];
		
		$langselect[$row['lang']] = $row["name"];
	}
	$smarty->assign('langselect', $langselect);

	$langs = array_replace($langs, $dblangs);
	unset($dblangs);

	// Read themes
	$q = "SELECT * FROM `themes` LEFT JOIN `themes_lang` 
			ON `themes`.`id` = `themesid` WHERE `lang` = '$lang'";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1) $theme = $row['theme'];
		if($row['cs']==1) $cstheme = $row['theme'];
			
		$themeselect[$row['theme']] = $row["name"];
	}
	$smarty->assign('themeselect', $themeselect);

	if (isset($_POST["theme"]))
	{
		if (file_exists('templates/css/theme_'.$_POST["theme"].'.css')) {
			$theme = $_POST["theme"];
			$_SESSION["unr_theme_$cookieKey"] = $_POST["theme"];
		}
		else {
			$langTheme1 = $themeselect[$theme];
			$langTheme2 = $langs["langThemeNotFound"];
		echo "<script>alert('$langTheme1 $langTheme2')</script>";
		}
	}
}

// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);
	
// Set all langs to Smarty
foreach($langs as $key=>$value) {
	$smarty->assign($key, $value);
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
	$_SESSION["unr_theme_$cookieKey"] = $cstheme;
	$menu = $menuCS;
}

if (isset($_SESSION["unr_theme_$cookieKey"]))
	$theme = $_SESSION["unr_theme_$cookieKey"];

$smarty->assign('cs', $cs);
$smarty->assign('theme', $theme);

// Select Player
$webadmin = 0;
if (isset($_SESSION["user_$cookieKey"]["id"]) && $action!="setup") {
	"SELECT * FROM `unr_players` WHERE `id`= ".$_SESSION["user_$cookieKey"]["id"];
	$r = mysqli_query($db, "SELECT * FROM `unr_players` WHERE `id`= ".$_SESSION["user_$cookieKey"]["id"]);
	if ($row = mysqli_fetch_assoc($r)) {
		foreach($row as $key => $value) {
			$_SESSION["user_$cookieKey"][$key] = $value;
		}
		
		if($row["webadmin"]==1) $webadmin = 1;
		
		$smarty->assign('user', $_SESSION["user_$cookieKey"]);
		
	}
	else
		unset($_SESSION["user_$cookieKey"]);
	
	$menu = $menuLogged;
}

$smarty->assign('webadmin', $webadmin);

// Get name from DB
if (isset($_GET["name"])) {
	$name = $_GET["name"];
	$q = "SELECT * FROM `unr_players` WHERE `name` = '$name' OR `name` = REPLACE('$name', '_', ' ') LIMIT 1";	
	$r = mysqli_query($db, $q);
	if($info = mysqli_fetch_assoc($r))
		$playerId = $info["id"];
}

if($action!="setup") {
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
}

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

$smarty->assign('cake', mt_rand(1, 5));

// Template
$smarty->display("index.tpl");

// Last URL
$_SESSION["lastUrl_$cookieKey"] = $baseUrl;

unset($_GLOBALS);
unset($_GET);
unset($_POST);
		
geoip_close($gi);
?>