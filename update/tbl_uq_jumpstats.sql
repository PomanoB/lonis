/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `info_stats`;
CREATE TABLE IF NOT EXISTS `info_stats` (
  `cvar` varchar(32) NOT NULL,
  `val` varchar(16) NOT NULL,
  UNIQUE KEY `cvar` (`cvar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_block_tops`;
CREATE TABLE IF NOT EXISTS `uq_block_tops` (
  `pid` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `distance` int(10) NOT NULL,
  `jumpoff` int(10) NOT NULL,
  `block` varchar(5) NOT NULL,
  `pspeed` int(3) NOT NULL,
  `wpn` varchar(32) NOT NULL,
  KEY `pid` (`pid`,`type`,`distance`,`jumpoff`,`pspeed`,`wpn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_jumps`;
CREATE TABLE IF NOT EXISTS `uq_jumps` (
  `pid` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `distance` int(10) NOT NULL,
  `maxspeed` int(10) NOT NULL,
  `prestrafe` int(10) NOT NULL,
  `strafes` int(2) NOT NULL,
  `sync` int(3) NOT NULL,
  `ddbh` int(3) NOT NULL DEFAULT '0',
  `pspeed` int(3) NOT NULL,
  `wpn` varchar(32) NOT NULL,
  KEY `pid` (`pid`,`type`,`distance`,`maxspeed`,`prestrafe`,`strafes`,`sync`,`ddbh`,`pspeed`,`wpn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_players`;
CREATE TABLE IF NOT EXISTS `uq_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `authid` varchar(35) NOT NULL,
  `lastseen` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`authid`)
) ENGINE=InnoDB AUTO_INCREMENT=68890 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
