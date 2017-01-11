<?php
$i=$j=$k=$n=$m=0;
$config_file = "config.ini";
$cs = 0;
$lang = "en";
$theme = "default";
$cstheme = "default";

$avatarSize = array(
	"Icon" => 24,
	"Medium" => 80,
	"Full" => 150,
);
	
// Default config
$conf_type = array(
	'password' => array('mysql_password'),
	'number' => array(
		'activateTime', 
		'gravatarSize', 
		'playerPerPage', 
		'mapsPerPage', 
		'playersPerPage', 
		'achievPerPage',
		'achievPlayersPerPage',
		'server_update'
		)
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
	'playerPerPage' => 15,
	'mapsPerPage' => 15,
	'playersPerPage' => 15,
	'achievPerPage' => 50,
	'achievPlayersPerPage' => 10,
	'server_update' => 60 * 30,
	
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
$menuStart = "home";
$menu = parse_menu('home|servers|players|achiev|kz_players|kz_maps|kz_duels|auth');
$menuLogged = parse_menu('home|servers|players|achiev|kz_players|kz_maps|kz_duels|logout');
$menuCS = parse_menu('kz_players|kz_maps|kz_duels');
$menuAdmin = parse_menu('admin_servers|admin_achiev|admin_langs|admin_players');

$ActionList  = array (
	"home" => "/home/",
	"setup" => "/setup/",
	"admin_servers" => "/admin/servers/",
	"admin_langs" => "/admin/langs/",
	"admin_achiev" => "/admin/achiev/",
	"admin_players" => "/admin/players/",
	"servers" => "/servers/",
	"players" => "/players/",
	"achiev" => "/achiev/",
	"kz_players" => "/kreedz/players/",
	"kz_maps" => "/kreedz/maps/",
	"kz_duels" => "/kreedz/duels/",
	"ucp" => "/ucp/",
	"steam" => "/steam/",
	"auth" => "/auth/",
	"logout" => "/logout/"
	);

// The sequence is important
$parseRules = array(
	"/^error\/([0-9]+)/" => "index.php?action=error&err=%1%",
	"/^setup\/(.*)/" => "index.php?action=setup&acts=%1%",
	"/^auth\/(.*)/" => "index.php?action=auth&key=%1%",
	"/^logout/" => "index.php?action=auth&act=logout",
	"/^ucp/" => "index.php?action=ucp",
	"/^steam/" => "index.php?action=steam",
	"/^home/" => "index.php?action=home",
	
	"/^admin\/([0-9a-zA-Z_!]+)?(\/page([0-9]+))?(\/(.*))?/" => "index.php?action=admin_%1%&page=%3%&search=%5%",
	
	"/^servers\/(page([0-9]+))?(\/(.*))?/" => "index.php?action=servers&page=%2%&addr=%4%",
	
	"/^players\/(name|achiev|country)?(-)?(asc|desc)?(\/page([0-9]+))?(\/(.*))?/" => "index.php?action=players&order=%1%&sort=%3%&page=%5%&search=%7%",
		
	"/^achiev\/(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=achiev&page=%2%&aname=%4%",
	"/^achievs\/(page([0-9]+))?/" => "index.php?action=achiev&page=%2%&act=achievs",
	"/^(.*)\/achiev\/(page([0-9]+))?/" => "index.php?action=achiev&name=%1%&page=%3%",
	
	"/^kreedz\/duels\/(page([0-9]+))?/" => "index.php?action=kz_duels&page=%2%",
	"/^kreedz\/players\/((pro|noob|all))?(\/page([0-9]+))?(\/(num|top1))?/" => "index.php?action=kz_players&type=%2%&sort=%6%&page=%4%",
	"/^kreedz\/maps\/((pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?(\/(.*))?/" => "index.php?action=kz_maps&type=%2%&page=%4%&rec=%6%&map=%8%",
	"/^kreedz\/([0-9a-zA-Z_!]+)?(\/(pro|noob|all))?(\/page([0-9]+)?)?/" => "index.php?action=kz_map&map=%1%&type=%3%&page=%5%",
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?(\/(num|top1))?/" => "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%&sort=%9%",
	
	"/^(.*)/" => "index.php?action=player&name=%1%",
);

$langs = array(
	"Title" => "Lonis",

	"ThemeNotFound" => "Theme not found",

	"logout" => "Logout",
	"login" => "Login",

	"Error" => "Error",
	"UserNotFound" => "Not found user entered data!",
	
	"Name" => "Name",
	"Password" => "Password",
	"Update" => "Update",
	"Current" => "Current",

	"setup" => "Setup config",
	"Save" => "Save",
	"Saved" => "Saved",
	"Reset" => "Reset",
	"ResetDef" => "Reset to default",
	"Confirm" => "Confirmed action",
	"timezone" => "Time zone",
	"charset" => "Charset",
	"mysql_user" => "User db",
	"mysql_password" => "Password db",
	"mysql_host" => "Host db",
	"mysql_db" => "Database",
	"mysql_prefix" => "Prefix db",
	"server_name" => "Server Name",
	"activateTime" => "Activation time e-mail",
	"baseUrl" => "Url site",
	"gravatarSize" => "Avatar size",
	"playerPerPage" => "Players per page",
	"mapsPerPage" => "Maps per page",
	"playersPerPage" => "Players per page KZ",
	"achievPerPage" => "Achiev per page",
	"achievPlayersPerPage" => "Achiev Players per page",	
	"server_update" => "Timer updated servers",
	"cookieKey" => "Cookie Key",
	"email" => "E-mail",
	
	"setupGeneral" => "General setting",
	"setupDb" => "Database",
	"Generate" => "Generate",
	"setupLang" => "Languages",
	"DbTitle" => "Working with database",
	"Base" => "DB",
	"Tables" => "Tables",
	"Data" => "Data",
	"Create" => "Create",
	"Delete" => "Delete",
	"Save" => "Save",
	"Add" => "Add",
	"Clear" => "Clear",
	"Edit" => "Edit",
	"DbNotConnect" => "Not connection to database",
	"DbNotTablesFile" => "File with tables not found",
	"DbNotDataFile" => "File with data not found",
	);
?>