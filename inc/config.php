<?php
$config_file = "config.ini";
$config_lang = "lang.ini";
$cs = 0;

// Default config
$conf_type = array(
	'password' => array('mysql_password'),
	'number' => array('activateTime', 'gravatarSize', 'playerPerPage', 'mapsPerPage', 'playersPerPage')
);

$conf = array (
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
	'cstheme' => "main"
);

$additional_flags = array(
	'green_chat' => 't'
);

// Menu action
// Type: 
// 		0 -/action/%1
//		1 - from $menuAction 
$actions = "home|players|kz_maps|achiev|reg|login|kz_duels|kz_players|ucp|achiev_admin|steam_login|setup";

$menu_footer = array(
	'Gm# Staff' => 'http://klan-hub.ru',
	'PomanoB' => 'http://klan-hub.ru/index.php?page=feedback',
	'Jeronimo' => 'http://leopold-soft.narod.ru',
);

// Menu List
$menu1 = array(
	'home',
	'players',
	'achiev|achiev_players',
	'kz_players|kz_maps|kz_duels',
	'auth' => 'login',
	'reg' => 'reg',
);

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

$ActionList = "home|players|kz_maps|achiev|achiev_players|reg|login|kz_duels|kz_players|ucp|achiev_admin|steam_login|login|logout|setup";
// The sequence is important
$parseRules = array(
	"/^error(\/([0-9]+))?/" => "index.php?action=error&err=%2%",
	"/^reg\/(.*)/" => "index.php?action=reg&key=%1%",
	"/^logout/" => "index.php?action=login&logout=1",
	"/^setup\/logout?/" => "index.php?action=setup&logout=1",
	"/^($ActionList)(\/)?(\/page([0-9]+))?/" => "index.php?action=%1%&page=%4%",	
	"/^action(\/([0-9a-zA-Z_]+))?/" => "index.php?action=%2%",
	"/^players\/(.*)\/page.([0-9]+)/" => "index.php?action=players&search=%1%&page=%2%",
	"/^achiev\/players(\/page.([0-9]+))/" => "index.php?action=achiev_players&page=%2%",
	"/^steam?/" => "index.php?action=steam_login",	
	"/^achiev\/(.*)/" => "index.php?action=achiev&aname=%2%",
	"/^(.*)\/achiev/" => "index.php?action=achiev&name=%1%",
	"/^kreedz\/players(\/(pro|noob|all))?(\/(num|top1))?(\/page([0-9]+))?/" => "index.php?action=kz_players&type=%2%&sort=%4%&page=%6%",
	"/^kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_maps&page=%4%&type=%2%&rec=%6%",
	"/^kreedz\/([0-9a-zA-Z_]+)?(\/(pro|noob|all))?(\/page([0-9]+)?)?/" => "index.php?action=kz_map&map=%1%&type=%3%&page=%5%",
	"/^unrid([0-9]+)?(\/kreedz)?(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_player&id=%1%&type=%4%&page=%6%&rec=%8%",
	"/^(.*)\/kreedz(\/(pro|noob|all))?(\/page([0-9]+))?(\/(norec|rec))?/" => "index.php?action=kz_player&name=%1%&type=%3%&page=%5%&rec=%7%",
	"/^(.*)/" => "index.php?action=player&name=%1%",
);

?>