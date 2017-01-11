<?php
$starttime = microtime(true);
error_reporting(E_ALL | E_STRICT);

session_start();

define('IN_KZ_TOP', 1);

include "inc/function.php";
include "inc/config.php";
include "inc/smarty_unr.php";

// Smarty
$smarty = new Smarty_unr();

// Starttime
assign('starttime', $starttime);

// Read setting from config.php
foreach($dconf as $key=>$value) {
	$$key = $value;
}

// Timezone
date_default_timezone_set($timezone);

// Base URL
$baseSite = str_replace("/index.php", "", $_SERVER["PHP_SELF"]);

// Parse URI
$uri = str_replace($baseSite."/", "", $_SERVER["REQUEST_URI"]);
if($uri!="") {
	$url = parse_urls(parse_uri($uri, $parseRules));
	if(isset($url["url"]) && isset($url["path"]) && $url["path"]!="index.php") {
		header("Location: ".$url["url"]);
	}
	$_GET = $url["uri"];
}

$baseUrl = "http://{$_SERVER["HTTP_HOST"]}{$baseSite}";
$docRoot = $_SERVER['DOCUMENT_ROOT'].$baseSite;

// Debug trace
//print_p();
//print_p($_SESSION);
//print_p($_SERVER);
//die();

// Action
$action = isset($_GET["action"]) && $_GET["action"]!="" ? $_GET["action"] : $menuStart;

$config_dir = $docRoot;

// Default config vars
$conf = $dconf;

// Read setting from config file or create default
$config_path = $config_dir.'/'.$config_file;
if(file_exists($config_path)) {
	$conf = array_replace($dconf, parse_ini_file($config_path));
	foreach($conf as $key=>$value) {
		$$key = $value;
	}
}
else {
	save_config_file($config_path, $conf);
}
assign("conf", $conf);

$db = @mysqli_connect($mysql_host, $mysql_user, $mysql_password);
$conn = mysqli_connect_errno($db);
if(!$conn) {
	$conn = 1;
	if (!mysqli_select_db($db, $mysql_db)) 
		$conn = 0;
	else
		if (!mysqli_fetch_assoc(mysqli_query($db, "show tables"))) $conn = 0;
	
	mysqli_query($db, "SET NAMES ".$charset);
}
else
	$conn = 0;
	
// Connect to mysql
if($action!="setup" && !$conn)
	header("Location: $baseUrl/setup/");

assign('conn', $conn);

if($conn) {
	// Get From unr_players
	$name = isset($_GET["name"]) ? url_replace($_GET["name"], BACK) : "";
	$id = isset($_GET["id"]) ? abs((int)$_GET["id"]) : 0;
	$player = getPlayerFormDB($db, $name, $id);
	assign('player', $player);

	// Read defaul language
	$r = mysqli_query($db, "SELECT * FROM `lang` WHERE `use` = 1 ORDER BY `name` ");
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1)
			$lang_def = $row['lang'];
		
		$langselect[$row['lang']] = $row["name"];
	}
	assign('langselect', $langselect);

	// Read language 
	if (isset($_POST["lang"])) {
		$lang = $_POST["lang"];
		$_SESSION["unr_lang_$cookieKey"] = $lang;
	}
		
	if (isset($_SESSION["unr_lang_$cookieKey"])) {
		$lang = $_SESSION["unr_lang_$cookieKey"];
	}
	else {	
		if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
			$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
		else
			$lang = $lang_def;
	}
	
	// Read language from file
	$dblangs = array();
	$r = mysqli_query($db, "SELECT * FROM `langs` WHERE `lang`='$lang'");
	while($row = mysqli_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["value"];
	}

	$langs = array_replace($langs, $dblangs);
	unset($dblangs);	
	assign('lang', $lang);
	
	// Read themes
	$q = "SELECT * FROM `themes` LEFT JOIN `themes_lang` ON `themes`.`id` = `themesid` WHERE `lang` = '$lang'";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1) $theme = $row['theme'];
		if($row['cs']==1) $cstheme = $row['theme'];
			
		$themeselect[$row['theme']] = $row["name"];
	}
	assign('themeselect', $themeselect);

	if (isset($_POST["theme"]))
	{
		if (file_exists('templates/css/theme_'.$_POST["theme"].'.css')) {
			$theme = $_POST["theme"];
			$_SESSION["unr_theme_$cookieKey"] = $_POST["theme"];
		}
		else {
			$langTheme1 = $themeselect[$theme];
			$langTheme2 = $langs["ThemeNotFound"];
		echo "<script>alert('$langTheme1 $langTheme2')</script>";
		}
	}
}

// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);
	
// Set all langs to Smarty
assign("langs", $langs);
	
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

assign('cs', $cs);
assign('theme', $theme);

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
		
		assign('user', $_SESSION["user_$cookieKey"]);
	}
	else
		unset($_SESSION["user_$cookieKey"]);
	
	$menu = $menuLogged;
}
assign('webadmin', $webadmin);

if($action!="setup") {
	// Menu
	function create_menu($menu) {
		global $langs, $ActionList;
		
		foreach($menu as $key=>$item) {
			$val = explode("|", $item);
			if($item!="-") {
				$menulist[$key]["item"] = $item;
				$menulist[$key]["name"] = $langs[$val[0]];
				$menulist[$key]["url"] = $ActionList[$val[0]];
				if(isset($val[1])) {
					foreach($val as $k=>$subitem) {
						$menulist[$key][$k]["name"] = $langs[$subitem];
						$menulist[$key][$k]["url"] = $ActionList[$subitem];	
					}	
				}
			}
		}
		
		return $menulist;
	}

	assign('menulist', create_menu($menu));
	assign('menuadminlist', create_menu($menuAdmin));
}

// Menu Footer
assign('menu_footer', $menu_footer);
	
// Include action
if(file_exists("inc/$action.php"))
	include "inc/$action.php";

if(!file_exists("templates/$action.tpl"))
	header("Location: $baseUrl/error/404");

// Global temlate vars
assign('baseUrl', $baseUrl);
assign('action', $action);
assign('cake', mt_rand(1, 5));
assign('cake_pl', mt_rand(0, 9));

// Template
$smarty->display("index.tpl");

// Last URL
$_SESSION["lastUrl_$cookieKey"] = $baseUrl;

unset($_GLOBALS);
unset($_GET);
unset($_POST);

/* FUNCTIONS */

// Get Player from DB
function getPlayerFormDB($db, $name, $id) {
	$name = slashes($name);
		
	$q = "SELECT * FROM `unr_players` WHERE `name` = '{$name}' OR `id` = {$id} ORDER BY `id` LIMIT 1";	
	$r = mysqli_query($db, $q);
	$player = mysqli_fetch_assoc($r);
	
	if(!isset($player)) {
		$player["id"] = $id;
		$player["name"] = $name;
	}
	
	$player["name_url"] = url_replace($player["name"]);
	
	return $player;
}

function geoip($db, $ip, $lang) {
	if(isset($ip) && $ip!="") {
		$q = "SELECT `code`, `country_name` as `country` FROM
					(SELECT * FROM `geoip_whois` WHERE `ip_to` >= INET_ATON('{$ip}') ORDER BY `ip_to` ASC LIMIT 1) AS `cnt`,
					`geoip_locations`
				WHERE `code` = `country_iso_code` AND `locale_code` = '{$lang}'";
		return mysqli_fetch_assoc(mysqli_query($db, $q));
	}
	else 
		return 0;
}
	
?>