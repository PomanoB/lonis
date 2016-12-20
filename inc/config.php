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
$menu = array(
	'home',
	'players',
	'achiev_players',
	'achiev',
	'kz_players',
	'kz_maps',
	'kz_duels',
	'auth' => 'login',
	'reg' => 'reg',
);

$menuUnLogged = array(
	'auth' => 'logout',
	'reg' => '-'
);
	
$menuCS = array(
	1 => 'kz_players',
	2 => 'kz_maps',
	3 => 'kz_duels',
);

// Menu List
$menuadmin = array(
	'admin_achiev',
	'admin_lang',
);

// The sequence is important
$ActionList  = "setup|admin_lang|admin_achiev";
$ActionList .= "|";
$ActionList .= "home|players|kz_maps|achiev_players|achiev|reg|kz_duels|kz_players|ucp|steam_login|login|logout";

// The sequence is important
$parseRules = array(
	"/^error(\/([0-9]+))?/" => "index.php?action=error&err=%2%",
	"/^reg\/(.*)/" => "index.php?action=reg&key=%1%",
	"/^logout/" => "index.php?action=login&logout=1",
	"/^setup\/logout?/" => "index.php?action=setup&logout=1",
	"/^achiev\/players(\/page.([0-9]+))/" => "index.php?action=achiev_players&page=%2%",
	"/^achiev\/(.*)/" => "index.php?action=achiev&aname=%1%",
	"/^players\/(.*)\/page.([0-9]+)/" => "index.php?action=players&search=%1%&page=%2%",
	"/^steam?/" => "index.php?action=steam_login",	
	"/^($ActionList)(\/)?(\/page([0-9]+))?/" => "index.php?action=%1%&page=%4%",
	"/^(.*)\/achiev/" => "index.php?action=achiev&name=%1%",
	
	"/^kreedz\/players(\/(pro|noob|all))?(\/(num|top1))?(\/page([0-9]+))?/" => "index.php?action=kz_players&type=%2%&sort=%4%&page=%6%",
	"/^kreedz\/map\/([0-9a-zA-Z_\s!]+)?(\/(pro|noob|all))?(\/page([0-9]+)?)?/" => "index.php?action=kz_map&map=%1%&type=%3%&page=%5%",
	"/^kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_maps&page=%4%&type=%2%&rec=%6%",
	
	"/^unrid([0-9]+)?(\/kreedz)?(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_player&id=%1%&type=%4%&page=%6%&rec=%8%",
	
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%",
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
);
?>