/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `num` int(2) unsigned NOT NULL DEFAULT '0',
  `parent` varchar(16) DEFAULT NULL,
  `mname` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`num`, `parent`, `mname`, `action`) VALUES
	(10, 'Main', 'Home', 'home'),
	(30, 'Main', 'Servers', 'servers'),
	(40, 'Main', 'Players', 'players'),
	(50, 'Main', 'Achievs', 'achiev'),
	(60, 'Kreedz', '', 'kreedz_home'),
	(60, 'Main', 'Kreedz', 'kreedz_home'),
	(63, 'Kreedz', 'Maps', 'kreedz_maps'),
	(64, 'Kreedz', 'Duels', 'kreedz_duels'),
	(92, 'Admin', 'Servers', 'admin_servers'),
	(92, 'Admin', 'Langs', 'admin_langs'),
	(93, 'Admin', 'Achievs', 'admin_achievs'),
	(91, 'Admin', 'Players', 'admin_players'),
	(60, 'Kreedz', '', 'kreedz_player'),
	(60, 'Kreedz', '', 'kreedz_map'),
	(65, 'Kreedz', 'Longjumps', 'kreedz_longjumps'),
	(80, 'Main', 'Account', 'account'),
	(66, 'Kreedz', 'Records', 'kreedz_records'),
	(68, 'Kreedz', '', 'kreedz_downloads'),
	(90, 'Main', 'Admin', 'admin_players'),
	(67, 'Kreedz', 'LJ Records', 'kreedz_ljsrecs'),
	(62, 'Kreedz', 'Players', 'kreedz_players');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
