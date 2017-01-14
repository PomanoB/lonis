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

-- Дамп структуры для таблица lonis.servers
DROP TABLE IF EXISTS `servers`;
CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mod` int(10) NOT NULL,
  `addres` varchar(32) NOT NULL,
  `vip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `map` varchar(32) DEFAULT NULL,
  `players` int(4) DEFAULT NULL,
  `max_players` int(4) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.servers: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` (`id`, `mod`, `addres`, `vip`, `name`, `map`, `players`, `max_players`, `update`) VALUES
	(1, 4, '94.198.128.44:27015', 1, '[K.lan] CSDM', '', 0, 0, '2017-01-11 10:54:13'),
	(2, 1, '94.198.128.44:27016', 1, '[K.lan] Classic', 'aim_riverex', 1, 22, '2017-01-11 10:54:13'),
	(3, 9, '94.198.128.44:27017', 1, '[K.lan] Kreedz', 'jro_2way_duck', 0, 18, '2017-01-11 10:54:13'),
	(4, 15, '94.198.128.44:27018', 1, '[K.lan] Zombie Plague', '', 0, 0, '2017-01-11 10:54:13'),
	(5, 9, '91.206.202.23:27044', 0, 'TheAbyss 1.6 #39 Jump Bhop', 'qsk_grayline', 3, 17, '2017-01-11 10:54:13'),
	(6, 9, '91.206.202.20:27017', 0, 'TheAbyss 1.6 #19 Jump KZ', 'kz_xj_brickjump', 1, 17, '2017-01-11 10:54:13'),
	(7, 9, '176.38.158.22:27020', 0, 'Borshaga CS KreedzJump', 'kz_man_nasa', 0, 18, '2017-01-11 10:54:13'),
	(8, 9, '212.76.153.22:27000', 0, 'cs-lords.ru | Jump', 'ad_snowhard', 0, 10, '2017-01-11 10:54:13'),
	(9, 9, '83.222.97.90:27020', 0, 'Skiller.ru - Jump', 'dyd_onlime_ez', 6, 17, '2017-01-11 10:54:13'),
	(10, 9, '83.239.99.132:27018', 0, '|sS| KreedZ', 'kzy_downslide', 1, 12, '2017-01-11 10:54:13'),
	(11, 9, '83.222.116.10:27023', 0, 'PPC-ZONE Jump', 'kz_kx_watercave', 0, 16, '2017-01-11 10:54:13'),
	(12, 9, '46.174.52.5:27208', 0, 'WildHunters', '', 0, 0, '2017-01-11 10:54:13'),
	(13, 7, '217.106.106.136:27107', 0, 'MakeFrag|floppytown|HNS', 'hns_floppytown', 0, 14, '2017-01-11 10:54:13'),
	(14, 7, '95.31.32.123:27016', 0, 'MakeFrag|HNS_255aa|DM_2016', 'hns_floppytown_pro', 2, 16, '2017-01-11 10:54:13');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;

-- Дамп структуры для таблица lonis.servers_mod
DROP TABLE IF EXISTS `servers_mod`;
CREATE TABLE IF NOT EXISTS `servers_mod` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(16) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.servers_mod: ~15 rows (приблизительно)
/*!40000 ALTER TABLE `servers_mod` DISABLE KEYS */;
INSERT INTO `servers_mod` (`mid`, `modname`) VALUES
	(1, 'Classic'),
	(2, 'Public'),
	(3, 'Aim'),
	(4, 'CSDM'),
	(5, 'Deathrun'),
	(6, 'GunGame'),
	(7, 'HNS'),
	(8, 'JailBreak'),
	(9, 'Kreedz'),
	(10, 'Knife'),
	(11, 'SoccerJump'),
	(12, 'SuperHero'),
	(13, 'Surf'),
	(14, 'Warcraft'),
	(15, 'ZombieMod');
/*!40000 ALTER TABLE `servers_mod` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
