DELETE FROM `menu`;
INSERT INTO `menu` (`id`, `lvl`, `num`, `admin`, `action`) VALUES
	(1, 1, 1, 0, 'home'),
	(2, 1, 3, 0, 'servers'),
	(3, 1, 4, 0, 'players'),
	(4, 1, 5, 0, 'achiev'),
	(5, 1, 6, 0, 'kz_players'),
	(6, 1, 7, 0, 'kz_maps'),
	(7, 1, 8, 0, 'kz_duels'),
	(8, 1, 1, 1, 'admin_servers'),
	(9, 1, 2, 1, 'admin_langs'),
	(10, 1, 3, 1, 'admin_achiev'),
	(11, 1, 4, 1, 'admin_players');
	
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
INSERT INTO `lang` (`id`, `lang`, `name`, `default`) VALUES
	(1, 'ru', 'Русский', 1),
	(2, 'en', 'English', 0);
	
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
	
DELETE FROM `unr_achiev`;
insert  into `unr_achiev`(`id`,`type`,`count`) values 
	(1,'money_t',125000),
	(2,'dominate_o',1),
	(3,'kill_l',1),
	(4,'dominate_m',1),
	(5,'kill_s',1),
	(6,'dominate_n',1),
	(7,'dominate_d',4),
	(8,'dominate_o',10),
	(9,'dominate_t',3),
	(10,'kill_d',1),
	(11,'kill_e',500),
	(12,'airkill_u',1),
	(13,'money_t',2500000),
	(14,'spray',100),
	(15,'dominate_m',20),
	(16,'airkill_b',1),
	(17,'kill_e',10000),
	(18,'airkill_e',1),
	(19,'flash_t',5),
	(20,'money_t',50000000),
	(21,'say',1000),
	(22,'spray',1000),
	(23,'money_b',100000),
	(24,'headshoots_in_round',5),
	(25,'95dmg',1),
	(26,'5dmg',1),
	(27,'break_in_round',10),
	(28,'win_round',10),
	(29,'win_round',200),
	(30,'win_round',5000),
	(31,'1sek_defusing',1),
	(32,'bomb_plant',100),
	(33,'bomb_defuse',100),
	(34,'de_dust2_win_round',100),
	(35,'break',500),
	(36,'de_nuke_win_round',100),
	(37,'deathrun_temple_win_round',100),
	(38,'surf_ski_2_win_round',100),
	(39,'awp_rooftops_win_round',100),
	(40,'hns_floppytown_win_round',100),
	(41,'money_t',1000000),
	(42,'collect_halloween_present',20);

DELETE FROM `unr_achiev_lang`;
insert  into `unr_achiev_lang`(`lid`,`achievid`,`lang`,`ltype`,`value`) values 
	(1,1,'ru','name','Военные Облигации'),
	(2,2,'ru','name','Рецидивист'),
	(3,3,'ru','name','Волшебная Пуля'),
	(4,4,'ru','name','С позиции силы'),
	(5,5,'ru','name','Глаза в глаза'),
	(6,6,'ru','name','Боевик'),
	(7,7,'ru','name','Чрезмерная Жестокость'),
	(8,8,'ru','name','Дециматор'),
	(9,9,'ru','name','Хет-трик'),
	(10,10,'ru','name','Экономия патронов'),
	(11,11,'ru','name','Санитар'),
	(12,12,'ru','name','Смерть с неба'),
	(13,13,'ru','name','Трофеи войны'),
	(14,14,'ru','name','Искусство войны'),
	(15,15,'ru','name','Не тронь меня!'),
	(16,16,'ru','name','Воздушный Necrobatics'),
	(17,17,'ru','name','Бог войны'),
	(18,18,'ru','name','Банни Хант'),
	(19,19,'ru','name','Привет, Ребята'),
	(20,20,'ru','name','Кровавые Деньги'),
	(21,21,'ru','name','Общительный игрок'),
	(22,22,'ru','name','День молодежи'),
	(23,23,'ru','name','Богатый игрок'),
	(24,24,'ru','name','Глава Лоскуток Выкупа'),
	(25,25,'ru','name','Праймер'),
	(26,26,'ru','name','Отделка Вышколены'),
	(27,27,'ru','name','Баальшой Респект'),
	(28,28,'ru','name','Ньют Мировой Порядок'),
	(29,29,'ru','name','Поощрятель'),
	(30,30,'ru','name','Leet мужчина'),
	(31,31,'ru','name','Второй нет'),
	(32,32,'ru','name','Boomala Boomala'),
	(33,33,'ru','name','Блокиратор Больно'),
	(34,34,'ru','name','Ветеран карты Dust2'),
	(35,35,'ru','name','Разрушитель'),
	(36,36,'ru','name','Ветеран карты Nuke'),
	(37,37,'ru','name','Ветеран карты Temple'),
	(38,38,'ru','name','Ветеран карты ski 2'),
	(39,39,'ru','name','Ветеран карты rooftops'),
	(40,40,'ru','name','Ветеран карты floppytown'),
	(41,41,'ru','name','НЕФТЬ! Я БОГАТ!'),
	(42,42,'ru','name','Хэллоуин время!'),
	(43,1,'ru','desc','Заработать $125,000'),
	(44,2,'ru','desc','Доминировать над вражеским игроком'),
	(45,3,'ru','desc','Убить врага последним патроном в магазине'),
	(46,4,'ru','desc','Убить противника, над которым вы уже доминируете'),
	(47,5,'ru','desc','Убить из снайперской винтовки вражеского снайпера'),
	(48,6,'ru','desc','Убить вражеского игрока, который над вами доминирует'),
	(49,7,'ru','desc','Убить вражеского игрока еще 4 раза, когда вы уже доминируете над ним'),
	(50,8,'ru','desc','Доминировать над 10 вражескими игроками'),
	(51,9,'ru','desc','Доминировать одновременно над тремя вражескими игроками'),
	(52,10,'ru','desc','Убить двух противников одной пулей'),
	(53,11,'ru','desc','Убить 500 врагов'),
	(54,12,'ru','desc','Убить врага, находясь в воздухе'),
	(55,13,'ru','desc','Заработать $2,500,000'),
	(56,14,'ru','desc','Нарисовать 100 рисунков'),
	(57,15,'ru','desc','Убить 20 вражеских игроков, которые доминируют над вами'),
	(58,16,'ru','desc','Находясь в воздухе, убить врага, тоже находящегося в воздухе'),
	(59,17,'ru','desc','Убить 10000 врагов'),
	(60,18,'ru','desc','Убить врага, находящегося в воздухе'),
	(61,19,'ru','desc','Ослепить товарищей 5 раз'),
	(62,20,'ru','desc','Заработать $50,000,000'),
	(63,21,'ru','desc','Написать в чат 1000 сообщений'),
	(64,22,'ru','desc','Нарисовать 1000 рисунков'),
	(65,23,'ru','desc','Потратить $100,000'),
	(66,24,'ru','desc','Убить 5 врагов выстрелами в голову за один раунд'),
	(67,25,'ru','desc','Нанести 95% урона врагу, которого затем убивает другой игрок'),
	(68,26,'ru','desc','Убить врага, который доведен до уровня мнее 5% здоровья другим игроком'),
	(69,27,'ru','desc','Сломать 10 предметов за один раунд'),
	(70,28,'ru','desc','Выиграть 10 раундов'),
	(71,29,'ru','desc','Выиграть 200 раундов'),
	(72,30,'ru','desc','Выиграть 5000 раундов'),
	(73,31,'ru','desc','Успешно обезвредить бомбу менее чем за одну секунду до взрыва'),
	(74,32,'ru','desc','Установить 100 бомб'),
	(75,33,'ru','desc','Обезвредить 100 бомб'),
	(76,34,'ru','desc','Выиграть 100 раундов на карте de_dust2'),
	(77,35,'ru','desc','Сломать 500 предметов'),
	(78,36,'ru','desc','Выиграть 100 раундов на карте de_nuke'),
	(79,37,'ru','desc','Выиграть 100 раундов на карте deathrun_temple'),
	(80,38,'ru','desc','Выиграть 100 раундов на карте surf_ski_2'),
	(81,39,'ru','desc','Выиграть 100 раундов на карте awp_rooftops'),
	(82,40,'ru','desc','Выиграть 100 раундов на карте hns_floppytown'),
	(83,41,'ru','desc','Заработать $1,000,000'),
	(84,42,'ru','desc','Собрать 20 мешков с подарками в период с 29.10 по 3.11'),
	(85,1,'en','name','War Bonds'),
	(86,2,'en','name','Repeat Offender'),
	(87,3,'en','name','Magic Bullet'),
	(88,4,'en','name','From a position of strength'),
	(89,5,'en','name','Eye to Eye'),
	(90,6,'en','name','Insurgent'),
	(91,7,'en','name','Excessive Brutality'),
	(92,8,'en','name','Decimator'),
	(93,9,'en','name','A hat-trick'),
	(94,10,'en','name','Saving ammunition'),
	(95,11,'en','name','Corpsman'),
	(96,12,'en','name','Смерть с неба'),
	(97,13,'en','name','Spoils of War'),
	(98,14,'en','name','The Art of War'),
	(99,15,'en','name','Don\'t touch me!'),
	(100,16,'en','name','Aerial Necrobatics'),
	(101,17,'en','name','God of War'),
	(102,18,'en','name','Bunny Hunt'),
	(103,19,'en','name','Hello Guys'),
	(104,20,'en','name','Blood Money'),
	(105,21,'en','name','A talkative player'),
	(106,22,'en','name','Youth day'),
	(107,23,'en','name','Rich player'),
	(108,24,'en','name','Head Shred Redemption'),
	(109,25,'en','name','Primer'),
	(110,26,'en','name','Finishing Schooled'),
	(111,27,'en','name','Mad Props'),
	(112,28,'en','name','Newb World Order'),
	(113,29,'en','name','Pro-moted'),
	(114,30,'en','name','Leet-er of Men'),
	(115,31,'en','name','Second to None'),
	(116,32,'en','name','Boomala Boomala'),
	(117,33,'en','name','The Hurt Blocker'),
	(118,34,'en','name','Veteran maps Dust2'),
	(119,35,'en','name','Разрушитель'),
	(120,36,'en','name','Veteran maps Nuke'),
	(121,37,'en','name','Veteran maps Temple'),
	(122,38,'en','name','Veteran maps ski 2'),
	(123,39,'en','name','Veteran maps rooftops'),
	(124,40,'en','name','Veteran maps floppytown'),
	(125,41,'en','name','OIL! I\'M RICH!'),
	(126,42,'en','name','Halloween time!'),
	(127,1,'en','desc','Earn $125,000'),
	(128,2,'en','desc','Dominate an enemy player'),
	(129,3,'en','desc','Kill an enemy with the last bullet in the store'),
	(130,4,'en','desc','Kill the enemy, over which you already dominate'),
	(131,5,'en','desc','To kill from a sniper rifle the enemy sniper'),
	(132,6,'en','desc','Kill an enemy player that is dominating over you'),
	(133,7,'en','desc','Kill an enemy player 4 times when you already dominate it'),
	(134,8,'en','desc','To dominate the 10 enemy players'),
	(135,9,'en','desc','At the same time to dominate three enemy players'),
	(136,10,'en','desc','Kill two enemies with one bullet'),
	(137,11,'en','desc','Kill 500 enemies'),
	(138,12,'en','desc','Kill an enemy while in the air'),
	(139,13,'en','desc','Earn $2,500,000'),
	(140,14,'en','desc','To draw 100 drawings'),
	(141,15,'en','desc','Kill 20 enemy players that are dominating you'),
	(142,16,'en','desc','While in the air, to kill the enemy is also in the air'),
	(143,17,'en','desc','Kill 10,000 enemies'),
	(144,18,'en','desc','Kill the enemy in the air'),
	(145,19,'en','desc','Dazzle comrades 5 times'),
	(146,20,'en','desc','Earn $50,000,000'),
	(147,21,'en','desc','Write in the chat 1000 messages'),
	(148,22,'en','desc','To draw 1,000 drawings'),
	(149,23,'en','desc','To spend $100,000'),
	(150,24,'en','desc','Kill 5 enemies with headshots in a single round'),
	(151,25,'en','desc','To inflict 95% damage to enemy that then kills the other player'),
	(152,26,'en','desc','Kill the enemy that brought to the level of less than 5% health by other player'),
	(153,27,'en','desc','Break 10 objects in a single round'),
	(154,28,'en','desc','Win 10 rounds'),
	(155,29,'en','desc','Win 200 rounds'),
	(156,30,'en','desc','Win 5,000 rounds'),
	(157,31,'en','desc','Successfully defuse a bomb in less than one second before the explosion'),
	(158,32,'en','desc','Install 100 bombs'),
	(159,33,'en','desc','Defuse 100 bombs'),
	(160,34,'en','desc','Win 100 rounds on the de_dust2 map'),
	(161,35,'en','desc','Break 500 objects'),
	(162,36,'en','desc','Win 100 rounds on the de_nuke map'),
	(163,37,'en','desc','Win 100 rounds on the map deathrun_temple'),
	(164,38,'en','desc','Win 100 rounds on the map surf_ski_2'),
	(165,39,'en','desc','Win 100 rounds on the map awp_rooftops'),
	(166,40,'en','desc','Win 100 rounds on the map hns_floppytown'),
	(167,41,'en','desc','To earn $1,000,000'),
	(168,42,'en','desc','Collect 20 bags of gifts in the period from 29.10 till 3.11');