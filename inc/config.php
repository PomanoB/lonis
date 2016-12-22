<?php
$config_file = "config.ini";
$config_lang = "lang.ini";
$cs = 0;

// Default config
$conf_type = array(
	'password' => array('mysql_password'),
	'number' => array('activateTime', 'gravatarSize', 'playerPerPage', 'mapsPerPage', 'playersPerPage')
);

$dconf = array (
	'timezone' => 'Europe/Moscow',
	'charset' => 'utf-8',

	'mysql_user' => 'lonis',
	'mysql_password' => '',
	'mysql_host' => 'localhost',
	'mysql_db' => 'lonis',
	'mysql_prefix' => 'lonis_',
	
	'server_name' => 'Server Name',
	'email' => 'admin@site.ru',
	
	'activateTime' => 60 * 60 * 24 * 3,		
	'gravatarSize' => 150,
	'playerPerPage' => 20,
	'mapsPerPage' => 20,
	'playersPerPage' => 20,

	'langlist' => "en ru",
	'lang' => "en",	
	'themelist' => "main white image null",
	'theme' => "main",
	'cstheme' => "main",
	
	'image_cc' => "https://cosy-climbing.net/img/maps/%map%.png",
	'image_xj' => "http://xtreme-jumps.eu/e107_plugins/lgsl_menu/images/mapz/halflife2/cstrike/%map%.jpg",

	'download_cc' => "https://cosy-climbing.net/files/maps/%map%.rar",
	'download_xj' => "http://files.xtreme-jumps.eu/maps/%map%.rar",
	
	'demos_cc' => "https://cosy-climbing.net/files/maps/%demo%.rar",
	'demos_xj' => "http://files.xtreme-jumps.eu/maps/%demo%.rar",	
	
	'cookieKey' => "cc1f891423db1ee24498e76f3b107bbe"
);

$additional_flags = array(
	'green_chat' => 't'
);

$menu_footer = array(
	'Gm# Staff' => 'http://klan-hub.ru',
	'PomanoB' => 'http://klan-hub.ru/index.php?page=feedback',
	'Jeronimo' => 'http://leopold-soft.narod.ru',
);

// Menu List
$menuStart = "servers";
$menu = 'servers|players|achiev_players|achiev|kz_players|kz_maps|kz_duels|reg|login';
$menuLogged = 'servers|players|achiev_players|achiev|kz_players|kz_maps|kz_duels|logout';
$menuCS = 'kz_players|kz_maps|kz_duels';
$menuAdmin = 'admin_achiev|admin_lang|admin_players';

$menu = parse_menu($menu);
$menuLogged = parse_menu($menuLogged);
$menuCS = parse_menu($menuCS);
$menuAdmin = parse_menu($menuAdmin);

// The sequence is important
$ActionList  = "setup|admin_lang|admin_achiev|admin_players|servers|players|kz_maps|achiev_players|achiev|reg|kz_duels|kz_players|ucp|steam_login|login|logout";
$ActionList = action_sort($ActionList);

// The sequence is important
$parseRules = array(
	"/^error(\/([0-9]+))?/" => "index.php?action=error&err=%2%",
	"/^reg\/(.*)/" => "index.php?action=reg&key=%1%",
	"/^logout/" => "index.php?action=login&logout=1",
	"/^setup\/logout?/" => "index.php?action=setup&logout=1",
	"/^achiev\/players(\/page([0-9]+))/" => "index.php?action=achiev_players&page=%2%",
	"/^achiev\/(.*)/" => "index.php?action=achiev&aname=%1%",
	"/^players\/(.*)\/page([0-9]+)/" => "index.php?action=players&search=%1%&page=%2%",	
	"/^(.*)\/achiev/" => "index.php?action=achiev&name=%1%",
	"/^kreedz\/players(\/(pro|noob|all))?(\/(num|top1))?(\/page([0-9]+))?/" => "index.php?action=kz_players&type=%2%&sort=%4%&page=%6%",
	"/^kreedz\/\/(pro|noob|all)?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_maps&page=%3%&type=%1%&rec=%5%",
	"/^kreedz\/([0-9a-zA-Z_!]+)?(\/(pro|noob|all))?(\/page([0-9]+)?)?/" => "index.php?action=kz_map&map=%1%&type=%3%&page=%5%",
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%",
	"/^($ActionList)?(\/page([0-9]+))?/" => "index.php?action=%1%&page=%3%",
	"/^(.*)/" => "index.php?action=player&name=%1%",
);

$langs = array(
	"langTitle" => "Lonis",

	"langLang_en" => "English",

	"langTheme_main" => "Standart",
	"langTheme_white" => "Invert",
	"langTheme_image" => "Images",
	"langTheme_null" => "Empty",
	"langThemeNotFound" => "Theme not found",

	"lang_home" => "Home",
	"lang_ucp" => "Profile",
	"lang_logout" => "Logout",
	"lang_player" => "Player",
	"lang_login" => "Login",
	"lang_reg" => "Register",
	"lang_players" => "Players",
	"lang_achiev" => "Achievs",
	"lang_achiev_players" => "Achievs players",
	"lang_kz_duels" => "KZ Duels",
	"lang_kz_maps" => "KZ Maps",
	"lang_kz_players" => "KZ Players",
	"lang_admin_achiev" => "Setup achiev",
	"lang_admin_lang" => "Dictonaries",

	"langError" => "Error",
	"langUserNotFound" => "Not found user entered data!",
	
	"langName" => "Name",
	"langPassword" => "Password",
	"langUpdate" => "Update",
	"langCurrent" => "Current",

	"lang_setup" => "Setup config",
	"langSave" => "Save",
	"langSaved" => "Saved",
	"langReset" => "Reset",
	"langResetDef" => "Reset to default",
	"langConfirm" => "Confirmed action",
	"lang_timezone" => "Time zone",
	"lang_charset" => "Charset",
	"lang_mysql_user" => "User db",
	"lang_mysql_password" => "Password db",
	"lang_mysql_host" => "Host db",
	"lang_mysql_db" => "Database",
	"lang_mysql_prefix" => "Prefix db",
	'lang_server_name' => 'Server Name',
	"lang_activateTime" => "Activation time e-mail",
	"lang_baseUrl" => "Url site",
	"lang_gravatarSize" => "Avatar size",
	"lang_playerPerPage" => "Players per page",
	"lang_mapsPerPage" => "Maps per page",
	"lang_playersPerPage" => "Players per page KZ",
	"lang_langlist" => "Language list (space specarate)",
	"lang_lang" => "Language default" ,
	"lang_themelist" => "Theme list (space specarate)",
	"lang_theme" => "Theme default",
	"lang_cstheme" => "Theme default in CS",
	"lang_email" => "E-mail",
	"lang_cookieKey" => "Cookie Key",

	"lang_setupGeneral" => "General setting",
	"lang_setupDb" => "Database",
	"langGenerate" => "Generate",
	"lang_setupLang" => "Languages",
	"langDbTitle" => "Working with database",
	"langBase" => "DB",
	"langTables" => "Tables",
	"langData" => "Data",
	"langCreate" => "Create",
	"langDelete" => "Delete",
	"langSave" => "Save",
	"langAdd" => "Add",
	"langClear" => "Clear",
	"langEdit" => "Edit",
	"langDbNotConnect" => "Not connection to database",
	"langDbNotTablesFile" => "File with tables not found",
	"langDbNotDataFile" => "File with data not found",
	
	'lang_image_cc' => "Image from CC",
	'lang_image_xj' => "Image from XJ",

	'lang_download_cc' => "Download map CC",
	'lang_download_xj' => "Download map XJ",
	
	'lang_demos_cc' => "Download demos CC",
	'lang_demos_xj' => "Download demos XJ",	
);
?>