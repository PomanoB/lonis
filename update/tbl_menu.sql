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
	(10, 'main', 'home', 'home'),
	(30, 'main', 'servers', 'servers'),
	(40, 'main', 'players', 'players'),
	(50, 'main', 'achievs', 'achievs'),
	(61, 'kreedz', 'kz_players', 'kz_players'),
	(60, 'main', 'kreedz', 'kz_players'),
	(62, 'kreedz', 'kz_maps', 'kz_maps'),
	(63, 'kreedz', 'kz_duels', 'kz_duels'),
	(92, 'admin', 'admin_servers', 'admin_servers'),
	(92, 'admin', 'admin_langs', 'admin_langs'),
	(93, 'admin', 'admin_achievs', 'admin_achievs'),
	(91, 'admin', 'admin_players', 'admin_players'),
	(68, 'kreedz', '', 'kz_player'),
	(69, 'kreedz', '', 'kz_map'),
	(64, 'kreedz', 'kz_longjumps', 'kz_longjumps'),
	(70, 'main', 'account', 'ucp'),
	(65, 'kreedz', 'kz_records', 'kz_records'),
	(66, 'kreedz', 'kz_downloads', 'kz_downloads'),
	(90, 'main', 'admin', 'admin_players');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
