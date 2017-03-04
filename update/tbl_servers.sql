/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` (`id`, `mod`, `addres`, `vip`, `name`, `map`, `players`, `max_players`, `update`) VALUES
	(1, 4, '94.198.128.44:27015', 1, '[K.lan] CSDM', 'de_inferno', 2, 20, '2017-03-03 22:50:02'),
	(2, 1, '94.198.128.44:27016', 1, '[K.lan] Classic', 'aim_headshot', 1, 22, '2017-03-03 22:50:02'),
	(3, 9, '94.198.128.44:27017', 1, '[K.lan] Kreedz', 'kzru_en_monochrome', 6, 18, '2017-03-03 22:50:02'),
	(4, 15, '94.198.128.44:27018', 1, '[K.lan] Zombie Plague', '', 0, 0, '2017-03-03 22:50:04'),
	(5, 9, '91.206.202.23:27044', 0, 'TheAbyss 1.6 #39 Jump Bhop', 'fu_sane', 14, 17, '2017-03-03 22:50:02'),
	(6, 9, '91.206.202.20:27017', 0, 'TheAbyss 1.6 #19 Jump KZ', 'cypress_megabl0ck', 10, 17, '2017-03-03 22:50:02'),
	(7, 9, '176.38.158.22:27020', 0, 'Borshaga CS KreedzJump', 'kz_longjumps2', 6, 18, '2017-03-03 22:50:02'),
	(8, 9, '212.76.153.22:27000', 0, 'cs-lords.ru | Jump', 'kzmo_willblock', 4, 10, '2017-03-03 22:50:02'),
	(9, 9, '83.222.97.90:27020', 0, 'Skiller.ru - Jump', 'kzge_upway', 5, 17, '2017-03-03 22:50:02'),
	(10, 9, '83.239.99.132:27018', 0, '|sS| KreedZ', 'jro_simjump_ez', 2, 12, '2017-03-03 22:50:04'),
	(11, 9, '83.222.116.10:27023', 0, 'PPC-ZONE Jump', 'kz_kzsca_bhopindustry', 2, 16, '2017-03-03 22:50:02'),
	(12, 7, '217.106.106.136:27107', 0, 'MakeFrag|floppytown|HNS', 'hns_floppytown', 2, 14, '2017-03-03 22:50:02'),
	(13, 7, '95.31.32.123:27016', 0, 'MakeFrag|HNS_255aa|DM_2016', 'hns_floppytown_pro', 9, 16, '2017-03-03 22:50:02');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;

DROP TABLE IF EXISTS `servers_mod`;
CREATE TABLE IF NOT EXISTS `servers_mod` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(16) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
