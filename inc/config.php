<?php
	
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU.utf-8');

$mysql_user = 'lonis';
$mysql_password = '';
$mysql_host = 'localhost';
$mysql_db = 'lonis';
$mysql_prefix = 'lonis_';

$activateTime = 60 * 60 * 24 * 3; // Трое суток

$baseUrl = "http://cs.klan-hub.ru/lonis";

$gravatarSize = 150;
$playerPerPage = 20;

$additional_flags = array(
	'green_chat' => 't'
);

$mapsPerPage = 20;
$playersPerPage = 20;

$typeDescription = array(
		'pro' => 'Про',
		'noob' => 'Новички',
		'all' => 'Все'
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