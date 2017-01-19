-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.16-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5144
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица lonis.unr_achiev
DROP TABLE IF EXISTS `unr_achiev`;
CREATE TABLE IF NOT EXISTS `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.unr_achiev: ~42 rows (приблизительно)
/*!40000 ALTER TABLE `unr_achiev` DISABLE KEYS */;
INSERT INTO `unr_achiev` (`id`, `type`, `count`) VALUES
	(1, 'money_t', 125000),
	(2, 'dominate_o', 1),
	(3, 'kill_l', 1),
	(4, 'dominate_m', 1),
	(5, 'kill_s', 1),
	(6, 'dominate_n', 1),
	(7, 'dominate_d', 4),
	(8, 'dominate_o', 10),
	(9, 'dominate_t', 3),
	(10, 'kill_d', 1),
	(11, 'kill_e', 500),
	(12, 'airkill_u', 1),
	(13, 'money_t', 2500000),
	(14, 'spray', 100),
	(15, 'dominate_m', 20),
	(16, 'airkill_b', 1),
	(17, 'kill_e', 10000),
	(18, 'airkill_e', 1),
	(19, 'flash_t', 5),
	(20, 'money_t', 50000000),
	(21, 'say', 1000),
	(22, 'spray', 1000),
	(23, 'money_b', 100000),
	(24, 'headshoots_in_round', 5),
	(25, '95dmg', 1),
	(26, '5dmg', 1),
	(27, 'break_in_round', 10),
	(28, 'win_round', 10),
	(29, 'win_round', 200),
	(30, 'win_round', 5000),
	(31, '1sek_defusing', 1),
	(32, 'bomb_plant', 100),
	(33, 'bomb_defuse', 100),
	(34, 'de_dust2_win_round', 100),
	(35, 'break', 500),
	(36, 'de_nuke_win_round', 100),
	(37, 'deathrun_temple_win_round', 100),
	(38, 'surf_ski_2_win_round', 100),
	(39, 'awp_rooftops_win_round', 100),
	(40, 'hns_floppytown_win_round', 100),
	(41, 'money_t', 1000000),
	(42, 'collect_halloween_present', 20);
/*!40000 ALTER TABLE `unr_achiev` ENABLE KEYS */;

-- Дамп структуры для таблица lonis.unr_achiev_lang
DROP TABLE IF EXISTS `unr_achiev_lang`;
CREATE TABLE IF NOT EXISTS `unr_achiev_lang` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `achievid` int(10) NOT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `desc` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.unr_achiev_lang: ~84 rows (приблизительно)
/*!40000 ALTER TABLE `unr_achiev_lang` DISABLE KEYS */;
INSERT INTO `unr_achiev_lang` (`lid`, `achievid`, `lang`, `name`, `desc`) VALUES
	(1, 1, 'ru', 'Военные Облигации', 'Заработать $125,000'),
	(2, 2, 'ru', 'Рецидивист', 'Доминировать над вражеским игроком'),
	(3, 3, 'ru', 'Волшебная Пуля', 'Убить врага последним патроном в магазине'),
	(4, 4, 'ru', 'С позиции силы', 'Убить противника, над которым вы уже доминируете'),
	(5, 5, 'ru', 'Глаза в глаза', 'Убить из снайперской винтовки вражеского снайпера'),
	(6, 6, 'ru', 'Боевик', 'Убить вражеского игрока, который над вами доминирует'),
	(7, 7, 'ru', 'Чрезмерная Жестокость', 'Убить вражеского игрока еще 4 раза, когда вы уже доминируете над ним'),
	(8, 8, 'ru', 'Дециматор', 'Доминировать над 10 вражескими игроками'),
	(9, 9, 'ru', 'Хет-трик', 'Доминировать одновременно над тремя вражескими игроками'),
	(10, 10, 'ru', 'Экономия патронов', 'Убить двух противников одной пулей'),
	(11, 11, 'ru', 'Санитар', 'Убить 500 врагов'),
	(12, 12, 'ru', 'Смерть с неба', 'Убить врага, находясь в воздухе'),
	(13, 13, 'ru', 'Трофеи войны', 'Заработать $2,500,000'),
	(14, 14, 'ru', 'Искусство войны', 'Нарисовать 100 рисунков'),
	(15, 15, 'ru', 'Не тронь меня!', 'Убить 20 вражеских игроков, которые доминируют над вами'),
	(16, 16, 'ru', 'Воздушный Акробат', 'Находясь в воздухе, убить врага, тоже находящегося в воздухе'),
	(17, 17, 'ru', 'Бог войны', 'Убить 10000 врагов'),
	(18, 18, 'ru', 'Банни Хант', 'Убить врага, находящегося в воздухе'),
	(19, 19, 'ru', 'Привет, Ребята', 'Ослепить товарищей 5 раз'),
	(20, 20, 'ru', 'Кровавые Деньги', 'Заработать $50,000,000'),
	(21, 21, 'ru', 'Общительный игрок', 'Написать в чат 1000 сообщений'),
	(22, 22, 'ru', 'День молодежи', 'Нарисовать 1000 рисунков'),
	(23, 23, 'ru', 'Богатый игрок', 'Потратить $100,000'),
	(24, 24, 'ru', 'Глава Лоскуток Выкупа', 'Убить 5 врагов выстрелами в голову за один раунд'),
	(25, 25, 'ru', 'Праймер', 'Нанести 95% урона врагу, которого затем убивает другой игрок'),
	(26, 26, 'ru', 'Отделка Вышколены', 'Убить врага, который доведен до уровня мнее 5% здоровья другим игроком'),
	(27, 27, 'ru', 'Баальшой Респект', 'Сломать 10 предметов за один раунд'),
	(28, 28, 'ru', 'Ньют Мировой Порядок', 'Выиграть 10 раундов'),
	(29, 29, 'ru', 'Поощрятель', 'Выиграть 200 раундов'),
	(30, 30, 'ru', 'Leet мужчина', 'Выиграть 5000 раундов'),
	(31, 31, 'ru', 'Второй нет', 'Успешно обезвредить бомбу менее чем за одну секунду до взрыва'),
	(32, 32, 'ru', 'Boomala Boomala', 'Установить 100 бомб'),
	(33, 33, 'ru', 'Блокиратор Больно', 'Обезвредить 100 бомб'),
	(34, 34, 'ru', 'Ветеран карты Dust2', 'Выиграть 100 раундов на карте de_dust2'),
	(35, 35, 'ru', 'Разрушитель', 'Сломать 500 предметов'),
	(36, 36, 'ru', 'Ветеран карты Nuke', 'Выиграть 100 раундов на карте de_nuke'),
	(37, 37, 'ru', 'Ветеран карты Temple', 'Выиграть 100 раундов на карте deathrun_temple'),
	(38, 38, 'ru', 'Ветеран карты ski 2', 'Выиграть 100 раундов на карте surf_ski_2'),
	(39, 39, 'ru', 'Ветеран карты rooftops', 'Выиграть 100 раундов на карте awp_rooftops'),
	(40, 40, 'ru', 'Ветеран карты floppytown', 'Выиграть 100 раундов на карте hns_floppytown'),
	(41, 41, 'ru', 'НЕФТЬ! Я БОГАТ!', 'Заработать $1,000,000'),
	(42, 42, 'ru', 'Хэллоуин время!', 'Собрать 20 мешков с подарками в период с 29.10 по 3.11'),
	(85, 1, 'en', 'War Bonds', 'Earn $125,000'),
	(86, 2, 'en', 'Repeat Offender', 'Dominate an enemy player'),
	(87, 3, 'en', 'Magic Bullet', 'Kill an enemy with the last bullet in the store'),
	(88, 4, 'en', 'From a position of strength', 'Kill the enemy, over which you already dominate'),
	(89, 5, 'en', 'Eye to Eye', 'To kill from a sniper rifle the enemy sniper'),
	(90, 6, 'en', 'Insurgent', 'Kill an enemy player that is dominating over you'),
	(91, 7, 'en', 'Excessive Brutality', 'Kill an enemy player 4 times when you already dominate it'),
	(92, 8, 'en', 'Decimator', 'To dominate the 10 enemy players'),
	(93, 9, 'en', 'A hat-trick', 'At the same time to dominate three enemy players'),
	(94, 10, 'en', 'Saving ammunition', 'Kill two enemies with one bullet'),
	(95, 11, 'en', 'Corpsman', 'Kill 500 enemies'),
	(96, 12, 'en', 'Death from air', 'Kill an enemy while in the air'),
	(97, 13, 'en', 'Spoils of War', 'Earn $2,500,000'),
	(98, 14, 'en', 'The Art of War', 'To draw 100 drawings'),
	(99, 15, 'en', 'Don\'t touch me!', 'Kill 20 enemy players that are dominating you'),
	(100, 16, 'en', 'Aerial Necrobatics', 'While in the air, to kill the enemy is also in the air'),
	(101, 17, 'en', 'God of War', 'Kill 10,000 enemies'),
	(102, 18, 'en', 'Bunny Hunt', 'Kill the enemy in the air'),
	(103, 19, 'en', 'Hello Guys', 'Dazzle comrades 5 times'),
	(104, 20, 'en', 'Blood Money', 'Earn $50,000,000'),
	(105, 21, 'en', 'A talkative player', 'Write in the chat 1000 messages'),
	(106, 22, 'en', 'Youth day', 'To draw 1,000 drawings'),
	(107, 23, 'en', 'Rich player', 'To spend $100,000'),
	(108, 24, 'en', 'Head Shred Redemption', 'Kill 5 enemies with headshots in a single round'),
	(109, 25, 'en', 'Primer', 'To inflict 95% damage to enemy that then kills the other player'),
	(110, 26, 'en', 'Finishing Schooled', 'Kill the enemy that brought to the level of less than 5% health by other player'),
	(111, 27, 'en', 'Mad Props', 'Break 10 objects in a single round'),
	(112, 28, 'en', 'Newb World Order', 'Win 10 rounds'),
	(113, 29, 'en', 'Pro-moted', 'Win 200 rounds'),
	(114, 30, 'en', 'Leet-er of Men', 'Win 5,000 rounds'),
	(115, 31, 'en', 'Second to None', 'Successfully defuse a bomb in less than one second before the explosion'),
	(116, 32, 'en', 'БУМ-БУМ', 'Install 100 bombs'),
	(117, 33, 'en', 'The Hurt Blocker', 'Defuse 100 bombs'),
	(118, 34, 'en', 'Veteran maps Dust2', 'Win 100 rounds on the de_dust2 map'),
	(119, 35, 'en', 'Разрушитель', 'Break 500 objects'),
	(120, 36, 'en', 'Veteran maps Nuke', 'Win 100 rounds on the de_nuke map'),
	(121, 37, 'en', 'Veteran maps Temple', 'Win 100 rounds on the map deathrun_temple'),
	(122, 38, 'en', 'Veteran maps ski 2', 'Win 100 rounds on the map surf_ski_2'),
	(123, 39, 'en', 'Veteran maps rooftops', 'Win 100 rounds on the map awp_rooftops'),
	(124, 40, 'en', 'Veteran maps floppytown', 'Win 100 rounds on the map hns_floppytown'),
	(125, 41, 'en', 'OIL! I\'M RICH!', 'To earn $1,000,000'),
	(126, 42, 'en', 'Halloween time!', 'Collect 20 bags of gifts in the period from 29.10 till 3.11');
/*!40000 ALTER TABLE `unr_achiev_lang` ENABLE KEYS */;

-- Дамп структуры для таблица lonis.unr_players_achiev
DROP TABLE IF EXISTS `unr_players_achiev`;
CREATE TABLE IF NOT EXISTS `unr_players_achiev` (
  `playerId` int(11) NOT NULL,
  `achievId` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `unlocked` int(11) NOT NULL,
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп структуры для представление lonis.achiev
DROP VIEW IF EXISTS `achiev`;
CREATE VIEW `achiev` AS select `a`.`id` AS `id`,`a`.`type` AS `type`,`a`.`count` AS `count`,`al`.`lid` AS `lid`,`al`.`achievid` AS `achievid`,`al`.`lang` AS `lang`,`al`.`name` AS `name`,`al`.`desc` AS `desc` from (`unr_achiev` `a` join `unr_achiev_lang` `al`) where (`a`.`id` = `al`.`achievid`);

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
