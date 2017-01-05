<?php
$config_file = "config.ini";
$cs = 0;
$lang = "en";
$theme = "main";
$cstheme = "main";

// Default config
$conf_type = array(
	'password' => array('mysql_password'),
	'number' => array('activateTime', 'gravatarSize', 'playerPerPage', 'mapsPerPage', 'playersPerPage', 'achievPerPage')
);

$dconf = array (
	'timezone' => 'Europe/Moscow',
	'charset' => 'utf-8',

	'mysql_user' => 'lonis',
	'mysql_password' => '',
	'mysql_host' => 'localhost',
	'mysql_db' => 'lonis',
	'mysql_prefix' => 'lonis_',
	
	'server_name' => '[K.lan] Counter-Strike',
	'email' => 'admin@klan-hub.ru',
	
	'activateTime' => 60 * 60 * 24 * 3,		
	'gravatarSize' => 150,
	'playerPerPage' => 20,
	'mapsPerPage' => 20,
	'playersPerPage' => 20,
	'achievPerPage' => 5,
	
	'image_cc' => "https://cosy-climbing.net/img/maps/%map%.png",
	'image_xj' => "http://xtreme-jumps.eu/e107_plugins/lgsl_menu/images/mapz/halflife2/cstrike/%map%.jpg",

	'download_cc' => "https://cosy-climbing.net/files/maps/%map%.rar",
	'download_xj' => "http://files.xtreme-jumps.eu/maps/%map%.rar",
	
	'demos_cc' => "https://cosy-climbing.net/files/demos/%demo%.rar",
	'demos_xj' => "http://files.xtreme-jumps.eu/demos/%demo%.rar",	
	
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
$menu = parse_menu('servers|players|achiev_players|achiev|kz_players|kz_maps|kz_duels|reg|login');
$menuLogged = parse_menu('servers|players|achiev_players|achiev|kz_players|kz_maps|kz_duels|logout');
$menuCS = parse_menu('kz_players|kz_maps|kz_duels');
$menuAdmin = parse_menu('admin_servers|admin_achiev|admin_langs|admin_players');

$ActionList  = array (
	"setup" => "/setup/",
	"admin_servers" => "/admin/servers",
	"admin_langs" => "/admin/langs",
	"admin_achiev" => "/admin/achiev",
	"admin_players" => "/admin/players",
	"servers" => "/servers/",
	"players" => "/players/",
	"achiev_players" => "/achiev/players",
	"achiev" => "/achiev/",
	"kz_players" => "/kreedz/players",
	"kz_maps" => "/kreedz/maps",
	"kz_duels" => "/kreedz/duels",
	"reg" => "/reg/",
	"ucp" => "/ucp/",
	"steam_login" => "/steam/",
	"login" => "/login/",
	"logout" => "/logout/"
	);

// The sequence is important
$parseRules = array(
	"/^error(\/([0-9]+))/" => "index.php?action=error&err=%2%",
	"/^setup?(\/(logout))?/" => "index.php?action=setup&acts=%2%",
	"/^reg\/(.*)/" => "index.php?action=reg&key=%1%",
	"/^login/" => "index.php?action=login",
	"/^logout/" => "index.php?action=login&logout=1",
	"/^ucp/" => "index.php?action=ucp",

	"/^admin\/([0-9a-zA-Z_!]+)?(\/page([0-9]+))?/" => "index.php?action=admin_%1%&page=%3%",
	
	"/^servers?(\/(.*))/" => "index.php?action=servers&addr=%2%",
	
	"/^players\/(.*)?(\/page([0-9]+))?/" => "index.php?action=players&search=%1%&page=%3%",	
	
	"/^achiev_players(\/page([0-9]+))?/" => "index.php?action=achiev_players&page=%2%",
	"/^achiev\/players(\/page([0-9]+))?/" => "index.php?action=achiev_players&page=%2%",	
	"/^achiev?(\/page([0-9]+))?(\/)?(.*)?/" => "index.php?action=achiev&page=%2%&aname=%4%",
	"/^(.*)\/achiev?(\/page([0-9]+))?/" => "index.php?action=achiev&name=%1%&page=%3%",
	
	"/^kreedz\/duels?(\/page([0-9]+))?/" => "index.php?action=kz_duels&page=%2%",
	"/^kreedz\/players?(\/(pro|noob|all))?(\/page([0-9]+))?(\/(num|top1))?/" => "index.php?action=kz_players&type=%2%&sort=%6%&page=%4%",
	"/^kreedz\/maps?(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_maps&page=%4%&type=%2%&rec=%6%",
	"/^kreedz\/([0-9a-zA-Z_!]+)?(\/(pro|noob|all))?(\/page([0-9]+)?)?/" => "index.php?action=kz_map&map=%1%&type=%3%&page=%5%",
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?(\/(num|top1))?/" => "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%&sort=%9%",
	
	"/^(.*)/" => "index.php?action=player&name=%1%",
);

$langs = array(
	"langTitle" => "Lonis",

	"langThemeNotFound" => "Theme not found",

	"lang_logout" => "Logout",
	"lang_login" => "Login",

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
	"lang_achievPerPage" => "Achiev per page", 
	"lang_langlist" => "Language list (space specarate)",
	"lang_lang" => "Language default" ,
	"lang_themelist" => "Theme list (space specarate)",
	"lang_theme" => "Theme default",
	"lang_cstheme" => "Theme default in CS",
	"lang_email" => "E-mail",
	"lang_cookieKey" => "Cookie Key",
	'lang_image_cc' => "Image from CC",
	'lang_image_xj' => "Image from XJ",
	'lang_download_cc' => "Download map CC",
	'lang_download_xj' => "Download map XJ",	
	'lang_demos_cc' => "Download demos CC",
	'lang_demos_xj' => "Download demos XJ",	
	
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