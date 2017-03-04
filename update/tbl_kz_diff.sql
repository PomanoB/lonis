/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `kz_diff`;
CREATE TABLE IF NOT EXISTS `kz_diff` (
  `id` int(11) unsigned NOT NULL,
  `dpname` varchar(32) NOT NULL,
  `dname` varchar(32) NOT NULL,
  `ddot` int(1) NOT NULL,
  `dcolor` char(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `kz_diff` DISABLE KEYS */;
INSERT INTO `kz_diff` (`id`, `dpname`, `dname`, `ddot`, `dcolor`) VALUES
	(0, 'Unknown', 'Unknown', 0, 'gray'),
	(1, 'Easy', 'Easy', 1, 'limegreen'),
	(2, 'Easy', 'Easy+Average', 2, 'green'),
	(3, 'Average', 'Average', 1, 'yellow'),
	(4, 'Average', 'Average+Hard', 2, 'orange'),
	(5, 'Hard', 'Hard', 1, 'steelblue'),
	(6, 'Hard', 'Hard+Extreme', 2, 'blue'),
	(7, 'Xtreme', 'Xtreme', 1, 'darkred'),
	(8, 'Xtreme', 'Xtreme+Impassable', 2, 'red'),
	(9, 'Xtreme', 'Impassable', 3, 'purple');
/*!40000 ALTER TABLE `kz_diff` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
