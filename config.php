<?php
// CONFIG 
// Mysql DB config
$dbconf = array (
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

$conf = array (
	'timezone' => 'Europe/Moscow',
	'charset' => 'utf-8',
	'server_name' => '[K.lan] Counter-Strike',
	'server_email' => 'admin@klan-hub.ru',
	'activateTime' => 60 * 60 * 24 * 3,
	'playerPerPage' => 15,
	'mapsPerPage' => 15,
	'mapsNorecPerPage' => 25,
	'newsPerPage' => 15,
	'playersPerPage' => 15,
	'achievPerPage' => 50,
	'achievPlayersPerPage' => 10,
	'achievAvatar' => 'gravatar',
	'server_update' => 60 * 30,
	'servers_autoupdate' => 1,	
	'avatar' => 32,
	'avatarmedium' => 80,
	'avatarfull' => 150,
	'avatarD' => 'wavatar', 
	'steamAvatar' => 1, 
	'cookieKey' => "cc1f891423db1ee24498e76f3b107bbe",
	'menuStart' => 'home',
	'style' => 'default',
	'csstyle' => 'default',
	'homepage' => 'home',
	'lang' => 'ru',
	'steamAPI' => 'FA568BC0A00A41BE5ADCEB161829770E',
);

$conf_type = array (
	'activateTime' => 'number',
	'playerPerPage' => 'number',
	'newsPerPage' => 'number',
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
);

$additional_flags = array(
	'green_chat' => 't'
);

// Menu footer
$menu_footer = array(
	'bug' => 'Jeronimo.',
	'aid-kit' => 'PomanoB'
);

$social = array(
	'steam2' => 'http://steamcommunity.com/groups/k_lan',
	'vk' => 'https://vk.com/club10526271',
	'dice' => 'http://klan-hub.ru',
	'skype' => "skype:PomanoB?call",
	'shield' => 'http://jeronimo.pw',

);

// Other
$cup_color = array(1=>"gold", 2=>"saddlebrown", 3=>"silver");

// Where SQL
$types = array(
	'pro' => 'AND (`go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29))',
	'noob' => 'AND (`go_cp` != 0 OR NOT (`weapon` = 16 OR `weapon` = 29))',
	'all' => ''
);

// The sequence is important
$parseRules = array(
	"/^error\/([0-9]+)/" => "index.php?action=error&err=%1%",
	"/^setup\/(.*)/" => "index.php?action=setup&acts=%1%",
	"/^account\/(.*)/" => "index.php?action=account&key=%1%",
	"/^logout\//" => "index.php?logout=1",
	"/^steam\//" => "index.php?steam=1",
	"/^home\//" => "index.php?action=home",
	
	"/^news\/post([0-9]+)?/" => "index.php?action=news&id=%1%",
	"/^news\/(page([0-9]+))/" => "index.php?action=news&page=%2%",
	
	"/^admin\/([0-9a-zA-Z_!]+)?(\/page([0-9]+))?(\/(.*))?/" => "index.php?action=admin_%1%&page=%3%&search=%5%",
	"/^servers\/(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=servers&page=%2%&addr=%4%",
	"/^players\/(name|achiev|country)?(-)?(asc|desc)?(\/page([0-9]+))?(\/)?(.*)?/" => "index.php?action=players&order=%1%&sort=%3%&page=%5%&search=%7%",
		
	"/^achiev\/(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=achievs&page=%2%&aname=%4%",
	"/^achievs\/(page([0-9]+))?/" => "index.php?action=achievs&page=%2%&act=achievs",
	"/^(.*)\/achiev\/(page([0-9]+))?/" => "index.php?action=achievs&name=%1%&page=%3%",
	
	"/^kreedz\/duels\/(page([0-9]+))?/" => "index.php?action=kreedz_duels&page=%2%",
	"/^kreedz\/players\/(pro|noob|all)?(\/page([0-9]+))?(\/(all|top1))?(\/)?(.*)?/" => "index.php?action=kreedz_players&type=%1%&page=%3%&sort=%5%&search=%7%",
	"/^kreedz\/maps\/(pro|noob|all)?(\/page([0-9]+))?(\/(norec|rec))?(\/)?(.*)?/" => "index.php?action=kreedz_maps&type=%1%&page=%3%&rec=%5%&search=%7%",
	"/^kreedz\/longjumps/" => "index.php?action=kreedz_longjumps",
	"/^kreedz\/ljsrecs\/?(.*)?/" => "index.php?action=kreedz_ljsrecs&comm=%1%",
	"/^kreedz\/records\/?(page([0-9]+))?(\/(.*))?/" => "index.php?action=kreedz_records&page=%2%&search=%4%",
	"/^kreedz\/downloads\/?(page([0-9]+))?(\/)?(.*)?/" => "index.php?action=kreedz_downloads&page=%2%&search=%4%",
	"/^kreedz\/last\/?(pro|noob|all)?(\/page([0-9]+))?(\/)?([^\/]+)?/" => "index.php?action=kreedz_last&type=%1%&page=%3%&map=%5%",
	"/^kreedz\/?(pro|noob|all)?(\/page([0-9]+))?(\/)?([^\/]+)?/" => "index.php?action=kreedz_map&type=%1%&page=%3%&map=%5%",
	
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?(\/(num|top1))?/" =>
 "index.php?action=kreedz_player&name=%1%&type=%3%&page=%5%&rec=%7%&sort=%9%",
	
	"/^(.*)/" => "index.php?action=players&name=%1%",
);

?>