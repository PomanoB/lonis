DELETE FROM `menu`;
INSERT INTO `menu` (`num`, `parent`, `mname`, `action`) VALUES
	(10, 'main', 'home', 'home'),
	(30, 'main', 'servers', 'servers'),
	(40, 'main', 'players', 'players'),
	(50, 'main', 'achiev', 'achiev'),
	(61, 'kreedz', 'kz_players', 'kz_players'),
	(60, 'main', 'kreedz', 'kz_players'),
	(62, 'kreedz', 'kz_maps', 'kz_maps'),
	(63, 'kreedz', 'kz_duels', 'kz_duels'),
	(91, 'admin', 'admin_servers', 'admin_servers'),
	(92, 'admin', 'admin_langs', 'admin_langs'),
	(93, 'admin', 'admin_achiev', 'admin_achiev'),
	(94, 'admin', 'admin_players', 'admin_players'),
	(68, 'kreedz', '', 'kz_player'),
	(69, 'kreedz', '', 'kz_map'),
	(64, 'kreedz', '', 'kz_longjump');
	
DELETE FROM `kz_comm`;
INSERT INTO `kz_comm` (`sort`, `name`, `fullname`, `url`, `image`, `download`, `mapinfo`) VALUES
	(2, 'cc', 'Cosy Climbing', 'https://cosy-climbing.net', 'https://cosy-climbing.net/img/maps/%map%.png', 'https://cosy-climbing.net/files/maps/%map%.rar', 'https://cosy-climbing.net/search.php?q=%map%&in=&ex=&ep=&be=%map%&t=all&r=0&s=Search&adv=0'),
	(4, 'kz-rush', 'Kz-Rush', 'http://kz-rush.ru', 'http://kz-rush.ru/xr_images/maps/%map%.jpg', 'http://kz-rush.ru/maps/%map%', 'http://kz-rush.ru/maps/%map%'),
	(3, 'kzru', 'KZ Russia', 'http://kzru.one', 'http://kzru.one/plugins/lgsl/lgsl_files/lgsl_image.php?map=%map%', 'http://kzru.one/maps/%map%', 'http://kzru.one/maps/%map%'),
	(1, 'xj', 'Xtreme Jumps', 'http://files.xtreme-jumps.eu', 'http://xtreme-jumps.eu/e107_plugins/lgsl_menu/images/mapz/halflife2/cstrike/%map%.jpg', 'http://files.xtreme-jumps.eu/maps/%map%.rar', 'http://xtreme-jumps.eu/demos_history/map_info.php?map=%map%');

DELETE FROM `unr_players`;
INSERT INTO `unr_players` (`id`, `name`, `password`, `email`, `active`, `webadmin`) VALUES
(10000, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@site.com', 1, 1);

	
DELETE FROM `lang`;
INSERT INTO `lang` (`id`, `lang`, `name`, `use`, `default`) VALUES
	(1, 'ru', 'Русский', 1, 1),
	(2, 'en', 'English', 1, 0),
	(3, 'de', 'de', 0, 0),
	(4, 'es', 'es', 0, 0),
	(5, 'fr', 'fr', 0, 0),
	(6, 'ya', 'ya', 0, 0),
	(7, 'pt', 'pt', 0, 0),
	(8, 'zh', 'zh', 0, 0);
	
DELETE FROM `themes`;
insert  into `themes`(`id`,`theme`,`default`,`cs`) values 
	(1,'default',1,1),
	(2,'white',0,0),
	(3,'empty',0,0);

DELETE FROM `themes_lang`;
insert  into `themes_lang`(`id`,`themesid`,`lang`,`name`) values 
	(1,1,'ru','Стандарная'),
	(2,2,'ru','Инвертная'),
	(3,3,'ru','Пустая'),
	(4,1,'en','Standart'),
	(5,2,'en','Invert'),
	(6,3,'en','Empty');

	
DELETE FROM `weapons`;
insert  into `weapons`(`id`,`wname`,`fullname`) values 
	(0,'NONE',''),
	(1,'P228','SIG Sauer P228'),
	(2,'WAT',''),
	(3,'SCOUT','Steyr Scout'),
	(4,'HEGRENADE','He Grenade'),
	(5,'XM1014','Benelli M4 Super 90'),
	(6,'C4','C4'),
	(7,'MAC10','Ingram MAC-10'),
	(8,'AUG','Steyr AUG'),
	(9,'SMOKEGRENADE','Smoke Grenade'),
	(10,'ELITE','Elite'),
	(11,'FIVESEVEN','FN Five-seveN'),
	(12,'UMP45','HK UMP'),
	(13,'SG550','SIG SG 550'),
	(14,'GALIL','Galil'),
	(15,'FAMAS','Famas'),
	(16,'USP','HK USP'),
	(17,'GLOCK18','Glock 18'),
	(18,'AWP','Accuracy International L96A1'),
	(19,'MP5NAVY','HK MP5'),
	(20,'M249','M249 SAW'),
	(21,'M3','M3 submachine gun'),
	(22,'M4A1','M4 carbine'),
	(23,'TMP','Steyr TMP'),
	(24,'G3SG1','HK G3'),
	(25,'FLASHBANG','Flash Bang'),
	(26,'DEAGLE','Desert Eagle'),
	(27,'SG552','SIG SG 550'),
	(28,'AK47','AK47'),
	(29,'KNIFE','Knife'),
	(30,'P90','FN P90'),
	(31,'VEST','Vest'),
	(32,'VESTHELM','Vest Helm');