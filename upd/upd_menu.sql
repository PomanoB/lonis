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
	(61, 'Kreedz', 'Players', 'kz_players'),
	(60, 'Main', 'Kreedz', 'kz_players'),
	(62, 'Kreedz', 'Maps', 'kz_maps'),
	(63, 'Kreedz', 'Duels', 'kz_duels'),
	(92, 'Admin', 'Servers', 'admin_servers'),
	(92, 'Admin', 'Langs', 'admin_langs'),
	(93, 'Admin', 'Achievs', 'admin_achievs'),
	(91, 'Admin', 'Players', 'admin_players'),
	(68, 'Kreedz', '', 'kz_player'),
	(69, 'Kreedz', '', 'kz_map'),
	(64, 'Kreedz', 'Longjumps', 'kz_longjumps'),
	(70, 'Main', 'Account', 'account'),
	(65, 'Kreedz', 'Records', 'kz_records'),
	(67, 'Kreedz', 'Archive', 'kz_downloads'),
	(90, 'Main', 'Admin', 'admin_players'),
	(66, 'Kreedz', 'LJ Records', 'kz_ljs_recs');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
