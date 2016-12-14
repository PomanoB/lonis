<?php
$config_file = "config.ini";
$cs = 0;

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

	'baseUrl' => "http://localhost/lonis",

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

$weaponNames = array(
	'',
	'P228',
	'',
	'SCOUT',
	'HEGRENADE',
	'XM1014',
	'C4',
	'MAC10',
	'AUG',
	'SMOKEGRENADE',
	'ELITE',
	'FIVESEVEN',
	'UMP45',
	'SG550',
	'GALI',
	'FAMAS',
	'USP',
	'GLOCK18',
	'AWP',
	'MP5NAVY',
	'M249',
	'M3',
	'M4A1',
	'TMP',
	'G3SG1',
	'FLASHBANG',
	'DEAGLE',
	'SG552',
	'AK47',
	'KNIFE',
	'P90',
	'VEST',
	'VESTHELM'
);

?>