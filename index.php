<?php

if(!file_exists("inc/error.php") || !file_exists("templates/error.tpl")) {
	echo "Error... Die.";
	die();
}

error_reporting(E_ALL | E_STRICT);

$starttime = microtime(true);

session_start();

define('IN_KZ_TOP', 1);

include "inc/config.php";
include "inc/function.php";
include "inc/function_sql.php";
include "inc/smarty_unr.php";

// Read setting from config.php
$conf = $conf_def;
foreach($conf as $key=>$value) {
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

// Config DIR;
$config_dir = $docRoot;

// Read setting from config file or create default
$config_path = $config_dir.'/'.$config_file;
$dbconf = $dbconf_def;
if(file_exists($config_path))	
	$dbconf = array_replace($dbconf, parse_ini_file($config_path));
else
	save_config_file($config_path, $dbconf_def);

foreach($dbconf as $key=>$value) {
	$$key = $value;	
}

// Connect to mysql
$db = @mysqli_connect($mysql_host, $mysql_user, $mysql_password);
$errno = mysqli_connect_errno($db);
if(!$errno) {
	$errno = !mysqli_select_db($db, $mysql_db);
	if(!$errno) $errno = mysqli_fetch_assoc(mysqli_query($db, "show tables")) ? 0 : 1;
}
	
if($action!="setup" && $errno) $action = "setup";

if(!$errno) {
	mysqli_query($db, "SET NAMES ".$charset);
	
	$is_config = mysqli_result(mysqli_query($db, "SHOW TABLES FROM {$mysql_db} like 'config'"), 0);
	if(!$is_config) {
		createConfigTable($db, $conf_def, $conf_type);
	}
	else
		$conf = array_replace($conf_def, getConfigVar($db));
	
	// Read defaul language
	$langselect = getLang($db);
	
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
	
	$dblangs = getLangs($db, $lang);
	$langs = array_replace($langs, $dblangs);	
	
	// Read themes
	$themeselect = getThemes($db, $lang);

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
	
	$menus = getMenus($db, $lang);
	$menu = $menus["normal"];
	$menuAdmin = $menus["admin"];
	
	$user = isset($_SESSION["user_$cookieKey"]) ? $_SESSION["user_$cookieKey"] : 0;
	$admin =  $user ? mysqli_result(mysqli_query($db, "SELECT `webadmin` FROM `unr_players` WHERE `id` = '{$user["id"]}'"), 0) : 0;	
}


	
// Set locale
setlocale(LC_ALL, $lang.'_'.$lang.'.'.$charset);

// Config
foreach($conf as $key=>$value) {
	$$key = $value;
}
	
// CS Style
$cs = isset($_SESSION["cs_$cookieKey"]) ? $_SESSION["cs_$cookieKey"] : $cs;
assign('cs', $cs);

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
}

// Session themes
if (isset($_SESSION["unr_theme_$cookieKey"])) {
	$theme = $_SESSION["unr_theme_$cookieKey"];
}

$cake = mt_rand(1, 5);

// Include
if(file_exists("inc/$action.php"))
	include "inc/$action.php";

// All assign
foreach($GLOBALS as $key=>$value) $smarty->assign($key, $value);

// Template
$smarty->display("index.tpl");
	
?>