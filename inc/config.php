<?php
$i=$j=$k=$n=$m=$cs=0;
$message = "";

$config_file = "config.ini";
$lang = "en";
$theme = "default";
$cstheme = "default";
$menuStart = "home";

// Dirs
$dtpl = "tpl";
$dimg = "tpl/img";
$dirs = array(
	'template_dir' => 'tpl/',
	'compile_dir' => 'inc/smarty3/tplc/',
	'config_dir' => '',
	'cache_dir' => 'inc/smarty3/cache/'
);
	
// Mysql DB config
$dbconf_def = array (
	'mysql_host' => 'localhost',
	'mysql_user' => 'lonis',
	'mysql_password' => 'lonis',
	'mysql_db' => 'lonis',
	'mysql_prefix' => 'lonis_',
	
	'uq_mysql_host' => 'localhost',
	'uq_mysql_user' => 'lonis',
	'uq_mysql_password' => 'lonis',
	'uq_mysql_db' => 'lonis',
	'uq_admin_user' => "admin",
	'uq_admin_password' => "lonis",
);

// Default config
// achievAvatar: img, fa, gravatar;
// avatarD: 404, mm, identicon, monsterid, wavatar, retro, blank
$conf_def = array (
	'timezone' => 'Europe/Moscow',
	'charset' => 'utf-8',
	'server_name' => '[K.lan] Counter-Strike',
	'server_email' => 'admin@klan-hub.ru',
	'activateTime' => 60 * 60 * 24 * 3,
	'playerPerPage' => 15,
	'mapsPerPage' => 15,
	'mapsNorecPerPage' => 25,
	'playersPerPage' => 15,
	'achievPerPage' => 50,
	'achievPlayersPerPage' => 10,
	'achievAvatar' => 'gravatar',
	'server_update' => 60 * 30,
	'servers_autoupdate' => 1,	
	'avatarIcon' => 32,
	'avatarMedium' => 80,
	'avatarFull' => 150,
	'avatarD' => 'wavatar', 
	'steamAvatar' => 1, 
	'cookieKey' => "cc1f891423db1ee24498e76f3b107bbe",
	'menuStart' => 'home'
);

$conf_type = array (
	'timezone' => 'text',
	'charset' => 'text',
	'server_name' => 'text',
	'email' => 'text',
	'activateTime' => 'number',
	'playerPerPage' => 'number',
	'mapsPerPage' => 'number',
	'mapsNorecPerPage' => 'number',
	'playersPerPage' => 'number',
	'achievPerPage' => 'number',
	'achievPlayersPerPage' => 'number',
	'server_update' => 'number',
	'servers_autoupdate' => 'number',	
	'avatarIcon' => 'number',
	'avatarMedium' => 'number',
	'avatarFull' => 'number',
	'steamAvatar' => 'number',
	'cookieKey' => "text",
	'menuStart' => 'text'
);

$additional_flags = array(
	'green_chat' => 't'
);

// Menu footer
$menu_footer = array(
	'Gm# Staff' => 'http://klan-hub.ru',
	'PomanoB' => 'http://klan-hub.ru/index.php?page=feedback',
	'Jeronimo' => 'http://leopold-soft.narod.ru',
);

// Other
$cup_color = array(1=>"gold", 2=>"saddlebrown", 3=>"silver");

// Where SQL
$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR NOT (`weapon` = 16 OR `weapon` = 29))',
	'all' => ''
);

// Action List
$actionList  = array (
	"error" => "/error/",
	"home" => "/home/",
	"admin_servers" => "/admin/servers/",
	"admin_langs" => "/admin/langs/",
	"admin_achievs" => "/admin/achievs/",
	"admin_players" => "/admin/players/",
	"servers" => "/servers/",
	"players" => "/players/",
	"achiev" => "/achiev/",
	"achievs" => "/achievs/",
	"kz_players" => "/kreedz/players/",
	"kz_maps" => "/kreedz/maps/",
	"kz_duels" => "/kreedz/duels/",
	"kz_longjumps" => "/kreedz/longjumps/",
	"kz_records" => "/kreedz/records/",
	"kz_ljs_recs" => "/kreedz/records/ljs/",
	"kz_downloads" => "/kreedz/downloads/",
	"account" => "/account/",
	"steam" => "/steam/",
	"logout" => "/logout/",
	"avatar" => "/avatar/",	
);

// The sequence is important
$parseRules = array(
	"/^error\/([0-9]+)/" => "index.php?action=error&err=%1%",
	"/^setup\/(.*)/" => "index.php?action=setup&acts=%1%",
	"/^account\/(.*)/" => "index.php?action=account&key=%1%",
	"/^logout\//" => "index.php?action=account&act=logout",
	"/^steam\//" => "index.php?action=account&act=steam",
	"/^home\//" => "index.php?action=home",
	
	"/^admin\/([0-9a-zA-Z_!]+)?(\/page([0-9]+))?(\/(.*))?/" => "index.php?action=admin_%1%&page=%3%&search=%5%",
	"/^servers\/(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=servers&page=%2%&addr=%4%",
	"/^players\/(name|achiev|country)?(-)?(asc|desc)?(\/page([0-9]+))?(\/)?(.*)?/" => "index.php?action=players&order=%1%&sort=%3%&page=%5%&search=%7%",
		
	"/^achiev\/(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=achievs&page=%2%&aname=%4%",
	"/^achievs\/(page([0-9]+))?/" => "index.php?action=achievs&page=%2%&act=achievs",
	"/^(.*)\/achiev\/(page([0-9]+))?/" => "index.php?action=achievs&name=%1%&page=%3%",
	
	"/^kreedz\/duels\/(page([0-9]+))?/" => "index.php?action=kz_duels&page=%2%",
	"/^kreedz\/players\/(pro|noob|all)?(\/page([0-9]+))?(\/(all|top1))?(\/)?(.*)?/" => "index.php?action=kz_players&type=%1%&page=%3%&sort=%5%&search=%7%",
	"/^kreedz\/maps\/(pro|noob|all)?(\/page([0-9]+))?(\/(norec|rec))?(\/)?(.*)?/" => "index.php?action=kz_maps&type=%1%&page=%3%&rec=%5%&search=%7%",
	"/^kreedz\/longjumps/" => "index.php?action=kz_longjumps",
	"/^kreedz\/records\/ljs\/?(.*)?/" => "index.php?action=kz_ljs_recs&comm=%1%",
	"/^kreedz\/records\/?(page([0-9]+))?(\/(.*))?/" => "index.php?action=kz_records&page=%2%&search=%4%",
	"/^kreedz\/downloads\/?(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=kz_downloads&page=%2%&search=%4%",
	"/^kreedz\/?(pro|noob|all)?(\/page([0-9]+))?(\/)?([^\/]+)?/" => "index.php?action=kz_map&type=%1%&page=%3%&map=%5%",
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?(\/(num|top1))?/" =>
 "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%&sort=%9%",
	
	"/^(.*)/" => "index.php?action=players&name=%1%",
);

?>