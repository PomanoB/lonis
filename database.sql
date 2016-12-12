-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 05 2010 г., 13:01
-- Версия сервера: 5.5.5
-- Версия PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Структура таблицы `kz_duel`
--

CREATE TABLE IF NOT EXISTS `kz_duel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player1` int(10) unsigned NOT NULL,
  `player2` int(10) unsigned NOT NULL,
  `result1` int(11) NOT NULL,
  `result2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `kz_duel`
--


-- --------------------------------------------------------

--
-- Структура таблицы `kz_map_top`
--

CREATE TABLE IF NOT EXISTS `kz_map_top` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` decimal(10,5) NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `go_cp` int(10) unsigned NOT NULL,
  `weapon` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3872 ;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_save`
--

CREATE TABLE IF NOT EXISTS `kz_save` (
  `map` varchar(50) NOT NULL,
  `player` int(11) NOT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `angle_x` int(11) NOT NULL,
  `angle_y` int(11) NOT NULL,
  `angle_z` int(11) NOT NULL,
  `cp` int(10) unsigned NOT NULL DEFAULT '0',
  `go_cp` int(10) unsigned NOT NULL DEFAULT '0',
  `weapon` int(10) unsigned NOT NULL,
  PRIMARY KEY (`map`,`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `unr_achiev`
--

CREATE TABLE IF NOT EXISTS `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `unr_achiev`
--

INSERT INTO `unr_achiev` (`id`, `name`, `description`, `count`, `type`) VALUES
(1, 'War Bonds', 'Заработать $125,000', 125000, 'money_t'),
(2, 'Repeat Offender', 'Доминировать над вражеским игроком', 1, 'dominate_o'),
(3, 'Magic Bullet', 'Убить врага последним патроном в магазине', 1, 'kill_l'),
(4, 'С позиции силы', 'Убить противника, над которым вы уже доминируете', 1, 'dominate_m'),
(5, 'Eye to Eye', 'Убить из снайперской винтовки вражеского снайпера', 1, 'kill_s'),
(6, 'Insurgent', 'Убить вражеского игрока, который над вами доминирует', 1, 'dominate_m'),
(7, 'Excessive Brutality', 'Убить вражеского игрока еще 4 раза, когда вы уже доминируете над ним', 4, 'dominate_d'),
(8, 'Decimator', 'Доминировать над 10 вражескими игроками', 10, 'dominate_o'),
(9, 'Хет-трик', 'Доминировать одновременно над тремя вражескими игроками', 3, 'dominate_t'),
(10, 'Экономия патронов', 'Убить двух противников одной пулей', 1, 'kill_d'),
(11, 'Corpseman', 'Убить 500 врагов', 500, 'kill_e'),
(12, 'Смерть с неба', 'Убить врага, находясь в воздухе', 1, 'airkill_u'),
(13, 'Spoils of War', 'Заработать $2,500,000', 2500000, 'money_t'),
(14, 'The Art of War', 'Нарисовать 100 рисунков', 100, 'spray'),
(15, 'Не тронь меня!', 'Убить 20 вражеских игроков, которые доминируют над вами', 20, 'dominate_m'),
(16, 'Aerial Necrobatics', 'Находясь в воздухе, убить врага, тоже находящегося в воздухе', 1, 'airkill_b'),
(17, 'God of War', 'Убить 10000 врагов', 10000, 'kill_e'),
(18, 'Bunny Hunt', 'Убить врага, находящегося в воздухе', 1, 'airkill_e'),
(19, 'Hello guys', 'Ослепить товарищей 5 раз', 5, 'flash_t'),
(20, 'Blood Money', 'Заработать $50,000,000', 50000000, 'money_t'),
(21, 'Общительный игрок', 'Написать в чат 1000 сообщений', 1000, 'say'),
(22, 'День молодежи', 'Нарисовать 1000 рисунков', 1000, 'spray'),
(23, 'Богатый игрок', 'Потратить $100,000', 100000, 'money_b'),
(24, 'Head Shred Redemption', 'Убить 5 врагов выстрелами в голову за один раунд', 5, 'headshoots_in_round'),
(25, 'Primer', 'Нанести 95% урона врагу, которого затем убивает другой игрок', 1, '95dmg'),
(26, 'Finishing Schooled', 'Убить врага, который доведен до уровня мнее 5% здоровья другим игроком', 1, '5dmg'),
(27, 'Mad Props', 'Сломать 10 предметов за один раунд', 10, 'break_in_round'),
(28, 'Newb World Order', 'Выиграть 10 раундов', 10, 'win_round'),
(29, 'Pro-moted', 'Выиграть 200 раундов', 200, 'win_round'),
(30, 'Leet-er of Men', 'Выиграть 5000 раундов', 5000, 'win_round'),
(31, 'Second to None', 'Успешно обезвредить бомбу менее чем за одну секунду до взрыва', 1, '1sek_defusing'),
(32, 'Boomala Boomala', 'Установить 100 бомб', 100, 'bomb_plant'),
(33, 'The Hurt Blocker', 'Обезвредить 100 бомб', 100, 'bomb_defuse'),
(34, 'Ветеран карты Dust2', 'Выиграть 100 раундов на карте de_dust2', 100, 'de_dust2_win_round'),
(35, 'Разрушитель', 'Сломать 500 предметов', 500, 'break'),
(36, 'Ветеран карты Nuke', 'Выиграть 100 раундов на карте de_nuke', 100, 'de_nuke_win_round'),
(37, 'Ветеран карты Temple', 'Выиграть 100 раундов на карте deathrun_temple', 100, 'deathrun_temple_win_round'),
(38, 'Ветеран карты ski 2', 'Выиграть 100 раундов на карте surf_ski_2', 100, 'surf_ski_2_win_round'),
(39, 'Ветеран карты rooftops', 'Выиграть 100 раундов на карте awp_rooftops', 100, 'awp_rooftops_win_round'),
(40, 'Ветеран карты floppytown', 'Выиграть 100 раундов на карте hns_floppytown', 100, 'hns_floppytown_win_round'),
(41, 'НЕФТЬ! Я БОГАТ!', 'Заработать $1,000,000', 1000000, 'money_t'),
(42, 'Halloween time!', 'Собрать 20 мешков с подарками в период с 29.10 по 3.11', 20, 'collect_halloween_present');

-- --------------------------------------------------------

--
-- Структура таблицы `unr_activate`
--

CREATE TABLE IF NOT EXISTS `unr_activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=363 ;

-- --------------------------------------------------------

--
-- Структура таблицы `unr_dr_stats`
--

CREATE TABLE IF NOT EXISTS `unr_dr_stats` (
  `map` varchar(32) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `free` int(1) unsigned NOT NULL,
  KEY `map` (`map`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `unr_players`
--

CREATE TABLE IF NOT EXISTS `unr_players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `lastIp` varchar(20) NOT NULL,
  `lastTime` int(1) NOT NULL,
  `onlineTime` int(1) NOT NULL,
  `steam_id` varchar(32) NOT NULL,
  `amxx_flags` varchar(34) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `webadmin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `icq` int(9) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `auth` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=512 ;
-- --------------------------------------------------------

--
-- Структура таблицы `unr_players_achiev`
--

CREATE TABLE IF NOT EXISTS `unr_players_achiev` (
  `playerId` int(11) NOT NULL,
  `achievId` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `unr_players_var`
--

CREATE TABLE IF NOT EXISTS `unr_players_var` (
  `playerId` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_map_comm`
--

CREATE TABLE `kz_map_comm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_map_rec`
--

CREATE TABLE `kz_map_rec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kz_map_list`
--

CREATE TABLE `kz_map_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура представления `kz_norec`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_norec` AS (
select  `lonis`.`kz_map_list`.`mid` AS `mid`,  `lonis`.`kz_map_list`.`mapname` AS `mapname`,  `tmp`.`id` AS `id`,  `tmp`.`map` AS `map`,  `tmp`.`player` AS `player`,  `tmp`.`time` AS `time`,  `tmp`.`cp` AS `cp`,  `tmp`.`go_cp` AS `go_cp`,  `tmp`.`weapon` AS `weapon` from (`lonis`.`kz_map_list`  left join (select  `lonis`.`kz_map_top`.`id` AS `id`,  `lonis`.`kz_map_top`.`map` AS `map`,  `lonis`.`kz_map_top`.`player` AS `player`,  `lonis`.`kz_map_top`.`time` AS `time`,  `lonis`.`kz_map_top`.`cp` AS `cp`,  `lonis`.`kz_map_top`.`go_cp` AS `go_cp`,  `lonis`.`kz_map_top`.`weapon` AS `weapon`  from `lonis`.`kz_map_top`  group by `lonis`.`kz_map_top`.`map`,`lonis`.`kz_map_top`.`player`) `tmp`  on ((`lonis`.`kz_map_list`.`mapname` = `tmp`.`map`))) order by `lonis`.`kz_map_list`.`mapname`)

-- --------------------------------------------------------

--
-- Структура представления `kz_top1`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_top1` AS (
select  `kz_map_top`.`map` AS `map`,  min(`kz_map_top`.`time`) AS `time` from `kz_map_top` group by `kz_map_top`.`map`)

-- --------------------------------------------------------

--
-- Структура представления `kz_tops`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_tops` AS 
select `tmp`.`id` AS `id`,`tmp`.`map` AS `map`,`tmp`.`player` AS `player`,`tmp`.`time` AS `time`,`tmp`.`cp` AS `cp`,`tmp`.`go_cp` AS `go_cp`,`tmp`.`weapon` AS `weapon`,`lonis`.`unr_players`.`name` AS `name` from (((select `lonis`.`kz_map_top`.`id` AS `id`,`lonis`.`kz_map_top`.`map` AS `map`,`lonis`.`kz_map_top`.`player` AS `player`,`lonis`.`kz_map_top`.`time` AS `time`,`lonis`.`kz_map_top`.`cp` AS `cp`,`lonis`.`kz_map_top`.`go_cp` AS `go_cp`,`lonis`.`kz_map_top`.`weapon` AS `weapon` from (`lonis`.`kz_map_top` join `lonis`.`kz_top1`) where ((`lonis`.`kz_map_top`.`map` = `kz_top1`.`map`) and (`lonis`.`kz_map_top`.`time` = `kz_top1`.`time`)) order by `lonis`.`kz_map_top`.`time`)) `tmp` join `lonis`.`unr_players`) where (`lonis`.`unr_players`.`id` = `tmp`.`player`) group by `tmp`.`map` order by `tmp`.`map`
