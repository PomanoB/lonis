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
$menuAction = array(
	'home' => '/',
	'players' => '/players',
	'achiev_players' => '/achiev/players',
	'achiev' => '/achiev',
	'kz_players' => '/kreedz/players',
	'kz_maps' => '/kreedz',
	'kz_duels' => '/kz_duels',
	'reg' => '/reg',
	'login' => '/login',
	'ucp' => '/ucp',
	'logout' => '/logout',
	'setup' => '/setup'
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
	'reg',
	'login',
);

$menuLogged = array(
	'ucp',
	'logout'
);

$menuUnLogged = array(
	'reg',
	'login'
);
	
$menuCS = array(
	'kz_players',
	'kz_maps',
	'kz_duels',
);

?>