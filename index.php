<?php

error_reporting(E_ALL | E_STRICT);
set_time_limit(240);
$starttime = microtime(true);

session_start();

// Base URL
$baseSite = str_replace("/index.php", "", $_SERVER["PHP_SELF"]);
$bUrl = "http://{$_SERVER["HTTP_HOST"]}{$baseSite}";
$docRoot = $_SERVER['DOCUMENT_ROOT'].$baseSite;

// Global Function and Setting
require "function.php";
$conf = $conf_def;
foreach($conf as $key=>$value) { $$key = $value; }

// Read setting from config file or create default
$config_path = $docRoot.'/config.ini';
$dbconf = $dbconf_def;
if(file_exists($config_path))	
	$dbconf = array_replace($dbconf, parse_ini_file($config_path));
else
	save_config_file($config_path, $dbconf_def);

foreach($dbconf as $key=>$value) { $$key = $value; }

// Themes
$bTheme = $bUrl."/themes/".$theme;

// Read theme setting
$theme_config = "config.php";
if(file_exists($theme_config)) require $theme_config;
foreach($conf as $key=>$value) { $$key = $value; }

// Read theme setting
$theme_func = "$docRoot/themes/$theme/function.php";
if(file_exists($theme_func)) require $theme_func;

// Timezone
date_default_timezone_set($timezone);

// Parse URI
$uri = str_replace($baseSite."/", "", $_SERVER["REQUEST_URI"]);
if($uri!="") {
	$url = parse_urls(parse_uri($uri, $parseRules));
	if(isset($url["url"]) && isset($url["path"]) && $url["path"]!="index.php") {
		header("Location: ".$url["url"]);
	}
	$_GET = $url["uri"];
}

// Configs;
$style = "default";
$i=$j=$k=$n=$m=$cs=0;
$message = $search = "";

// Action
$action = isset($_GET["action"]) && $_GET["action"]!="" ? $_GET["action"] : $homepage;

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
		createConfigTable($db, $conf, $conf_type);
	}
	else
		$conf = array_replace($conf, getConfigVar($db));
	
	// Read defaul language
	$langselect = getLang($db);
	
	// Read language 
	if(isset($_GET["lang"]) && $_GET["lang"]) {
		$lang = $_GET["lang"];
		$_SESSION["lang_$cookieKey"] = $lang;
	}
	if (isset($_POST["lang"])) {
		$lang = $_POST["lang"];
		$_SESSION["lang_$cookieKey"] = $lang;
	}
		
	if (isset($_SESSION["lang_$cookieKey"])) {
		$lang = $_SESSION["lang_$cookieKey"];
	}
	else {	
		if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
			$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
		else
			$lang = "en";
	}
	
	$langs = getLangs($db, $lang);
	//$langs = array_replace($langs, $dblangs);	
	
	// Read styles
	$styleselect = getstyles($db, $lang);
	if (isset($_POST["style"])) {
		if (file_exists('themes'.$theme.'/css/style_'.$_POST["style"].'.css')) {
			$style = $_POST["style"];
			$_SESSION["style_$cookieKey"] = $_POST["style"];
		}
	}
	
	// Read Menu
	$menu = getMenus($db);
	$parent = getMenuParent($db, $action);
	
	// If Admin
	$user = isset($_SESSION["user_$cookieKey"]) ? $_SESSION["user_$cookieKey"] : 0;
	$username = mysqli_result(mysqli_query($db, "SELECT `name` FROM `players` WHERE `id` = '{$user["id"]}'"), 0);
	$admin = $user ? mysqli_result(mysqli_query($db, "SELECT `webadmin` FROM `players` WHERE `id` = '{$user["id"]}'"), 0) : 0;
}
	
// Set locale
setlocale(LC_ALL, $lang.'_'.strtoupper($lang).'.'.$charset);

// Config
foreach($conf as $key=>$value) {
	$$key = $value;
}
	
// CS Style
$cs = isset($_SESSION["cs_$cookieKey"]) ? $_SESSION["cs_$cookieKey"] : $cs;

if(isset($_GET["cs"])) { 
	$cs = $_GET["cs"];
	$_SESSION["cs_$cookieKey"] = $cs;
}
if(isset($_POST["cs"])) {
	$cs = $_POST["cs"];
	$_SESSION["cs_$cookieKey"] = $cs;
}

if($cs) {
	$_SESSION["style_$cookieKey"] = $csstyle;
}

// Session styles
if (isset($_SESSION["style_$cookieKey"])) {
	$style = $_SESSION["style_$cookieKey"];
}

$cake = mt_rand(1, 5);

// Include widget
include("include/auth.php");

// Include
$module = "include/{$action}.php";
if(file_exists($module))
	include($module);
else
	header("Location: {$bUrl}");

if(!file_exists("themes/{$theme}/{$action}.phps"))
	header("Location: {$bUrl}");	

// BODY
include("themes/{$theme}/index.phps");

?>